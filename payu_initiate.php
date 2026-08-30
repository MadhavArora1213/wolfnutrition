<?php
// payu_initiate.php — Create order & submit to PayU Gateway
session_start();
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/env.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit();
}

if (!verify_csrf_token()) {
    header("Location: checkout.php");
    exit();
}

$payu_key    = trim(getenv('PAYU_KEY'));
$payu_salt   = trim(getenv('PAYU_SALT'));

if (empty($payu_key) || empty($payu_salt)) {
    die("Payment gateway not configured. Please contact support.");
}

// Collect form data
$payment_method = $_POST['payment_method'] ?? 'UPI';
$cust_name    = sanitize_string($_POST['customer_name'] ?? '');
$cust_email   = sanitize_email($_POST['customer_email'] ?? '');
$cust_phone   = preg_replace('/[^0-9]/', '', trim($_POST['customer_phone'] ?? ''));
$pincode      = preg_replace('/[^0-9]/', '', trim($_POST['pincode'] ?? ''));
$address_line1 = sanitize_string($_POST['address_line1'] ?? '');
$address_line2 = sanitize_string($_POST['address_line2'] ?? '');
$city         = sanitize_string($_POST['city'] ?? '');
$state        = sanitize_string($_POST['state'] ?? '');
$note         = sanitize_string($_SESSION['cart_notes'] ?? '');

$user = get_logged_in_user();

// Address selection from saved
if ($user && isset($_POST['selected_address_id']) && $_POST['selected_address_id'] !== 'new') {
    $addr_id = (int)$_POST['selected_address_id'];
    $stmt_a = $pdo->prepare("SELECT * FROM user_addresses WHERE id = ? AND user_id = ?");
    $stmt_a->execute([$addr_id, $user['id']]);
    $addr = $stmt_a->fetch();
    if ($addr) {
        $cust_name = $addr['name'];
        $cust_phone = $addr['phone'];
        $pincode = $addr['pincode'];
        $address_line1 = $addr['address_line1'];
        $address_line2 = $addr['address_line2'];
        $city = $addr['city'];
        $state = $addr['state'];
    }
}

// Basic validation
if (empty($cust_name) || empty($cust_email) || empty($cust_phone) || empty($pincode) || empty($address_line1) || empty($city) || empty($state)) {
    die("Please fill in all required shipping details.");
}
if (!filter_var($cust_email, FILTER_VALIDATE_EMAIL)) {
    die("Please enter a valid email address.");
}
if (!preg_match('/^[1-9][0-9]{5}$/', $pincode)) {
    die("Please enter a valid 6-digit India Pincode.");
}
if (!preg_match('/^[6-9][0-9]{9}$/', $cust_phone)) {
    die("Please enter a valid 10-digit mobile number.");
}

// Get cart
$cart_items = get_cart_items();
if (empty($cart_items)) {
    header("Location: index.php");
    exit();
}

$totals = get_cart_totals($payment_method);

// Build full address
$full_address = $address_line1;
if (!empty($address_line2)) $full_address .= ', ' . $address_line2;
$full_address .= ", {$city}, {$state} - {$pincode}";

// ─── Create order in DB ───────────────────────────────
try {
    $pdo->beginTransaction();

    $order_number = 'WN-' . time() . '-' . rand(1000, 9999);
    $user_id = $user ? $user['id'] : null;

    $stmt_o = $pdo->prepare("
        INSERT INTO orders (user_id, order_number, subtotal, discount, shipping, total, payment_method, payment_status, customer_name, customer_email, customer_phone, shipping_address, pincode, note)
        VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?, ?, ?, ?, ?)
    ");
    $stmt_o->execute([
        $user_id,
        $order_number,
        $totals['subtotal'],
        $totals['quantity_discount'] + $totals['coupon_discount'],
        $totals['shipping'],
        $totals['total'],
        $payment_method,
        $cust_name,
        $cust_email,
        $cust_phone,
        $full_address,
        $pincode,
        $note
    ]);

    $order_id = $pdo->lastInsertId();

    // Insert order items & deduct stock
    foreach ($cart_items as $item) {
        $variant_id = isset($item['variant_id']) ? $item['variant_id'] : null;
        $bundle_id  = isset($item['bundle_id'])  ? $item['bundle_id']  : null;

        $stmt_i = $pdo->prepare("
            INSERT INTO order_items (order_id, product_id, variant_id, bundle_id, product_name, variant_name, price, quantity)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt_i->execute([
            $order_id,
            isset($item['product_id']) ? $item['product_id'] : 0,
            $variant_id,
            $bundle_id,
            $item['name'],
            $item['size'],
            $item['price'],
            $item['qty']
        ]);

        if ($variant_id) {
            $pdo->prepare("UPDATE product_variants SET stock_qty = stock_qty - ? WHERE id = ?")->execute([$item['qty'], $variant_id]);
        }

        if ($bundle_id) {
            $stmt_b = $pdo->prepare("SELECT variant_id FROM bundle_items WHERE bundle_id = ?");
            $stmt_b->execute([$bundle_id]);
            foreach ($stmt_b->fetchAll() as $bi) {
                $pdo->prepare("UPDATE product_variants SET stock_qty = stock_qty - ? WHERE id = ?")->execute([$item['qty'], $bi['variant_id']]);
            }
        }
    }

    // Update coupon usage
    if ($totals['coupon_code']) {
        $pdo->prepare("UPDATE coupons SET used_count = used_count + 1 WHERE code = ?")->execute([$totals['coupon_code']]);
    }

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    error_log("PayU initiate error: " . $e->getMessage());
    die("Failed to create order. Please try again.");
}

// ─── Generate PayU Hash & Submit Form ─────────────────
$txnid      = $order_number;
$productinfo = 'Wolf Nutrition Order ' . $order_number;
$amount     = number_format($totals['total'], 2, '.', '');
$returnurl  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/wolfnutrition/payu_response.php';
$surl       = $returnurl;
$furl       = $returnurl;

// PayU hash: sha512(key|txnid|amount|productinfo|firstname|email|udf1|udf2|||||||||SALT)
$hash_string = $payu_key . '|' . $txnid . '|' . $amount . '|' . $productinfo . '|' . $cust_name . '|' . $cust_email . '|' . $order_number . '|' . $payment_method . '|' . '' . '|' . '' . '|' . '' . '||||||' . $payu_salt;
$hash = hash('sha512', $hash_string);
?>
<!DOCTYPE html>
<html>
<head><title>Redirecting to Payment...</title></head>
<body>
    <center>
        <h2>Redirecting to PayU Payment Gateway...</h2>
        <p>Please wait, do not refresh this page.</p>
        <form method="POST" action="https://secure.payu.in/_payment" id="payu-form">
            <input type="hidden" name="key" value="<?php echo htmlspecialchars($payu_key); ?>">
            <input type="hidden" name="txnid" value="<?php echo htmlspecialchars($txnid); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <input type="hidden" name="productinfo" value="<?php echo htmlspecialchars($productinfo); ?>">
            <input type="hidden" name="firstname" value="<?php echo htmlspecialchars($cust_name); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($cust_email); ?>">
            <input type="hidden" name="phone" value="<?php echo htmlspecialchars($cust_phone); ?>">
            <input type="hidden" name="surl" value="<?php echo htmlspecialchars($surl); ?>">
            <input type="hidden" name="furl" value="<?php echo htmlspecialchars($furl); ?>">
            <input type="hidden" name="hash" value="<?php echo htmlspecialchars($hash); ?>">
            <input type="hidden" name="udf1" value="<?php echo htmlspecialchars($order_number); ?>">
            <input type="hidden" name="udf2" value="<?php echo htmlspecialchars($payment_method); ?>">
            <noscript><button type="submit">Continue to Payment</button></noscript>
        </form>
    </center>
    <script>document.getElementById('payu-form').submit();</script>
</body>
</html>
