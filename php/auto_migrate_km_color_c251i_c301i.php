<?php
/**
 * Auto-migration script for KM Color BH-C251i / BH-C301i (and C251i / C301i) consumable options.
 * Automatically runs on deployment / git pull when db_conn.php is loaded.
 * Ensures WASTE TONER BOX, INTERMEDIATE IMAGE TRANSFER UNIT/TRANSFER BELT,
 * 2ND IMAGE TRANSFER ROLLER ASSY, and FUSING UNIT are configured as consumables & item codes.
 */

if (!isset($conn) || !($conn instanceof mysqli)) {
    return;
}

// 1. Quick check if already executed
$migrationKey = 'migration_km_color_c251i_c301i_v1';

$tableCheck = $conn->query("SHOW TABLES LIKE 'dashboard_settings'");
if ($tableCheck && $tableCheck->num_rows > 0) {
    $checkKey = $conn->query("SELECT id FROM dashboard_settings WHERE setting_key = '$migrationKey' LIMIT 1");
    if ($checkKey && $checkKey->num_rows > 0) {
        return; // Migration already applied
    }
}

// 2. Define consumables and item codes to add (from EDSR CONS 1(KM COLOR).csv)
$consumablesToAdd = [
    'WASTE TONER BOX' => 'WASTE TONER BOX',
    'INTERMEDIATE IMAGE TRANSFER UNIT/TRANSFER BELT' => 'INTERMEDIATE IMAGE TRANSFER UNIT/TRANSFER BELT',
    '2ND IMAGE TRANSFER ROLLER ASSY' => '2ND IMAGE TRANSFER ROLLER ASSY',
    'FUSING UNIT' => 'FUSING UNIT',
];

// 3. Dynamic category lookup for KM Color and KM Machine
$targetCatIds = [];
$catRes = $conn->query("SELECT id FROM categories WHERE field = 'Product Type' AND category_name IN ('KM Color', 'KM Machine') AND is_deleted = 0");
if ($catRes) {
    while ($row = $catRes->fetch_assoc()) {
        $targetCatIds[] = (int)$row['id'];
    }
}
if (empty($targetCatIds)) {
    $targetCatIds = [393, 350];
}
$targetCatIds = array_unique($targetCatIds);

// Models that must exist in target categories
$requiredModels = ['BH-C251i', 'BH-C301i'];
// Existing alias models to also update if present
$optionalAliasModels = ['C251i', 'C301i'];

// 4. Perform insertions
$stmtInsertItem = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name, is_deleted) VALUES (?, ?, ?, 0)");

foreach ($targetCatIds as $catId) {
    $modelIds = [];

    // Ensure required models exist
    foreach ($requiredModels as $modelName) {
        $scStmt = $conn->prepare("SELECT id FROM subcategories WHERE category_id = ? AND subcategory_name = ? AND is_deleted = 0 LIMIT 1");
        $scStmt->bind_param("is", $catId, $modelName);
        $scStmt->execute();
        $scRes = $scStmt->get_result();

        if ($scRes && $scRes->num_rows > 0) {
            $modelIds[] = (int)$scRes->fetch_assoc()['id'];
        } else {
            $scIns = $conn->prepare("INSERT INTO subcategories (category_id, subcategory_name, is_deleted) VALUES (?, ?, 0)");
            $scIns->bind_param("is", $catId, $modelName);
            $scIns->execute();
            if ($scIns->insert_id) {
                $modelIds[] = (int)$scIns->insert_id;
            }
            $scIns->close();
        }
        $scStmt->close();
    }

    // Also include existing alias models (e.g., C251i / C301i under KM Machine) without creating duplicates
    foreach ($optionalAliasModels as $aliasName) {
        $scStmt = $conn->prepare("SELECT id FROM subcategories WHERE category_id = ? AND subcategory_name = ? AND is_deleted = 0 LIMIT 1");
        $scStmt->bind_param("is", $catId, $aliasName);
        $scStmt->execute();
        $scRes = $scStmt->get_result();
        if ($scRes && $scRes->num_rows > 0) {
            $modelIds[] = (int)$scRes->fetch_assoc()['id'];
        }
        $scStmt->close();
    }

    $modelIds = array_unique($modelIds);

    foreach ($modelIds as $modelId) {
        foreach ($consumablesToAdd as $consName => $itemName) {
            // Ensure consumable exists
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

            // Insert item code if missing
            if ($consId && $stmtInsertItem) {
                $chkStmt = $conn->prepare("SELECT id FROM item_codes WHERE consumable_id = ? AND item_name = ? AND is_deleted = 0 LIMIT 1");
                $chkStmt->bind_param("is", $consId, $itemName);
                $chkStmt->execute();
                $chkRes = $chkStmt->get_result();
                if ($chkRes && $chkRes->num_rows == 0) {
                    $stmtInsertItem->bind_param("iss", $consId, $itemName, $itemName);
                    $stmtInsertItem->execute();
                }
                $chkStmt->close();
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
