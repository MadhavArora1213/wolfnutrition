-- Migration: Add product_categories junction table for many-to-many
USE `wolfnutrition`;

CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`product_id`, `category_id`),
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Migrate existing single category_id data into the junction table
INSERT IGNORE INTO `product_categories` (`product_id`, `category_id`)
SELECT `id`, `category_id` FROM `products` WHERE `category_id` IS NOT NULL;
