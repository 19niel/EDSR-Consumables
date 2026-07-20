<?php
require_once('../vendor/autoload.php');
include('db_conn.php');

use setasign\Fpdi\Fpdi;

$encodedId = $_GET['id'] ?? null;
if (!$encodedId) {
    die("Missing account ID.");
}

// 1. Fetch the master encoded record first
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

// 2. Fetch the child product loop profiles
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

// Prepare PDF
$pdf = new Fpdi();
$pdf->AddPage();
// set the source file
$pdf->setSourceFile("../QUOTATION TEMPLATE (12).pdf");
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at point 0,0 with a width of 210 mm (A4 portrait)
$pdf->useTemplate($tplIdx, 0, 0, 210);

$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0, 0, 0);

// Helper function to write text safely
function writeText($pdf, $x, $y, $text, $font = 'Arial', $style = '', $size = 10) {
    $pdf->SetFont($font, $style, $size);
    $pdf->SetXY($x, $y);
    // Convert to windows-1252 to handle special characters properly in FPDF
    $pdf->Write(0, iconv('UTF-8', 'windows-1252//TRANSLIT', $text));
}

// Date
writeText($pdf, 48, 55, date('F j, Y'));

// Customer ID
writeText($pdf, 48, 63, $data['LID'] ?? '');

// Company Name
writeText($pdf, 48, 71, $data['accName'] ?? '');

// Address
writeText($pdf, 48, 79, $data['address'] ?? '');

// Attention: Contact Person
$contactStr = '';
if (!empty($data['contactPerson'])) {
    // If contactPerson is a comma-separated string or array (it's stored as string here)
    $contactPersons = explode(',', $data['contactPerson']);
    $contactStr = trim($contactPersons[0] ?? '');
}
writeText($pdf, 48, 93, $contactStr);

// Attention: Contact Number
$contactNumStr = '';
if (!empty($data['contactNumber'])) {
    $contactNumbers = explode(',', $data['contactNumber']);
    $contactNumStr = trim($contactNumbers[0] ?? '');
}
writeText($pdf, 48, 102, $contactNumStr);

// Checkboxes: KM or Riso
if (isset($data['sbu'])) {
    $sbu = strtolower($data['sbu']);
    if (strpos($sbu, 'riso') !== false) {
        // Riso box
        writeText($pdf, 150, 137, 'X', 'Arial', 'B', 14); // Adjust coordinate
    } else {
        // KM box
        writeText($pdf, 132, 137, 'X', 'Arial', 'B', 14); // Adjust coordinate
    }
}

// Table Data
$startY = 162; // Adjust Y coordinate for first row
$rowHeight = 7.8;
$totalAmount = 0;

if (isset($data['products']) && is_array($data['products'])) {
    foreach ($data['products'] as $i => $product) {
        if ($i > 5) break; // Max 6 rows in template
        
        $y = $startY + ($i * $rowHeight);
        
        // Model (Product Subcategory Name)
        $modelName = getSubcategoryName($conn, $product['productSubcategoryID'] ?? '');
        writeText($pdf, 15, $y, $modelName, 'Arial', '', 9);
        
        // Item Description/Code
        $itemDesc = $product['itemCode'] ?? $product['consumables'] ?? '';
        // If it's numeric and it's a subcategory ID, we can fetch name too, but let's assume it's string
        writeText($pdf, 55, $y, $itemDesc, 'Arial', '', 9);
        
        // Unit Price
        $price = floatval($product['productAmount'] ?? 0);
        if ($price > 0) {
            writeText($pdf, 110, $y, number_format($price, 2), 'Arial', '', 9);
        }
        
        // QTY
        $qty = intval($product['quantity'] ?? 0);
        if ($qty > 0) {
            writeText($pdf, 135, $y, (string)$qty, 'Arial', '', 9);
        }
        
        // UNIT
        if ($price > 0 && $qty > 0) {
            writeText($pdf, 150, $y, 'pc', 'Arial', '', 9);
        }
        
        // AMOUNT
        $amount = $price * $qty;
        if ($amount > 0) {
            writeText($pdf, 175, $y, number_format($amount, 2), 'Arial', '', 9);
            $totalAmount += $amount;
        }
    }
}

// Total
writeText($pdf, 175, 210, number_format($totalAmount, 2), 'Arial', '', 9);

// VAT Inclusive Checkbox (Check YES for now, or based on db if available)
writeText($pdf, 44, 216, 'X', 'Arial', 'B', 12);

// Grand Total 
writeText($pdf, 175, 222, number_format($totalAmount, 2), 'Arial', '', 9);

$pdf->Output('I', 'Quotation_' . ($data['LID'] ?? 'Unknown') . '.pdf');
?>
