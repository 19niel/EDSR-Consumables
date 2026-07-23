<?php
require_once('../vendor/autoload.php');
include('db_conn.php');
require_once('helpers/product_helpers.php');


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

// Prepare DomPDF
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Buffer the HTML template
ob_start();
include('quotation_template.php');
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

$dompdf->stream('Quotation_' . ($data['LID'] ?? 'Unknown') . '.pdf', array("Attachment" => false));
?>
