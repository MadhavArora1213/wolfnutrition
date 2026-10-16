-- Migration: Add editable combo MRP to bundles (combos)
-- individual_mrp = the struck-through "Individual MRP" shown for a combo.
-- 0 (default)  = auto-calculate from the MRPs of the products added to the combo
-- > 0          = admin's own value, shown as-is (total is NOT fetched from products)

USE `wolfnutrition`;

ALTER TABLE `bundles`
  ADD COLUMN `individual_mrp` DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER `combo_price`;
