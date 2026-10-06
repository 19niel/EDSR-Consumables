<?php
require __DIR__ . '/../php/db_conn.php';

// 1. Models under KM Color (Category ID 393)
$res = $conn->query("SELECT id, subcategory_name FROM subcategories WHERE category_id = 393 AND is_deleted = 0 ORDER BY subcategory_name");
$models = [];
while($r = $res->fetch_assoc()) {
    $models[] = $r;
}

echo "Total KM Color Machine Models: " . count($models) . "\n";
foreach($models as $m) {
    echo "  [ID: {$m['id']}] {$m['subcategory_name']}\n";
}

// 2. Sample of consumables under these models
echo "\n--- Summary of Consumable Types under KM Color ---\n";
$resCons = $conn->query("
    SELECT c.consumable_name, COUNT(DISTINCT c.model_id) as model_count, COUNT(ic.id) as item_code_count
    FROM subcategories sc
    JOIN consumables c ON c.model_id = sc.id AND c.is_deleted = 0
    LEFT JOIN item_codes ic ON ic.consumable_id = c.id AND ic.is_deleted = 0
    WHERE sc.category_id = 393 AND sc.is_deleted = 0
    GROUP BY c.consumable_name
    ORDER BY c.consumable_name
");
while($r = $resCons->fetch_assoc()) {
    echo "  - {$r['consumable_name']} (across {$r['model_count']} models, {$r['item_code_count']} item codes)\n";
}

// 3. Encoded data with KM Kitbuyer & KM Color
echo "\n--- Encoded records with KM Kitbuyer & KM Color ---\n";
$resEnc = $conn->query("
    SELECT e.id as encoded_id, e.LID, e.accName, e.callDate, e.accExec,
           sc.subcategory_name as model, cons.consumable_name,
           ic.item_name, pd.quantity, pd.productAmount
    FROM encoded e
    JOIN product_details pd ON pd.encodedID = e.id AND pd.is_deleted = 0
    JOIN categories c ON pd.productTypeID = c.id
    LEFT JOIN subcategories sc ON pd.productSubcategoryID = sc.id
    LEFT JOIN consumables cons ON pd.deviceConditionID = cons.id
    LEFT JOIN item_codes ic ON pd.itemCode = ic.id OR pd.itemCode = ic.item_code
    WHERE (e.sbu = 'KM Kitbuyer' OR e.sbu = '342')
      AND (c.category_name = 'KM Color' OR pd.productTypeID = 393)
    ORDER BY e.id DESC
");
echo "Total Encoded KM Color Line Items for KM Kitbuyer: " . $resEnc->num_rows . "\n";

// Count distinct accounts
$resAccts = $conn->query("
    SELECT COUNT(DISTINCT e.id) as total_encoded_entries, COUNT(DISTINCT e.accName) as total_unique_accounts
    FROM encoded e
    JOIN product_details pd ON pd.encodedID = e.id AND pd.is_deleted = 0
    JOIN categories c ON pd.productTypeID = c.id
    WHERE (e.sbu = 'KM Kitbuyer' OR e.sbu = '342')
      AND (c.category_name = 'KM Color' OR pd.productTypeID = 393)
");
$acctRow = $resAccts->fetch_assoc();
echo "Unique Encoded Reports: {$acctRow['total_encoded_entries']}, Unique Accounts: {$acctRow['total_unique_accounts']}\n";
