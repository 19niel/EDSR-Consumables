<?php
require __DIR__ . '/../php/db_conn.php';

echo "=== 1. Categories for RISO ===\n";
$res = $conn->query("SELECT id, field, category_name FROM categories WHERE category_name LIKE '%RISO%'");
while($r = $res->fetch_assoc()) {
    echo "ID: {$r['id']} | Field: {$r['field']} | Name: {$r['category_name']}\n";
}

echo "\n=== 2. Subcategories under Category 396 (RISO Consumables) ===\n";
$res = $conn->query("SELECT id, category_id, subcategory_name FROM subcategories WHERE category_id = 396 AND is_deleted = 0 ORDER BY subcategory_name");
echo "Count: " . $res->num_rows . "\n";
while($r = $res->fetch_assoc()) {
    echo "  [ID: {$r['id']}] {$r['subcategory_name']}\n";
}

echo "\n=== 3. Subcategories under Category 351 (RISO Machine) ===\n";
$res = $conn->query("SELECT id, category_id, subcategory_name FROM subcategories WHERE category_id = 351 AND is_deleted = 0 ORDER BY subcategory_name");
echo "Count: " . $res->num_rows . "\n";
while($r = $res->fetch_assoc()) {
    echo "  [ID: {$r['id']}] {$r['subcategory_name']}\n";
}

echo "\n=== 4. Any other subcategories matching SF, MZ, RZ, EZ across all categories ===\n";
$res = $conn->query("SELECT id, category_id, subcategory_name FROM subcategories WHERE (subcategory_name LIKE 'SF%' OR subcategory_name LIKE 'MZ%' OR subcategory_name LIKE 'RZ%' OR subcategory_name LIKE 'EZ%') AND is_deleted = 0 ORDER BY category_id, subcategory_name");
echo "Count: " . $res->num_rows . "\n";
while($r = $res->fetch_assoc()) {
    echo "  Cat ID: {$r['category_id']} | [ID: {$r['id']}] {$r['subcategory_name']}\n";
}
