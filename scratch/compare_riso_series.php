<?php
require __DIR__ . '/../php/db_conn.php';

echo "=== Subcategories starting with SF, MZ, RZ, EZ under Category 396 (RISO) ===\n";
$res396 = $conn->query("
    SELECT id, subcategory_name
    FROM subcategories
    WHERE category_id = 396
      AND (subcategory_name LIKE 'SF%' OR subcategory_name LIKE 'MZ%' OR subcategory_name LIKE 'RZ%' OR subcategory_name LIKE 'EZ%')
      AND is_deleted = 0
    ORDER BY subcategory_name
");
while($r = $res396->fetch_assoc()) {
    echo "  [ID: {$r['id']}] {$r['subcategory_name']}\n";
    $cres = $conn->query("SELECT id, consumable_name FROM consumables WHERE model_id = {$r['id']} AND is_deleted = 0");
    while($cr = $cres->fetch_assoc()) {
        $icres = $conn->query("SELECT id, item_name FROM item_codes WHERE consumable_id = {$cr['id']} AND is_deleted = 0");
        echo "     Consumable [ID: {$cr['id']}]: {$cr['consumable_name']} (" . $icres->num_rows . " item codes)\n";
    }
}

echo "\n=== Subcategories starting with SF, MZ, RZ, EZ under Category 351 (RISO Machine) ===\n";
$res351 = $conn->query("
    SELECT id, subcategory_name
    FROM subcategories
    WHERE category_id = 351
      AND (subcategory_name LIKE 'SF%' OR subcategory_name LIKE 'MZ%' OR subcategory_name LIKE 'RZ%' OR subcategory_name LIKE 'EZ%')
      AND is_deleted = 0
    ORDER BY subcategory_name
");
while($r = $res351->fetch_assoc()) {
    echo "  [ID: {$r['id']}] {$r['subcategory_name']}\n";
    $cres = $conn->query("SELECT id, consumable_name FROM consumables WHERE model_id = {$r['id']} AND is_deleted = 0");
    while($cr = $cres->fetch_assoc()) {
        $icres = $conn->query("SELECT id, item_name FROM item_codes WHERE consumable_id = {$cr['id']} AND is_deleted = 0");
        echo "     Consumable [ID: {$cr['id']}]: {$cr['consumable_name']} (" . $icres->num_rows . " item codes)\n";
    }
}
