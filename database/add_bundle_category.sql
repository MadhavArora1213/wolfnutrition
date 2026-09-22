-- Migration: Add optional category_id to bundles (combos)
-- Category is OPTIONAL (nullable) so admin can assign "best seller" category for reporting.

USE `wolfnutrition`;

ALTER TABLE `bundles`
  ADD COLUMN `category_id` INT NULL DEFAULT NULL AFTER `display_order`,
  ADD CONSTRAINT `fk_bundles_category`
    FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
    ON DELETE SET NULL ON UPDATE CASCADE;
