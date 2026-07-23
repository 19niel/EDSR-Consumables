<?php
include(__DIR__ . '/../php/db_conn.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Starting CSV import...\n";

// Disable foreign key checks for truncation
$conn->query("SET FOREIGN_KEY_CHECKS = 0");
$conn->query("TRUNCATE TABLE item_codes");
$conn->query("TRUNCATE TABLE consumables");
$conn->query("SET FOREIGN_KEY_CHECKS = 1");
echo "Cleared existing consumables and item_codes tables.\n";

$filesToProcess = [
    [
        'file' => __DIR__ . '/EDSR CONS 1(KM COLOR) (1).csv',
        'category_id' => 393
    ],
    [
        'file' => __DIR__ . '/EDSR CONS 1(KM MONO) (2).csv',
        'category_id' => 395
    ],
    [
        'file' => __DIR__ . '/EDSR CONS 1(RISO) (1).csv',
        'category_id' => 396
    ]
];

foreach ($filesToProcess as $fileData) {
    $filename = $fileData['file'];
    $categoryId = $fileData['category_id'];
    
    if (!file_exists($filename)) {
        echo "Error: File $filename not found.\n";
        continue;
    }

    echo "Processing $filename...\n";
    
    $handle = fopen($filename, "r");
    if ($handle !== FALSE) {
        $headerSkipped = false;
        
        $currentModelLine = '';
        $currentConsumable = '';
        
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (!$headerSkipped) {
                $headerSkipped = true;
                continue;
            }
            
            // Skip totally empty rows
            if (empty(array_filter($data))) {
                continue;
            }
            
            // Col 0: Machine Model
            if (!empty(trim($data[0]))) {
                $currentModelLine = trim($data[0]);
            }
            
            // Col 1: Consumable
            if (!empty(trim($data[1]))) {
                $currentConsumable = trim($data[1]);
            }
            
            // Col 2: Item Code
            $itemCodeStr = isset($data[2]) ? trim($data[2]) : '';
            
            if (empty($itemCodeStr) || empty($currentModelLine) || empty($currentConsumable)) {
                // If item code is empty or missing data, skip
                continue;
            }
            
            // Handle multiple machine models separated by / or &
            // Replace & with / to split easily
            $modelsStr = str_replace('&', '/', $currentModelLine);
            $models = explode('/', $modelsStr);
            
            foreach ($models as $rawModel) {
                $modelName = trim($rawModel);
                if (empty($modelName)) continue;
                
                // 1. Find or create Subcategory (Machine Model)
                $stmt = $conn->prepare("SELECT id FROM subcategories WHERE subcategory_name = ? AND category_id = ? AND is_deleted = 0 LIMIT 1");
                $stmt->bind_param("si", $modelName, $categoryId);
                $stmt->execute();
                $res = $stmt->get_result();
                $modelRow = $res->fetch_assoc();
                $stmt->close();
                
                $modelId = null;
                if ($modelRow) {
                    $modelId = $modelRow['id'];
                } else {
                    // Create it
                    $stmtInsert = $conn->prepare("INSERT INTO subcategories (category_id, subcategory_name) VALUES (?, ?)");
                    $stmtInsert->bind_param("is", $categoryId, $modelName);
                    $stmtInsert->execute();
                    $modelId = $stmtInsert->insert_id;
                    $stmtInsert->close();
                    echo "Created missing machine model: $modelName (Cat $categoryId)\n";
                }
                
                // 2. Find or create Consumable
                $stmtCheck = $conn->prepare("SELECT id FROM consumables WHERE model_id = ? AND consumable_name = ? LIMIT 1");
                $stmtCheck->bind_param("is", $modelId, $currentConsumable);
                $stmtCheck->execute();
                $resCheck = $stmtCheck->get_result();
                $consumableRow = $resCheck->fetch_assoc();
                $stmtCheck->close();
                
                $consumableId = null;
                if ($consumableRow) {
                    $consumableId = $consumableRow['id'];
                } else {
                    $stmtInsertCons = $conn->prepare("INSERT INTO consumables (model_id, consumable_name) VALUES (?, ?)");
                    $stmtInsertCons->bind_param("is", $modelId, $currentConsumable);
                    $stmtInsertCons->execute();
                    $consumableId = $stmtInsertCons->insert_id;
                    $stmtInsertCons->close();
                }
                
                // 3. Insert Item Code
                $stmtItemInsert = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name) VALUES (?, ?, ?)");
                // We use the same string for both item_code and item_name since the new CSV doesn't have short codes
                $stmtItemInsert->bind_param("iss", $consumableId, $itemCodeStr, $itemCodeStr);
                $stmtItemInsert->execute();
                $stmtItemInsert->close();
            }
        }
        fclose($handle);
        echo "Finished $filename.\n";
    }
}

$conn->close();
echo "Import completed successfully!\n";
?>
