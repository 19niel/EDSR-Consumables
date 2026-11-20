<?php
/**
 * Standalone migration runner for adding KM Color BH-C251i / BH-C301i (and C251i / C301i) consumables & item codes.
 * Can be run via CLI (`php add_km_color_c251i_c301i.php`) or accessed via web browser.
 */

require_once __DIR__ . '/php/db_conn.php';

$isCli = (php_sapi_name() === 'cli');

function outputMsg($msg, $type = 'info') {
    global $isCli;
    if ($isCli) {
        echo "[" . strtoupper($type) . "] " . strip_tags($msg) . "\n";
    } else {
        $color = ($type === 'success') ? 'green' : (($type === 'warn') ? 'orange' : (($type === 'error') ? 'red' : '#333'));
        echo "<p style='color:{$color}; margin: 4px 0;'>{$msg}</p>";
    }
}

if (!$isCli) {
    echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>KM Color C251i / C301i Migration</title>";
    echo "<style>body{font-family:sans-serif;padding:24px;line-height:1.5;background:#f9f9fb;color:#222;} .box{background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.1);max-width:800px;margin:auto;}</style>";
    echo "</head><body><div class='box'>";
    echo "<h2>KM Color C251i / C301i Consumables &amp; Item Codes Migration</h2><hr>";
}

outputMsg("Starting KM Color C251i / C301i migration...", "info");

$consumablesToAdd = [
    'WASTE TONER BOX' => 'WASTE TONER BOX',
    'INTERMEDIATE IMAGE TRANSFER UNIT/TRANSFER BELT' => 'INTERMEDIATE IMAGE TRANSFER UNIT/TRANSFER BELT',
    '2ND IMAGE TRANSFER ROLLER ASSY' => '2ND IMAGE TRANSFER ROLLER ASSY',
    'FUSING UNIT' => 'FUSING UNIT',
];

$categoriesToUpdate = [];
$catRes = $conn->query("SELECT id, category_name FROM categories WHERE field = 'Product Type' AND category_name IN ('KM Color', 'KM Machine') AND is_deleted = 0");
if ($catRes) {
    while ($row = $catRes->fetch_assoc()) {
        $categoriesToUpdate[(int)$row['id']] = $row['category_name'];
    }
}

if (empty($categoriesToUpdate)) {
    $categoriesToUpdate[393] = 'KM Color';
    $categoriesToUpdate[350] = 'KM Machine';
}

$requiredModels = ['BH-C251i', 'BH-C301i'];
$optionalAliasModels = ['C251i', 'C301i'];

$totalInsertedCons = 0;
$totalInsertedItems = 0;
$totalExistingItems = 0;

$stmtInsertItem = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name, is_deleted) VALUES (?, ?, ?, 0)");

foreach ($categoriesToUpdate as $catId => $catName) {
    outputMsg("<b>Processing Category: {$catName} (ID: {$catId})</b>", "info");

    $modelsToProcess = [];

    foreach ($requiredModels as $modelName) {
        $scStmt = $conn->prepare("SELECT id FROM subcategories WHERE category_id = ? AND subcategory_name = ? AND is_deleted = 0 LIMIT 1");
        $scStmt->bind_param("is", $catId, $modelName);
        $scStmt->execute();
        $scRes = $scStmt->get_result();

        if ($scRes && $scRes->num_rows > 0) {
            $modelsToProcess[(int)$scRes->fetch_assoc()['id']] = $modelName;
        } else {
            $scIns = $conn->prepare("INSERT INTO subcategories (category_id, subcategory_name, is_deleted) VALUES (?, ?, 0)");
            $scIns->bind_param("is", $catId, $modelName);
            $scIns->execute();
            $modelsToProcess[(int)$scIns->insert_id] = $modelName;
            $scIns->close();
            outputMsg("Created missing model: {$modelName}", "warn");
        }
        $scStmt->close();
    }

    foreach ($optionalAliasModels as $aliasName) {
        $scStmt = $conn->prepare("SELECT id FROM subcategories WHERE category_id = ? AND subcategory_name = ? AND is_deleted = 0 LIMIT 1");
        $scStmt->bind_param("is", $catId, $aliasName);
        $scStmt->execute();
        $scRes = $scStmt->get_result();
        if ($scRes && $scRes->num_rows > 0) {
            $modelsToProcess[(int)$scRes->fetch_assoc()['id']] = $aliasName;
        }
        $scStmt->close();
    }

    foreach ($modelsToProcess as $modelId => $modelName) {
        foreach ($consumablesToAdd as $consName => $itemName) {
            $cStmt = $conn->prepare("SELECT id FROM consumables WHERE model_id = ? AND consumable_name = ? AND is_deleted = 0 LIMIT 1");
            $cStmt->bind_param("is", $modelId, $consName);
            $cStmt->execute();
            $cRes = $cStmt->get_result();

            if ($cRes && $cRes->num_rows > 0) {
                $consId = (int)$cRes->fetch_assoc()['id'];
            } else {
                $cIns = $conn->prepare("INSERT INTO consumables (model_id, consumable_name, is_deleted) VALUES (?, ?, 0)");
                $cIns->bind_param("is", $modelId, $consName);
                $cIns->execute();
                $consId = (int)$cIns->insert_id;
                $cIns->close();
                $totalInsertedCons++;
                outputMsg("Added consumable '{$consName}' for {$modelName}", "success");
            }
            $cStmt->close();

            $chkStmt = $conn->prepare("SELECT id FROM item_codes WHERE consumable_id = ? AND item_name = ? AND is_deleted = 0 LIMIT 1");
            $chkStmt->bind_param("is", $consId, $itemName);
            $chkStmt->execute();
            $chkRes = $chkStmt->get_result();
            if ($chkRes && $chkRes->num_rows == 0) {
                $stmtInsertItem->bind_param("iss", $consId, $itemName, $itemName);
                $stmtInsertItem->execute();
                $totalInsertedItems++;
                outputMsg("Added item code '{$itemName}' for {$modelName}", "success");
            } else {
                $totalExistingItems++;
            }
            $chkStmt->close();
        }
    }
}

$stmtInsertItem->close();

outputMsg("<b>Migration complete!</b> Newly inserted consumables: {$totalInsertedCons} | Newly inserted item codes: {$totalInsertedItems} | Already present: {$totalExistingItems}.", "success");

if (!$isCli) {
    echo "<hr><p style='font-size:13px;color:#666;'>You can safely close this page or re-run anytime.</p></div></body></html>";
}
