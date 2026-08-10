<?php
require 'php/db_conn.php';

echo "<h3>Server Database Update Script</h3>";

// 1. Add vatType column if it doesn't exist
$result = $conn->query("SHOW COLUMNS FROM encoded LIKE 'vatType'");
if ($result->num_rows == 0) {
    $sql = "ALTER TABLE encoded ADD COLUMN vatType VARCHAR(20) DEFAULT NULL AFTER proposedPrice";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>✅ Column 'vatType' added successfully to 'encoded' table.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error adding column: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color:blue;'>ℹ️ Column 'vatType' already exists.</p>";
}

// 2. Add KM Mono Models and Consumables
$stmt_cat = $conn->prepare("SELECT id FROM categories WHERE category_name = 'KM Mono' AND is_deleted = 0 LIMIT 1");
$stmt_cat->execute();
$res_cat = $stmt_cat->get_result();

if ($res_cat->num_rows == 0) {
    echo "<p style='color:red;'>❌ Category 'KM Mono' not found.</p>";
} else {
    $category_id = $res_cat->fetch_assoc()['id'];
    
    $models = ['BH287', 'BH367'];
    $data = [
        'TONER' => 'TONER BLACK (TN323)',
        'DEVELOPING UNIT' => 'DEVELOPING UNIT (DV312)',
        'DRUM UNIT' => 'DRUM UNIT (DR312)',
        'OZONE FILTER' => 'OZONE FILTER',
        'TONER FILTER' => 'TONER FILTER',
        'WASTE TONER BOX' => 'WASTE TONER BOX',
        'FUSING UNIT' => 'FUSING UNIT',
        'TRANSFER ROLLER UNIT' => 'TRANSFER ROLLER UNIT'
    ];

    foreach ($models as $model_name) {
        // Subcategory check
        $stmt = $conn->prepare("SELECT id FROM subcategories WHERE subcategory_name = ? AND category_id = ? AND is_deleted = 0 LIMIT 1");
        $stmt->bind_param("si", $model_name, $category_id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        if ($res->num_rows == 0) {
            $stmt_insert_sub = $conn->prepare("INSERT INTO subcategories (subcategory_name, category_id, is_deleted) VALUES (?, ?, 0)");
            $stmt_insert_sub->bind_param("si", $model_name, $category_id);
            $stmt_insert_sub->execute();
            $model_id = $stmt_insert_sub->insert_id;
            echo "<p style='color:green;'>✅ Inserted Model: $model_name</p>";
        } else {
            $model_id = $res->fetch_assoc()['id'];
            echo "<p style='color:blue;'>ℹ️ Model $model_name already exists.</p>";
        }
        
        foreach ($data as $cons_name => $item_code_name) {
            // Consumable check
            $stmt_cons = $conn->prepare("SELECT id FROM consumables WHERE consumable_name = ? AND model_id = ? AND is_deleted = 0 LIMIT 1");
            $stmt_cons->bind_param("si", $cons_name, $model_id);
            $stmt_cons->execute();
            $res_cons = $stmt_cons->get_result();
            
            if ($res_cons->num_rows == 0) {
                $stmt_insert_cons = $conn->prepare("INSERT INTO consumables (consumable_name, model_id, is_deleted) VALUES (?, ?, 0)");
                $stmt_insert_cons->bind_param("si", $cons_name, $model_id);
                $stmt_insert_cons->execute();
                $cons_id = $stmt_insert_cons->insert_id;
            } else {
                $cons_id = $res_cons->fetch_assoc()['id'];
            }
            
            // Item code check
            $stmt_item = $conn->prepare("SELECT id FROM item_codes WHERE item_name = ? AND consumable_id = ? AND is_deleted = 0 LIMIT 1");
            $stmt_item->bind_param("si", $item_code_name, $cons_id);
            $stmt_item->execute();
            $res_item = $stmt_item->get_result();
            
            if ($res_item->num_rows == 0) {
                $stmt_insert_item = $conn->prepare("INSERT INTO item_codes (item_name, consumable_id, is_deleted) VALUES (?, ?, 0)");
                $stmt_insert_item->bind_param("si", $item_code_name, $cons_id);
                $stmt_insert_item->execute();
            }
        }
        echo "<p style='color:green;'>✅ Checked and updated all consumables/item codes for $model_name.</p>";
    }
}
echo "<hr><h4>Update Complete! You can now delete this file from the server for security.</h4>";
?>
