<?php
require __DIR__ . '/../php/db_conn.php';

$outputFile = __DIR__ . '/../KM_COLOR_KITBUYER_REFERENCE.md';
$md = "";

$md .= "# KM Color Options & Records (SBU: KM Kitbuyer)\n\n";
$md .= "> **System Context**: In E-DSR Consumables (`e-dsr-cons`), when the **SBU / Segment** is selected as `KM Kitbuyer` (Category ID `342`), the system activates the Consumables product and pricing module. Under this module, **Product Type** offers `KM Color` (Category ID `393`), `KM Mono` (Category ID `395`), and `RISO` (Category ID `396`).\n\n";

$md .= "## 📁 Generated Files\n";
$md .= "- [km_color_catalog.csv](file:///c:/xampp/htdocs/e-dsr-cons/km_color_catalog.csv): Complete catalog of **857** items (55 Machine Models, Consumables, and Item Codes).\n";
$md .= "- [km_color_kitbuyer_encoded.csv](file:///c:/xampp/htdocs/e-dsr-cons/km_color_kitbuyer_encoded.csv): All **316** historical encoded transaction line items recorded under `KM Kitbuyer` for `KM Color`.\n\n";

// Overview Stats
$md .= "## 📊 Overview Statistics\n\n";
$md .= "| Metric | Count |\n";
$md .= "| :--- | :--- |\n";
$md .= "| **Total KM Color Machine Models (Subcategories)** | **55** |\n";
$md .= "| **Total Catalog Item Codes across Models** | **857** |\n";
$md .= "| **Total Historical Encoded Reports (KM Kitbuyer + KM Color)** | **99** |\n";
$md .= "| **Total Encoded Line Items (KM Kitbuyer + KM Color)** | **316** |\n";
$md .= "| **Unique Client Accounts Encoded** | **65** |\n\n";

// Section 1: All 55 Models and available consumables
$md .= "## 🖨️ 1. Complete List of KM Color Models & Available Consumables (55 Models)\n\n";
$md .= "Below are all 55 Konica Minolta Color models available in the system dropdown when `KM Color` is selected:\n\n";

$resModels = $conn->query("
    SELECT sc.id as model_id, sc.subcategory_name as model_name
    FROM subcategories sc
    WHERE sc.category_id = 393 AND sc.is_deleted = 0
    ORDER BY sc.subcategory_name ASC
");

$md .= "| # | Model Name | Model ID | Available Consumables | Item Codes Count |\n";
$md .= "| :-: | :--- | :-: | :--- | :-: |\n";

$i = 1;
while($m = $resModels->fetch_assoc()) {
    $modelId = $m['model_id'];
    $resC = $conn->query("
        SELECT c.consumable_name, COUNT(ic.id) as item_cnt
        FROM consumables c
        LEFT JOIN item_codes ic ON ic.consumable_id = c.id AND ic.is_deleted = 0
        WHERE c.model_id = $modelId AND c.is_deleted = 0
        GROUP BY c.id
        ORDER BY c.consumable_name ASC
    ");
    $consList = [];
    $totalItems = 0;
    while($crow = $resC->fetch_assoc()) {
        $consList[] = $crow['consumable_name'];
        $totalItems += (int)$crow['item_cnt'];
    }
    $consStr = empty($consList) ? "*(None configured)*" : implode(", ", $consList);
    $md .= "| {$i} | **{$m['model_name']}** | `{$m['model_id']}` | {$consStr} | {$totalItems} |\n";
    $i++;
}

// Section 2: Encoded Data Breakdown
$md .= "\n## 📈 2. Historical Encoded Records Breakdown (KM Kitbuyer + KM Color)\n\n";
$md .= "Transactions encoded in E-DSR with SBU = **KM Kitbuyer** and Product Type = **KM Color**, grouped by Machine Model and Consumable:\n\n";

$resEncBreakdown = $conn->query("
    SELECT sc.subcategory_name as model, cons.consumable_name, COUNT(*) as count, SUM(pd.quantity) as total_qty, SUM(pd.quantity * pd.productAmount) as total_sales
    FROM encoded e
    JOIN product_details pd ON pd.encodedID = e.id AND pd.is_deleted = 0
    JOIN categories c ON pd.productTypeID = c.id
    LEFT JOIN subcategories sc ON pd.productSubcategoryID = sc.id
    LEFT JOIN consumables cons ON pd.deviceConditionID = cons.id
    WHERE (e.sbu = 'KM Kitbuyer' OR e.sbu = '342')
      AND (c.category_name = 'KM Color' OR pd.productTypeID = 393)
    GROUP BY sc.subcategory_name, cons.consumable_name
    ORDER BY count DESC
");

$md .= "| Model | Consumable | Encoded Lines | Total Qty | Total Sales (PHP) |\n";
$md .= "| :--- | :--- | :-: | :-: | :--- |\n";

while($r = $resEncBreakdown->fetch_assoc()) {
    $formattedSales = number_format($r['total_sales'], 2);
    $md .= "| **{$r['model']}** | {$r['consumable_name']} | {$r['count']} | {$r['total_qty']} | ₱{$formattedSales} |\n";
}

file_put_contents($outputFile, $md);
echo "Successfully generated KM_COLOR_KITBUYER_REFERENCE.md\n";
