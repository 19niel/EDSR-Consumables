<?php
require __DIR__ . '/../php/db_conn.php';

$sqlFile = __DIR__ . '/../add_riso_fii_options.sql';

$seriesModels = [
    'EZ2301', 'EZ330', 'EZ331', 'EZ3701', 'EZ5701',
    'MZ1070', 'MZ7700', 'MZ8700', 'MZ970',
    'RZ1070', 'RZ2300', 'RZ3700', 'RZ5700', 'RZ970',
    'SF5230', 'SF530', 'SF5330', 'SF5350', 'SF9350', 'SF9390'
];

$inkOptions = [
    'RISO INK FII TYPE BLACK AG',
    'RISO INK FII TYPE YELLOW UA',
    'RISO INK FII TYPE BLUE UA',
    'RISO INK FII TYPE FLUORESCENT PINK UA',
    'RISO INK FII TYPE GREEN UA',
    'RISO INK FII TYPE RED UA',
    'RISO INK FII TYPE AQUA UA',
    'RISO MASTER FII TYPE77AG/A3'
];

$masterOptions = [
    'RISO MASTER FII TYPE77AG/A3'
];

$sql = "-- ====================================================================\n";
$sql .= "-- Migration: Add RISO FII Consumable Options to SF/MZ/RZ/EZ Series\n";
$sql .= "-- Safe & Idempotent: Uses NOT EXISTS subqueries to prevent duplicates\n";
$sql .= "-- ====================================================================\n\n";

foreach ([396, 351] as $catId) {
    $catLabel = ($catId === 396) ? "Category 396 (RISO Consumables)" : "Category 351 (RISO Machine)";
    $sql .= "-- --------------------------------------------------------------------\n";
    $sql .= "-- $catLabel\n";
    $sql .= "-- --------------------------------------------------------------------\n\n";
    
    foreach ($seriesModels as $m) {
        $sql .= "-- Model: $m\n";
        
        // Ink items
        foreach ($inkOptions as $item) {
            $escItem = addslashes($item);
            $sql .= "INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)\n";
            $sql .= "SELECT c.id, '{$escItem}', '{$escItem}', 0\n";
            $sql .= "FROM `consumables` c\n";
            $sql .= "JOIN `subcategories` sc ON c.model_id = sc.id\n";
            $sql .= "WHERE sc.category_id = {$catId} AND sc.subcategory_name = '{$m}' AND c.consumable_name = 'INK'\n";
            $sql .= "  AND NOT EXISTS (\n";
            $sql .= "      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = '{$escItem}' AND ic.is_deleted = 0\n";
            $sql .= "  ) LIMIT 1;\n";
        }
        
        // Master item
        foreach ($masterOptions as $item) {
            $escItem = addslashes($item);
            $sql .= "INSERT INTO `item_codes` (`consumable_id`, `item_code`, `item_name`, `is_deleted`)\n";
            $sql .= "SELECT c.id, '{$escItem}', '{$escItem}', 0\n";
            $sql .= "FROM `consumables` c\n";
            $sql .= "JOIN `subcategories` sc ON c.model_id = sc.id\n";
            $sql .= "WHERE sc.category_id = {$catId} AND sc.subcategory_name = '{$m}' AND c.consumable_name = 'MASTER'\n";
            $sql .= "  AND NOT EXISTS (\n";
            $sql .= "      SELECT 1 FROM `item_codes` ic WHERE ic.consumable_id = c.id AND ic.item_name = '{$escItem}' AND ic.is_deleted = 0\n";
            $sql .= "  ) LIMIT 1;\n";
        }
        $sql .= "\n";
    }
}

file_put_contents($sqlFile, $sql);
echo "Generated add_riso_fii_options.sql successfully!\n";
