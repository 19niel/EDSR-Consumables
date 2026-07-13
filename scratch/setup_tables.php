<?php
include('../php/db_conn.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>E-DSR Database Setup - Consumables & Item Codes Tables</h3>";

// 1. Create the consumables table
$consumablesTableSql = "CREATE TABLE IF NOT EXISTS consumables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model_id INT NOT NULL,
    consumable_name VARCHAR(100) NOT NULL,
    is_deleted TINYINT DEFAULT 0,
    INDEX idx_model_id (model_id),
    FOREIGN KEY (model_id) REFERENCES subcategories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($consumablesTableSql) === TRUE) {
    echo "<p style='color: green;'>✔ Table 'consumables' created successfully or already exists.</p>";
} else {
    echo "<p style='color: red;'>❌ Error creating table 'consumables': " . $conn->error . "</p>";
}

// 2. Create the item_codes table
$itemCodesTableSql = "CREATE TABLE IF NOT EXISTS item_codes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    consumable_id INT NOT NULL,
    item_code VARCHAR(100) NOT NULL,
    item_name VARCHAR(255) NOT NULL,
    is_deleted TINYINT DEFAULT 0,
    INDEX idx_consumable_id (consumable_id),
    FOREIGN KEY (consumable_id) REFERENCES consumables(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if ($conn->query($itemCodesTableSql) === TRUE) {
    echo "<p style='color: green;'>✔ Table 'item_codes' created successfully or already exists.</p>";
} else {
    echo "<p style='color: red;'>❌ Error creating table 'item_codes': " . $conn->error . "</p>";
}

// =========================================================================
// PLACEHOLDER / TEMPLATE SEEDING DATA
// You can customize the logic below to populate your tables with initial mappings.
// =========================================================================

echo "<h4>Initial Data Seeding Template</h4>";

// Example of finding the subcategory ID for a machine model (e.g., 'C450')
$modelName = 'C450';
$stmt = $conn->prepare("SELECT id FROM subcategories WHERE subcategory_name = ? AND is_deleted = 0 LIMIT 1");
$stmt->bind_param("s", $modelName);
$stmt->execute();
$res = $stmt->get_result();
$model = $res->fetch_assoc();
$stmt->close();

if ($model) {
    $modelId = $model['id'];
    echo "<p>Found machine model '{$modelName}' with ID: <strong>{$modelId}</strong>.</p>";

    // --- Template: Insert Consumable Category 'TONER' for model C450 ---
    $categoryName = 'TONER';
    
    // Check if it already exists
    $stmtCheck = $conn->prepare("SELECT id FROM consumables WHERE model_id = ? AND consumable_name = ? LIMIT 1");
    $stmtCheck->bind_param("is", $modelId, $categoryName);
    $stmtCheck->execute();
    $resCheck = $stmtCheck->get_result();
    $existingConsumable = $resCheck->fetch_assoc();
    $stmtCheck->close();

    if (!$existingConsumable) {
        $stmtInsert = $conn->prepare("INSERT INTO consumables (model_id, consumable_name) VALUES (?, ?)");
        $stmtInsert->bind_param("is", $modelId, $categoryName);
        $stmtInsert->execute();
        $consumableId = $stmtInsert->insert_id;
        $stmtInsert->close();
        echo "<p style='color: blue;'>Added consumable category '{$categoryName}' (ID: {$consumableId}) for {$modelName}.</p>";
    } else {
        $consumableId = $existingConsumable['id'];
        echo "<p>Consumable category '{$categoryName}' (ID: {$consumableId}) already exists for {$modelName}.</p>";
    }

    // --- Template: Insert Item Codes under 'TONER' consumable category ---
    $items = [
        ['code' => 'BAT', 'name' => 'TONER BLACK (TN310K)'],
        ['code' => 'NAG', 'name' => 'TONER MAGENTA (TN310M)'],
        ['code' => 'SUB', 'name' => 'TONER YELLOW (TN310Y)'],
        ['code' => 'BAC', 'name' => 'TONER CYAN (TN310C)'],
    ];

    foreach ($items as $item) {
        // Check if item code already exists under this consumable
        $stmtItemCheck = $conn->prepare("SELECT id FROM item_codes WHERE consumable_id = ? AND item_code = ? LIMIT 1");
        $stmtItemCheck->bind_param("is", $consumableId, $item['code']);
        $stmtItemCheck->execute();
        $resItemCheck = $stmtItemCheck->get_result();
        $existingItem = $resItemCheck->fetch_assoc();
        $stmtItemCheck->close();

        if (!$existingItem) {
            $stmtItemInsert = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name) VALUES (?, ?, ?)");
            $stmtItemInsert->bind_param("iss", $consumableId, $item['code'], $item['name']);
            $stmtItemInsert->execute();
            $stmtItemInsert->close();
            echo "<p style='color: darkcyan;'>→ Inserted Item: {$item['name']} ({$item['code']})</p>";
        } else {
            echo "<p style='color: gray;'>→ Item already exists: {$item['name']}</p>";
        }
    }

} else {
    echo "<p style='color: orange;'>⚠️ Machine model '{$modelName}' was not found in 'subcategories' table. Skip seeding demo.</p>";
}

$conn->close();
echo "<br><p><strong>Setup script execution finished.</strong> Feel free to edit this file to map out your full product list, then visit it in your browser to load your data.</p>";
?>
