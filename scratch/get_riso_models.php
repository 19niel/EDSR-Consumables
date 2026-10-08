<?php
require_once __DIR__ . '/../php/db_conn.php';

$catRes = $conn->query("SELECT id, category_name FROM categories WHERE field = 'Product Type' AND category_name IN ('RISO', 'RISO Machine') AND is_deleted = 0");
$categories = [];
while ($row = $catRes->fetch_assoc()) {
    $categories[] = $row['id'];
}

if (empty($categories)) {
    echo "No RISO categories found.\n";
    exit;
}

$catIds = implode(",", $categories);
$res = $conn->query("SELECT subcategory_name FROM subcategories WHERE category_id IN ($catIds) AND is_deleted = 0");
$models = [];
while ($row = $res->fetch_assoc()) {
    $models[] = $row['subcategory_name'];
}
sort($models);
echo implode("\n", $models) . "\n";
