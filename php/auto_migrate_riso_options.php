<?php
/**
 * Auto-migration script for RISO FII series consumable options.
 * Automatically runs on deployment / git pull when db_conn.php is loaded.
 * Ensures SF, MZ, RZ, and EZ series have all FII Inks and Master configured.
 */

if (!isset($conn) || !($conn instanceof mysqli)) {
    return;
}

// 1. Quick check if already executed
$migrationKey = 'migration_riso_fii_options_v1';

$tableCheck = $conn->query("SHOW TABLES LIKE 'dashboard_settings'");
if ($tableCheck && $tableCheck->num_rows > 0) {
    $checkKey = $conn->query("SELECT id FROM dashboard_settings WHERE setting_key = '$migrationKey' LIMIT 1");
    if ($checkKey && $checkKey->num_rows > 0) {
        return; // Migration already applied, exit with zero overhead
    }
}

// 2. Define models and options
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
    'RISO MASTER FII TYPE77AG/A3'
];

$masterOptions = [
    'RISO MASTER FII TYPE77AG/A3'
];

// 3. Dynamic category lookup by name (supports different auto-increment IDs on server)
$targetCatIds = [];

// Look up 'RISO' under Product Type
$catRes1 = $conn->query("SELECT id FROM categories WHERE field = 'Product Type' AND category_name = 'RISO' AND is_deleted = 0");
while ($r = $catRes1->fetch_assoc()) {
    $targetCatIds[] = (int)$r['id'];
}
// Look up 'RISO Machine' under Product Type
$catRes2 = $conn->query("SELECT id FROM categories WHERE field = 'Product Type' AND category_name = 'RISO Machine' AND is_deleted = 0");
while ($r = $catRes2->fetch_assoc()) {
    $targetCatIds[] = (int)$r['id'];
}

// Fallback to defaults 396 and 351 if categories table is empty or names differ
if (empty($targetCatIds)) {
    $targetCatIds = [396, 351];
}
$targetCatIds = array_unique($targetCatIds);

// 4. Perform insertions
$stmtInsertItem = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name, is_deleted) VALUES (?, ?, ?, 0)");

foreach ($targetCatIds as $catId) {
    foreach ($seriesModels as $modelName) {
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

        // Ensure 'INK' consumable exists
        $cInkStmt = $conn->prepare("SELECT id FROM consumables WHERE model_id = ? AND consumable_name = 'INK' AND is_deleted = 0 LIMIT 1");
        $cInkStmt->bind_param("i", $modelId);
        $cInkStmt->execute();
        $cInkRes = $cInkStmt->get_result();
        
        $inkConsId = null;
        if ($cInkRes && $cInkRes->num_rows > 0) {
            $inkConsId = (int)$cInkRes->fetch_assoc()['id'];
        } else {
            $cInkIns = $conn->prepare("INSERT INTO consumables (model_id, consumable_name, is_deleted) VALUES (?, 'INK', 0)");
            $cInkIns->bind_param("i", $modelId);
            $cInkIns->execute();
            $inkConsId = (int)$cInkIns->insert_id;
            $cInkIns->close();
        }
        $cInkStmt->close();

        // Ensure 'MASTER' consumable exists
        $cMstStmt = $conn->prepare("SELECT id FROM consumables WHERE model_id = ? AND consumable_name = 'MASTER' AND is_deleted = 0 LIMIT 1");
        $cMstStmt->bind_param("i", $modelId);
        $cMstStmt->execute();
        $cMstRes = $cMstStmt->get_result();
        
        $mstConsId = null;
        if ($cMstRes && $cMstRes->num_rows > 0) {
            $mstConsId = (int)$cMstRes->fetch_assoc()['id'];
        } else {
            $cMstIns = $conn->prepare("INSERT INTO consumables (model_id, consumable_name, is_deleted) VALUES (?, 'MASTER', 0)");
            $cMstIns->bind_param("i", $modelId);
            $cMstIns->execute();
            $mstConsId = (int)$cMstIns->insert_id;
            $cMstIns->close();
        }
        $cMstStmt->close();

        // Insert Ink options if missing
        if ($inkConsId && $stmtInsertItem) {
            foreach ($inkOptions as $item) {
                $chkStmt = $conn->prepare("SELECT id FROM item_codes WHERE consumable_id = ? AND item_name = ? AND is_deleted = 0 LIMIT 1");
                $chkStmt->bind_param("is", $inkConsId, $item);
                $chkStmt->execute();
                $chkRes = $chkStmt->get_result();
                if ($chkRes->num_rows == 0) {
                    $stmtInsertItem->bind_param("iss", $inkConsId, $item, $item);
                    $stmtInsertItem->execute();
                }
                $chkStmt->close();
            }
        }

        // Insert Master options if missing
        if ($mstConsId && $stmtInsertItem) {
            foreach ($masterOptions as $item) {
                $chkStmt = $conn->prepare("SELECT id FROM item_codes WHERE consumable_id = ? AND item_name = ? AND is_deleted = 0 LIMIT 1");
                $chkStmt->bind_param("is", $mstConsId, $item);
                $chkStmt->execute();
                $chkRes = $chkStmt->get_result();
                if ($chkRes->num_rows == 0) {
                    $stmtInsertItem->bind_param("iss", $mstConsId, $item, $item);
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

// 5. Mark migration as finished in dashboard_settings
if ($tableCheck && $tableCheck->num_rows > 0) {
    $markStmt = $conn->prepare("INSERT INTO dashboard_settings (setting_key, setting_value) VALUES (?, '1') ON DUPLICATE KEY UPDATE setting_value = '1'");
    if ($markStmt) {
        $markStmt->bind_param("s", $migrationKey);
        $markStmt->execute();
        $markStmt->close();
    }
}
