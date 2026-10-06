-- ====================================================================
-- Migration: Add RISO FII Consumable Options to SF/MZ/RZ/EZ Series
-- Safe & Idempotent: Uses NOT EXISTS subqueries to prevent duplicates
-- ====================================================================

-- --------------------------------------------------------------------
-- Category 396 (RISO Consumables)
-- --------------------------------------------------------------------

-- Model: EZ2301
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ330
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ331
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ3701
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ5701
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ1070
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ7700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ8700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ970
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ1070
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ2300
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ3700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ5700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ970
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF5230
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF530
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF5330
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF5350
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF9350
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF9390
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 396 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- --------------------------------------------------------------------
-- Category 351 (RISO Machine)
-- --------------------------------------------------------------------

-- Model: EZ2301
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ2301' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ330
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ330' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ331
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ331' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ3701
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ3701' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: EZ5701
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'EZ5701' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ1070
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ1070' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ7700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ7700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ8700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ8700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: MZ970
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'MZ970' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ1070
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ1070' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ2300
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ2300' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ3700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ3700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ5700
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ5700' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: RZ970
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'RZ970' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF5230
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5230' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF530
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF530' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF5330
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5330' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF5350
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF5350' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF9350
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9350' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

-- Model: SF9390
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLACK AG', 'RISO INK FII TYPE BLACK AG', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLACK AG' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE YELLOW UA', 'RISO INK FII TYPE YELLOW UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE YELLOW UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE BLUE UA', 'RISO INK FII TYPE BLUE UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE BLUE UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE FLUORESCENT PINK UA', 'RISO INK FII TYPE FLUORESCENT PINK UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE FLUORESCENT PINK UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE GREEN UA', 'RISO INK FII TYPE GREEN UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE GREEN UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE RED UA', 'RISO INK FII TYPE RED UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE RED UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO INK FII TYPE AQUA UA', 'RISO INK FII TYPE AQUA UA', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO INK FII TYPE AQUA UA' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'INK'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;
INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)
SELECT c.id, 'RISO MASTER FII TYPE77AG/A3', 'RISO MASTER FII TYPE77AG/A3', 0
FROM `consumables` c
JOIN `subcategories` sc ON c.model_id = sc.id
WHERE sc.category_id = 351 AND sc.subcategory_name = 'SF9390' AND c.consumable_name = 'MASTER'
  AND NOT EXISTS (
      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = 'RISO MASTER FII TYPE77AG/A3' AND ic.is_deleted = 0
  ) LIMIT 1;

