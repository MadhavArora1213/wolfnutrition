<?php
// includes/header.php
require_once __DIR__ . '/functions.php';

$announcements = get_announcements();
$cart_count = get_cart_count();
$active_page = basename($_SERVER['PHP_SELF']);

// Dynamic SEO & Metatag Engine
$seo_title = "Wolf Nutrition | Premium Ayurvedic Performance & Vitality Stacks";
$seo_desc = "Wolf Nutrition merges ancient Ayurvedic wisdom with modern sports science. Buy certified Shilajit, Ashwagandha, and Kutki stacks for stamina and liver support.";
$seo_keywords = "wolf nutrition, ayurvedic supplements india, shilajit capsules, ashwagandha, liver support kutki, wolftox liver detox, wolfpack vitality, ayurvedic stamina gainer, veggie capsules fssai certified";
$seo_og_type = "website";
$canonical_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ($active_page === 'product.php' && isset($_GET['slug'])) {
    $prod_slug = $_GET['slug'];
    $stmt = $pdo->prepare("SELECT name, short_description FROM products WHERE slug = ?");
    $stmt->execute([$prod_slug]);
    $prod_seo = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($prod_seo) {
        $seo_title = htmlspecialchars($prod_seo['name']) . " | Buy Online | Wolf Nutrition";
        $seo_desc = htmlspecialchars(strip_tags($prod_seo['short_description']));
        $seo_keywords = htmlspecialchars(strtolower($prod_seo['name'])) . ", buy online, ayurvedic premium performance";
    }
} elseif ($active_page === 'category.php' && isset($_GET['slug'])) {
    $cat_slug = $_GET['slug'];
    if ($cat_slug === 'vitality') {
        $seo_title = "Ayurvedic Performance & Vitality Supplements | Wolf Nutrition";
        $seo_desc = "Shop premium Ayurvedic vitality capsules containing pure Himalayan Shilajit, Ashwagandha, Gokshura, and Safed Musli extracts.";
    } elseif ($cat_slug === 'liver-detox') {
        $seo_title = "Liver Support & Detox Stacks | Wolf Nutrition";
        $seo_desc = "Protect your liver enzymes and cleanse toxins. Shop Kutki, Milk Thistle, and Kalmegh Ayurvedic liver support capsules.";
    }
} elseif ($active_page === 'about.php') {
    $seo_title = "Our Brand Story & Philosophy | Wolf Nutrition";
    $seo_desc = "Discover how Wolf Nutrition bridges the gap between ancient Ayurvedic botanicals and the rigorous demands of modern active life.";
} elseif ($active_page === 'contact.php') {
    $seo_title = "Contact Us & Expert Support | Wolf Nutrition";
    $seo_desc = "Get in touch with Wolf Nutrition. Ask questions about your stacks, shipping, or book your free dietitian Ayurvedic call.";
} elseif ($active_page === 'blog-post.php' && isset($_GET['slug'])) {
    $blog_slug = $_GET['slug'];
    $stmt_blog = $pdo->prepare("SELECT title, body, cover_image, category_tag, excerpt FROM blog_posts WHERE slug = ? AND status = 1");
    $stmt_blog->execute([$blog_slug]);
    $blog_seo = $stmt_blog->fetch(PDO::FETCH_ASSOC);
    if ($blog_seo) {
        $seo_title = htmlspecialchars($blog_seo['title']) . " | Wolf Nutrition Blog";
        $blog_excerpt = !empty($blog_seo['excerpt']) ? $blog_seo['excerpt'] : strip_tags($blog_seo['body']);
        $seo_desc = htmlspecialchars(substr($blog_excerpt, 0, 160));
        $seo_keywords = htmlspecialchars($blog_seo['category_tag']) . ", wolf nutrition, ayurvedic, wellness, blog";
        $blog_og_image = !empty($blog_seo['cover_image']) ? $blog_seo['cover_image'] : 'assets/images/logo.png';
        $seo_og_type = "article";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo $seo_title; ?></title>
    <meta name="description" content="<?php echo $seo_desc; ?>">
    <meta name="keywords" content="<?php echo $seo_keywords; ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo $canonical_url; ?>">

    <!-- Open Graph / Facebook / Instagram -->
    <meta property="og:type" content="<?php echo $seo_og_type; ?>">
    <meta property="og:url" content="<?php echo $canonical_url; ?>">
    <meta property="og:title" content="<?php echo $seo_title; ?>">
    <meta property="og:description" content="<?php echo $seo_desc; ?>">
    <meta property="og:image" content="<?php echo ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . (isset($blog_og_image) ? $blog_og_image : 'assets/images/logo.png'); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Wolf Nutrition">
    <meta property="og:locale" content="en_IN">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo $canonical_url; ?>">
    <meta name="twitter:title" content="<?php echo $seo_title; ?>">
    <meta name="twitter:description" content="<?php echo $seo_desc; ?>">
    <meta name="twitter:image" content="<?php echo ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . (isset($blog_og_image) ? $blog_og_image : 'assets/images/logo.png'); ?>">

    <!-- Mobile Browser Theme Color -->
    <meta name="theme-color" content="#080C10">

    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- JSON-LD Structured Data for Search Engine rich snippets -->
    <script type="application/ld+json">
    <?php
    $site_base = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    $logo_url = $site_base . '/assets/images/logo.png';

    if ($active_page === 'product.php' && isset($prod_seo)) {
        echo json_encode([
            "@context" => "https://schema.org/",
            "@type" => "Product",
            "name" => $prod_seo['name'],
            "image" => $logo_url,
            "description" => $seo_desc,
            "brand" => [
                "@type" => "Brand",
                "name" => "Wolf Nutrition"
            ],
            "offers" => [
                "@type" => "AggregateOffer",
                "url" => $canonical_url,
                "priceCurrency" => "INR",
                "lowPrice" => "899.00",
                "highPrice" => "1999.00",
                "offerCount" => "1"
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    } elseif ($active_page === 'blog-post.php' && isset($blog_seo)) {
        echo json_encode([
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $blog_seo['title'],
            "description" => $seo_desc,
            "image" => !empty($blog_seo['cover_image']) ? $site_base . '/' . $blog_seo['cover_image'] : $logo_url,
            "author" => [
                "@type" => "Organization",
                "name" => "Wolf Nutrition"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "Wolf Nutrition",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => $logo_url
                ]
            ],
            "datePublished" => date('c', strtotime($blog_seo['published_at'] ?? 'now')),
            "mainEntityOfPage" => $canonical_url
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    } elseif ($active_page === 'index.php') {
        echo json_encode([
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "WebSite",
                    "name" => "Wolf Nutrition",
                    "url" => $site_base,
                    "potentialAction" => [
                        "@type" => "SearchAction",
                        "target" => [
                            "@type" => "EntryPoint",
                            "urlTemplate" => $site_base . "/search_api.php?q={search_term_string}"
                        ],
                        "query-input" => "required name=search_term_string"
                    ]
                ],
                [
                    "@type" => "Organization",
                    "name" => "Wolf Nutrition",
                    "url" => $site_base,
                    "logo" => $logo_url,
                    "description" => "Premium Ayurvedic supplements for vitality, stamina, and liver support. 100% Ayurvedic, FSSAI certified, lab-tested formulations.",
                    "foundingDate" => "2024",
                    "contactPoint" => [
                        "@type" => "ContactPoint",
                        "telephone" => "+91-9779450455",
                        "contactType" => "customer service",
                        "availableLanguage" => "English"
                    ],
                    "sameAs" => [
                        "https://instagram.com/wolfnutrition",
                        "https://facebook.com/wolfnutrition"
                    ],
                    "address" => [
                        "@type" => "PostalAddress",
                        "addressCountry" => "IN"
                    ]
                ],
                [
                    "@type" => "WebPage",
                    "@id" => $canonical_url,
                    "name" => $seo_title,
                    "description" => $seo_desc,
                    "isPartOf" => [
                        "@type" => "WebSite",
                        "name" => "Wolf Nutrition",
                        "url" => $site_base
                    ],
                    "breadcrumb" => [
                        "@type" => "BreadcrumbList",
                        "itemListElement" => [
                            [
                                "@type" => "ListItem",
                                "position" => 1,
                                "name" => "Home",
                                "item" => $site_base
                            ]
                        ]
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    } else {
        echo json_encode([
            "@context" => "https://schema.org",
            "@type" => "Organization",
            "name" => "Wolf Nutrition",
            "url" => $site_base,
            "logo" => $logo_url,
            "description" => "Premium Ayurvedic supplements for vitality, stamina, and liver support.",
            "sameAs" => [
                "https://facebook.com/wolfnutrition",
                "https://instagram.com/wolfnutrition"
            ]
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
    ?>
    </script>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Header CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/header-clean.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>

<script>
document.addEventListener('DOMContentLoaded', function() {

    /* ── Mobile menu ── */
    var menuBtn  = document.getElementById('mobileMenuBtn');
    var mobileNav = document.getElementById('mobileNav');
    var overlay  = document.getElementById('mobileOverlay');
    var closeBtn = document.getElementById('mobileCloseBtn');

    function openMobile() {
        mobileNav.classList.add('open');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeMobile() {
        mobileNav.classList.remove('open');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    if (menuBtn)  menuBtn.addEventListener('click', openMobile);
    if (closeBtn) closeBtn.addEventListener('click', closeMobile);
    if (overlay)  overlay.addEventListener('click', closeMobile);
    document.querySelectorAll('.mobile-nav-links a').forEach(function(l){ l.addEventListener('click', closeMobile); });

    /* ── SHOP mega menu ── */
    var shopTrigger  = document.getElementById('shopTrigger');
    var megaMenu     = document.getElementById('megaMenu');
    var megaBackdrop = document.getElementById('megaBackdrop');
    var isOpen       = false;

    function setMegaTop() {
        if (!megaMenu) return;
        var header = document.getElementById('mainHeader');
        megaMenu.style.top = header.getBoundingClientRect().bottom + 'px';
    }

    // Pre-calculate on load so first click is instant
    setMegaTop();

    function openMega() {
        isOpen = true;
        setMegaTop();
        megaMenu.classList.add('open');
        megaBackdrop.classList.add('active');
        shopTrigger.setAttribute('aria-expanded', 'true');
        megaMenu.setAttribute('aria-hidden', 'false');
        shopTrigger.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }
    function closeMega() {
        isOpen = false;
        megaMenu.classList.remove('open');
        megaBackdrop.classList.remove('active');
        shopTrigger.setAttribute('aria-expanded', 'false');
        megaMenu.setAttribute('aria-hidden', 'true');
        shopTrigger.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    if (shopTrigger) {
        shopTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            isOpen ? closeMega() : openMega();
        });
    }
    if (megaBackdrop) {
        megaBackdrop.addEventListener('click', closeMega);
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isOpen) closeMega();
    });
    document.querySelectorAll('.mega-menu a').forEach(function(l) {
        l.addEventListener('click', closeMega);
    });
    window.addEventListener('scroll', function() {
        if (isOpen) setMegaTop();
    }, { passive: true });
});
</script>

    <!-- Premium Navbar -->
    <header id="mainHeader">
        <div class="header-inner">

            <!-- LEFT: SHOP trigger -->
            <div class="header-left">
                <button class="shop-trigger" id="shopTrigger" aria-expanded="false" aria-haspopup="true">
                    <span class="shop-trigger-icon" id="shopTriggerIcon">
                        <span></span><span></span><span></span>
                    </span>
                    <span class="shop-trigger-label">SHOP</span>
                </button>
            </div>

            <!-- CENTER: Logo -->
            <a href="index.php" class="logo-center" aria-label="Wolf Nutrition - Home">
                <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="Wolf Nutrition">
                <div class="logo-wordmark">WOLF <span>NUTRITION</span></div>
            </a>

            <!-- RIGHT: Icons -->
            <div class="header-right">
                <button class="nav-icon search-trigger" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
                <a href="<?php echo is_logged_in() ? 'my-account.php' : 'login.php'; ?>" class="nav-icon" aria-label="<?php echo is_logged_in() ? 'My Account' : 'Login'; ?>">
                    <i class="fas fa-user"></i>
                    <?php if (is_logged_in()): ?><span class="nav-icon-dot"></span><?php endif; ?>
                </a>
                <button class="nav-icon cart-drawer-trigger" aria-label="Cart">
                    <i class="fas fa-bag-shopping"></i>
                    <span class="cart-badge" style="<?php echo $cart_count > 0 ? 'display:flex;' : 'display:none;'; ?>">
                        <?php echo $cart_count; ?>
                    </span>
                </button>
                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" id="mobileMenuBtn" aria-label="Open menu">
                    <span></span><span></span><span></span>
                </button>
            </div>

        </div>

        <!-- MEGA MENU PANEL -->
        <div class="mega-menu" id="megaMenu" aria-hidden="true">
            <div class="mega-menu-inner">

                <!-- Left: Main nav links -->
                <div class="mega-col mega-col-categories">
                    <p class="mega-featured-label">Browse</p>
                    <ul class="mega-category-list">
                        <li class="<?php echo ($active_page === 'category.php' && isset($_GET['slug']) && $_GET['slug'] === 'vitality') ? 'mega-active' : ''; ?>">
                            <a href="category.php?slug=vitality">Supplements</a>
                        </li>
                        <li class="<?php echo ($active_page === 'category.php' && isset($_GET['slug']) && $_GET['slug'] === 'liver-detox') ? 'mega-active' : ''; ?>">
                            <a href="category.php?slug=liver-detox">Liver Support &amp; Detox</a>
                        </li>
                        <li class="<?php echo $active_page === 'about.php' ? 'mega-active' : ''; ?>">
                            <a href="about.php">About Us</a>
                        </li>
                        <li class="<?php echo $active_page === 'contact.php' ? 'mega-active' : ''; ?>">
                            <a href="contact.php">Contact</a>
                        </li>
                        <li class="<?php echo $active_page === 'blog.php' ? 'mega-active' : ''; ?>">
                            <a href="blog.php">Wellness Blog</a>
                        </li>
                        <li class="<?php echo $active_page === 'certificates.php' ? 'mega-active' : ''; ?>">
                            <a href="certificates.php">Certifications</a>
                        </li>
                        <li class="mega-shop-all"><a href="category.php?slug=vitality">Shop All</a></li>
                    </ul>
                </div>

                <!-- Divider -->
                <div class="mega-divider"></div>

                <!-- Middle: Product quick links -->
                <div class="mega-col mega-col-links">
                    <p class="mega-featured-label">Our Products</p>
                    <ul class="mega-quick-links">
                        <li><a href="product.php?slug=wolfpack-unleash-the-alpha-within">Wolfpack — Vitality Stack</a></li>
                        <li><a href="product.php?slug=wolftox-liver-support-detox">Wolftox — Liver Detox</a></li>
                        <li><a href="category.php?slug=vitality">Best Sellers</a></li>
                        <li><a href="category.php?slug=liver-detox">Liver Support</a></li>
                    </ul>
                </div>

                <!-- Right: Feature banner -->
                <div class="mega-col mega-col-banner">
                    <a href="category.php?slug=vitality" class="mega-banner-card">
                        <img src="assets/images/products/wolfpack_shoot.png" alt="Shop Bestsellers">
                        <span class="mega-banner-cta">Shop Bestsellers</span>
                    </a>
                </div>

            </div>
        </div>
        <!-- Mega menu backdrop -->
        <div class="mega-backdrop" id="megaBackdrop"></div>

    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay" id="mobileOverlay"></div>
    <nav class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <a href="index.php" class="mobile-nav-logo" aria-label="Wolf Nutrition - Home">
                <img src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="Wolf Nutrition Logo">
                <span>WOLF NUTRITION</span>
            </a>
            <button class="mobile-nav-close" id="mobileCloseBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <ul class="mobile-nav-links">
            <li class="<?php echo $active_page === 'index.php' ? 'active' : ''; ?>">
                <a href="index.php"><i class="fas fa-home"></i> Home</a>
            </li>
            <li class="<?php echo ($active_page === 'category.php' && isset($_GET['slug']) && $_GET['slug'] === 'vitality') ? 'active' : ''; ?>">
                <a href="category.php?slug=vitality"><i class="fas fa-capsules"></i> Supplements</a>
            </li>
            <li class="<?php echo ($active_page === 'category.php' && isset($_GET['slug']) && $_GET['slug'] === 'liver-detox') ? 'active' : ''; ?>">
                <a href="category.php?slug=liver-detox"><i class="fas fa-shield-halved"></i> Liver Support & Detox</a>
            </li>
            <li class="<?php echo $active_page === 'about.php' ? 'active' : ''; ?>">
                <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
            </li>
            <li class="<?php echo $active_page === 'contact.php' ? 'active' : ''; ?>">
                <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            </li>
        </ul>
        <div class="mobile-nav-footer">
            <a href="<?php echo is_logged_in() ? 'my-account.php' : 'login.php'; ?>" class="btn-gold" style="width:100%; justify-content:center; padding:12px; text-decoration:none;">
                <i class="fas fa-user-circle"></i> <?php echo is_logged_in() ? 'My Account' : 'Login / Register'; ?>
            </a>
        </div>
    </nav>

    <!-- Search Overlay -->
    <div class="search-overlay">
        <div class="search-close"><i class="fas fa-times"></i></div>
        <div class="search-input-wrapper">
            <input type="text" id="search-input" placeholder="What are you looking for..." autocomplete="off">
        </div>
        
        <div class="search-popular-searches">
            <h4>Popular Searches</h4>
            <div class="search-tags">
                <a href="product.php?slug=wolfpack-unleash-the-alpha-within" class="search-tag">Wolfpack Vitality</a>
                <a href="product.php?slug=wolftox-liver-support-detox" class="search-tag">Wolftox Detox</a>
                <a href="category.php?slug=vitality" class="search-tag">Shilajit</a>
                <a href="category.php?slug=liver-detox" class="search-tag">Liver Support</a>
            </div>
        </div>

        <!-- Search Live Results -->
        <div class="search-live-results"></div>
    </div>

    <!-- Slide-out Cart Drawer Backdrop -->
    <div class="cart-drawer-backdrop"></div>

    <!-- Slide-out Cart Drawer -->
    <div class="cart-drawer">
        <div class="cart-drawer-header">
            <h3>Your Pack Cart</h3>
            <div class="cart-drawer-close"><i class="fas fa-times"></i></div>
        </div>
        
        <!-- Cart Drawer Items -->
        <div class="cart-drawer-items">
            <!-- Populated via AJAX / main.js -->
        </div>

        <div class="cart-drawer-footer">
            <div class="cart-drawer-totals">
                <span>Subtotal:</span>
                <span id="cart-drawer-total-val">₹0</span>
            </div>
            
            <div class="cart-drawer-actions">
                <a href="cart.php" class="btn btn-outline-gold" style="width:100%;">View Full Cart</a>
                <a href="checkout.php" class="btn btn-gold" style="width:100%;">Proceed to Checkout</a>
            </div>
        </div>
    </div>
