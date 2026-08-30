-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 21, 2026 at 08:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wolfnutrition`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `message`, `link`, `display_order`, `status`) VALUES
(1, '­ƒöÑ FREE Shipping on all prepaid orders! Limited time only.', '#', 1, 1),
(2, 'ÔÜí Wolfpack Combo Offer: Buy 2 products together, Save 10% automatically!', '#', 2, 1),
(3, '­ƒî┐ 100% Ayurvedic Sourced | FSSAI Certified Wholesaler | Veggie Capsules', '/certificates.php', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `display_order`, `status`) VALUES
(1, 'Wellness', 'wellness', 1, 1),
(2, 'Nutrition', 'nutrition', 2, 1),
(3, 'Fitness', 'fitness', 3, 1),
(4, 'Ayurveda', 'ayurveda', 4, 1),
(5, 'Lifestyle', 'lifestyle', 5, 1),
(6, 'hvfhdhfcvh', 'hvfhdhfcvh', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_tag` varchar(100) DEFAULT 'Wellness',
  `article_type` varchar(50) DEFAULT 'Blog',
  `cover_image` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `author_user_id` int(11) DEFAULT NULL,
  `custom_author` varchar(150) DEFAULT NULL,
  `editor_name` varchar(150) DEFAULT NULL,
  `reading_time` int(11) DEFAULT 5,
  `excerpt` varchar(300) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `category_tag`, `article_type`, `cover_image`, `body`, `status`, `author_user_id`, `custom_author`, `editor_name`, `reading_time`, `excerpt`, `alt_text`, `tags`, `published_at`) VALUES
(1, 'Shilajit Demystified: The Ancient Himalayan Tonic for Elite Stamina', 'shilajit-demystified-himalayan-tonic-stamina', 'Vitality', 'Blog', 'assets/images/blog/shilajit_blog.png', '<p>For thousands of years, Himalayan yogis and ancient Ayurvedic texts have extolled the virtues of a mysterious black resin known as <strong>Shilajit</strong> (Black Asphaltum). Reoccurring in high altitude rock formations, Shilajit is rich in fulvic acid, humic acid, and more than 84 minerals.</p><h3>How Shilajit Boosts Performance</h3><p>At a cellular level, Shilajit works by optimizing mitochondrial functionÔÇöthe powerhouses of your cells. By enhancing CoQ10 levels, it facilitates faster conversion of oxygen and nutrients into ATP (cellular energy). This results in lower muscle fatigue, quicker recovery cycles, and improved cardiorespiratory efficiency.</p><p>In Wolfpack, we utilize purified Shilajit standardized for fulvic acid content, combining it with high-potency Ashwagandha to create a synergistic vitality booster that works safely and naturally.</p>', 1, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2026-07-01 10:48:06'),
(2, 'The Hardest Working Filter: Why Your Liver Needs a Routine Detox', 'why-your-liver-needs-detox', 'Detox', 'Blog', 'assets/images/blog/liver_blog.png', '<p>Your liver performs over 500 vital functions every single day, working 24/7 to cleanse blood, synthesize protein, and store energy. From processing greasy foods and environmental pollutants to filtering cellular waste, it is your body\'s primary engine shield.</p><h3>Signs of an Overburdened Liver</h3><ul><li>Chronic fatigue and sluggish energy levels</li><li>Frequent bloating, indigestion, or heartburn</li><li>Poor skin health or sudden breakouts</li><li>Slow metabolism and weight loss plateaus</li></ul><h3>The Ayurvedic Shield: Kutki and Kalmegh</h3><p>Traditional wellness employs hepatoprotective herbs like Kutki and Kalmegh. Kutki triggers cell regeneration, improves bile production, and lowers fatty acid accumulation in liver cells. Kalmegh acts as a natural antioxidant, neutralising toxic metabolites from medications, alcohol, and stress. Wolftox brings these together alongside Milk Thistle to support peak filtration and overall gut health.</p>', 1, NULL, NULL, NULL, 5, NULL, NULL, NULL, '2026-07-01 10:48:06'),
(3, 'hjvvchdbvhjed cdvhjcvfjvhf', 'hjvvchdbvhje', 'Fitness', 'News', 'uploads/blog/blog_1783251272_9f37c09a208a8134.png', '<p>dhcvdhgbcwdvhjn cbcv</p>', 1, 3, '', 'cbdjch', 5, 'yccn yckfuycbjv bhdbj m', 'c djvfhj', 'chvdchv,ncjbhf', '2026-07-05 08:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`id`, `name`, `slug`, `status`) VALUES
(1, 'vgfcvfhc', 'vgfcvfhc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE `bundles` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `combo_price` decimal(10,2) NOT NULL,
  `discount_percent` decimal(5,2) DEFAULT 0.00,
  `status` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bundles`
--

INSERT INTO `bundles` (`id`, `title`, `slug`, `description`, `banner_image`, `combo_price`, `discount_percent`, `status`, `display_order`) VALUES
(1, 'Wolfpack (60 Capsules) + Wolftox (60 Capsules) Combo', 'wolfpack-wolftox-combo', 'Unleash peak performance while keeping your internal engine clean. This ultimate combination pack includes our premier vitality supplement Wolfpack (60 Caps) and our expert liver protectant Wolftox (60 Caps). Total retail price of both individual items is Ôé╣2,998, buy them together now for Ôé╣2,699 only and save Ôé╣299 (10% extra savings!).', 'assets/images/products/wolfpack_wolftox_combo.png', 2699.00, 10.00, 1, 1),
(2, 'hello+ugfuf', 'hellougfuf', '<p><strong>gefg et dfvf</strong></p>', 'uploads/products/combo_1783245444_b7a4cea210ff98f5.png', 0.47, 0.17, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `bundle_items`
--

CREATE TABLE `bundle_items` (
  `id` int(11) NOT NULL,
  `bundle_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bundle_items`
--

INSERT INTO `bundle_items` (`id`, `bundle_id`, `product_id`, `variant_id`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 4),
(3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `is_active`, `display_order`) VALUES
(1, 'Vitality', 'vitality', 'Supplements designed to boost natural performance, energy and stamina.', 1, 1),
(2, 'Liver & Detox', 'liver-detox', 'Ayurvedic formulations to cleanse, rejuvenate and support liver health.', 1, 2),
(3, 'gtgt', 'gtgt', 'vefv ftegbnfg hbrthrdb', 0, 0),
(4, 'Coming Soon', 'coming-soon', 'Exciting new products launching soon!', 1, 3),
(5, 'Weight Management', 'weight-management', 'Thermo-metabolic and lean body support supplements.', 1, 3),
(6, 'Protein', 'protein', 'Premium protein isolates for muscle recovery and growth.', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `title` varchar(150) NOT NULL,
  `display_order` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `image_url`, `title`, `display_order`, `status`) VALUES
(5, 'uploads/certificates/fssai-registration-2026.pdf', 'FSSAI Registration Certificate 2026', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `title` varchar(150) NOT NULL,
  `body` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `slug`, `title`, `body`, `updated_at`) VALUES
(1, 'shipping-policy', 'Shipping Policy', '<h3>Shipping & Delivery Timeline</h3><p>At Wolf Nutrition, we strive to deliver your orders promptly and safely. Here is our shipping framework:</p><ul><li><strong>Order Processing:</strong> All orders are processed and packaged within 24 to 48 hours of confirmation.</li><li><strong>Estimated Shipping Time:</strong> Delivery usually takes 3 to 5 business days in metro cities, and 5 to 7 business days in other regions across India.</li><li><strong>Shipping Charges:</strong> We offer FREE Shipping on all prepaid orders storewide. Cash on Delivery (COD) orders attract a flat shipping and handling fee of Ôé╣99.</li><li><strong>Courier Partners:</strong> We partner with India\'s leading courier networks including Bluedart, Delhivery, Expressbees, and DTDC to ensure reliable tracking.</li></ul>', '2026-07-01 10:48:06'),
(2, 'refund-policy', 'Refund & Return Policy', '<h3>Return and Replacement Window</h3><p>We want you to be completely satisfied with your wellness stack. Our return and refund guidelines include:</p><ul><li><strong>15-Day Replacement:</strong> We offer a 15-day free replacement policy for products that arrive damaged, have leaking seals, or are incorrect.</li><li><strong>Verification requirement:</strong> To initiate a replacement or return, please share clear photos/videos of the package and invoice to support@wolfnutrition.in.</li><li><strong>Refund Processing:</strong> Once approved, refunds for prepaid orders are credited back to the original payment source within 5 to 7 business days. For COD orders, we process refunds via UPI or bank transfer after customer details are confirmed.</li><li><strong>Non-Returnable Items:</strong> Open bottles, partially consumed capsules, or items purchased during special stock clearance sales are not eligible for returns.</li></ul>', '2026-07-01 10:48:06'),
(3, 'terms-of-service', 'Terms of Service', '<h3>User Terms and Agreements</h3><p>Welcome to Wolf Nutrition (wolfnutrition.in). By using our website and purchasing our products, you agree to comply with the following terms:</p><ol><li><strong>Product Representation:</strong> We make every effort to represent our products and packaging colors accurately. However, actual label placements, shapes, or color hues may vary slightly based on display monitors and screen settings.</li><li><strong>Medical Disclaimer:</strong> The products and details provided on this site are not evaluated by the FDA or intended to diagnose, treat, cure, or prevent any medical condition. Please consult your physician before starting any dietary supplement.</li><li><strong>Age Restriction:</strong> Wolfpack is strictly formulated for adult male use. You must be at least 18 years of age to purchase Wolfpack.</li><li><strong>Pricing:</strong> We reserve the right to alter pricing, discounts, and combo bundle values at any time without prior notification.</li></ol>', '2026-07-01 10:48:06'),
(4, 'privacy-policy', 'Privacy Policy', '<h3>Your Data Safety</h3><p>At Wolf Nutrition, safeguarding your private data is a top priority. We outline our policy below:</p><ul><li><strong>Information Collection:</strong> We collect details like name, email, shipping address, phone number, and payment method when you create an account or check out.</li><li><strong>Data Usage:</strong> Your details are used exclusively to process orders, generate invoices, send tracking updates (via SMS/WhatsApp), and run customer accounts.</li><li><strong>No Third-Party Sharing:</strong> We do not lease, trade, or sell customer databases to advertising networks or external third parties.</li><li><strong>Security:</strong> All transactional exchanges and credit details are processed via secure SSL gateways. We do not store sensitive payment passwords or card numbers on our local server.</li></ul>', '2026-07-01 10:48:06'),
(5, 'about-us', 'Welcome to the Pack: The Wolf Nutrition Story', '<h3>Welcome to the Pack: The Wolf Nutrition Story</h3><p>At Wolf Nutrition, we believe that true performance starts from within. We are dedicated to formulating premium, high-impact supplements that empower you to conquer your daily challenges with sustained energy, focus, and vitality.</p><h4>Our Philosophy: Ancient Wisdom Meets Modern Performance</h4><p>We bridge the gap between time-tested traditions and the rigorous demands of modern life. Our core formulations are built upon the foundation of potent, authentic Ayurvedic botanicals. By harnessing the natural power of trusted ingredients like Shilajit, Ashwagandha, Kutki, and Gokshura, we create active blends designed to naturally support stamina, detoxification, and overall peak performance.</p><h4>The Wolfpack Standard</h4><ul><li><strong>Uncompromising Quality:</strong> We meticulously source our botanical ingredients to ensure you receive the highest quality, active blends in every single veggie capsule bottle.</li><li><strong>Holistic Vitality:</strong> From comprehensive liver support to targeted vitality enhancers, our products are crafted to optimize your body\'s natural systems from the ground up.</li><li><strong>A Premium Experience:</strong> We believe wellness should look as good as it feels. Our commitment to excellence extends from our carefully balanced, science-backed formulations to our sleek, minimalist design aesthetic.</li></ul><h4>Our Commitment to You</h4><p>We aren\'t just creating supplements; we are building a standard for those who demand more from themselves. Whether you are pushing through a demanding workday or striving for new personal bests, Wolf Nutrition provides the essential tools to help you lead the pack.</p>', '2026-07-01 10:48:06'),
(6, 'hello', 'hello', '<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n  <meta charset=\"UTF-8\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title>MBA - Master of Business Administration 2026: Scope, Fees, Specializations, Jobs &amp; Top Colleges - AdmissionSeason</title>\r\n  <meta name=\"description\" content=\"Details about MBA - Master of Business Administration including average salary, eligibility, specializations, career paths and top colleges in India.\">\r\n  <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">\r\n  <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>\r\n  <link href=\"https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap\" rel=\"stylesheet\">\r\n  <script src=\"https://unpkg.com/@phosphor-icons/web\"></script>\r\n  <link rel=\"stylesheet\" href=\"/ADMISSION/ADMISSION/assets/css/style.css?v=1781774487\">\r\n  <link rel=\"stylesheet\" href=\"/ADMISSION/ADMISSION/assets/css/college-pages.css?v=1781774487\">\r\n  <style>\r\n    .course-hero { background: linear-gradient(135deg, #0B2447 0%, #19376D 100%), url(\"data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M54.627 0l.83.83-49.12 49.12L5.5 49.12 54.627 0zM0 54.627l.83.83L5.5 54.627 0 49.12v5.507z\' fill=\'%23ffffff\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'/%3E%3C/svg%3E\"); padding: 80px 0 60px; color: #fff; position: relative; overflow: hidden; }\r\n    .course-hero::after { content:\'\'; position:absolute; bottom:0; left:0; right:0; height:40px; background:linear-gradient(to top, rgba(255,255,255,0.1), transparent); pointer-events:none; }\r\n    .course-hero-inner { display: flex; gap: 32px; align-items: flex-start; position: relative; z-index: 2; }\r\n    .course-hero-title { font-family: \'Plus Jakarta Sans\', sans-serif; font-size: 3rem; font-weight: 800; margin: 0 0 20px 0; line-height: 1.2; text-shadow: 0 2px 10px rgba(0,0,0,0.2); }\r\n    .course-hero-chips { display: flex; flex-wrap: wrap; gap: 12px; }\r\n    .course-hero-chips span { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); border-radius: 30px; font-size: 0.95rem; font-weight: 600; backdrop-filter: blur(8px); box-shadow: 0 4px 15px rgba(0,0,0,0.05); }\r\n    .course-hero-chips span i { font-size: 1.2rem; }\r\n    .course-hero-actions { margin-left: auto; display: flex; flex-direction: column; gap: 12px; }\r\n    .course-btn-primary { background: #fff; color: var(--cp-blue); padding: 16px 32px; border-radius: 50px; font-weight: 800; text-decoration: none; text-align: center; transition: all 0.3s ease; box-shadow: 0 10px 30px rgba(0,0,0,0.15); font-size: 1.05rem; display: inline-flex; align-items: center; gap: 8px; }\r\n    .course-btn-primary:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(0,0,0,0.2); background: #f8fafc; color: #0f172a; }\r\n    \r\n    .course-tabs-sticky { position: sticky; top: 0; z-index: 100; background: rgba(255,255,255,0.95); border-bottom: 1px solid var(--cp-border); box-shadow: 0 4px 20px rgba(0,0,0,0.04); backdrop-filter: blur(10px); }\r\n    .shiksha-tabs-nav ul { display: flex; list-style: none; padding: 0; margin: 0; overflow-x: auto; gap: 40px; }\r\n    .shiksha-tabs-nav li a { display: flex; align-items: center; gap: 10px; padding: 22px 0; color: #64748b; font-weight: 700; text-decoration: none; border-bottom: 3px solid transparent; transition: all 0.3s ease; white-space: nowrap; font-size: 1rem; }\r\n    .shiksha-tabs-nav li a:hover { color: var(--cp-blue); }\r\n    .shiksha-tabs-nav li a.active { color: var(--cp-blue); border-bottom-color: var(--cp-blue); }\r\n    \r\n    .tab-content { padding: 50px 0; min-height: 50vh; }\r\n    \r\n    .info-card { background: #fff; border-radius: 20px; padding: 40px; border: 1px solid var(--cp-border); box-shadow: 0 10px 40px rgba(0,0,0,0.03); margin-bottom: 32px; position: relative; overflow: hidden; }\r\n    .info-card::before { content:\'\'; position:absolute; left:0; top:0; width:6px; height:100%; background: linear-gradient(to bottom, var(--cp-blue), #3b82f6); border-radius: 20px 0 0 20px; }\r\n    .info-card-title { font-size: 1.6rem; font-weight: 800; color: var(--cp-blue); margin-bottom: 20px; display: flex; align-items: center; gap: 12px; }\r\n    .info-card-title i { color: #3b82f6; background: #eff6ff; padding: 10px; border-radius: 12px; font-size: 1.5rem; }\r\n    .info-card-content { font-size: 1.1rem; line-height: 1.8; color: #475569; }\r\n\r\n    .specs-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; margin-top: 32px; }\r\n    .spec-card { background: #fff; border: 1px solid var(--cp-border); border-radius: 20px; padding: 30px; transition: all 0.3s ease; display: flex; flex-direction: column; gap: 12px; position: relative; overflow: hidden; }\r\n    .spec-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(11,36,71,0.06); border-color: var(--cp-blue); }\r\n    .spec-card-icon { width: 50px; height: 50px; background: #eff6ff; color: var(--cp-blue); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 8px; transition: all 0.3s ease; }\r\n    .spec-card:hover .spec-card-icon { background: var(--cp-blue); color: #fff; transform: scale(1.1) rotate(5deg); }\r\n    .spec-card h4 { font-size: 1.25rem; color: #0f172a; margin: 0; font-weight: 800; }\r\n    .spec-card p { font-size: 1rem; color: #64748b; margin: 0; line-height: 1.6; }\r\n    \r\n    .career-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 24px; margin-top: 32px; }\r\n    .career-card { background: #fff; border-radius: 20px; padding: 30px; border: 1px solid var(--cp-border); box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: all 0.3s ease; }\r\n    .career-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(11,36,71,0.08); border-color: var(--cp-blue); }\r\n    .career-role { font-size: 1.4rem; font-weight: 800; color: #0f172a; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; }\r\n    .career-role i { color: #f59e0b; font-size: 1.8rem; background: #fffbeb; padding: 12px; border-radius: 14px; }\r\n    .career-salary-box { display: flex; background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 24px; border: 1px solid #e2e8f0; }\r\n    .career-salary-item { flex: 1; text-align: center; }\r\n    .career-salary-item:first-child { border-right: 1px solid #e2e8f0; }\r\n    .career-salary-label { font-size: 0.85rem; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }\r\n    .career-salary-val { font-size: 1.25rem; font-weight: 800; color: #16a34a; }\r\n    .career-companies { font-size: 0.95rem; color: #475569; line-height: 1.6; }\r\n    .career-companies strong { color: #0f172a; display: block; margin-bottom: 8px; font-weight: 700; }\r\n    \r\n    .clg-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; margin-top: 32px; }\r\n    .clg-mini-card { background: #fff; border: 1px solid var(--cp-border); border-radius: 20px; padding: 20px; display: flex; align-items: center; gap: 20px; text-decoration: none; transition: all 0.3s ease; }\r\n    .clg-mini-card:hover { box-shadow: 0 15px 35px rgba(0,0,0,0.06); border-color: var(--cp-blue); transform: translateX(5px); }\r\n    .clg-mini-img { width: 70px; height: 70px; border-radius: 14px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }\r\n    .clg-mini-info h4 { font-size: 1.1rem; color: #0f172a; margin: 0 0 6px 0; font-weight: 800; line-height: 1.4; }\r\n    .clg-mini-info p { font-size: 0.9rem; color: #64748b; margin: 0; display: flex; align-items: center; gap: 6px; }\r\n  </style>\r\n</head>\r\n<body class=\"bg-light\">\r\n\r\n<!-- ═══ PRO STYLE NAVBAR ═══ -->\r\n<header class=\"pro-header\" id=\"header\">\r\n  <div class=\"pro-nav-main\">\r\n    <div class=\"container pro-nav-flex\">\r\n      <div class=\"pro-nav-left\">\r\n        <a href=\"/\" class=\"pro-logo\">\r\n          <i class=\"ph-fill ph-student\"></i>\r\n          <span>AdmissionSeason</span>\r\n        </a>\r\n      </div>\r\n      \r\n      <div class=\"pro-nav-search\">\r\n        <i class=\"ph ph-magnifying-glass\"></i>\r\n        <input type=\"text\" placeholder=\"Search for Colleges, Exams, Courses and More..\">\r\n      </div>\r\n      \r\n      <div class=\"pro-nav-right\">\r\n        <a href=\"#\" class=\"pro-nav-link\"><i class=\"ph ph-pencil-simple\"></i> Write a Review</a>\r\n        <a href=\"#\" class=\"pro-icon-btn\" title=\"Saved\"><i class=\"ph ph-heart\"></i></a>\r\n        <a href=\"#\" class=\"pro-icon-btn\" title=\"Notifications\"><i class=\"ph ph-bell\"></i></a>\r\n                  <a href=\"login.php\" class=\"pro-user-btn\" title=\"Login\"><i class=\"ph-fill ph-user-plus\"></i></a>\r\n              </div>\r\n    </div>\r\n  </div>\r\n  \r\n  <div class=\"pro-nav-sub\">\r\n    <div class=\"container pro-nav-flex\">\r\n      <ul class=\"pro-sub-links\">\r\n        \r\n        <li class=\"pro-has-mega\">\r\n          <a href=\"colleges.php\">Colleges <i class=\"ph ph-caret-down\"></i></a>\r\n          <div class=\"pro-mega-menu\">\r\n            <div class=\"mega-col\">\r\n              <h4>Top Courses</h4>\r\n              <ul>\r\n                                <li><a href=\"#\">B.Tech - Bachelor of Technology</a></li>\r\n                                <li><a href=\"#\">MBA - Master of Business Administration</a></li>\r\n                                <li><a href=\"#\">BCA - Bachelor of Computer Applications</a></li>\r\n                                <li><a href=\"#\">MBBS - Bachelor of Medicine and Bachelor of Surgery</a></li>\r\n                              </ul>\r\n            </div>\r\n            <div class=\"mega-col\">\r\n              <h4>Top Locations</h4>\r\n              <ul>\r\n                                <li><a href=\"colleges.php?state=9\">Delhi (NCT)</a></li>\r\n                                <li><a href=\"colleges.php?state=11\">Gujarat</a></li>\r\n                                <li><a href=\"colleges.php?state=16\">Karnataka</a></li>\r\n                                <li><a href=\"colleges.php?state=20\">Maharashtra</a></li>\r\n                                <li><a href=\"colleges.php?state=28\">Rajasthan</a></li>\r\n                                <li><a href=\"colleges.php?state=30\">Tamil Nadu</a></li>\r\n                                <li><a href=\"colleges.php?state=1\">Andhra Pradesh</a></li>\r\n                                <li><a href=\"colleges.php?state=2\">Arunachal Pradesh</a></li>\r\n                                <li><a href=\"colleges.php?state=3\">Assam</a></li>\r\n                                <li><a href=\"colleges.php?state=4\">Bihar</a></li>\r\n                                <li><a href=\"colleges.php?state=5\">Chandigarh (UT)</a></li>\r\n                                <li><a href=\"colleges.php?state=6\">Chhattisgarh</a></li>\r\n                                <li><a href=\"colleges.php?state=7\">Dadra and Nagar Haveli (UT)</a></li>\r\n                                <li><a href=\"colleges.php?state=8\">Daman and Diu (UT)</a></li>\r\n                                <li><a href=\"colleges.php?state=10\">Goa</a></li>\r\n                                <li><a href=\"colleges.php?state=12\">Haryana</a></li>\r\n                                <li><a href=\"colleges.php?state=13\">Himachal Pradesh</a></li>\r\n                                <li><a href=\"colleges.php?state=14\">Jammu and Kashmir</a></li>\r\n                                <li><a href=\"colleges.php?state=15\">Jharkhand</a></li>\r\n                                <li><a href=\"colleges.php?state=17\">Kerala</a></li>\r\n                                <li><a href=\"colleges.php?state=18\">Lakshadweep (UT)</a></li>\r\n                                <li><a href=\"colleges.php?state=19\">Madhya Pradesh</a></li>\r\n                                <li><a href=\"colleges.php?state=21\">Manipur</a></li>\r\n                                <li><a href=\"colleges.php?state=22\">Meghalaya</a></li>\r\n                                <li><a href=\"colleges.php?state=23\">Mizoram</a></li>\r\n                                <li><a href=\"colleges.php?state=24\">Nagaland</a></li>\r\n                                <li><a href=\"colleges.php?state=25\">Odisha</a></li>\r\n                                <li><a href=\"colleges.php?state=26\">Puducherry (UT)</a></li>\r\n                                <li><a href=\"colleges.php?state=27\">Punjab</a></li>\r\n                                <li><a href=\"colleges.php?state=29\">Sikkim</a></li>\r\n                                <li><a href=\"colleges.php?state=31\">Telangana</a></li>\r\n                                <li><a href=\"colleges.php?state=32\">Tripura</a></li>\r\n                                <li><a href=\"colleges.php?state=34\">Uttar Pradesh</a></li>\r\n                                <li><a href=\"colleges.php?state=33\">Uttarakhand</a></li>\r\n                                <li><a href=\"colleges.php?state=35\">West Bengal</a></li>\r\n                              </ul>\r\n            </div>\r\n            <div class=\"mega-col\">\r\n              <h4>Top Colleges</h4>\r\n              <ul>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/college/iim-ahmedabad\">IIM Ahmedabad</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/college/iit-bombay\">IIT Bombay</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/college/anna-university\">Anna University</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/college/nimhans-bangalore\">NIMHANS Bangalore</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/college/university-of-delhi\">University of Delhi</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/college/madhav-arora\">Madhav Arora</a></li>\r\n                              </ul>\r\n            </div>\r\n          </div>\r\n        </li>\r\n\r\n        <li class=\"pro-has-mega\">\r\n          <a href=\"/ADMISSION/ADMISSION/exams\">Exams <i class=\"ph ph-caret-down\"></i></a>\r\n          <div class=\"pro-mega-menu\">\r\n            <div class=\"mega-col\">\r\n              <h4>Top UG Exams</h4>\r\n              <ul>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/sdfghf\">sdfghf</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/cat\">Common Admission Test</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/jee-main\">Joint Entrance Examination (Main)</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/neet\">National Eligibility cum Entrance Test (UG)</a></li>\r\n                              </ul>\r\n            </div>\r\n            <div class=\"mega-col\">\r\n              <h4>Top PG Exams</h4>\r\n              <ul>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/sdfghf\">sdfghf</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/cat\">Common Admission Test</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/jee-main\">Joint Entrance Examination (Main)</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/exam/neet\">National Eligibility cum Entrance Test (UG)</a></li>\r\n                              </ul>\r\n            </div>\r\n            <div class=\"mega-col\">\r\n              <h4>Quick Links</h4>\r\n              <ul>\r\n                <li><a href=\"#\">Exam Calendar 2026</a></li>\r\n                <li><a href=\"#\">Application Deadlines</a></li>\r\n                <li><a href=\"#\">Syllabus & Pattern</a></li>\r\n                <li><a href=\"#\">Result Dates</a></li>\r\n              </ul>\r\n            </div>\r\n          </div>\r\n        </li>\r\n\r\n        <li class=\"pro-has-mega\">\r\n          <a href=\"/ADMISSION/ADMISSION/courses\">Courses <i class=\"ph ph-caret-down\"></i></a>\r\n          <div class=\"pro-mega-menu\">\r\n            <div class=\"mega-col\">\r\n              <h4>Top UG Courses</h4>\r\n              <ul>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/course/btech\">B.Tech - Bachelor of Technology</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/course/regtbeg\">BCA - Bachelor of Computer Applications</a></li>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/course/mbbs\">MBBS - Bachelor of Medicine and Bachelor of Surgery</a></li>\r\n                              </ul>\r\n            </div>\r\n            <div class=\"mega-col\">\r\n              <h4>Top PG Courses</h4>\r\n              <ul>\r\n                                <li><a href=\"/ADMISSION/ADMISSION/course/mba\">MBA - Master of Business Administration</a></li>\r\n                              </ul>\r\n            </div>\r\n            <div class=\"mega-col\">\r\n              <h4>Explore More</h4>\r\n              <ul>\r\n                <li><a href=\"#\">Diploma Courses</a></li>\r\n                <li><a href=\"#\">PhD Programs</a></li>\r\n                <li><a href=\"#\">Online Certifications</a></li>\r\n                <li><a href=\"#\">Highest Paying Courses</a></li>\r\n              </ul>\r\n            </div>\r\n          </div>\r\n        </li>\r\n\r\n        <li class=\"pro-has-mega\">\r\n          <a href=\"#\">Study Abroad <i class=\"ph ph-caret-down\"></i></a>\r\n          <div class=\"pro-mega-menu\">\r\n            <div class=\"mega-col\">\r\n              <h4>Top Destinations</h4>\r\n              <ul>\r\n                                <li><a href=\"#\">United States</a></li>\r\n                                <li><a href=\"#\">United Kingdom</a></li>\r\n                                <li><a href=\"#\">Canada</a></li>\r\n                                <li><a href=\"#\">Australia</a></li>\r\n                                <li><a href=\"#\">Germany</a></li>\r\n                              </ul>\r\n            </div>\r\n            <div class=\"mega-col\">\r\n              <h4>International Exams</h4>\r\n              <ul>\r\n                <li><a href=\"#\">IELTS</a></li>\r\n                <li><a href=\"#\">TOEFL</a></li>\r\n                <li><a href=\"#\">GRE</a></li>\r\n                <li><a href=\"#\">GMAT</a></li>\r\n                <li><a href=\"#\">SAT</a></li>\r\n              </ul>\r\n            </div>\r\n          </div>\r\n        </li>\r\n\r\n        <li><a href=\"#\">Admissions 2026 <span class=\"nav-badge-hot\">LIVE</span></a></li>\r\n        <li><a href=\"#\">Reviews</a></li>\r\n        <li><a href=\"news.php\">News</a></li>\r\n      </ul>\r\n      <ul class=\"pro-sub-links-right\">\r\n        <li><a href=\"#\" class=\"counselling-btn\"><i class=\"ph-fill ph-headset\"></i> Free Counselling <span class=\"pulse-dot\"></span></a></li>\r\n      </ul>\r\n    </div>\r\n  </div>\r\n<script>\r\nfunction toggleUserMenu() {\r\n  const menu = document.getElementById(\'userMenu\');\r\n  if (menu) {\r\n    menu.classList.toggle(\'open\');\r\n  }\r\n}\r\n\r\ndocument.addEventListener(\'click\', function(e) {\r\n  const menu = document.getElementById(\'userMenu\');\r\n  const btn = document.getElementById(\'userMenuBtn\');\r\n  if (menu && menu.classList.contains(\'open\') && !menu.contains(e.target) && e.target !== btn && !btn.contains(e.target)) {\r\n    menu.classList.remove(\'open\');\r\n  }\r\n});\r\n\r\ndocument.addEventListener(\'keydown\', function(e) {\r\n  if (e.key === \'Escape\') {\r\n    document.getElementById(\'userMenu\')?.classList.remove(\'open\');\r\n  }\r\n});\r\n</script>\r\n</header>\r\n\r\n<!-- HERO -->\r\n<div class=\"course-hero\">\r\n  <div class=\"container course-hero-inner\">\r\n    <div>\r\n      <h1 class=\"course-hero-title\">MBBS - Bachelor of Medicine and Bachelor of Surgery</h1>\r\n      <div class=\"course-hero-chips\">\r\n                \r\n                \r\n                \r\n              </div>\r\n    </div>\r\n    <div class=\"course-hero-actions\">\r\n      <a href=\"/ADMISSION/ADMISSION/colleges\" class=\"course-btn-primary\">\r\n        Browse Colleges <i class=\"ph ph-arrow-right\"></i>\r\n      </a>\r\n    </div>\r\n  </div>\r\n</div>\r\n\r\n<!-- TABS -->\r\n<div class=\"course-tabs-sticky shiksha-tabs-nav\">\r\n  <div class=\"container\">\r\n    <ul>\r\n            <li>\r\n        <a href=\"/ADMISSION/ADMISSION/course/mba\" class=\"active\">\r\n          <i class=\"ph ph-info\"></i> Overview &amp; Info        </a>\r\n      </li>\r\n            <li>\r\n        <a href=\"/ADMISSION/ADMISSION/course/mba/specializations\" class=\"\">\r\n          <i class=\"ph ph-git-branch\"></i> Specializations        </a>\r\n      </li>\r\n            <li>\r\n        <a href=\"/ADMISSION/ADMISSION/course/mba/careers\" class=\"\">\r\n          <i class=\"ph ph-briefcase\"></i> Career &amp; Jobs        </a>\r\n      </li>\r\n            <li>\r\n        <a href=\"/ADMISSION/ADMISSION/course/mba/colleges\" class=\"\">\r\n          <i class=\"ph ph-buildings\"></i> Top Colleges        </a>\r\n      </li>\r\n          </ul>\r\n  </div>\r\n</div>\r\n\r\n<!-- CONTENT -->\r\n<div class=\"container tab-content\">\r\n  <div class=\"container tab-content\">\r\n    \r\n          <div class=\"info-card\">\r\n        <h2 class=\"info-card-title\"><i class=\"ph ph-info\"></i> About MBBS - Bachelor of Medicine and Bachelor of Surgery</h2>\r\n        <div class=\"info-card-content\">\r\n          Details not available.        </div>\r\n      </div>\r\n      \r\n      <div class=\"info-card\">\r\n        <h2 class=\"info-card-title\"><i class=\"ph ph-check-circle\"></i> Eligibility Criteria</h2>\r\n        <div class=\"info-card-content\">\r\n          Details not available.        </div>\r\n      </div>\r\n\r\n      <div class=\"info-card\">\r\n        <h2 class=\"info-card-title\"><i class=\"ph ph-rocket\"></i> Career Scope & Future</h2>\r\n        <div class=\"info-card-content\">\r\n          Details not available.        </div>\r\n      </div>\r\n      \r\n      \r\n    \r\n  </div>\r\n</div>\r\n\r\n<!-- ═══ FOOTER ═══ -->\r\n<footer class=\"footer\">\r\n  <div class=\"container\">\r\n    <div class=\"footer-grid\">\r\n      <div class=\"footer-brand\">\r\n        <a href=\"/\" class=\"flogo\"><i class=\"ph-fill ph-graduation-cap\"></i> Admission<span>Season</span></a>\r\n        <p>India\'s leading college discovery platform. Find detailed info on colleges, courses, exams, and get personalised admission assistance.</p>\r\n        <div class=\"fsocial\">\r\n          <a href=\"#\" aria-label=\"Facebook\"><i class=\"ph ph-facebook-logo\"></i></a>\r\n          <a href=\"#\" aria-label=\"X\"><i class=\"ph ph-twitter-logo\"></i></a>\r\n          <a href=\"#\" aria-label=\"Instagram\"><i class=\"ph ph-instagram-logo\"></i></a>\r\n          <a href=\"#\" aria-label=\"LinkedIn\"><i class=\"ph ph-linkedin-logo\"></i></a>\r\n          <a href=\"#\" aria-label=\"YouTube\"><i class=\"ph ph-youtube-logo\"></i></a>\r\n        </div>\r\n      </div>\r\n      <div class=\"footer-col\">\r\n        <h4>Colleges</h4>\r\n        <ul><li><a href=\"#\">Engineering</a></li><li><a href=\"#\">MBA</a></li><li><a href=\"#\">Medical</a></li><li><a href=\"#\">Law</a></li><li><a href=\"#\">Design</a></li></ul>\r\n      </div>\r\n      <div class=\"footer-col\">\r\n        <h4>Exams</h4>\r\n        <ul><li><a href=\"#\">JEE Main</a></li><li><a href=\"#\">NEET</a></li><li><a href=\"#\">CAT</a></li><li><a href=\"#\">GATE</a></li><li><a href=\"#\">CUET</a></li></ul>\r\n      </div>\r\n      <div class=\"footer-col\">\r\n        <h4>Abroad</h4>\r\n        <ul><li><a href=\"#\">Study in USA</a></li><li><a href=\"#\">Study in UK</a></li><li><a href=\"#\">Study in Canada</a></li><li><a href=\"#\">Study in Australia</a></li><li><a href=\"#\">Study in Germany</a></li></ul>\r\n      </div>\r\n      <div class=\"footer-col\">\r\n        <h4>Quick Links</h4>\r\n        <ul><li><a href=\"#\">About</a></li><li><a href=\"#\">Contact</a></li><li><a href=\"#\">Privacy</a></li><li><a href=\"#\">Terms</a></li><li><a href=\"#\">Careers</a></li></ul>\r\n      </div>\r\n    </div>\r\n    <div class=\"footer-bottom\">\r\n      <p>&copy; 2026 AdmissionSeason. All rights reserved.</p>\r\n      <div class=\"footer-badges\">\r\n        <span><i class=\"ph ph-shield-check\"></i> Verified Data</span>\r\n        <span><i class=\"ph ph-lock\"></i> Secure</span>\r\n        <span><i class=\"ph ph-star\"></i> 5M+ Students</span>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</footer>\r\n</body>\r\n</html>', '2026-07-05 11:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `is_spam` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type` enum('percentage','flat') DEFAULT 'percentage',
  `value` decimal(10,2) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT 0.00,
  `max_discount` decimal(10,2) DEFAULT 0.00,
  `expiry_date` date NOT NULL,
  `usage_limit` int(11) DEFAULT 0,
  `used_count` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `min_order_amount`, `max_discount`, `expiry_date`, `usage_limit`, `used_count`, `status`) VALUES
(1, 'WOLF10', 'percentage', 10.00, 500.00, 250.00, '2028-12-31', 500, 0, 1),
(2, 'ALPHA200', 'flat', 200.00, 1499.00, 0.00, '2028-12-31', 200, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `attempt_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`id`, `email`, `ip_address`, `is_active`, `created_at`) VALUES
(1, 'madhavarora132005@gmail.com', '::1', 1, '2026-07-06 08:04:06'),
(2, 'aroramadhav1312@gmail.com', '::1', 1, '2026-07-06 12:25:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_number` varchar(50) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `shipping` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT 'COD',
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `razorpay_payment_id` varchar(100) DEFAULT NULL,
  `shipping_status` enum('pending','shipped','delivered','cancelled') DEFAULT 'pending',
  `tracking_number` varchar(100) DEFAULT NULL,
  `courier_name` varchar(100) DEFAULT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(15) NOT NULL,
  `shipping_address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `subtotal`, `discount`, `shipping`, `total`, `payment_method`, `payment_status`, `razorpay_payment_id`, `shipping_status`, `tracking_number`, `courier_name`, `customer_name`, `customer_email`, `customer_phone`, `shipping_address`, `pincode`, `note`, `created_at`, `updated_at`) VALUES
(1, 4, 'WN-1782925364-3870', 1194.00, 0.00, 0.00, 1194.00, 'UPI', 'paid', NULL, 'pending', NULL, NULL, 'Kashish Singh', 'madhavarora132005@gmail.com', '8707773540', '245 D , railway colony no. 3, preet nagar, JALANDHAR, Punjab - 144001', '144001', '', '2026-07-01 17:02:44', '2026-07-01 17:02:44'),
(2, 6, 'WN-TEST-001-2026', 0.00, 0.00, 0.00, 1999.00, 'COD', 'pending', NULL, 'delivered', 'TRK9876543210', 'Delhivery', '', '', '', '42 Wolf Street, Sector 15, Noida, UP - 201301', '', NULL, '2026-06-28 09:00:00', '2026-07-03 16:33:00'),
(3, 6, 'WN-TEST-002-2026', 0.00, 0.00, 0.00, 899.00, 'COD', 'pending', NULL, 'pending', 'TRK1234567890', 'BlueDart', '', '', '', '42 Wolf Street, Sector 15, Noida, UP - 201301', '', NULL, '2026-07-02 04:45:00', '2026-07-03 16:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `bundle_id` int(11) DEFAULT NULL,
  `product_name` varchar(150) NOT NULL,
  `variant_name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `variant_id`, `bundle_id`, `product_name`, `variant_name`, `price`, `quantity`) VALUES
(1, 1, 1, 1, NULL, 'WOLFPACK - UNLEASH THE ALPHA WITHIN', '30 Veggie Capsules', 1194.00, 1),
(5, 2, 1, NULL, NULL, 'WOLFPACK - UNLEASH THE ALPHA WITHIN', '30 Veggie Capsules', 1199.00, 1),
(6, 2, 2, NULL, NULL, 'WOLFTOX - LIVER SUPPORT & DETOX', '60 Veggie Capsules', 800.00, 1),
(7, 3, 2, NULL, NULL, 'WOLFTOX - LIVER SUPPORT & DETOX', '60 Veggie Capsules', 899.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `image_gallery` text DEFAULT NULL,
  `benefits` text DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `how_to_use` text DEFAULT NULL,
  `disclaimer` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `category_id`, `image_url`, `image_gallery`, `benefits`, `ingredients`, `how_to_use`, `disclaimer`, `is_active`, `created_at`) VALUES
(1, 'WOLFPACK - UNLEASH THE ALPHA WITHIN', 'wolfpack-unleash-the-alpha-within', 'Reclaim your edge. Wolfpack is a premium, all-natural male wellness supplement engineered for the modern man who demands peak performance.', 'Reclaim your edge. Wolfpack is a premium, all-natural male wellness supplement engineered for the modern man who demands peak performance. Combining ancient Ayurvedic wisdom with high-potency ingredients, Wolfpack is designed to support stamina, vitality, and hormonal balance.\n\nWhether you\'re crushing it in the gym, leading in the boardroom, or looking to enhance your personal life, Wolfpack provides the \"Raw, Natural, and Wild\" energy you need to lead the pack.\n\nWHY CHOOSE WOLFPACK?\n\nMaximum Vitality: Formulated with Black Asphaltum (Shilajit) and Ashwagandha, known for centuries to boost energy and reduce stress.\n\nPure & Potent: A powerful 500mg blend per capsule featuring Saffron, Mucuna Pruriens, and Iron Calcined.\n\nClean Formulation: 100% Veggie Capsules. No hidden fillers. Raw, natural ingredients.\n\nHolistic Support: Includes Emblica Officinalis (Amla) and Glycyrrhiza Glabra for overall wellness and recovery.', 1, 'assets/images/products/wolfpack.png', 'assets/images/products/wolfpack.png,assets/images/products/wolfpack_shoot.png', '• Maximum Vitality: Formulated with Black Asphaltum (Shilajit) and Ashwagandha, known for centuries to boost energy and reduce stress.\n• Pure & Potent: A powerful 500mg blend per capsule featuring Saffron, Mucuna Pruriens, and Iron Calcined.\n• Clean Formulation: 100% Veggie Capsules. No hidden fillers. Raw, natural ingredients.\n• Holistic Support: Includes Emblica Officinalis (Amla) and Glycyrrhiza Glabra for overall wellness and recovery.', 'Each 500mg Veggie Capsule contains:\n• Purified Shilajit (Asphaltum punjabianum) 150mg\n• Ashwagandha (Withania somnifera) 120mg\n• Safed Musli (Chlorophytum borivilianum) 80mg\n• Kaunch Beej (Mucuna pruriens) 60mg\n• Gokshura (Tribulus terrestris) 50mg\n• Kesar/Saffron (Crocus sativus) 5mg\n• Yashad Bhasma (Zinc oxide) 20mg\n• Amla (Emblica officinalis) 15mg', 'Take 1-2 capsules daily after a meal with warm milk or water, or as directed by your healthcare professional. Maintain consistency for 60-90 days for peak results.\n\nProduct Specifications:\n• Quantity: 30 Veggie Capsules (Full 15-30 day supply)\n• Quantity: 60 Veggie Capsules (Full 30-60 day supply)\n• Usage: Take 1-2 capsules daily after a meal or as directed by your healthcare professional.\n• Quality Assured: Manufactured under FSSAI license and rigorous quality standards.', 'Wolfpack is for adult use only (men above 18). Consult your physician before use if you have an underlying medical condition like hypertension, diabetes, or cardiovascular issues. Do not exceed the recommended daily dose.', 1, '2026-07-01 10:48:06'),
(2, 'WOLFTOX - LIVER SUPPORT & DETOX', 'wolftox-liver-support-detox', 'Your liver is the hardest working organ in your body. Wolftox provides the ultimate support for your body\'s natural filtration system.', 'WOLFTOX: THE ULTIMATE SHIELD FOR YOUR INTERNAL ENGINE\n\nYour liver is the hardest working organ in your body, filtering toxins and managing your metabolism 24/7. Whether you\'re pushing through an intense training cycle or just looking to optimize your health, Wolftox by Wolf Nutrition provides the ultimate support for your body\'s natural filtration system.\n\nWhy Wolftox?\n\nEnzymatic Support: Expertly formulated to support healthy liver enzyme levels and peak function.\n\nDeep Detoxification: Helps flush out impurities and metabolic waste, keeping you feeling light and energized.\n\nImmune & Digestive Kickstart: A healthy liver means a healthy gut. Wolftox aids in bile production for smoother digestion and boosts your natural immunity.\n\n60 High-Potency Capsules: A full month of premium liver protection.\n\nGive your liver the care it deserves with Wolftox. Designed to promote long-term vitality, these capsules are your daily defense against environmental toxins and dietary stressors.', 2, 'assets/images/products/wolftox.png', 'assets/images/products/wolftox.png,assets/images/products/wolftox_label.png', '• Liver Enzyme Support: Maintains healthy liver markers.\n• Improved Digestion: Helps your body process nutrients more efficiently.\n• Immunity & Protection: Strengthens your body\'s natural defenses.\n• Deep Detoxification: Helps flush out impurities and metabolic waste.\n• Enzymatic Support: Expertly formulated to support healthy liver enzyme levels and peak function.', 'Each capsule contains a potent blend of Ayurvedic liver-support botanicals including:\n• Kutki (Picrorhiza kurroa) - Powerful liver tonic\n• Kalmegh (Andrographis paniculata) - Detoxification support\n• Bhringraj (Eclipta alba) - Liver cell regeneration\n• Makoy (Solanum nigrum) - Hepatoprotective properties\n• Kasani (Cichorium intybus) - Bile production support\n• Arjuna (Terminalia arjuna) - Cardiovascular & liver health\n• Bhumi Amla (Phyllanthus niruri) - Antiviral liver support\n• Kutaki (Picrorhiza kurroa) - Liver enzyme balance', 'Take 1-2 capsules daily after meals with water, or as directed by your healthcare professional.\n\nProduct Specifications:\n• Quantity: 30 Capsules (15-30 day supply)\n• Quantity: 60 Capsules (30-60 day supply)\n• Purpose: Detoxification, Digestion, & Immunity\n• Brand: Wolf Nutrition\n• Quality Assured: Manufactured under FSSAI license.', 'Wolftox is for adult use only. Consult your physician before use if you have an underlying medical condition. Do not exceed the recommended daily dose. Store in a cool, dry place away from direct sunlight.', 1, '2026-07-01 10:48:06'),
(3, 'WolfBurn - Thermo-Metabolic Lean Burner 60 Capsules', 'wolfburn-thermo-metabolic-lean-burner', 'Ignite your metabolism and carve out your physique with WolfBurn. 100% natural thermo-metabolic lean burner for stubborn weight loss.', 'Ignite your metabolism and carve out your physique with WolfBurn, our 100% natural fat burner. Staying true to our Raw, Natural, Wild philosophy, this thermo-metabolic lean burner is engineered to help you shed stubborn weight without the jitters. We have tapped into the power of traditional, raw botanicals to create a potent formula that accelerates fat loss, controls cravings, and fuels your daily energy naturally.<br><br><strong>The Apex Predator Blend:</strong><br>- <strong>Vrikshamla Extract:</strong> A powerful, natural compound that helps curb appetite and block the formation of new fat cells.<br>- <strong>Guggulu Purified:</strong> A revered traditional ingredient known for optimizing lipid metabolism and supporting healthy thyroid function.<br>- <strong>Green Tea Extract:</strong> Packed with natural antioxidants to boost your core temperature, driving thermogenesis and fat oxidation.<br>- <strong>Trikatu Extract:</strong> A natural bioavailability enhancer that ensures your body absorbs every ounce of these powerful ingredients while further stimulating metabolism.', 5, 'assets/images/products/189870.png', 'assets/images/products/189870.png', '- Thermo-Metabolic Support: Clinically-inspired Ayurvedic herbs boost metabolic rate and accelerate calorie burning.<br>- Natural Fat Blocking: Vrikshamla Extract helps curb appetite and prevent new fat cell formation.<br>- Thyroid Optimization: Guggulu Purified supports healthy thyroid function for optimal metabolism.<br>- Enhanced Bioavailability: Trikatu Extract ensures maximum absorption of all active ingredients.<br>- Clean Formula: 100% Veggie Capsules. No artificial stimulants, fillers, or synthetic additives.', 'Each 500mg Veggie Capsule contains: Vrikshamla (Garcinia cambogia) Extract 150mg, Guggulu (Commiphora mukul) Purified 100mg, Green Tea (Camellia sinensis) Extract 80mg, Trikatu Extract (Long Pepper, Black Pepper, Ginger) 60mg, BioPerine (Black Pepper Extract) 5mg.', 'Take 1 capsule twice daily 30 minutes before meals with water. For best results, combine with regular exercise and a balanced diet. Do not exceed 2 capsules in a 24-hour period.', 'Not recommended for pregnant or lactating women. Consult your physician before use if you have heart disease, high blood pressure, or are taking any medication. Keep out of reach of children.', 0, '2026-07-19 16:45:55'),
(4, 'WOLFPRO - Premium Protein Isolate', 'wolfpro-premium-protein-isolate', 'Ultra-pure protein isolate for elite performance and rapid muscle repair. Clean fuel for lean, dense muscle.', 'When you train like a beast, you need to recover like an alpha. Enter WOLFPRO, our upcoming Premium Protein Isolate designed for elite performance and rapid muscle repair. Stripped of excess fats, carbs, and lactose, this ultra-pure isolate delivers the raw, fast-absorbing nutrients your muscles crave immediately after a brutal session. Engineered for those who refuse to compromise on quality, WOLFPRO provides the clean fuel necessary to build lean, dense muscle and keep you at the top of the food chain.<br><br><strong>The Alpha Standard:</strong><br>- <strong>Rapid Absorption:</strong> Micro-filtered isolate digests quickly to flood your muscles with essential amino acids right when you need them most.<br>- <strong>Maximum Protein Yield:</strong> Delivers a massive hit of pure protein per scoop with near-zero fillers, fats, or sugars.<br>- <strong>Lean Muscle Support:</strong> The perfect catalyst for maximizing hypertrophy, enhancing recovery times, and supporting a lean, shredded physique.<br>- <strong>Uncompromising Purity:</strong> Clean, easily digestible, and aligned with our commitment to high-quality, premium formulations.', 4, 'assets/images/products/189873.png', 'assets/images/products/189873.png', '- Ultra-Pure Isolate: 27g protein per serving with 90%+ protein content and minimal carbs and fats.<br>- Fast Absorption: Micro-filtered whey isolate for rapid amino acid delivery to muscles.<br>- Muscle Recovery: Rich in BCAAs and essential amino acids to support post-workout repair.<br>- Clean Label: No added sugar, no artificial colors, no fillers.', 'Whey Protein Isolate (from Grass-Fed Cows), Natural Cocoa Flavor (for Chocolate variant), Sunflower Lecithin (emulsifier), Steviol Glycosides (natural sweetener).', 'Mix 1 scoop (30g) with 200-250ml of cold water or milk. Shake or blend for 20-30 seconds. Best consumed within 30 minutes after exercise or as a meal supplement.', 'Not a substitute for a balanced diet. Do not exceed recommended daily intake. Keep in a cool, dry place away from direct sunlight. Once opened, consume within 60 days.', 0, '2026-07-19 16:45:55'),
(5, 'Wolfgain - Advanced Mass Gainer Formula', 'wolfgain-advanced-mass-gainer', 'Advanced Mass Gainer Formula built for those who demand uncompromising bulk and power. Serious gains, serious taste.', 'Size matters when you are hunting for serious gains. Prepare for the arrival of Wolfgain, our Advanced Mass Gainer Formula built for those who demand uncompromising bulk and power. Formulated with a high-quality protein blend and multi-sourced carbs, Wolfgain is designed to replenish depleted glycogen stores, trigger rapid muscle recovery, and pack on dense mass after your most brutal workouts.<br><br><strong>Why Wolfgain Will Dominate:</strong><br>- <strong>Multi-Sourced Carbs:</strong> Provides a sustained release of energy to fuel heavy lifts and prevent muscle breakdown.<br>- <strong>High-Quality Blend:</strong> Premium macronutrients engineered for optimal absorption and maximum muscle hypertrophy.<br>- <strong>Incredible Taste:</strong> Launching in our signature Choco Fury flavor because fueling your gains should taste as good as it feels.', 5, 'assets/images/products/189869.png', 'assets/images/products/189869.png', '- Multi-Sourced Carbs: Complex and simple carbohydrate blend for sustained energy and glycogen replenishment.<br>- Premium Protein Blend: High-quality protein matrix for optimal muscle recovery and growth.<br>- Rapid Mass Gain: Engineered for maximum caloric density to support serious weight and muscle gain.<br>- Incredible Taste: Launching in Choco Fury flavor for a delicious post-workout experience.<br>- Clean Formula: No artificial colors, zero trans fats, and minimal fillers.', 'Multi-Carb Complex (Maltodextrin, Oat Flour, Sweet Potato Powder), Whey Protein Concentrate, Milk Protein Isolate, Cocoa Powder, Natural & Artificial Flavors, Sunflower Lecithin, Medium Chain Triglycerides (MCT Oil), Digestive Enzyme Blend (Amylase, Protease).', 'Mix 1-2 scoops (100-200g) with 300-600ml of cold water or milk. Shake or blend for 30-45 seconds. Best consumed post-workout or between meals to meet your daily caloric goals.', 'Not intended for use by individuals under 18. Consult your physician before use if you have any medical condition. Keep out of reach of children. Store in a cool, dry place.', 0, '2026-07-20 08:14:09'),
(6, 'WOLF-AG - Premium Ashwagandha Extract Capsules', 'wolf-ag-premium-ashwagandha-extract', 'Premium Ashwagandha extract capsules to conquer stress, reclaim focus, and unlock your true physical potential.', 'Conquer stress, reclaim your focus, and unlock your true physical potential with Wolf-AG, our upcoming premium Ashwagandha extract capsules. Rooted in ancient botanical wisdom and refined for the modern alpha, Wolf-AG delivers a highly potent, standardized dose of pure Ashwagandha. Designed to naturally lower cortisol, boost vitality, and accelerate recovery, this powerful adaptogen helps you maintain an untamed edge in both the gym and daily life.<br><br><strong>The Adaptogenic Edge:</strong><br>- <strong>Cortisol and Stress Control:</strong> Helps the body adapt to intense physical and mental stress, keeping your mind sharp and your focus locked.<br>- <strong>Strength and Vitality Support:</strong> Formulated to naturally aid in boosting endurance, muscular strength, and overall vitality.<br>- <strong>Deep Physical Recovery:</strong> Optimizes nighttime recovery and reduces muscle soreness, ensuring you wake up ready to hunt your goals.<br>- <strong>100% Pure Botanicals:</strong> True to our raw philosophy, delivering a clean, high-potency herbal extract with zero unnecessary fillers.', 1, 'assets/images/products/189872.png', 'assets/images/products/189872.png', '- Cortisol and Stress Control: Helps the body adapt to intense physical and mental stress, keeping your mind sharp and focused.<br>- Strength and Vitality Support: Naturally aids in boosting endurance, muscular strength, and overall vitality.<br>- Deep Physical Recovery: Optimizes nighttime recovery and reduces muscle soreness for peak performance.<br>- 100% Pure Botanicals: Clean, high-potency herbal extract with zero unnecessary fillers.<br>- Standardized Extract: Each capsule delivers a consistent, clinically-relevant dose of KSM-66 Ashwagandha.', 'Each 500mg Veggie Capsule contains: Ashwagandha (Withania somnifera) Root Extract (KSM-66, 5% Withanolides) 500mg.', 'Take 1 capsule twice daily with meals, or as directed by your healthcare professional. For best results, maintain consistency for 60-90 days.', 'Not recommended for pregnant or lactating women. Consult your physician before use if you have autoimmune conditions, thyroid disorders, or are taking medication. Keep out of reach of children.', 0, '2026-07-20 08:15:10'),
(7, 'Wolfgain - Advanced Mass Gainer Formula (2KG)', 'wolfgain-advanced-mass-gainer-2kg', 'Size matters when you\'re hunting for serious gains. Prepare for the arrival of Wolfgain, our Advanced Mass Gainer Formula built for those who demand uncompromising bulk and power.', 'Size matters when you\'re hunting for serious gains. Prepare for the arrival of Wolfgain, our Advanced Mass Gainer Formula built for those who demand uncompromising bulk and power. Formulated with a high-quality protein blend and multi-sourced carbs, Wolfgain is designed to replenish depleted glycogen stores, trigger rapid muscle recovery, and pack on dense mass after your most brutal workouts.', 4, 'assets/images/products/189871.png', 'assets/images/products/189871.png', 'Multi-Sourced Carbs: Provides a sustained release of energy to fuel heavy lifts and prevent muscle breakdown.\nHigh-Quality Blend: Premium macronutrients engineered for optimal absorption and maximum muscle hypertrophy.\nIncredible Taste: Launching in our signature Choco Fury flavor.', 'Multi-Source Carbohydrate Blend (Oat Flour, Maltodextrin, Waxy Maize) 50g, Whey Protein Concentrate 15g, Milk Protein Isolate 10g, Natural Cocoa Flavor, MCT Oil 3g, Digestive Enzyme Blend 50mg, Sunflower Lecithin.', 'Mix 1 heaping scoop (100g) with 300-400ml of cold water or milk. Blend or shake vigorously for 30-45 seconds. Best consumed post-workout or between meals.', 'Not a substitute for a balanced diet. Do not exceed recommended daily intake. Keep in a cool, dry place away from direct sunlight.', 0, '2026-07-20 17:36:49'),
(8, 'WOLFPRO - Premium Protein Isolate (2kg)', 'wolfpro-premium-protein-isolate-2kg', 'Ultra-pure protein isolate for elite performance and rapid muscle repair. Clean fuel for lean, dense muscle.', 'When you train like a beast, you need to recover like an alpha. Enter WOLFPRO, our upcoming Premium Protein Isolate designed for elite performance and rapid muscle repair. Stripped of excess fats, carbs, and lactose, this ultra-pure isolate delivers the raw, fast-absorbing nutrients your muscles crave immediately after a brutal session. Engineered for those who refuse to compromise on quality, WOLFPRO provides the clean fuel necessary to build lean, dense muscle and keep you at the top of the food chain.<br><br><strong>The Alpha Standard:</strong><br>- <strong>Rapid Absorption:</strong> Micro-filtered isolate digests quickly to flood your muscles with essential amino acids right when you need them most.<br>- <strong>Maximum Protein Yield:</strong> Delivers a massive hit of pure protein per scoop with near-zero fillers, fats, or sugars.<br>- <strong>Lean Muscle Support:</strong> The perfect catalyst for maximizing hypertrophy, enhancing recovery times, and supporting a lean, shredded physique.<br>- <strong>Uncompromising Purity:</strong> Clean, easily digestible, and aligned with our commitment to high-quality, premium formulations.', 4, 'assets/images/products/189874.png', 'assets/images/products/189874.png', '- Ultra-Pure Isolate: 27g protein per serving with 90%+ protein content and minimal carbs and fats.<br>- Fast Absorption: Micro-filtered whey isolate for rapid amino acid delivery to muscles.<br>- Muscle Recovery: Rich in BCAAs and essential amino acids to support post-workout repair.<br>- Clean Label: No added sugar, no artificial colors, no fillers.', 'Whey Protein Isolate (from Grass-Fed Cows), Natural Cocoa Flavor (for Chocolate variant), Sunflower Lecithin (emulsifier), Steviol Glycosides (natural sweetener).', 'Mix 1 scoop (30g) with 200-250ml of cold water or milk. Shake or blend for 20-30 seconds. Best consumed within 30 minutes after exercise or as a meal supplement.', 'Not a substitute for a balanced diet. Do not exceed recommended daily intake. Keep in a cool, dry place away from direct sunlight. Once opened, consume within 60 days.', 0, '2026-07-21 04:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `size_capsules` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `stock_qty` int(11) DEFAULT 0,
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `sku`, `size_capsules`, `price`, `sale_price`, `stock_qty`, `is_default`) VALUES
(1, 1, 'WP30', '30 Veggie Capsules', 1697.00, 1194.00, 99, 1),
(2, 1, 'WP60', '60 Veggie Capsules', 2498.00, 1999.00, 150, 0),
(3, 2, 'WT30', '30 Veggie Capsules', 1499.00, 1275.00, 80, 1),
(4, 2, 'WT60', '60 Veggie Capsules', 1499.00, 999.00, 120, 0),
(6, 3, 'WB60', '60 Veggie Capsules', 1799.00, 1499.00, 0, 1),
(7, 4, 'WP1KG', '1 KG (30 Servings)', 2999.00, 2499.00, 0, 1),
(8, 8, 'WP2KG', '2 KG (60 Servings)', 5499.00, 4199.00, 0, 0),
(9, 5, 'WG1KG', '1 KG (15 Servings)', 2999.00, 2499.00, 0, 1),
(11, 6, 'WAG60', '60 Veggie Capsules', 1499.00, 1199.00, 0, 1),
(13, 7, 'WG2KG', '2KG - 30 Servings', 4999.00, 4199.00, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quantity_discounts`
--

CREATE TABLE `quantity_discounts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `min_qty` int(11) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quantity_discounts`
--

INSERT INTO `quantity_discounts` (`id`, `product_id`, `min_qty`, `discount_percent`, `status`) VALUES
(1, NULL, 2, 10.00, 1),
(2, NULL, 3, 15.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `review_text` text NOT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `user_name`, `rating`, `title`, `review_text`, `is_approved`, `is_featured`, `created_at`) VALUES
(1, 1, 2, 'Yuvek Verma', 5, 'Absolute Game Changer!', 'I have been using the 60 Capsules pack of Wolfpack for over a month now. My stamina levels and gym performance have gone through the roof! It has a subtle energy release without any jitters. Highly recommended.', 1, 1, '2026-07-01 10:48:06'),
(2, 2, NULL, 'Karan Sharma', 5, 'Highly effective detox', 'I take Wolftox daily to protect my liver from a high-protein bodybuilding diet. It keeps my digestion smooth and completely removes bloating. 100% natural, no chemical taste.', 1, 1, '2026-07-01 10:48:06'),
(3, 1, NULL, 'Sanjay Sen', 4, 'Very good vitality supplement', 'Great ingredients. Standardized Shilajit + Ashwagandha really helps with office fatigue. Deducted 1 star because shipping took 5 days, but the product is excellent.', 1, 0, '2026-07-01 10:48:06'),
(6, 2, NULL, 'ghgdh', 5, 'hgfgh', 'hgdh', 0, 0, '2026-07-05 11:40:02'),
(7, 1, 4, 'madhavarora1213', 5, 'vhj', 'cgfgh', 1, 0, '2026-07-06 14:56:04'),
(8, 1, 4, 'madhavarora1213', 5, 'vhj', 'cgfgh', 0, 0, '2026-07-06 14:57:03'),
(9, 1, 4, 'madhavarora1213', 5, 'vhj', 'cgfgh', 0, 0, '2026-07-06 15:02:37'),
(10, 1, 4, 'madhavarora1213', 5, 'vhj', 'cgfgh', 0, 0, '2026-07-06 15:10:20'),
(11, 1, 4, 'madhavarora1213', 5, 'vhj', 'cgfgh', 0, 0, '2026-07-06 15:15:14'),
(12, 1, 4, 'madhavarora1213', 5, 'vhj', 'cgfgh', 0, 0, '2026-07-06 15:18:58'),
(13, 1, 4, 'madhavarora1213', 5, 'vhj', 'cgfgh', 0, 0, '2026-07-06 15:19:02');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_title` varchar(150) DEFAULT NULL,
  `testimonial_text` text NOT NULL,
  `rating` int(11) DEFAULT 5,
  `avatar_url` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `customer_name`, `customer_title`, `testimonial_text`, `rating`, `avatar_url`, `display_order`, `is_featured`, `status`, `created_at`) VALUES
(1, 'Rahul Sharma', 'Fitness Trainer, Mumbai', 'Wolf Nutrition supplements have completely transformed my training recovery. The Vitality Stack is a game-changer for energy and stamina.', 5, NULL, 1, 1, 1, '2026-07-05 15:25:55'),
(2, 'Amit Verma', 'Software Engineer, Delhi', 'I was skeptical at first but after 2 weeks of using the Liver Detox supplement, I noticed a massive improvement in my energy levels and digestion.', 5, NULL, 2, 1, 1, '2026-07-05 15:25:55'),
(3, 'Priya Singh', 'Yoga Instructor, Bangalore', 'The 100% Ayurvedic ingredients give me confidence. No side effects, just pure results. Highly recommend to anyone serious about their health.', 4, NULL, 3, 0, 1, '2026-07-05 15:25:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `is_active`, `created_at`) VALUES
(1, 'Admin Wolf', 'admin@wolfnutrition.in', '9999999999', '$2y$10$Pr5A3f6vyUj/fHFQX87qZOvOXWUJ1QcuJppNvs7rza.f.mFVlsUce', 'admin', 1, '2026-07-01 10:48:06'),
(2, 'Yuvek Verma', 'yuvek@gmail.com', '9876543210', '$2y$10$vYqF2jJszkKux6g2gL3O2eF1Z0t4JkU1F1p9L7oZzU8rOqQ5iN6zG', 'customer', 1, '2026-07-01 10:48:06'),
(3, 'Kashish Singh', 'singhkashish364@gmail.com', '', '$2y$10$rfCtMyY1/I7GhuF8pIv0Y.A8i6LoOcWAqwUzKShGJTai3c/4fw.gW', 'admin', 1, '2026-07-01 11:44:53'),
(4, 'Kashish Singh', 'madhavarora132005@gmail.com', '8707773540', '$2y$10$IYnkgrsQK2LPGcozFOIPMu100No9CUFGn/1yqecH98NrCkKTvod4m', 'customer', 1, '2026-07-01 17:01:56'),
(5, 'Arun', 'aroramadhav1213@gmail.com', '9877275894', '$2y$10$15e2hdZ5T0IJdBH1bcV6NeE3XmnCtH5WPitszaC.5AgmdYuXwkrEG', 'customer', 1, '2026-07-03 11:32:03'),
(6, 'hfvhjevf', 'admin@thehimt.com', '830620489', '$2y$10$QW5J.JTmJBfrfpG4UrZclepU1ZqLBwPASTs3zDN1XX/FWVZn5xoxq', 'customer', 1, '2026-07-03 16:29:38'),
(7, 'Madhav Aroea', 'aroramadhav1312@gmail.com', '9041525250', '$2y$10$vbQGl3UlStP.9xB/outEZePb7hDA4vYjci5z0PKv/JTWZfI3KBmnK', 'customer', 1, '2026-07-06 12:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `country` varchar(100) DEFAULT 'India',
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `name`, `phone`, `address_line1`, `address_line2`, `city`, `state`, `pincode`, `country`, `is_default`) VALUES
(1, 6, 'Madhav Arora', '9877275894', 'nikki board vpo khudda district hoshiarpur', '1st Floor', 'Hoshiarpur', 'Punjab', '144305', 'India', 1);

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_settings`
--

CREATE TABLE `whatsapp_settings` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `greeting_message` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whatsapp_settings`
--

INSERT INTO `whatsapp_settings` (`id`, `phone_number`, `greeting_message`, `status`) VALUES
(1, '+912212602200', 'Hey Wolf Nutrition! I\'m interested in your supplements. Can you help me choose?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `bundles`
--
ALTER TABLE `bundles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `bundle_items`
--
ALTER TABLE `bundle_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bundle_id` (`bundle_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`),
  ADD KEY `idx_active` (`is_active`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`),
  ADD KEY `bundle_id` (`bundle_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `quantity_discounts`
--
ALTER TABLE `quantity_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bundles`
--
ALTER TABLE `bundles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bundle_items`
--
ALTER TABLE `bundle_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `quantity_discounts`
--
ALTER TABLE `quantity_discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bundle_items`
--
ALTER TABLE `bundle_items`
  ADD CONSTRAINT `bundle_items_ibfk_1` FOREIGN KEY (`bundle_id`) REFERENCES `bundles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bundle_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bundle_items_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_ibfk_4` FOREIGN KEY (`bundle_id`) REFERENCES `bundles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quantity_discounts`
--
ALTER TABLE `quantity_discounts`
  ADD CONSTRAINT `quantity_discounts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
