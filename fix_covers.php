<?php
require_once __DIR__ . '/config/db.php';

$rows = $pdo->query("SELECT id, cover_image FROM blog_posts WHERE cover_image IS NOT NULL AND cover_image != ''")->fetchAll();
$fixed = 0;

foreach ($rows as $row) {
    $path = $row['cover_image'];
    if (!str_starts_with($path, 'http')) {
        $check = __DIR__ . '/' . ltrim($path, '/');
        if (!file_exists($check)) {
            $pdo->prepare("UPDATE blog_posts SET cover_image = '' WHERE id = ?")->execute([$row['id']]);
            $fixed++;
        }
    }
}

echo "Fixed $fixed blog posts with missing cover images.";
