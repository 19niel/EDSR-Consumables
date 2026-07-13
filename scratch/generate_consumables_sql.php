<?php
/**
 * Parse "EDSR CONS 1(KM COLOR).csv" and generate SQL INSERT statements
 * for `consumables` and `item_codes` tables.
 *
 * Run via: php scratch/generate_consumables_sql.php > scratch/seed_consumables.sql
 */

$csvPath = __DIR__ . '/../EDSR CONS 1(KM COLOR).csv';

// -----------------------------------------------------------------------
// Machine model → subcategory IDs (category_id = 350 in subcategories table)
// -----------------------------------------------------------------------
$machineToIds = [
    'C450'                         => [210],
    'C451 / C550'                  => [211, 212],
    'C454 / C454E / C554 / C554E' => [213, 214, 215, 216],
    'C552 / C652'                  => [219, 220],
    'C6500'                        => [221],
    'C6501'                        => [222],
    'C70HC'                        => [223],
    'C7000/C6000'                  => [224, 225],
    'C224 / C284 / C364 (C224E)'  => [226, 227, 228],
    'BH600'                        => [229],
    'BHC35'                        => [230],
    'BH C308 / C368'              => [217, 218],
    'BHC3350 / C3850'             => [231, 232],
    'BHC221 / C281'               => [233, 234],
    'BH C458/C558/C658'           => [235, 236, 237],
    'BIZHUB BHC3110'              => [238],
    'BH C227 / C287'              => [239, 240],
    'BH C227i'                    => [241],
    'BHC300i / C360i / C250i'    => [242, 243, 244],
    'C1060/C1070/C2060/C3070'    => [245, 246, 247, 248],
    'BHC650i/C550i/C450i/C551i'  => [249, 250, 251, 252],
    'BHC750i'                     => [253],
    'BHC4050i/BHC3350i'          => [254, 255],
    'C4070'                        => [256],
    'C4065'                        => [257],
    'BH-C654/C654e/C754/C754e'   => [258, 259, 260, 261],
    'BH-C251i'                    => [262],
    'BH-C301i'                    => [263],
];

// -----------------------------------------------------------------------
// Parse CSV
// -----------------------------------------------------------------------
$handle = fopen($csvPath, 'r');
if (!$handle) {
    die("ERROR: Cannot open CSV file at: $csvPath\n");
}

// Skip header row
fgetcsv($handle);

$rawRows = [];
while (($data = fgetcsv($handle)) !== false) {
    if (count($data) < 3) continue;
    $rawRows[] = [
        'machine'    => trim($data[0]),
        'consumable' => trim($data[1]),
        'item_name'  => trim($data[2]),
    ];
}
fclose($handle);

// -----------------------------------------------------------------------
// Fill in blank cells (inherited from previous row — "merged cell" pattern)
// -----------------------------------------------------------------------
$currentMachine    = '';
$currentConsumable = '';
$filled = [];

foreach ($rawRows as $row) {
    if ($row['machine'] !== '')    $currentMachine    = $row['machine'];
    if ($row['consumable'] !== '') $currentConsumable = $row['consumable'];
    if ($row['item_name'] === '')  continue; // skip blank item rows

    $filled[] = [
        'machine'    => $currentMachine,
        'consumable' => $currentConsumable,
        'item_name'  => $row['item_name'],
    ];
}

// -----------------------------------------------------------------------
// Group: machine → consumable → [item names]  (preserving insertion order)
// -----------------------------------------------------------------------
$grouped = [];
foreach ($filled as $row) {
    $m = $row['machine'];
    $c = $row['consumable'];
    if (!isset($grouped[$m]))     $grouped[$m]     = [];
    if (!isset($grouped[$m][$c])) $grouped[$m][$c] = [];
    $grouped[$m][$c][] = $row['item_name'];
}

// -----------------------------------------------------------------------
// Generate INSERT statements
// -----------------------------------------------------------------------
$consumableRows = [];
$itemCodeRows   = [];
$consumableId   = 1;
$itemCodeId     = 1;
$warnings       = [];

foreach ($grouped as $machineName => $consumables) {
    $modelIds = $machineToIds[$machineName] ?? null;

    if (!$modelIds) {
        $warnings[] = "-- WARNING: No subcategory ID mapping found for machine: \"$machineName\"";
        continue;
    }

    // For each machine model in this group, duplicate the consumables+items
    foreach ($modelIds as $modelId) {
        foreach ($consumables as $consumableName => $items) {
            $cid = $consumableId++;

            $consumableRows[] = sprintf(
                "(%d, %d, '%s', 0)",
                $cid,
                $modelId,
                addslashes(trim($consumableName))
            );

            foreach ($items as $itemName) {
                $itemCodeRows[] = sprintf(
                    "(%d, %d, '', '%s', 0)",
                    $itemCodeId++,
                    $cid,
                    addslashes(trim($itemName))
                );
            }
        }
    }
}

// -----------------------------------------------------------------------
// Output SQL
// -----------------------------------------------------------------------
$totalConsumables = count($consumableRows);
$totalItemCodes   = count($itemCodeRows);

echo "-- =================================================================\n";
echo "-- EDSR Consumables Seed Data\n";
echo "-- Generated: " . date('Y-m-d H:i:s') . "\n";
echo "-- Consumable rows : $totalConsumables\n";
echo "-- Item code rows  : $totalItemCodes\n";
echo "-- =================================================================\n\n";

if ($warnings) {
    echo implode("\n", $warnings) . "\n\n";
}

echo "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
echo "START TRANSACTION;\n\n";

// --- consumables ---
echo "-- -----------------------------------------------------------------\n";
echo "-- Table: consumables\n";
echo "-- -----------------------------------------------------------------\n";
echo "INSERT INTO `consumables` (`id`, `model_id`, `consumable_name`, `is_deleted`) VALUES\n";
echo implode(",\n", $consumableRows) . ";\n\n";

// --- item_codes ---
echo "-- -----------------------------------------------------------------\n";
echo "-- Table: item_codes\n";
echo "-- -----------------------------------------------------------------\n";
echo "INSERT INTO `item_codes` (`id`, `consumable_id`, `item_code`, `item_name`, `is_deleted`) VALUES\n";
echo implode(",\n", $itemCodeRows) . ";\n\n";

echo "-- Update AUTO_INCREMENT\n";
echo "ALTER TABLE `consumables` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=" . ($consumableId) . ";\n";
echo "ALTER TABLE `item_codes`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=" . ($itemCodeId) . ";\n\n";

echo "COMMIT;\n";
echo "\n-- Done. Total consumables: $totalConsumables | Total item codes: $totalItemCodes\n";
