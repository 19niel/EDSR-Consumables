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

$plan = [];

foreach ($targetCategories as $catId) {
    $catName = ($catId === 396) ? 'RISO (Consumables)' : 'RISO Machine (Machines)';
    
    foreach ($seriesModels as $modelName) {
        $scRes = $conn->query("SELECT id FROM subcategories WHERE category_id = $catId AND subcategory_name = '$modelName' AND is_deleted = 0");
        $sc = $scRes->fetch_assoc();
        if (!$sc) {
            echo "Warning: Subcategory $modelName not found in Category $catId\n";
            continue;
        }
        $modelId = $sc['id'];
        
        // 1. INK consumable
        $cInk = $conn->query("SELECT id FROM consumables WHERE model_id = $modelId AND consumable_name = 'INK' AND is_deleted = 0")->fetch_assoc();
        if (!$cInk) {
            echo "Warning: INK consumable not found for model $modelName ($catName)\n";
        } else {
            $inkConsId = $cInk['id'];
            foreach ($inkOptions as $item) {
                $check = $conn->query("SELECT id FROM item_codes WHERE consumable_id = $inkConsId AND item_name = '" . $conn->real_escape_string($item) . "' AND is_deleted = 0");
                if ($check->num_rows == 0) {
                    $plan[] = [
                        'cat' => $catName,
                        'model' => $modelName,
                        'model_id' => $modelId,
                        'consumable' => 'INK',
                        'cons_id' => $inkConsId,
                        'item_name' => $item
                    ];
                }
            }
        }
        
        // 2. MASTER consumable
        $cMaster = $conn->query("SELECT id FROM consumables WHERE model_id = $modelId AND consumable_name = 'MASTER' AND is_deleted = 0")->fetch_assoc();
        if (!$cMaster) {
            echo "Warning: MASTER consumable not found for model $modelName ($catName)\n";
        } else {
            $masterConsId = $cMaster['id'];
            foreach ($masterOptions as $item) {
                $check = $conn->query("SELECT id FROM item_codes WHERE consumable_id = $masterConsId AND item_name = '" . $conn->real_escape_string($item) . "' AND is_deleted = 0");
                if ($check->num_rows == 0) {
                    $plan[] = [
                        'cat' => $catName,
                        'model' => $modelName,
                        'model_id' => $modelId,
                        'consumable' => 'MASTER',
                        'cons_id' => $masterConsId,
                        'item_name' => $item
                    ];
                }
            }
        }
    }
}

echo "Total items to insert across both categories: " . count($plan) . "\n";
$byCat = [];
foreach ($plan as $p) {
    $byCat[$p['cat']][] = $p;
}
foreach ($byCat as $cat => $items) {
    echo "  $cat: " . count($items) . " items to add\n";
}
