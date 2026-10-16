<?php
// Database Configuration — loads from .env

require_once __DIR__ . '/env.php';

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'wolfnutrition');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

// ── Base URL (works on localhost/subfolder and live domain) ──
if (!defined('BASE_URL')) {
    $scheme   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script   = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
    // Find the root directory relative to document root
    $docRoot  = rtrim($_SERVER['DOCUMENT_ROOT'] ?? '', '/');
    $appRoot  = dirname(dirname(__FILE__)); // one level up from config/
    $subPath  = str_replace($docRoot, '', $appRoot);
    $subPath  = str_replace('\\', '/', $subPath);
    define('BASE_URL', $scheme . '://' . $host . rtrim($subPath, '/'));
}

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
        ]
    );

    // Auto-create rate limiter table if missing
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS login_attempts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ip_address VARCHAR(45) NOT NULL,
            email VARCHAR(255) NOT NULL,
            attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB;
    ");

    // Auto-migrate: admin-editable combo MRP (bundles.individual_mrp).
    // Added for the combo page's struck-through "Individual MRP" field.
    // Runs only when the column is missing, so it is safe on every request.
    try {
        if ($pdo->query("SHOW COLUMNS FROM bundles LIKE 'individual_mrp'")->fetch() === false) {
            $pdo->exec("ALTER TABLE bundles ADD COLUMN individual_mrp DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER combo_price");
        }
    } catch (PDOException $e) {
        // bundles table not created yet (fresh install) — nothing to migrate
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
