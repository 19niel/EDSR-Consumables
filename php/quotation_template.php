<?php
// Ensure this is included from generateQuotation.php
if (!isset($data) || !isset($conn)) {
    die('Direct access not permitted');
}

// Convert logo to base64 so DomPDF can easily embed it
$logoPath = __DIR__ . '/../img/new.png';
$logoSrc = '';
if (file_exists($logoPath)) {
    $logoData = base64_encode(file_get_contents($logoPath));
    $logoSrc = 'data:image/png;base64,' . $logoData;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style type="text/css">
        body { 
            font-family: Arial, Helvetica, sans-serif; 
            font-size: 10pt; 
            color: #333;
        }
        table { width: 100%; border-collapse: collapse; }
        .header-table td { vertical-align: top; }
        
        .title { 
            font-size: 16pt; 
            font-weight: bold; 
            text-align: right; 
            color: #000;
            margin-bottom: 5px;
        }
        
        .logo { 
            max-width: 2500px; 
            float: right; 
        }
        
        .company-info h2 {
            margin-top: 0;
            font-size: 14pt;
        }
        .company-info p {
            margin: 0;
            line-height: 1.4;
        }
        
        hr { 
            border: 0; 
            border-top: 2px solid #333; 
            margin: 20px 0; 
        }
        
        .info-table { margin-bottom: 20px; }
        .info-table td { padding: 4px; vertical-align: top; }
        .info-label { font-weight: bold; width: 120px; color: #555; }
        
        .items-table { margin-top: 20px; }
        .items-table th { 
            background-color: #f2f2f2; 
            border: 1px solid #999; 
            padding: 8px; 
            text-align: left; 
            font-weight: bold;
        }
        .items-table td { 
            border: 1px solid #ccc; 
            padding: 8px; 
        }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        
        .totals-section td {
            padding-top: 10px;
            font-size: 11pt;
            border: none;
        }
        
        .reminders {
            margin-top: 40px;
            font-size: 8pt;
            color: #666;
            line-height: 1.5;
        }
        .reminders strong { color: #333; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td width="50%" class="company-info">
                <h2>UBIX CORPORATION</h2>
                <p>1344 Angono St.<br>
                Makati City<br>
                Tel.# 897-6819 • Telefax 23120 UBX PH<br>
                Fax: 897-6805</p>
            </td>
            <td width="50%" style="text-align: right;">
                <?php if ($logoSrc): ?>
                <img src="<?php echo $logoSrc; ?>" class="logo">
                <?php endif; ?>
                <div style="clear:both; padding-top: 15px;">
                    <div class="title">QUOTATION</div>
                    <p style="margin: 0;">Date: <?php echo date('F j, Y'); ?></p>
                </div>
            </td>
        </tr>
    </table>
    
    <hr>
    
    <table class="info-table">
        <tr>
            <td class="info-label">Customer ID:</td>
            <td width="30%"><?php echo htmlspecialchars($data['LID'] ?? ''); ?></td>
            <td class="info-label">SBU (KM/Riso):</td>
            <td><?php echo htmlspecialchars($data['sbu'] ?? ''); ?></td>
        </tr>
        <tr>
            <td class="info-label">Company Name:</td>
            <td colspan="3"><?php echo htmlspecialchars($data['accName'] ?? ''); ?></td>
        </tr>
        <tr>
            <td class="info-label">Address:</td>
            <td colspan="3"><?php echo htmlspecialchars($data['address'] ?? ''); ?></td>
        </tr>
        <?php
        $cpDisplay = trim($data['contactPerson'] ?? '');
        if (!empty(trim($data['contactPerson1'] ?? ''))) {
            $cpDisplay .= ' / ' . trim($data['contactPerson1']);
        }
        
        $cnDisplay = trim($data['contactNumber'] ?? '');
        if (!empty(trim($data['contactNumber1'] ?? ''))) {
            $cnDisplay .= ' / ' . trim($data['contactNumber1']);
        }
        ?>
        <tr>
            <td class="info-label">Contact Person:</td>
            <td><?php echo htmlspecialchars($cpDisplay); ?></td>
            <td class="info-label">Contact No:</td>
            <td><?php echo htmlspecialchars($cnDisplay); ?></td>
        </tr>
    </table>
    
    <table class="items-table">
        <thead>
            <tr>
                <th>Model</th>
                <th>Item Description / Code</th>
                <th class="text-right">Unit Price</th>
                <th class="text-center">QTY</th>
                <th class="text-center">Unit</th>
                <th class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalAmount = 0;
            if (!empty($data['products']) && is_array($data['products'])): 
                foreach ($data['products'] as $product):
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
                    
                    $desc = trim($itemCodeName . ' ' . $consName);
                    if (empty($desc)) {
                        $desc = $product['itemCode'] ?? $product['consumables'] ?? '';
                    }
                    $price = floatval($product['productAmount'] ?? 0);
                    $qty = intval($product['quantity'] ?? 0);
                    $amount = $price * $qty;
                    $totalAmount += $amount;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($modelName); ?></td>
                <td><?php echo htmlspecialchars($desc); ?></td>
                <td class="text-right"><?php echo $price > 0 ? number_format($price, 2) : ''; ?></td>
                <td class="text-center"><?php echo $qty > 0 ? $qty : ''; ?></td>
                <td class="text-center"><?php echo ($price > 0 && $qty > 0) ? 'pc' : ''; ?></td>
                <td class="text-right"><?php echo $amount > 0 ? number_format($amount, 2) : ''; ?></td>
            </tr>
            <?php 
                endforeach;
            else:
            ?>
            <tr>
                <td colspan="6" class="text-center">No items found</td>
            </tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr class="totals-section">
                <td colspan="5" class="text-right" style="font-weight: bold; padding-top: 15px;">Total:</td>
                <td class="text-right" style="font-weight: bold; padding-top: 15px;"><?php echo number_format($totalAmount, 2); ?></td>
            </tr>
            <tr class="totals-section">
                <td colspan="5" class="text-right" style="font-weight: bold;">Grand Total (VAT Inclusive):</td>
                <td class="text-right" style="font-weight: bold;"><?php echo number_format($totalAmount, 2); ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="reminders">
        <strong>REMINDERS:</strong><br>
        * PLEASE PAY IN CHECK, WE DO NOT ACCEPT CASH.<br>
        * PLEASE MAKE CHECK PAYABLE TO U-BIX CORPORATION.<br>
        * CHECK PAYMENT MUST BE RELEASED TOGETHER WITH EWT CERTIFICATE.<br>
        * PAYMENT W/O EWT CERTIFICATE IS CONSIDERED INCOMPLETE & NOT FULLY SETTLED.<br>
        * OVERDUE BILLINGS/INVOICES IS SUBJECT TO 12% PENALTY CHARGES PER ANNUM.<br>
        * IF NO DISCREPANCY IS REPORTED WITHIN SEVEN DAYS FROM RECEIPT OF INVOICE, THE BILLED AMOUNT WILL BE CONSIDERED CORRECT.
    </div>
</body>
</html>
