<?php
include('db_conn.php');
require_once('helpers/product_helpers.php');

$encodedId = $_GET['id'] ?? null;
if (!$encodedId) {
    die("Missing account ID.");
}

// Fetch the master encoded record
$masterQuery = "SELECT * FROM encoded WHERE id = ? AND is_deleted = 0";
$stmt = $conn->prepare($masterQuery);
$stmt->bind_param('i', $encodedId);
$stmt->execute();
$masterResult = $stmt->get_result();
$data = $masterResult->fetch_assoc();
$stmt->close();

if (!$data) {
    die("No matching records found");
}

// Fetch the child product loop profiles
$products = [];
$productQuery = "SELECT * FROM product_details WHERE encodedID = ?";
$stmt2 = $conn->prepare($productQuery);
$stmt2->bind_param('i', $encodedId);
$stmt2->execute();
$productResult = $stmt2->get_result();
while ($pRow = $productResult->fetch_assoc()) {
    $products[] = $pRow;
}
$stmt2->close();

$data['products'] = $products;

// Function to get subcategory name
function getSubcategoryName($conn, $id) {
    if (!$id || $id === 'N/A') return '';
    $stmt = $conn->prepare("SELECT subcategory_name FROM subcategories WHERE id = ?");
    if($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $res ? $res['subcategory_name'] : '';
    }
    return '';
}

// Data Preparation
$date = date('F j, Y', strtotime($data['created_at'] ?? 'now'));
$customerId = $data['LID'] ?? '';
$companyName = $data['accName'] ?? '';
$address = $data['address'] ?? '';

$contactName = trim($data['contactPerson'] ?? '');
$contactNumber = trim($data['contactNumber'] ?? '');

$sbu = strtolower($data['sbu'] ?? '');
$isRiso = (strpos($sbu, 'riso') !== false);
$isKm = !$isRiso;

// Fetch AE Details
$aeName = $data['accExec'] ?? '';
$aeEmail = '';
$aeContact = '';

if ($aeName) {
    $aeStmt = $conn->prepare("SELECT email_address, contact_no FROM users WHERE name = ? AND is_deleted = 0 LIMIT 1");
    if ($aeStmt) {
        $aeStmt->bind_param('s', $aeName);
        $aeStmt->execute();
        $aeResult = $aeStmt->get_result();
        if ($aeRow = $aeResult->fetch_assoc()) {
            $aeEmail = $aeRow['email_address'] ?? '';
            $aeContact = $aeRow['contact_no'] ?? '';
        }
        $aeStmt->close();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quotation - <?= htmlspecialchars($customerId) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #525659;
            display: flex;
            justify-content: center;
        }
        .a4-container {
            width: 8.5in;
            min-height: 11in;
            background-color: white;
            padding: 0.25in 0.65in 0.25in 0.65in;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            margin: 15px auto;
            position: relative;
            font-size: 12.5px;
        }
        @page {
            size: letter;
            margin: 0;
        }
        @media print {
            body {
                background-color: white;
                margin: 0;
                padding: 0;
                display: block;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .a4-container {
                box-shadow: none;
                margin: 0 auto;
                padding: 0.2in 0.45in 0.2in 0.45in;
                width: 100%;
                max-width: 8.5in;
                height: auto !important;
                min-height: auto !important;
                page-break-inside: avoid;
            }
            .no-print { display: none !important; }
            
            table.items-table { page-break-inside: auto; }
            table.items-table tr { page-break-inside: avoid; page-break-after: auto; }
            table.items-table thead { display: table-header-group; }
            table.items-table tfoot { display: table-footer-group; }
            
            .totals-section, .bottom-section, .thick-border-container { page-break-inside: avoid; }
        }
        .header-logo {
            text-align: right;
            font-size: 13px;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
        }
        .header-logo img {
            max-height: 110px;
            display: block;
            margin-bottom: 2px;
        }
        
        .top-info-table {
            width: 450px;
            margin-bottom: 4px;
            font-size: 12.5px;
            border-collapse: collapse;
        }
        .top-info-table td {
            padding: 1px 0;
            vertical-align: bottom;
        }
        .top-label {
            width: 125px;
            font-weight: bold;
        }
        .top-value {
            border-bottom: 1px solid #000;
            padding-bottom: 1px;
            padding-left: 20px;
            font-weight: normal;
        }
        .attention-subtext {
            text-align: center;
            font-size: 10.5px;
            padding-top: 1px;
            font-weight: normal;
        }

        .greeting {
            margin-top: 4px;
            margin-bottom: 4px;
            line-height: 1.25;
            font-size: 12.5px;
        }
        .check-box-group {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-left: 10px;
            margin-right: 15px;
        }
        .check-box {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #000;
            text-align: center;
            line-height: 14px;
            font-size: 13px;
            font-weight: bold;
        }
        .check-box-filled {
            background-color: #000;
            color: #000;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-weight: bold;
            font-size: 12px;
        }
        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 3px 4px;
            text-align: center;
        }
        .items-table td {
            font-weight: normal;
            height: 18px;
        }

        .totals-section {
            display: flex;
            margin-top: 4px;
            margin-bottom: 6px;
        }
        .totals-left {
            flex: 1;
            font-weight: bold;
            padding-left: 35px;
            font-size: 12px;
        }
        .totals-right {
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            font-size: 12px;
        }
        .totals-row {
            display: flex;
            width: 100%;
            justify-content: flex-end;
            margin-bottom: 4px;
            font-weight: bold;
        }
        .totals-row span.label {
            margin-right: 30px;
        }
        .totals-row span.value {
            min-width: 80px;
            text-align: center;
        }
        .vat-inclusive {
            font-weight: bold;
            text-decoration: underline;
            margin-top: -2px;
            margin-right: 10px;
            font-size: 11.5px;
        }

        .thick-border-box {
            border: 2px solid #000;
            padding: 2px 5px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 2px;
            font-size: 12px;
        }
        .thick-border-container {
            margin-bottom: 6px;
        }

        .paragraph {
            margin-bottom: 6px;
            line-height: 1.3;
            font-size: 12px;
        }
        .inline-line {
            display: inline-block;
            border-bottom: 1px solid #000;
            width: 150px;
        }

        .bottom-section {
            display: flex;
            justify-content: space-between;
            margin-top: 6px;
            font-size: 12px;
        }
        .bottom-left {
            width: 45%;
            display: flex;
            flex-direction: column;
        }
        .sign-block {
            margin-top: 8px;
            margin-bottom: 4px;
        }
        .sign-line-full {
            border-bottom: 1px solid #000;
            width: 80%;
            margin-bottom: 2px;
        }
        .sign-sub {
            font-size: 10.5px;
            font-style: italic;
            padding-left: 20px;
        }
        .sign-title {
            font-weight: bold;
            text-align: center;
            width: 80%;
            font-size: 11.5px;
        }

        .bottom-right {
            width: 50%;
            border: 2px solid #000;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }
        .br-header {
            font-weight: bold;
            padding: 4px;
            border-bottom: 1px solid #000;
            height: 48px;
        }
        .br-header-title {
            margin-bottom: 4px;
        }
        .br-header-center {
            text-align: center;
        }
        .br-num-row {
            display: flex;
            border-bottom: 1px solid #000;
            padding: 1px 4px;
            font-weight: bold;
            min-height: 18px;
        }
        .br-details {
            padding: 4px;
        }
        .br-details-header {
            font-weight: bold;
            text-align: center;
            margin-bottom: 4px;
            margin-top: 2px;
        }
        .br-row {
            display: flex;
            margin-bottom: 3px;
            align-items: flex-end;
        }
        .br-label {
            font-weight: bold;
            width: 145px;
            font-size: 11.5px;
        }
        .br-value {
            flex: 1;
            border-bottom: 1px solid #000;
            min-height: 14px;
        }

        .footer-line {
            border-top: 2px solid #000;
            margin-top: 6px;
            padding-top: 3px;
            font-size: 10.5px;
        }

        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            z-index: 1000;
        }
        .print-btn:hover { background-color: #0b5ed7; }
    </style>
</head>
<body>

    <button class="print-btn no-print" onclick="window.print()">🖨️ Print Quotation</button>

    <div class="a4-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
            <div style="font-size: 18px; font-weight: 800; color: #333; border: 2px solid #333; padding: 4px 12px; border-radius: 4px; background-color: #f8f9fa; text-transform: uppercase; letter-spacing: 0.5px;">
                LID: <?= htmlspecialchars($customerId) ?>
            </div>
            <div class="header-logo" style="margin-bottom: 0;">
                <img src="../scratch/UBIX_LOGO.png" alt="UBIX Logo">
                <strong style="line-height: 1.1; font-size: 13px;">www.ubix.com.ph</strong>
            </div>
        </div>

        <table class="top-info-table">
            <tr>
                <td class="top-label">Date:</td>
                <td><div class="top-value"><?= htmlspecialchars($date) ?></div></td>
            </tr>
            <tr>
                <td class="top-label">Customer ID :</td>
                <td><div class="top-value"><?= htmlspecialchars($customerId) ?></div></td>
            </tr>
            <tr>
                <td class="top-label">Company Name :</td>
                <td><div class="top-value"><?= htmlspecialchars($companyName) ?></div></td>
            </tr>
            <tr>
                <td class="top-label">Address :</td>
                <td><div class="top-value"><?= htmlspecialchars($address) ?></div></td>
            </tr>
            <tr><td colspan="2" style="height: 3px;"></td></tr>
            <tr>
                <td class="top-label" style="vertical-align: top; padding-top: 2px;">Attention:</td>
                <td>
                    <div class="top-value"><?= htmlspecialchars($contactName) ?></div>
                    <div class="attention-subtext">Contact Person</div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="top-value" style="margin-top: 3px;"><?= htmlspecialchars($contactNumber) ?></div>
                    <div class="attention-subtext">Contact</div>
                </td>
            </tr>
        </table>

        <div class="greeting">
            We thank you for your inquiry regarding the consumables needed by your
            <span class="check-box-group">
                <span class="check-box <?= $isKm ? 'check-box-filled' : '' ?>"></span> KM
            </span>
            <span class="check-box-group">
                <span class="check-box <?= $isRiso ? 'check-box-filled' : '' ?>"></span> Riso
            </span>
            <br>
            At your request, we are pleased to submit a quotation for your kind consideration and favorable<br>
            approval as follows.
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>MODEL</th>
                    <th>ITEM DESCRIPTION/CODE</th>
                    <th>UNIT PRICE</th>
                    <th>QTY</th>
                    <th>UNIT</th>
                    <th>TOTAL PRICE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalAmount = 0;
                foreach ($products as $product):
                    $modelName = getSubcategoryName($conn, $product['productSubcategoryID'] ?? '');
                    
                    $itemCodeName = '';
                    if (!empty($product['itemCode'])) {
                        $itemCodeName = getItemCodeName($conn, $product['itemCode']);
                        if ($itemCodeName === 'N/A') {
                            $itemCodeName = $product['itemCode'];
                        }
                    }
                    
                    $consName = '';
                    if (!empty($product['deviceConditionID'])) {
                        $consName = getConsumableName($conn, $product['deviceConditionID']);
                        if ($consName === 'N/A') {
                            $consName = '';
                        }
                    }
                    
                    $itemDescCode = trim($itemCodeName . ' ' . $consName);
                    if (empty($itemDescCode)) {
                        $type = $product['productTypeSubcategory'] ?? '';
                        $consumable = $product['consumables'] ?? '';
                        $itemDescCode = $type;
                        if (!empty($consumable)) {
                            $itemDescCode .= " ( " . $consumable . " )";
                        }
                    }
                    
                    $price = floatval($product['productAmount'] ?? 0);
                    $qty = intval($product['quantity'] ?? 0);
                    $amount = $price * $qty;
                    $totalAmount += $amount;
                ?>
                <tr>
                    <td><?= htmlspecialchars($modelName) ?></td>
                    <td><?= htmlspecialchars($itemDescCode) ?></td>
                    <td><?= $price > 0 ? number_format($price, 2) : '' ?></td>
                    <td><?= $qty > 0 ? $qty : '' ?></td>
                    <td><?= ($price > 0 && $qty > 0) ? 'pc' : '' ?></td>
                    <td><?= $amount > 0 ? number_format($amount, 2) : '-' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="totals-section">
            <div class="totals-left">
                APPLY WH TAX?<br>
                <span class="check-box-group" style="margin-left:0; margin-top:5px;">
                    <span class="check-box"></span> Yes
                </span>
                <span class="check-box-group">
                    <span class="check-box"></span> No
                </span>
            </div>
            <div class="totals-right">
                <div class="totals-row">
                    <span class="label">TOTAL</span>
                    <span class="value"><?= number_format($totalAmount, 2) ?></span>
                </div>
                <?php
                $grandTotal = $totalAmount;
                if (!empty($data['discountEnabled'])) {
                    $discountType = $data['discountType'] ?? 'percentage';
                    $discountValue = (float)($data['discountValue'] ?? 0);
                    $discountAmount = 0;
                    
                    if ($discountType === 'percentage') {
                        $discountAmount = $totalAmount * ($discountValue / 100);
                        $discountText = rtrim(rtrim(number_format($discountValue, 2), '0'), '.') . '%';
                    } else {
                        $discountAmount = $discountValue;
                        $discountText = '₱' . number_format($discountValue, 2);
                    }
                    $grandTotal = max(0, $totalAmount - $discountAmount);
                ?>
                <div class="totals-row" style="color: #d32f2f;">
                    <span class="label">DISCOUNT (<?= $discountText ?>)</span>
                    <span class="value">-<?= number_format($discountAmount, 2) ?></span>
                </div>
                <?php } ?>
                <div class="totals-row" style="margin-bottom: 5px;">
                    <span class="label">GRAND TOTAL</span>
                    <span class="value"><?= number_format($grandTotal, 2) ?></span>
                </div>
                <div class="vat-inclusive"><?= (isset($data['vatType']) && $data['vatType'] === 'Exclusive') ? 'VAT EXCLUSIVE' : 'VAT INCLUSIVE' ?></div>
            </div>
        </div>

        <div class="thick-border-container">
            <div class="thick-border-box" style="width: 100%; max-width: 610px;">DELIVERY LEAD TIME:</div><br>
            <div class="thick-border-box" style="width: 100%; max-width: 250px;">PRICE VALIDITY: 30 DAYS</div>
        </div>

        <div class="paragraph">
            Should you need additional information and/or clarification, please feel free to get in touch with us at
            contact no. <span class="inline-line" style="text-align: center; font-weight: bold;"><?= htmlspecialchars($aeContact) ?></span> and we would be glad to discuss it with you at your most convenient time.<br>
            If you wish to avail the quoted item/s please fill up <strong>COMPLETELY</strong> the data below, then EMAIL back at
        </div>

        <div class="bottom-section">
            <div class="bottom-left">
                <div style="text-align: center; width: 80%;">
                    <div style="font-weight: bold; margin-bottom: 2px; height: 16px;"><?= htmlspecialchars($aeEmail) ?></div>
                    <div class="sign-line-full"></div>
                    <div class="sign-sub" style="padding-left:0;">Email Address</div>
                </div>
                
                <div style="margin-top: 8px;">Thank you.</div>

                <div class="sign-block">
                    Prepared by:
                    <div style="text-align:center; width:80%; font-weight:bold; height: 18px; margin-top: 25px;"><?= htmlspecialchars($aeName) ?></div>
                    <div class="sign-line-full"></div>
                    <div class="sign-title">AE/CSO/AO</div>
                    <div class="sign-sub" style="padding-left:0; text-align:center; width:80%;">Signature over Printed Name</div>
                </div>

                <div class="sign-block">
                    Noted by:
                    <div style="text-align:center; width:80%; font-weight:bold; height: 18px; margin-top: 25px;">Maria Valerie Gomez</div>
                    <div class="sign-line-full"></div>
                    <div class="sign-sub" style="padding-left:0; text-align:center; width:80%;">Signature over Printed Name</div>
                </div>
            </div>
            
            <div class="bottom-right">
                <div class="br-header">
                    <div class="br-header-title">Kindly fill out this portion completely:</div>
                    <div class="br-header-center">Print Name & Signature</div>
                </div>
                <div class="br-num-row">1).</div>
                <div class="br-num-row">2).</div>
                
                <div class="br-details">
                    <div class="br-details-header">Place of Delivery :</div>
                    <div class="br-row">
                        <div class="br-label">Contact Number :</div>
                        <div class="br-value"></div>
                    </div>
                    <div class="br-row">
                        <div class="br-label">Serial Number :</div>
                        <div class="br-value"></div>
                    </div>
                    <div class="br-row">
                        <div class="br-label">Present Meter Reading :</div>
                        <div class="br-value"></div>
                    </div>
                    <div class="br-row">
                        <div class="br-label">TIN number :</div>
                        <div class="br-value"></div>
                    </div>
                    <div class="br-row">
                        <div class="br-label">Terms of Payment :</div>
                        <div class="br-value"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-line">
            Form# UBX-OPS-23
        </div>

    </div>

</body>
</html>
