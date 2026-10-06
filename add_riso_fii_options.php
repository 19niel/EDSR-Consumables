<?php
/**
 * Standalone migration runner for RISO FII series consumables and item codes.
 * Can be run via CLI (`php add_riso_fii_options.php`) or accessed via web browser.
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
    echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>RISO FII Migration</title>";
    echo "<style>body{font-family:sans-serif;padding:24px;line-height:1.5;background:#f9f9fb;color:#222;} .box{background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.1);max-width:800px;margin:auto;}</style>";
    echo "</head><body><div class='box'>";
    echo "<h2>RISO FII Consumables & Item Codes Migration</h2><hr>";
}

outputMsg("Starting RISO FII migration...", "info");

// Series models to update
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

// Determine categories
$categoriesToUpdate = [];
$catRes = $conn->query("SELECT id, category_name FROM categories WHERE field = 'Product Type' AND category_name IN ('RISO', 'RISO Machine') AND is_deleted = 0");
while ($row = $catRes->fetch_assoc()) {
    $categoriesToUpdate[$row['id']] = $row['category_name'];
}

if (empty($categoriesToUpdate)) {
    $categoriesToUpdate[396] = 'RISO (Consumables)';
    $categoriesToUpdate[351] = 'RISO Machine';
}

$totalInserted = 0;
$totalExisting = 0;

$stmtInsert = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name, is_deleted) VALUES (?, ?, ?, 0)");

foreach ($categoriesToUpdate as $catId => $catName) {
    outputMsg("<b>Processing Category: {$catName} (ID: {$catId})</b>", "info");

    foreach ($seriesModels as $modelName) {
        // Model
        $scRes = $conn->query("SELECT id FROM subcategories WHERE category_id = {$catId} AND subcategory_name = '{$modelName}' AND is_deleted = 0");
        if ($scRes && $scRes->num_rows > 0) {
            $modelId = $scRes->fetch_assoc()['id'];
        } else {
            $conn->query("INSERT INTO subcategories (category_id, subcategory_name, is_deleted) VALUES ({$catId}, '{$modelName}', 0)");
            $modelId = $conn->insert_id;
            outputMsg("Created missing model: {$modelName}", "warn");
        }

        // INK consumable
        $inkRes = $conn->query("SELECT id FROM consumables WHERE model_id = {$modelId} AND consumable_name = 'INK' AND is_deleted = 0");
        if ($inkRes && $inkRes->num_rows > 0) {
            $inkConsId = $inkRes->fetch_assoc()['id'];
        } else {
            $conn->query("INSERT INTO consumables (model_id, consumable_name, is_deleted) VALUES ({$modelId}, 'INK', 0)");
            $inkConsId = $conn->insert_id;
            outputMsg("Created missing INK consumable for {$modelName}", "warn");
        }

        // MASTER consumable
        $mstRes = $conn->query("SELECT id FROM consumables WHERE model_id = {$modelId} AND consumable_name = 'MASTER' AND is_deleted = 0");
        if ($mstRes && $mstRes->num_rows > 0) {
            $mstConsId = $mstRes->fetch_assoc()['id'];
        } else {
            $conn->query("INSERT INTO consumables (model_id, consumable_name, is_deleted) VALUES ({$modelId}, 'MASTER', 0)");
            $mstConsId = $conn->insert_id;
            outputMsg("Created missing MASTER consumable for {$modelName}", "warn");
        }

        // Ink items
        foreach ($inkOptions as $item) {
            $chk = $conn->query("SELECT id FROM item_codes WHERE consumable_id = {$inkConsId} AND item_name = '" . $conn->real_escape_string($item) . "' AND is_deleted = 0");
            if ($chk->num_rows == 0) {
                $stmtInsert->bind_param("iss", $inkConsId, $item, $item);
                $stmtInsert->execute();
                $totalInserted++;
            } else {
                $totalExisting++;
            }
        }

        // Master items
        foreach ($masterOptions as $item) {
            $chk = $conn->query("SELECT id FROM item_codes WHERE consumable_id = {$mstConsId} AND item_name = '" . $conn->real_escape_string($item) . "' AND is_deleted = 0");
            if ($chk->num_rows == 0) {
                $stmtInsert->bind_param("iss", $mstConsId, $item, $item);
                $stmtInsert->execute();
                $totalInserted++;
            } else {
                $totalExisting++;
            }
        }
    }
}

$stmtInsert->close();

// Mark in dashboard_settings
$tableCheck = $conn->query("SHOW TABLES LIKE 'dashboard_settings'");
if ($tableCheck && $tableCheck->num_rows > 0) {
    $conn->query("INSERT INTO dashboard_settings (setting_key, setting_value) VALUES ('migration_riso_fii_options_v1', '1') ON DUPLICATE KEY UPDATE setting_value = '1'");
}

outputMsg("<b>Migration complete!</b> Newly inserted: {$totalInserted} items | Already present: {$totalExisting} items.", "success");

if (!$isCli) {
    echo "<hr><p style='font-size:13px;color:#666;'>You can safely close this page or re-run anytime.</p></div></body></html>";
}
