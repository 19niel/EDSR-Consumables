<?php
require __DIR__ . '/../php/db_conn.php';

echo "--- 1. Check Category for KM Color ---\n";
$res = $conn->query("SELECT id, field, category_name FROM categories WHERE category_name LIKE '%KM Color%' OR field = 'Product Type'");
while($r = $res->fetch_assoc()) {
    echo "ID: {$r['id']} | Field: {$r['field']} | Name: {$r['category_name']}\n";
}

echo "\n--- 2. Check SBU for KM Kitbuyer ---\n";
$res = $conn->query("SELECT id, field, category_name FROM categories WHERE category_name LIKE '%Kitbuyer%' OR field = 'SBU'");
while($r = $res->fetch_assoc()) {
    echo "ID: {$r['id']} | Field: {$r['field']} | Name: {$r['category_name']}\n";
}

echo "\n--- 3. Encoded records with SBU = 'KM Kitbuyer' or 342 ---\n";
$res = $conn->query("SELECT COUNT(*) as cnt FROM encoded WHERE sbu = 'KM Kitbuyer' OR sbu = '342'");
$cnt = $res->fetch_assoc()['cnt'];
echo "Total encoded records with KM Kitbuyer: $cnt\n";

echo "\n--- 4. Product details linked to encoded with KM Kitbuyer ---\n";
$q = "SELECT e.id as encoded_id, e.sbu, e.accName, e.accExec, e.callDate,
             pd.id as pd_id, pd.productTypeID, c.category_name as product_type,
             pd.productSubcategoryID, sc.subcategory_name as model,
             pd.deviceConditionID as consumable_id, cons.consumable_name,
             pd.itemCode as item_code_id, ic.item_name, ic.item_code,
             pd.quantity, pd.productAmount
      FROM encoded e
      JOIN product_details pd ON pd.encodedID = e.id AND pd.is_deleted = 0
      LEFT JOIN categories c ON pd.productTypeID = c.id
      LEFT JOIN subcategories sc ON pd.productSubcategoryID = sc.id
      LEFT JOIN consumables cons ON pd.deviceConditionID = cons.id
      LEFT JOIN item_codes ic ON pd.itemCode = ic.id OR pd.itemCode = ic.item_code
      WHERE (e.sbu = 'KM Kitbuyer' OR e.sbu = '342')
      ORDER BY e.id DESC";
$res = $conn->query($q);
if ($res) {
    echo "Found " . $res->num_rows . " product detail rows for KM Kitbuyer.\n";
    $km_color_count = 0;
    while($r = $res->fetch_assoc()) {
        if ($r['product_type'] === 'KM Color' || $r['productTypeID'] == 393) {
            $km_color_count++;
            echo "Encoded ID: {$r['encoded_id']} | Acct: {$r['account_name']} | Type: {$r['product_type']} | Model: {$r['model']} | Consumable: {$r['consumable_name']} | ItemCode: {$r['item_name']} | Qty: {$r['quantity']} | Price: {$r['productAmount']}\n";
        }
    }
    echo "Total KM Color rows among KM Kitbuyer records: $km_color_count\n";
} else {
    echo "Error querying product details: " . $conn->error . "\n";
}

echo "\n--- 5. All Subcategories (Models), Consumables, and Item Codes under KM Color (Category ID 393) ---\n";
$qCatalog = "SELECT sc.id as model_id, sc.subcategory_name as model_name,
                    c.id as cons_id, c.consumable_name,
                    ic.id as item_id, ic.item_code, ic.item_name
             FROM subcategories sc
             LEFT JOIN consumables c ON c.model_id = sc.id AND c.is_deleted = 0
             LEFT JOIN item_codes ic ON ic.consumable_id = c.id AND ic.is_deleted = 0
             WHERE sc.category_id = 393 AND sc.is_deleted = 0
             ORDER BY sc.subcategory_name, c.consumable_name, ic.item_name";
$resCatalog = $conn->query($qCatalog);
if ($resCatalog) {
    echo "Total catalog items under KM Color: " . $resCatalog->num_rows . "\n";
}
