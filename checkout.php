<?php
// checkout.php
require_once __DIR__ . '/includes/header.php';

$cart_items = get_cart_items();
if (empty($cart_items)) {
    header("Location: index.php");
    exit();
}

$payment_method = 'UPI';
$totals = get_cart_totals($payment_method);
$checkout_error = '';
?>

<style>
@media(max-width:900px){
    body{overflow-x:hidden;}
    .checkout-grid{grid-template-columns:1fr !important; gap:24px !important;}
    .summary-sidebar{position:static !important;}
    .section-header h2{font-size:1.5rem !important; letter-spacing:0.5px !important;}
    .section-header p{font-size:0.85rem !important;}
    .checkout-section-box{padding:20px !important; border-radius:14px !important;}
    .checkout-section-box h3{font-size:1rem !important; margin-bottom:14px !important;}
    .form-row{grid-template-columns:1fr !important; gap:14px !important;}
    .form-control{padding:11px 14px !important; font-size:0.88rem !important;}
    .form-group label{font-size:0.8rem !important;}
    .payment-label{font-size:0.85rem !important; flex-wrap:wrap;}
}
@media(max-width:600px){
    .container{padding:0 12px !important; width:95% !important;}
    .checkout-section-box{padding:16px !important;}
    .summary-sidebar{padding:18px !important; border-radius:14px !important;}
    .summary-sidebar h3{font-size:1rem !important;}
    .summary-line-item{font-size:0.85rem !important;}
    .summary-total{font-size:1.05rem !important;}
    .btn-gold{font-size:0.95rem !important; padding:14px !important;}
}
</style>

    <div class="container" style="margin-top: 40px; margin-bottom: 60px;">
        <div class="section-header">
            <h2>Secure Checkout</h2>
            <p>Complete your shipping and billing details below</p>
        </div>

        <?php if ($checkout_error): ?>
            <div class="quantity-discount-widget" style="background-color:rgba(255,255,255,0.05); border-color:rgba(255,255,255,0.15); color:var(--danger-color); margin-bottom:20px;">
                ❌ <?php echo htmlspecialchars($checkout_error); ?>
            </div>
        <?php endif; ?>

        <form action="payu_initiate.php" method="POST" id="checkout-form">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="payment_method" value="UPI">
            <div class="checkout-grid">
                
                <!-- Shipping Address Form -->
                <div>
                    <div class="checkout-section-box" id="new-address-form-box">
                        <h3>Shipping Details</h3>
                        
                        <div class="form-group">
                            <label for="customer_name">Full Name *</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" value="" placeholder="Enter recipient's full name">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="customer_email">Email Address *</label>
                                <input type="email" name="customer_email" id="customer_email" class="form-control" value="" placeholder="For order receipt & tracking link">
                            </div>
                            <div class="form-group">
                                <label for="customer_phone">Phone Number *</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="" placeholder="10-digit mobile number" maxlength="10">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address_line1">Street Address *</label>
                            <input type="text" name="address_line1" id="address_line1" class="form-control" placeholder="House number, apartment, street name" style="margin-bottom:10px;">
                            <input type="text" name="address_line2" id="address_line2" class="form-control" placeholder="Landmark, suite, floor etc (optional)">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City / Town *</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="e.g. Jalandhar">
                            </div>
                            <div class="form-group">
                                <label for="state">State *</label>
                                <input type="text" name="state" id="state" class="form-control" placeholder="e.g. Punjab">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="pincode">Pincode *</label>
                                <input type="text" name="pincode" id="pincode" class="form-control" placeholder="6-digit India Pincode" maxlength="6">
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" value="India" readonly disabled style="background:rgba(255,255,255,0.1); border-color:rgba(255,255,255,0.15);">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary Sidebar -->
                <aside class="summary-sidebar">
                    <h3>Order Summary</h3>
                    
                    <div id="checkout-cart-items" style="border-bottom:1px solid var(--border-color); padding-bottom:15px; margin-bottom:15px;">
                        <?php foreach ($cart_items as $key => $item): ?>
                            <div class="checkout-item" data-key="<?php echo htmlspecialchars($key); ?>" style="display:flex; justify-content:space-between; align-items:center; padding:8px 0; font-size:0.85rem; gap:8px;">
                                <div style="flex:1; min-width:0;">
                                    <div style="font-weight:700; color:#fff; font-size:0.82rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"><?php echo htmlspecialchars($item['name']); ?></div>
                                    <div style="color:var(--text-muted); font-size:0.7rem; margin-top:2px;"><?php echo htmlspecialchars($item['size']); ?></div>
                                    <div style="font-weight:700; color:var(--gold-primary); font-size:0.8rem; margin-top:3px;">₹<?php echo number_format($item['price'], 2); ?>/qty</div>
                                </div>
                                <div style="display:flex; flex-direction:column; align-items:flex-end; gap:4px; flex-shrink:0;">
                                    <div style="display:inline-flex; align-items:center; border:1px solid var(--border-color); border-radius:6px; overflow:hidden;">
                                        <button type="button" onclick="checkoutUpdateQty('<?php echo htmlspecialchars($key); ?>', <?php echo $item['qty'] - 1; ?>)" style="width:24px; height:24px; border:none; background:transparent; color:#fff; cursor:pointer; font-size:0.75rem;">-</button>
                                        <span style="width:22px; text-align:center; font-weight:700; font-size:0.75rem;"><?php echo $item['qty']; ?></span>
                                        <button type="button" onclick="checkoutUpdateQty('<?php echo htmlspecialchars($key); ?>', <?php echo $item['qty'] + 1; ?>)" style="width:24px; height:24px; border:none; background:transparent; color:#fff; cursor:pointer; font-size:0.75rem;">+</button>
                                    </div>
                                    <button type="button" onclick="checkoutRemoveItem('<?php echo htmlspecialchars($key); ?>')" style="background:none; border:none; color:var(--danger-color, #e74c3c); font-size:0.68rem; cursor:pointer; padding:0;">
                                        <i class="fas fa-trash-alt"></i> Remove
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="summary-line-item">
                        <span>Cart Subtotal:</span>
                        <span>₹<?php echo number_format($totals['subtotal'], 2); ?></span>
                    </div>

                    <?php if ($totals['quantity_discount'] > 0 || $totals['coupon_discount'] > 0): ?>
                        <div class="summary-line-item discount">
                            <span>Discounts Applied:</span>
                            <span>-₹<?php echo number_format($totals['quantity_discount'] + $totals['coupon_discount'], 2); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="summary-line-item" id="summary-shipping-row">
                        <span>Shipping:</span>
                        <span id="summary-shipping-val"><?php echo $totals['shipping'] > 0 ? "₹" . number_format($totals['shipping'], 2) : "FREE"; ?></span>
                    </div>

                    <div class="summary-total">
                        <span>Grand Total:</span>
                        <span id="summary-total-val">₹<?php echo number_format($totals['total'], 2); ?></span>
                    </div>

                    <button type="button" name="place_order" class="btn-gold" id="place-order-btn" style="width:100%; margin-top:25px; padding:15px; font-size:1.1rem;">
                        <i class="fas fa-lock" style="margin-right:8px;"></i> PAY NOW SECURELY
                    </button>
                    <p style="text-align:center; font-size:0.75rem; color:var(--text-muted); margin-top:10px;">
                        <i class="fas fa-shield-alt"></i> SSL secure payments. Formulated under strict FSSAI guidelines.
                    </p>
                </aside>
            </div>
        </form>
    </div>

    <script>
        // ── PayU Payment Flow ──
        var placeOrderBtn = document.getElementById('place-order-btn');
        if (placeOrderBtn) {
            placeOrderBtn.addEventListener('click', function(e) {
                e.preventDefault();
                var form = document.getElementById('checkout-form');
                var requiredFields = ['customer_name', 'customer_email', 'customer_phone', 'address_line1', 'city', 'state', 'pincode'];
                for (var i = 0; i < requiredFields.length; i++) {
                    var field = form.querySelector('[name="' + requiredFields[i] + '"]');
                    if (field && !field.value.trim()) {
                        field.focus();
                        alert('Please fill in all required fields.');
                        return;
                    }
                }
                placeOrderBtn.disabled = true;
                placeOrderBtn.textContent = 'Processing...';
                form.submit();
            });
        }

        var checkoutCsrfToken = '<?php echo generate_csrf_token(); ?>';

        function checkoutUpdateQty(key, qty) {
            if (qty < 1) {
                checkoutRemoveItem(key);
                return;
            }
            var fd = new URLSearchParams();
            fd.append('action', 'update');
            fd.append('key', key);
            fd.append('qty', qty);
            fd.append('csrf_token', checkoutCsrfToken);

            fetch('cart_api.php', { method: 'POST', body: fd })
                .then(function(r) { return r.json(); })
                .then(function(d) {
                    if (d.success) {
                        location.reload();
                    } else {
                        alert(d.message || 'Update failed');
                    }
                })
                .catch(function() { alert('Network error'); });
        }

        function checkoutRemoveItem(key) {
            if (!confirm('Remove this item?')) return;
            var fd = new URLSearchParams();
            fd.append('action', 'remove');
            fd.append('key', key);
            fd.append('csrf_token', checkoutCsrfToken);

            fetch('cart_api.php', { method: 'POST', body: fd })
                .then(function(r) { return r.json(); })
                .then(function(d) {
                    if (d.success) {
                        location.reload();
                    } else {
                        alert(d.message || 'Remove failed');
                    }
                })
                .catch(function() { alert('Network error'); });
        }

    </script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
