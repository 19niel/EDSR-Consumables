<?php
require 'php/db_conn.php';

echo "<h3>Adding BH-C458 Roller Consumable</h3>";

$categoryName = 'KM Color';
$modelName = 'BH-C458';
$consumableName = 'ROLLER';
$itemCodeName = 'ROLLER ADXG560100';

// 1. Get Category ID for KM Color
$stmt_cat = $conn->prepare("SELECT id FROM categories WHERE category_name = ? AND is_deleted = 0 LIMIT 1");
$stmt_cat->bind_param("s", $categoryName);
$stmt_cat->execute();
$res_cat = $stmt_cat->get_result();

if ($res_cat->num_rows == 0) {
    echo "<p style='color:red;'>❌ Category '$categoryName' not found.</p>";
    exit;
}
$category_id = $res_cat->fetch_assoc()['id'];
$stmt_cat->close();
echo "<p>✅ Found Category: $categoryName (ID: $category_id)</p>";

// 2. Check/Insert Model BH-C458
$stmt_mod = $conn->prepare("SELECT id FROM subcategories WHERE subcategory_name = ? AND category_id = ? AND is_deleted = 0 LIMIT 1");
$stmt_mod->bind_param("si", $modelName, $category_id);
$stmt_mod->execute();
$res_mod = $stmt_mod->get_result();

if ($res_mod->num_rows == 0) {
    $stmt_insert = $conn->prepare("INSERT INTO subcategories (subcategory_name, category_id, is_deleted) VALUES (?, ?, 0)");
    $stmt_insert->bind_param("si", $modelName, $category_id);
    $stmt_insert->execute();
    $model_id = $stmt_insert->insert_id;
    echo "<p style='color:green;'>✅ Inserted New Machine: $modelName</p>";
} else {
    $model_id = $res_mod->fetch_assoc()['id'];
    echo "<p style='color:blue;'>ℹ️ Machine $modelName already exists.</p>";
}
$stmt_mod->close();

// 3. Check/Insert Consumable 'Roller'
$stmt_cons = $conn->prepare("SELECT id FROM consumables WHERE consumable_name = ? AND model_id = ? AND is_deleted = 0 LIMIT 1");
$stmt_cons->bind_param("si", $consumableName, $model_id);
$stmt_cons->execute();
$res_cons = $stmt_cons->get_result();

if ($res_cons->num_rows == 0) {
    $stmt_insert_cons = $conn->prepare("INSERT INTO consumables (consumable_name, model_id, is_deleted) VALUES (?, ?, 0)");
    $stmt_insert_cons->bind_param("si", $consumableName, $model_id);
    $stmt_insert_cons->execute();
    $cons_id = $stmt_insert_cons->insert_id;
    echo "<p style='color:green;'>✅ Inserted New Consumable: $consumableName</p>";
} else {
    $cons_id = $res_cons->fetch_assoc()['id'];
    echo "<p style='color:blue;'>ℹ️ Consumable $consumableName already exists.</p>";
}
$stmt_cons->close();

// 4. Check/Insert Item Code
$stmt_item = $conn->prepare("SELECT id FROM item_codes WHERE item_name = ? AND consumable_id = ? AND is_deleted = 0 LIMIT 1");
$stmt_item->bind_param("si", $itemCodeName, $cons_id);
$stmt_item->execute();
$res_item = $stmt_item->get_result();

if ($res_item->num_rows == 0) {
    $stmt_insert_item = $conn->prepare("INSERT INTO item_codes (item_name, consumable_id, is_deleted) VALUES (?, ?, 0)");
    $stmt_insert_item->bind_param("si", $itemCodeName, $cons_id);
    $stmt_insert_item->execute();
    echo "<p style='color:green;'>✅ Added Item Code: $itemCodeName</p>";
} else {
    echo "<p style='color:blue;'>ℹ️ Item Code $itemCodeName already exists.</p>";
}
$stmt_item->close();

echo "<h4>Update Complete!</h4>";
?>
