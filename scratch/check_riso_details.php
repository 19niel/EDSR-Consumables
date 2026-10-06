<?php
require __DIR__ . '/../php/db_conn.php';

echo "=== RISO (Category 396) Consumables & Item Codes ===\n";
$q = "
    SELECT sc.id as model_id, sc.subcategory_name as model_name,
           c.id as cons_id, c.consumable_name,
           ic.id as item_id, ic.item_code, ic.item_name
    FROM subcategories sc
    LEFT JOIN consumables c ON c.model_id = sc.id AND c.is_deleted = 0
    LEFT JOIN item_codes ic ON ic.consumable_id = c.id AND ic.is_deleted = 0
    WHERE sc.category_id = 396 AND sc.is_deleted = 0
    ORDER BY sc.subcategory_name, c.consumable_name, ic.item_name
";
$res = $conn->query($q);
echo "Total rows: " . $res->num_rows . "\n";

$modelsMap = [];
while($r = $res->fetch_assoc()) {
    $m = $r['model_name'];
    if (!isset($modelsMap[$m])) {
        $modelsMap[$m] = [];
    }
    $c = $r['consumable_name'] ?? '(no consumable)';
    if (!isset($modelsMap[$m][$c])) {
        $modelsMap[$m][$c] = [];
    }
    if ($r['item_name']) {
        $modelsMap[$m][$c][] = $r['item_name'];
    }
}

foreach($modelsMap as $model => $consumables) {
    echo "\nModel: $model\n";
    foreach($consumables as $cons => $items) {
        echo "  Consumable: $cons (" . count($items) . " item codes)\n";
        foreach($items as $it) {
            echo "    - $it\n";
        }
    }
}
