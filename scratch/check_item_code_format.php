<?php
require __DIR__ . '/../php/db_conn.php';

$res = $conn->query("SELECT id, consumable_id, item_code, item_name FROM item_codes WHERE item_name LIKE 'RISO INK FII%' LIMIT 10");
while($r = $res->fetch_assoc()) {
    echo "ID: {$r['id']} | ConsID: {$r['consumable_id']} | Code: '{$r['item_code']}' | Name: '{$r['item_name']}'\n";
}
