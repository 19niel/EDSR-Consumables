<?php
require __DIR__ . '/../php/db_conn.php';

$models = [
    'EZ2301', 'EZ330', 'EZ331', 'EZ3701', 'EZ5701',
    'MZ1070', 'MZ7700', 'MZ8700', 'MZ970',
    'RZ1070', 'RZ2300', 'RZ3700', 'RZ5700', 'RZ970',
    'SF5230', 'SF530', 'SF5330', 'SF5350', 'SF9350', 'SF9390'
];

foreach ([396, 351] as $catId) {
    echo "=== Category $catId ===\n";
    foreach ($models as $m) {
        $scRes = $conn->query("SELECT id FROM subcategories WHERE category_id = $catId AND subcategory_name = '$m' AND is_deleted = 0");
        $sc = $scRes->fetch_assoc();
        if (!$sc) {
            echo "Missing subcategory $m in Cat $catId\n";
            continue;
        }
        $scId = $sc['id'];
        $cInk = $conn->query("SELECT id FROM consumables WHERE model_id = $scId AND consumable_name = 'INK' AND is_deleted = 0")->fetch_assoc();
        $cMaster = $conn->query("SELECT id FROM consumables WHERE model_id = $scId AND consumable_name = 'MASTER' AND is_deleted = 0")->fetch_assoc();
        echo "Model $m (ID: $scId) -> INK: " . ($cInk['id'] ?? 'MISSING') . " | MASTER: " . ($cMaster['id'] ?? 'MISSING') . "\n";
    }
}
