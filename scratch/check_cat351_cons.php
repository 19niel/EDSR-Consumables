<?php
require __DIR__ . '/../php/db_conn.php';

$res = $conn->query("
    SELECT COUNT(*) as cnt
    FROM subcategories sc
    JOIN consumables c ON c.model_id = sc.id
    WHERE sc.category_id = 351
");
$row = $res->fetch_assoc();
echo "Consumables linked to category 351 (RISO Machine): " . $row['cnt'] . "\n";

$res2 = $conn->query("
    SELECT COUNT(*) as cnt
    FROM subcategories sc
    JOIN consumables c ON c.model_id = sc.id
    WHERE sc.category_id = 396
");
$row2 = $res2->fetch_assoc();
echo "Consumables linked to category 396 (RISO Consumables): " . $row2['cnt'] . "\n";
