<?php
require __DIR__ . '/../php/db_conn.php';

$outputFile = __DIR__ . '/../RISO_KITBUYER_REFERENCE.md';
$md = "";

$md .= "# RISO Options & Records (SBU: RISO Kitbuyer)\n\n";
$md .= "> **System Context**: In E-DSR Consumables (`e-dsr-cons`), when the **SBU / Segment** is selected as `RISO Kitbuyer` (Category ID `343`) or `OP - Riso` (Category ID `341`), the system activates the Consumables product and pricing module. In this module, the **Product Type** option `RISO` (Category ID `396`) provides RISO machine models, consumables, and item codes.\n\n";

$md .= "## 📁 Generated Files\n";
$md .= "- [riso_catalog.csv](file:///c:/xampp/htdocs/e-dsr-cons/riso_catalog.csv): Complete catalog of **293** items across all **36** RISO Machine Models, Consumables, and Item Codes.\n";
$md .= "- [riso_kitbuyer_encoded.csv](file:///c:/xampp/htdocs/e-dsr-cons/riso_kitbuyer_encoded.csv): All **152** historical encoded transactions recorded under RISO.\n\n";

$md .= "## 🆕 Newly Added Items for SF, MZ, RZ, and EZ Series\n\n";
$md .= "The following **8 item codes** were added across all **20 models** starting with **SF, MZ, RZ, and EZ**:\n\n";
$md .= "### Under Consumable: `INK`\n";
$md .= "1. `RISO INK FII TYPE BLACK AG`\n";
$md .= "2. `RISO INK FII TYPE YELLOW UA`\n";
$md .= "3. `RISO INK FII TYPE BLUE UA`\n";
$md .= "4. `RISO INK FII TYPE FLUORESCENT PINK UA`\n";
$md .= "5. `RISO INK FII TYPE GREEN UA`\n";
$md .= "6. `RISO INK FII TYPE RED UA`\n";
$md .= "7. `RISO INK FII TYPE AQUA UA`\n";
$md .= "8. `RISO MASTER FII TYPE77AG/A3` *(also available under INK for convenience)*\n\n";
$md .= "### Under Consumable: `MASTER`\n";
$md .= "1. `RISO MASTER FII TYPE77AG/A3`\n\n";

$md .= "### Applied to Models (20 Models):\n";
$md .= "- **EZ Series (5 models)**: `EZ2301`, `EZ330`, `EZ331`, `EZ3701`, `EZ5701`\n";
$md .= "- **MZ Series (4 models)**: `MZ1070`, `MZ7700`, `MZ8700`, `MZ970`\n";
$md .= "- **RZ Series (5 models)**: `RZ1070`, `RZ2300`, `RZ3700`, `RZ5700`, `RZ970`\n";
$md .= "- **SF Series (6 models)**: `SF5230`, `SF530`, `SF5330`, `SF5350`, `SF9350`, `SF9390`\n\n";

// Overview Stats
$md .= "## 📊 Overview Statistics\n\n";
$md .= "| Metric | Count |\n";
$md .= "| :--- | :--- |\n";
$md .= "| **Total RISO Machine Models (Subcategories)** | **36** |\n";
$md .= "| **Total Catalog Item Codes across Models** | **293** |\n";
$md .= "| **Total Historical Encoded Transactions** | **152** |\n\n";

// Section 1: All 36 Models
$md .= "## 🖨️ 1. Complete List of All RISO Models & Available Consumables (36 Models)\n\n";
$md .= "| # | Model Name | Model ID | Available Consumables | Item Codes Count | Series Group |\n";
$md .= "| :-: | :--- | :-: | :--- | :-: | :--- |\n";

$resModels = $conn->query("
    SELECT sc.id as model_id, sc.subcategory_name as model_name
    FROM subcategories sc
    WHERE sc.category_id = 396 AND sc.is_deleted = 0
    ORDER BY sc.subcategory_name ASC
");

$i = 1;
while($m = $resModels->fetch_assoc()) {
    $modelId = $m['model_id'];
    $mName = $m['model_name'];
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
        $consList[] = $crow['consumable_name'] . " (" . $crow['item_cnt'] . ")";
        $totalItems += (int)$crow['item_cnt'];
    }
    $consStr = empty($consList) ? "*(None configured)*" : implode(", ", $consList);
    
    $series = "Other";
    if (strpos($mName, 'SF') === 0) $series = "**SF Series (Updated)**";
    elseif (strpos($mName, 'MZ') === 0) $series = "**MZ Series (Updated)**";
    elseif (strpos($mName, 'RZ') === 0) $series = "**RZ Series (Updated)**";
    elseif (strpos($mName, 'EZ') === 0) $series = "**EZ Series (Updated)**";
    
    $md .= "| {$i} | **{$m['model_name']}** | `{$m['model_id']}` | {$consStr} | **{$totalItems}** | {$series} |\n";
    $i++;
}

// Section 2: Encoded Data Breakdown
$md .= "\n## 📈 2. Historical Encoded Records Breakdown for RISO\n\n";
$resEncBreakdown = $conn->query("
    SELECT sc.subcategory_name as model, cons.consumable_name, COUNT(*) as count, SUM(pd.quantity) as total_qty, SUM(pd.quantity * pd.productAmount) as total_sales
    FROM encoded e
    JOIN product_details pd ON pd.encodedID = e.id AND pd.is_deleted = 0
    LEFT JOIN categories c ON pd.productTypeID = c.id
    LEFT JOIN subcategories sc ON pd.productSubcategoryID = sc.id
    LEFT JOIN consumables cons ON pd.deviceConditionID = cons.id
    WHERE (e.sbu = 'RISO Kitbuyer' OR e.sbu = '343' OR e.sbu = 'OP - Riso' OR e.sbu = '341' OR c.category_name = 'RISO' OR pd.productTypeID IN (396, 351, 258, 260))
    GROUP BY sc.subcategory_name, cons.consumable_name
    ORDER BY count DESC
");

$md .= "| Model | Consumable | Encoded Lines | Total Qty | Total Sales (PHP) |\n";
$md .= "| :--- | :--- | :-: | :-: | :--- |\n";

while($r = $resEncBreakdown->fetch_assoc()) {
    $formattedSales = number_format($r['total_sales'] ?? 0, 2);
    $modelDisp = $r['model'] ?? 'N/A (Machine only / unlinked)';
    $consDisp = $r['consumable_name'] ?? 'N/A';
    $md .= "| **{$modelDisp}** | {$consDisp} | {$r['count']} | {$r['total_qty']} | ₱{$formattedSales} |\n";
}

file_put_contents($outputFile, $md);
echo "Successfully generated RISO_KITBUYER_REFERENCE.md\n";
