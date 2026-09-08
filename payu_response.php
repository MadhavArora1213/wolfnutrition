<?php
// payu_response.php — Handle PayU payment callback
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/env.php';

$payu_key  = getenv('PAYU_KEY');
$payu_salt = getenv('PAYU_SALT');

// PayU sends status via POST (success) or GET/POST (failure)
$status   = $_POST['status'] ?? $_GET['status'] ?? '';
$txnid     = $_POST['txnid'] ?? $_GET['txnid'] ?? '';
$payu_mihpayid = $_POST['mihpayid'] ?? $_GET['mihpayid'] ?? '';
$amount    = $_POST['amount'] ?? $_GET['amount'] ?? '';
$productinfo = $_POST['productinfo'] ?? $_GET['productinfo'] ?? '';
$firstname = $_POST['firstname'] ?? $_GET['firstname'] ?? '';
$email     = $_POST['email'] ?? $_GET['email'] ?? '';
$udf1      = $_POST['udf1'] ?? $_GET['udf1'] ?? '';  // order_number
$udf2      = $_POST['udf2'] ?? $_GET['udf2'] ?? '';  // payment_method
$udf3      = $_POST['udf3'] ?? $_GET['udf3'] ?? '';
$udf4      = $_POST['udf4'] ?? $_GET['udf4'] ?? '';
$udf5      = $_POST['udf5'] ?? $_GET['udf5'] ?? '';
$payu_hash = $_POST['hash'] ?? $_GET['hash'] ?? '';

if (empty($txnid)) {
    header("Location: index.php");
    exit();
}

// ─── Verify Hash ──────────────────────────────────────
// Response hash: SHA512(SALT|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|KEY)
$verify_string = $payu_salt . '|' . $status . '||||||' . $udf5 . '|' . $udf4 . '|' . $udf3 . '|' . $udf2 . '|' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $payu_key;
$verify_hash = hash('sha512', $verify_string);

$hash_valid = hash_equals($verify_hash, $payu_hash);

// ─── Update Order Status ─────────────────────────────
$order_number = $udf1;
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_number = ?");
$stmt->execute([$txnid]);
$order = $stmt->fetch();

if (!$order) {
    die("Order not found. Please contact support.");
}

if ($hash_valid && strtolower($status) === 'success') {
    // Payment success
    $pdo->prepare("UPDATE orders SET payment_status = 'paid', payu_txnid = ? WHERE id = ?")->execute([$payu_mihpayid, $order['id']]);
    clear_cart();
    unset($_SESSION['cart_notes']);

    header("Location: order-confirmation.php?order_number=" . urlencode($order_number));
    exit();
} else {
    // Payment failed — delete the order so user can retry
    $pdo->prepare("UPDATE orders SET payment_status = 'failed' WHERE id = ?")->execute([$order['id']]);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Payment Failed - Wolf Nutrition</title>
        <style>
            body { background: #0d0d0d; color: #fff; font-family: 'Segoe UI', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; }
            .fail-box { background: #1a1a1a; border: 1px solid #ff4444; border-radius: 12px; padding: 40px; text-align: center; max-width: 480px; }
            .fail-box h1 { color: #ff4444; font-size: 2rem; margin-bottom: 10px; }
            .fail-box p { color: rgba(255,255,255,0.7); margin-bottom: 25px; }
            .btn { display: inline-block; padding: 12px 30px; border-radius: 6px; text-decoration: none; font-weight: 700; margin: 0 8px; }
            .btn-gold { background: #D4AF37; color: #000; }
            .btn-outline { border: 1px solid #D4AF37; color: #D4AF37; }
        </style>
    </head>
    <body>
        <div class="fail-box">
            <h1>Payment Failed</h1>
            <p>Your payment could not be processed. The order has been cancelled. Please try again.</p>
            <a href="checkout.php" class="btn btn-gold">Retry Payment</a>
            <a href="cart.php" class="btn btn-outline">Back to Cart</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}
