<?php
error_reporting(0);
ini_set('display_errors', 0);

include('db_conn.php');
header('Content-Type: application/json');

$monthFilter = isset($_GET['month']) ? mysqli_real_escape_string($conn, $_GET['month']) : 'current';
$sbuFilter = isset($_GET['sbu']) ? mysqli_real_escape_string($conn, $_GET['sbu']) : 'all';

// Filter explicitly for Closed-Won Opportunities (accStatus = '230')
$whereClause = "WHERE is_deleted = 0 AND accStatus = '230'";

$sbuConditions = [];
$sbuArray = explode(',', $sbuFilter);

if (!in_array('all', $sbuArray) && !empty($sbuFilter)) {
    foreach ($sbuArray as $sbu) {
        $sbu = trim($sbu);
        if ($sbu === 'km_machine') {
            $sbuConditions[] = "(sbu LIKE '%OP MFP%' OR sbu LIKE '%OP - PP%')";
        } elseif ($sbu === 'riso_machine') {
            $sbuConditions[] = "(sbu = 'OP - Riso' OR sbu = 'OP Riso')";
        } elseif ($sbu === 'km_consumables') {
            $sbuConditions[] = "(sbu = 'OP - Consumables' AND EXISTS (SELECT 1 FROM product_details pd WHERE pd.encodedID = encoded.id AND pd.productTypeID IN (393, 395)))";
        } elseif ($sbu === 'riso_consumables') {
            $sbuConditions[] = "(sbu = 'OP - Consumables' AND EXISTS (SELECT 1 FROM product_details pd WHERE pd.encodedID = encoded.id AND pd.productTypeID = 396))";
        }
    }
}

if (!empty($sbuConditions)) {
    $whereClause .= " AND (" . implode(" OR ", $sbuConditions) . ")";
}

if ($monthFilter === 'current') {
    $currentMonth = date('m');
    $currentYear = date('Y');
    $whereClause .= " AND MONTH(callDate) = '$currentMonth' AND YEAR(callDate) = '$currentYear'";
} elseif ($monthFilter !== 'all' && preg_match('/^\d{2}$/', $monthFilter)) {
    $currentYear = date('Y');
    $whereClause .= " AND MONTH(callDate) = '$monthFilter' AND YEAR(callDate) = '$currentYear'";
}

// 🎯 Added clear formatting parsing rules for progressDate to keep it thin
$query = "SELECT 
            id,
            COALESCE(NULLIF(TRIM(accExec), ''), 'Unassigned') as exec_name,
            COALESCE(NULLIF(TRIM(accName), ''), 'Unknown') as client_name,
            COALESCE(DATE_FORMAT(progressDate, '%m/%d/%Y'), 'N/A') as formatted_date,
            COALESCE(proposedPrice, 0) as amount
          FROM encoded 
          $whereClause 
          ORDER BY id DESC";

$result = mysqli_query($conn, $query);
$projectsList = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $projectsList[] = [
            'id' => $row['id'], // 🎯 Captured record id
            'accExec' => $row['exec_name'],
            'accName' => ucwords(strtolower($row['client_name'])),
            'progressDate' => $row['formatted_date'],
            'proposedPrice' => floatval($row['amount'])
        ];
    }
    
    echo json_encode([
        'success' => true, 
        'data' => $projectsList
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'error_message' => mysqli_error($conn), 
        'data' => []
    ]);
}

mysqli_close($conn);
?>