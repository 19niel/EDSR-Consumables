<?php
require __DIR__ . '/../php/db_conn.php';

$seriesModels = [
    'EZ2301', 'EZ330', 'EZ331', 'EZ3701', 'EZ5701',
    'MZ1070', 'MZ7700', 'MZ8700', 'MZ970',
    'RZ1070', 'RZ2300', 'RZ3700', 'RZ5700', 'RZ970',
    'SF5230', 'SF530', 'SF5330', 'SF5350', 'SF9350', 'SF9390'
];

$itemsExpected = [
    'RISO INK FII TYPE BLACK AG',
    'RISO INK FII TYPE YELLOW UA',
    'RISO INK FII TYPE BLUE UA',
    'RISO INK FII TYPE FLUORESCENT PINK UA',
    'RISO INK FII TYPE GREEN UA',
    'RISO INK FII TYPE RED UA',
    'RISO INK FII TYPE AQUA UA',
    'RISO MASTER FII TYPE77AG/A3'
];

echo "=== Verification of RISO (Cat 396 - Consumables) ===\n";
$allGood396 = true;
foreach ($seriesModels as $m) {
    $sc = $conn->query("SELECT id FROM subcategories WHERE category_id = 396 AND subcategory_name = '$m' AND is_deleted = 0")->fetch_assoc();
    $cInk = $conn->query("SELECT id FROM consumables WHERE model_id = {$sc['id']} AND consumable_name = 'INK'")->fetch_assoc();
    $cMaster = $conn->query("SELECT id FROM consumables WHERE model_id = {$sc['id']} AND consumable_name = 'MASTER'")->fetch_assoc();
    
    // Check ink items
    $inkCount = 0;
    foreach ($itemsExpected as $it) {
        $chk = $conn->query("SELECT id FROM item_codes WHERE consumable_id = {$cInk['id']} AND item_name = '$it' AND is_deleted = 0");
        if ($chk->num_rows > 0) $inkCount++;
    }
    
    // Check master item
    $mChk = $conn->query("SELECT id FROM item_codes WHERE consumable_id = {$cMaster['id']} AND item_name = 'RISO MASTER FII TYPE77AG/A3' AND is_deleted = 0");
    $hasMaster = ($mChk->num_rows > 0);
    
    if ($inkCount < 8 || !$hasMaster) {
        $allGood396 = false;
        echo "FAIL for $m: Found $inkCount/8 under INK, Master present: " . ($hasMaster ? 'YES' : 'NO') . "\n";
    }
}
if ($allGood396) {
    echo "SUCCESS: All 20 models in Category 396 have all 8 items under INK and MASTER!\n";
}

echo "\n=== Verification of RISO Machine (Cat 351) ===\n";
$allGood351 = true;
foreach ($seriesModels as $m) {
    $sc = $conn->query("SELECT id FROM subcategories WHERE category_id = 351 AND subcategory_name = '$m' AND is_deleted = 0")->fetch_assoc();
    $cInk = $conn->query("SELECT id FROM consumables WHERE model_id = {$sc['id']} AND consumable_name = 'INK'")->fetch_assoc();
    $cMaster = $conn->query("SELECT id FROM consumables WHERE model_id = {$sc['id']} AND consumable_name = 'MASTER'")->fetch_assoc();
    
    // Check ink items
    $inkCount = 0;
    foreach ($itemsExpected as $it) {
        $chk = $conn->query("SELECT id FROM item_codes WHERE consumable_id = {$cInk['id']} AND item_name = '$it' AND is_deleted = 0");
        if ($chk->num_rows > 0) $inkCount++;
    }
    
    // Check master item
    $mChk = $conn->query("SELECT id FROM item_codes WHERE consumable_id = {$cMaster['id']} AND item_name = 'RISO MASTER FII TYPE77AG/A3' AND is_deleted = 0");
    $hasMaster = ($mChk->num_rows > 0);
    
    if ($inkCount < 8 || !$hasMaster) {
        $allGood351 = false;
        echo "FAIL for $m: Found $inkCount/8 under INK, Master present: " . ($hasMaster ? 'YES' : 'NO') . "\n";
    }
}
if ($allGood351) {
    echo "SUCCESS: All 20 models in Category 351 have all 8 items under INK and MASTER!\n";
}
