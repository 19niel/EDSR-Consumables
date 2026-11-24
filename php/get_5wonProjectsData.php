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
            $sbuConditions[] = "(EXISTS (SELECT 1 FROM product_details pd WHERE pd.encodedID = encoded.id AND pd.productTypeID = 350) OR encoded.sbu IN ('OP - MFP', 'OP - PP', '339', '340'))";
        } elseif ($sbu === 'riso_machine') {
            $sbuConditions[] = "(EXISTS (SELECT 1 FROM product_details pd WHERE pd.encodedID = encoded.id AND pd.productTypeID = 351) OR encoded.sbu IN ('OP - Riso', '341'))";
        } elseif ($sbu === 'km_consumables') {
            $sbuConditions[] = "(EXISTS (SELECT 1 FROM product_details pd WHERE pd.encodedID = encoded.id AND pd.productTypeID IN (393, 395)) OR encoded.sbu IN ('KM Kitbuyer', '342'))";
        } elseif ($sbu === 'riso_consumables') {
            $sbuConditions[] = "(EXISTS (SELECT 1 FROM product_details pd WHERE pd.encodedID = encoded.id AND pd.productTypeID = 396) OR encoded.sbu IN ('RISO Kitbuyer', '343'))";
        }
    }
}

if (!empty($sbuConditions)) {
    $whereClause .= " AND (" . implode(" OR ", $sbuConditions) . ")";
}

$currentYear = date('Y');

if ($monthFilter === 'current') {
    $whereClause .= " AND MONTH(progressDate) = MONTH(CURRENT_DATE()) AND YEAR(progressDate) = '$currentYear'";
} elseif (in_array($monthFilter, ['Q1', 'Q2', 'Q3', 'Q4'])) {
    if ($monthFilter === 'Q1') $whereClause .= " AND MONTH(progressDate) IN (1, 2, 3)";
    if ($monthFilter === 'Q2') $whereClause .= " AND MONTH(progressDate) IN (4, 5, 6)";
    if ($monthFilter === 'Q3') $whereClause .= " AND MONTH(progressDate) IN (7, 8, 9)";
    if ($monthFilter === 'Q4') $whereClause .= " AND MONTH(progressDate) IN (10, 11, 12)";
    $whereClause .= " AND YEAR(progressDate) = '$currentYear'";
} elseif ($monthFilter === 'custom') {
    $dateFrom = isset($_GET['dateFrom']) ? mysqli_real_escape_string($conn, trim($_GET['dateFrom'])) : '';
    $dateTo = isset($_GET['dateTo']) ? mysqli_real_escape_string($conn, trim($_GET['dateTo'])) : '';

    if (!empty($dateFrom) && !empty($dateTo)) {
        $whereClause .= " AND progressDate BETWEEN '$dateFrom' AND '$dateTo'";
    } elseif (!empty($dateFrom)) {
        $whereClause .= " AND progressDate >= '$dateFrom'";
    } elseif (!empty($dateTo)) {
        $whereClause .= " AND progressDate <= '$dateTo'";
    }
} elseif ($monthFilter !== 'all' && preg_match('/^\d{2}$/', $monthFilter)) {
    $monthVal = intval($monthFilter);
    $whereClause .= " AND MONTH(progressDate) = $monthVal AND YEAR(progressDate) = '$currentYear'";
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