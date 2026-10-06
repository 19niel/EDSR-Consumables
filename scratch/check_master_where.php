<?php
require __DIR__ . '/../php/db_conn.php';

$res = $conn->query("
    SELECT ic.id, ic.consumable_id, c.consumable_name, sc.subcategory_name, sc.category_id
    FROM item_codes ic
    JOIN consumables c ON ic.consumable_id = c.id
    JOIN subcategories sc ON c.model_id = sc.id
    WHERE ic.item_name LIKE '%RISO MASTER FII TYPE77AG/A3%'
");
echo "Existing occurrences of RISO MASTER FII TYPE77AG/A3:\n";
while($r = $res->fetch_assoc()) {
    echo "  Cat {$r['category_id']} | Model: {$r['subcategory_name']} | Consumable: {$r['consumable_name']} (ID: {$r['consumable_id']}) | Item ID: {$r['id']}\n";
}
