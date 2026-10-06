<?php
require __DIR__ . '/../php/db_conn.php';

$seriesModels = [
    // EZ series
    'EZ2301', 'EZ330', 'EZ331', 'EZ3701', 'EZ5701',
    // MZ series
    'MZ1070', 'MZ7700', 'MZ8700', 'MZ970',
    // RZ series
    'RZ1070', 'RZ2300', 'RZ3700', 'RZ5700', 'RZ970',
    // SF series
    'SF5230', 'SF530', 'SF5330', 'SF5350', 'SF9350', 'SF9390'
];

$inkOptions = [
    'RISO INK FII TYPE BLACK AG',
    'RISO INK FII TYPE YELLOW UA',
    'RISO INK FII TYPE BLUE UA',
    'RISO INK FII TYPE FLUORESCENT PINK UA',
    'RISO INK FII TYPE GREEN UA',
    'RISO INK FII TYPE RED UA',
    'RISO INK FII TYPE AQUA UA',
    'RISO MASTER FII TYPE77AG/A3' // included under INK for full compatibility
];

$masterOptions = [
    'RISO MASTER FII TYPE77AG/A3'
];

$targetCategories = [396, 351]; // 396 = RISO Consumables, 351 = RISO Machine

$stmtInsert = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name, is_deleted) VALUES (?, ?, ?, 0)");

$insertedCount = 0;

foreach ($targetCategories as $catId) {
    $catName = ($catId === 396) ? 'RISO (Consumables)' : 'RISO Machine (Machines)';
    
    foreach ($seriesModels as $modelName) {
        $scRes = $conn->query("SELECT id FROM subcategories WHERE category_id = $catId AND subcategory_name = '$modelName' AND is_deleted = 0");
        $sc = $scRes->fetch_assoc();
        if (!$sc) continue;
        $modelId = $sc['id'];
        
        // 1. INK consumable
        $cInk = $conn->query("SELECT id FROM consumables WHERE model_id = $modelId AND consumable_name = 'INK' AND is_deleted = 0")->fetch_assoc();
        if ($cInk) {
            $inkConsId = $cInk['id'];
            foreach ($inkOptions as $item) {
                $check = $conn->query("SELECT id FROM item_codes WHERE consumable_id = $inkConsId AND item_name = '" . $conn->real_escape_string($item) . "' AND is_deleted = 0");
                if ($check->num_rows == 0) {
                    $stmtInsert->bind_param("iss", $inkConsId, $item, $item);
                    $stmtInsert->execute();
                    $insertedCount++;
                }
            }
        }
        
        // 2. MASTER consumable
        $cMaster = $conn->query("SELECT id FROM consumables WHERE model_id = $modelId AND consumable_name = 'MASTER' AND is_deleted = 0")->fetch_assoc();
        if ($cMaster) {
            $masterConsId = $cMaster['id'];
            foreach ($masterOptions as $item) {
                $check = $conn->query("SELECT id FROM item_codes WHERE consumable_id = $masterConsId AND item_name = '" . $conn->real_escape_string($item) . "' AND is_deleted = 0");
                if ($check->num_rows == 0) {
                    $stmtInsert->bind_param("iss", $masterConsId, $item, $item);
                    $stmtInsert->execute();
                    $insertedCount++;
                }
            }
        }
    }
}

$stmtInsert->close();

echo "Successfully inserted $insertedCount item codes!\n";
