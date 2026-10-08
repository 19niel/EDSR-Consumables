<?php
/**
 * Auto-migration script for RISO FII series consumable options.
 * Automatically runs on deployment / git pull when db_conn.php is loaded.
 * Ensures SF, MZ, RZ, EZ, CZ and other series have all Inks and Master configured.
 */

if (!isset($conn) || !($conn instanceof mysqli)) {
    return;
}

// 1. Quick check if already executed
$migrationKey = 'migration_riso_options_v2';

$tableCheck = $conn->query("SHOW TABLES LIKE 'dashboard_settings'");
if ($tableCheck && $tableCheck->num_rows > 0) {
    $checkKey = $conn->query("SELECT id FROM dashboard_settings WHERE setting_key = '$migrationKey' LIMIT 1");
    if ($checkKey && $checkKey->num_rows > 0) {
        return; // Migration already applied
    }
}

// 2. Define models
$ez_models = ['EZ2301', 'EZ330', 'EZ331', 'EZ3701', 'EZ5701'];
$mz_models = ['MZ1070', 'MZ7700', 'MZ8700', 'MZ970'];
$rz_models = ['RZ1070', 'RZ2300', 'RZ3700', 'RZ5700', 'RZ970'];
$sf_models = ['SF5230', 'SF530', 'SF5330', 'SF5350', 'SF9350', 'SF9390'];
$cz_models = ['CZ180'];
$mz970_models = ['MZ970'];

$sf_mz_rz_ez = array_merge($sf_models, $mz_models, $rz_models, $ez_models);
$mz_rz_ez = array_merge($mz_models, $rz_models, $ez_models);

// Get all models dynamically for "all" series
$all_models = [];
$catIdsRes = $conn->query("SELECT id FROM categories WHERE field = 'Product Type' AND category_name IN ('RISO', 'RISO Machine') AND is_deleted = 0");
$catIdsArr = [];
if ($catIdsRes) {
    while ($row = $catIdsRes->fetch_assoc()) {
        $catIdsArr[] = $row['id'];
    }
}
if (!empty($catIdsArr)) {
    $ids = implode(',', $catIdsArr);
    $res = $conn->query("SELECT DISTINCT subcategory_name FROM subcategories WHERE category_id IN ($ids) AND is_deleted = 0");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $all_models[] = $row['subcategory_name'];
        }
    }
} else {
    $all_models = array_merge($ez_models, $mz_models, $rz_models, $sf_models, $cz_models);
}

// Combine all logic into a structured array
// format: [ 'consumable_name' => [ 'item_name' => [ models array ] ] ]
$mappings = [
    'INK' => [
        // Old mappings (originally for SF/MZ/RZ/EZ)
        'RISO INK FII TYPE BLACK AG' => $sf_mz_rz_ez,
        'RISO INK FII TYPE YELLOW UA' => $sf_mz_rz_ez,
        'RISO INK FII TYPE BLUE UA' => $sf_mz_rz_ez,
        'RISO INK FII TYPE FLUORESCENT PINK UA' => $sf_mz_rz_ez,
        'RISO INK FII TYPE GREEN UA' => $sf_mz_rz_ez,
        'RISO INK FII TYPE RED UA' => $sf_mz_rz_ez,
        
        // New mappings
        'RISO INK FII TYPE BRIGHT RED UA' => $sf_mz_rz_ez,
        'FII TYPE RISO FEDERAL BLUE' => $sf_mz_rz_ez,
        'FII TYPE RISO PURPLE' => $sf_mz_rz_ez,
        'RISO INK FII TYPE MEDIUM BLUE UA' => $sf_mz_rz_ez,
        
        'RISO INK FII TYPE ORANGE UA' => $mz970_models,
        
        'RISO INK Z TYPE / E TYPE BLUE' => $mz_rz_ez,
        'RISO INK ETYPE YELLOW' => $mz_rz_ez,
        
        'RISO INK CZ TYPE RED' => $cz_models,
        'RISO INK CZ TYPE BLUE' => $cz_models,
        'RISO INK CZ TYPE GREEN' => $cz_models,
        
        // AQUA UA is limited to SF SERIES per new prompt
        'RISO INK FII TYPE AQUA UA' => $sf_models,
        
        'RISO FII TYPE FLAT GOLD' => $all_models,
    ],
    'MASTER' => [
        // Old mappings
        'RISO MASTER FII TYPE77AG/A3' => $sf_mz_rz_ez
    ]
];

// 3. Dynamic category lookup
$targetCatIds = $catIdsArr;
if (empty($targetCatIds)) {
    $targetCatIds = [396, 351];
}
$targetCatIds = array_unique($targetCatIds);

// 4. Perform insertions
$stmtInsertItem = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name, is_deleted) VALUES (?, ?, ?, 0)");

foreach ($targetCatIds as $catId) {
    foreach ($mappings as $consName => $itemsMap) {
        foreach ($itemsMap as $itemName => $modelsToApply) {
            foreach ($modelsToApply as $modelName) {
                // Find or create subcategory (model)
                $scStmt = $conn->prepare("SELECT id FROM subcategories WHERE category_id = ? AND subcategory_name = ? AND is_deleted = 0 LIMIT 1");
                $scStmt->bind_param("is", $catId, $modelName);
                $scStmt->execute();
                $scRes = $scStmt->get_result();
                
                $modelId = null;
                if ($scRes && $scRes->num_rows > 0) {
                    $modelId = (int)$scRes->fetch_assoc()['id'];
                } else {
                    $scIns = $conn->prepare("INSERT INTO subcategories (category_id, subcategory_name, is_deleted) VALUES (?, ?, 0)");
                    $scIns->bind_param("is", $catId, $modelName);
                    $scIns->execute();
                    $modelId = (int)$scIns->insert_id;
                    $scIns->close();
                }
                $scStmt->close();

                if (!$modelId) continue;

                // Ensure consumable exists (INK or MASTER)
                $cStmt = $conn->prepare("SELECT id FROM consumables WHERE model_id = ? AND consumable_name = ? AND is_deleted = 0 LIMIT 1");
                $cStmt->bind_param("is", $modelId, $consName);
                $cStmt->execute();
                $cRes = $cStmt->get_result();
                
                $consId = null;
                if ($cRes && $cRes->num_rows > 0) {
                    $consId = (int)$cRes->fetch_assoc()['id'];
                } else {
                    $cIns = $conn->prepare("INSERT INTO consumables (model_id, consumable_name, is_deleted) VALUES (?, ?, 0)");
                    $cIns->bind_param("is", $modelId, $consName);
                    $cIns->execute();
                    $consId = (int)$cIns->insert_id;
                    $cIns->close();
                }
                $cStmt->close();

                // Insert item option if missing
                if ($consId && $stmtInsertItem) {
                    $chkStmt = $conn->prepare("SELECT id FROM item_codes WHERE consumable_id = ? AND item_name = ? AND is_deleted = 0 LIMIT 1");
                    $chkStmt->bind_param("is", $consId, $itemName);
                    $chkStmt->execute();
                    $chkRes = $chkStmt->get_result();
                    if ($chkRes->num_rows == 0) {
                        $stmtInsertItem->bind_param("iss", $consId, $itemName, $itemName);
                        $stmtInsertItem->execute();
                    }
                    $chkStmt->close();
                }
            }
        }
    }
}

if ($stmtInsertItem) {
    $stmtInsertItem->close();
}

// 5. Mark migration as finished
if ($tableCheck && $tableCheck->num_rows > 0) {
    $markStmt = $conn->prepare("INSERT INTO dashboard_settings (setting_key, setting_value) VALUES (?, '1') ON DUPLICATE KEY UPDATE setting_value = '1'");
    if ($markStmt) {
        $markStmt->bind_param("s", $migrationKey);
        $markStmt->execute();
        $markStmt->close();
    }
}
