<?php
/**
 * Standalone migration runner for adding more RISO inks.
 * Can be run via CLI (`php add_more_riso_inks.php`) or accessed via web browser.
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
    echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>More RISO Inks Migration</title>";
    echo "<style>body{font-family:sans-serif;padding:24px;line-height:1.5;background:#f9f9fb;color:#222;} .box{background:#fff;padding:20px;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,0.1);max-width:800px;margin:auto;}</style>";
    echo "</head><body><div class='box'>";
    echo "<h2>More RISO Inks Migration</h2><hr>";
}

outputMsg("Starting more RISO inks migration...", "info");

// Define the series models
$ez_models = ['EZ2301', 'EZ330', 'EZ331', 'EZ3701', 'EZ5701'];
$mz_models = ['MZ1070', 'MZ7700', 'MZ8700', 'MZ970'];
$rz_models = ['RZ1070', 'RZ2300', 'RZ3700', 'RZ5700', 'RZ970'];
$sf_models = ['SF5230', 'SF530', 'SF5330', 'SF5350', 'SF9350', 'SF9390'];
$cz_models = ['CZ180'];
$mz970_models = ['MZ970'];

// Get all models from DB dynamically for "all" series
$all_models = [];
$catRes = $conn->query("SELECT id FROM categories WHERE field = 'Product Type' AND category_name IN ('RISO', 'RISO Machine') AND is_deleted = 0");
$catIds = [];
while ($row = $catRes->fetch_assoc()) {
    $catIds[] = $row['id'];
}
if (!empty($catIds)) {
    $ids = implode(',', $catIds);
    $res = $conn->query("SELECT DISTINCT subcategory_name FROM subcategories WHERE category_id IN ($ids) AND is_deleted = 0");
    while ($row = $res->fetch_assoc()) {
        $all_models[] = $row['subcategory_name'];
    }
} else {
    // Fallback if none found
    $all_models = array_merge($ez_models, $mz_models, $rz_models, $sf_models, $cz_models);
}


$sf_mz_rz_ez = array_merge($sf_models, $mz_models, $rz_models, $ez_models);
$mz_rz_ez = array_merge($mz_models, $rz_models, $ez_models);

// Mapping of item code to models
$items_to_add = [
    'RISO INK FII TYPE BRIGHT RED UA' => $sf_mz_rz_ez,
    'FII TYPE RISO FEDERAL BLUE' => $sf_mz_rz_ez,
    'FII TYPE RISO PURPLE' => $sf_mz_rz_ez,
    'RISO INK FII TYPE YELLOW UA' => $sf_mz_rz_ez,
    'RISO INK FII TYPE MEDIUM BLUE UA' => $sf_mz_rz_ez,
    'RISO INK FII TYPE FLUORESCENT PINK UA' => $sf_mz_rz_ez,
    'RISO INK FII TYPE GREEN UA' => $sf_mz_rz_ez,
    
    'RISO INK FII TYPE ORANGE UA' => $mz970_models,
    
    'RISO INK Z TYPE / E TYPE BLUE' => $mz_rz_ez,
    'RISO INK ETYPE YELLOW' => $mz_rz_ez,
    
    'RISO INK CZ TYPE RED' => $cz_models,
    'RISO INK CZ TYPE BLUE' => $cz_models,
    'RISO INK CZ TYPE GREEN' => $cz_models,
    
    'RISO INK FII TYPE AQUA UA' => $sf_models,
    
    'RISO FII TYPE FLAT GOLD' => $all_models
];

// Determine categories
$categoriesToUpdate = [];
$catRes = $conn->query("SELECT id, category_name FROM categories WHERE field = 'Product Type' AND category_name IN ('RISO', 'RISO Machine') AND is_deleted = 0");
while ($row = $catRes->fetch_assoc()) {
    $categoriesToUpdate[$row['id']] = $row['category_name'];
}

if (empty($categoriesToUpdate)) {
    // Hardcoded fallbacks if no rows found
    $categoriesToUpdate[396] = 'RISO (Consumables)';
    $categoriesToUpdate[351] = 'RISO Machine';
}

$totalInserted = 0;
$totalExisting = 0;

$stmtInsert = $conn->prepare("INSERT INTO item_codes (consumable_id, item_code, item_name, is_deleted) VALUES (?, ?, ?, 0)");

foreach ($categoriesToUpdate as $catId => $catName) {
    outputMsg("<b>Processing Category: {$catName} (ID: {$catId})</b>", "info");

    foreach ($items_to_add as $itemName => $modelsToApply) {
        foreach ($modelsToApply as $modelName) {
            // Find or create the Model
            $scRes = $conn->query("SELECT id FROM subcategories WHERE category_id = {$catId} AND subcategory_name = '" . $conn->real_escape_string($modelName) . "' AND is_deleted = 0");
            if ($scRes && $scRes->num_rows > 0) {
                $modelId = $scRes->fetch_assoc()['id'];
            } else {
                $conn->query("INSERT INTO subcategories (category_id, subcategory_name, is_deleted) VALUES ({$catId}, '" . $conn->real_escape_string($modelName) . "', 0)");
                $modelId = $conn->insert_id;
                outputMsg("Created missing model: {$modelName}", "warn");
            }

            // Find or create INK consumable
            $inkRes = $conn->query("SELECT id FROM consumables WHERE model_id = {$modelId} AND consumable_name = 'INK' AND is_deleted = 0");
            if ($inkRes && $inkRes->num_rows > 0) {
                $inkConsId = $inkRes->fetch_assoc()['id'];
            } else {
                $conn->query("INSERT INTO consumables (model_id, consumable_name, is_deleted) VALUES ({$modelId}, 'INK', 0)");
                $inkConsId = $conn->insert_id;
                outputMsg("Created missing INK consumable for {$modelName}", "warn");
            }

            // Check if item already exists
            $chk = $conn->query("SELECT id FROM item_codes WHERE consumable_id = {$inkConsId} AND item_name = '" . $conn->real_escape_string($itemName) . "' AND is_deleted = 0");
            if ($chk && $chk->num_rows == 0) {
                $stmtInsert->bind_param("iss", $inkConsId, $itemName, $itemName);
                $stmtInsert->execute();
                $totalInserted++;
            } else {
                $totalExisting++;
            }
        }
    }
}

$stmtInsert->close();

outputMsg("<b>Migration complete!</b> Newly inserted: {$totalInserted} items | Already present: {$totalExisting} items.", "success");

if (!$isCli) {
    echo "<hr><p style='font-size:13px;color:#666;'>You can safely close this page or re-run anytime.</p></div></body></html>";
}
