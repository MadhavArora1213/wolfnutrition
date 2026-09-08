<?php
// includes/footer.php
require_once __DIR__ . '/functions.php';
?>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <!-- About Info -->
                <div class="footer-about">
                    <a href="index.php" class="logo" style="margin-bottom: 15px;" aria-label="Wolf Nutrition - Home">
                        <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="Wolf Nutrition - Premium Ayurvedic Supplements">
                    </a>
                    <p>Ancient Ayurvedic wisdom engineered for modern male peak performance. Clean, raw formulations with zero hidden fillers.</p>
                </div>

                <!-- Quick Links -->
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="category.php?slug=vitality">Supplements</a></li>
                        <li><a href="category.php?slug=liver-detox">Liver Support & Detox</a></li>
                        <li><a href="about.php">Our Brand Story</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="certificates.php">Quality Certificates</a></li>
                    </ul>
                </div>

                <!-- Policy Links -->
                <div class="footer-links">
                    <h4>Our Policies</h4>
                    <ul>
                        <li><a href="page.php?slug=shipping-policy">Shipping & Delivery</a></li>
                        <li><a href="page.php?slug=refund-policy">Refund & Return Policy</a></li>
                        <li><a href="page.php?slug=privacy-policy">Privacy Policy</a></li>
                        <li><a href="page.php?slug=terms-of-service">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Newsletter Signup -->
                <div class="footer-newsletter">
                    <h4>Join the Pack</h4>
                    <p>Subscribe to receive exclusive discounts, stack guides, and early access to new releases.</p>
                    <form class="newsletter-form" id="footer-nl-form" onsubmit="return handleFooterNewsletterSubmit(event);" style="display:flex; gap:8px;">
                        <input type="email" id="footer-nl-email" required placeholder="Your Email Address" style="flex:1;">
                        <button type="submit" id="footer-nl-btn" class="btn-gold" style="padding:10px 15px;"><i class="fas fa-paper-plane"></i></button>
                    </form>
                    <div id="footer-nl-msg" style="margin-top:8px; font-size:0.75rem; display:none;"></div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="footer-bottom">
                <div>
                    &copy; <?php echo date('Y'); ?> Wolf Nutrition. All Rights Reserved. 
                    <span style="margin-left:15px; color: var(--gold-muted);">FSSAI Reg No: 22126022000063</span>
                </div>
                <!-- Social Icons -->
                <div class="footer-socials">
                    <a href="https://instagram.com/wolfnutrition" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="Follow Wolf Nutrition on Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://facebook.com/wolfnutrition" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="Follow Wolf Nutrition on Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/wolfnutrition" class="social-icon" target="_blank" rel="noopener noreferrer" aria-label="Follow Wolf Nutrition on Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Main Script JS -->
    <script>window.__csrfToken = '<?php echo generate_csrf_token(); ?>';</script>
    <script src="<?php echo BASE_URL; ?>/assets/js/main.js"></script>
    <script>
    function handleFooterNewsletterSubmit(e) {
        e.preventDefault();
        var email = document.getElementById('footer-nl-email').value.trim();
        var btn = document.getElementById('footer-nl-btn');
        var msg = document.getElementById('footer-nl-msg');
        if (!email) return false;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        var fd = new FormData();
        fd.append('email', email);
        fetch('newsletter_subscribe.php', { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                msg.style.display = 'block';
                msg.style.color = data.success ? '#4ade80' : '#ef4444';
                msg.textContent = data.message;
                if (data.success) {
                    btn.innerHTML = '<i class="fas fa-check"></i>';
                    btn.style.background = 'linear-gradient(135deg, #4ade80, #22c55e)';
                } else {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane"></i>';
                }
                setTimeout(function() { msg.style.display = 'none'; }, 4000);
            })
            .catch(function() {
                msg.style.display = 'block';
                msg.style.color = '#ef4444';
                msg.textContent = 'Something went wrong.';
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane"></i>';
            });
        return false;
    }
    </script>

    <!-- Sticky WhatsApp Button -->
    <a href="https://wa.me/919779450455?text=Hi%20Wolf%20Nutrition,%20I%20have%20a%20question." target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp" style="position:fixed; bottom:24px; right:24px; width:60px; height:60px; background:#25D366; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 20px rgba(37,211,102,0.4); z-index:9999; transition:transform 0.3s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="#fff"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    </a>

</body>
</html>
