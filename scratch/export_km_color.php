<?php
require __DIR__ . '/../php/db_conn.php';

// Generate Catalog CSV
$catalogFile = __DIR__ . '/../km_color_catalog.csv';
$fp = fopen($catalogFile, 'w');
fputcsv($fp, ['Category', 'Model_ID', 'Model_Name', 'Consumable_ID', 'Consumable_Name', 'Item_ID', 'Item_Code', 'Item_Name']);

$qCatalog = "
    SELECT sc.id as model_id, sc.subcategory_name as model_name,
           c.id as cons_id, c.consumable_name,
           ic.id as item_id, ic.item_code, ic.item_name
    FROM subcategories sc
    JOIN consumables c ON c.model_id = sc.id AND c.is_deleted = 0
    JOIN item_codes ic ON ic.consumable_id = c.id AND ic.is_deleted = 0
    WHERE sc.category_id = 393 AND sc.is_deleted = 0
    ORDER BY sc.subcategory_name ASC, c.consumable_name ASC, ic.item_name ASC
";
$resCat = $conn->query($qCatalog);
$catCount = 0;
while($row = $resCat->fetch_assoc()) {
    fputcsv($fp, [
        'KM Color',
        $row['model_id'],
        $row['model_name'],
        $row['cons_id'],
        $row['consumable_name'],
        $row['item_id'],
        $row['item_code'],
        $row['item_name']
    ]);
    $catCount++;
}
fclose($fp);
echo "Wrote $catCount catalog items to km_color_catalog.csv\n";

// Generate Encoded KM Kitbuyer Records with KM Color CSV
$encodedFile = __DIR__ . '/../km_color_kitbuyer_encoded.csv';
$fpEnc = fopen($encodedFile, 'w');
fputcsv($fpEnc, [
    'Encoded_ID', 'LID', 'SBU', 'Account_Name', 'Account_Executive', 'Call_Date',
    'Product_Type', 'Model', 'Consumable', 'Item_Code', 'Quantity', 'Unit_Price', 'Total_Amount', 'Status', 'Remarks'
]);

$qEnc = "
    SELECT e.id as encoded_id, e.LID, e.sbu, e.accName, e.accExec, e.callDate, e.accStatus, e.remarks,
           c.category_name as product_type,
           sc.subcategory_name as model,
           cons.consumable_name,
           COALESCE(ic.item_name, pd.itemCode) as item_name,
           pd.quantity,
           pd.productAmount,
           (pd.quantity * pd.productAmount) as line_total
    FROM encoded e
    JOIN product_details pd ON pd.encodedID = e.id AND pd.is_deleted = 0
    JOIN categories c ON pd.productTypeID = c.id
    LEFT JOIN subcategories sc ON pd.productSubcategoryID = sc.id
    LEFT JOIN consumables cons ON pd.deviceConditionID = cons.id
    LEFT JOIN item_codes ic ON (pd.itemCode = ic.id OR pd.itemCode = ic.item_code)
    WHERE (e.sbu = 'KM Kitbuyer' OR e.sbu = '342')
      AND (c.category_name = 'KM Color' OR pd.productTypeID = 393)
    ORDER BY e.callDate DESC, e.id DESC
";
$resEnc = $conn->query($qEnc);
$encCount = 0;
while($row = $resEnc->fetch_assoc()) {
    fputcsv($fpEnc, [
        $row['encoded_id'],
        $row['LID'],
        $row['sbu'],
        $row['accName'],
        $row['accExec'],
        $row['callDate'],
        $row['product_type'],
        $row['model'],
        $row['consumable_name'],
        $row['item_name'],
        $row['quantity'],
        $row['productAmount'],
        $row['line_total'],
        $row['accStatus'],
        $row['remarks']
    ]);
    $encCount++;
}
fclose($fpEnc);
echo "Wrote $encCount encoded records to km_color_kitbuyer_encoded.csv\n";
