<?php
error_reporting(0);
ini_set('display_errors', 0);

include('db_conn.php');
header('Content-Type: application/json');

$monthFilter = isset($_GET['month']) ? mysqli_real_escape_string($conn, $_GET['month']) : 'current';
$sbuFilter = isset($_GET['sbu']) ? mysqli_real_escape_string($conn, $_GET['sbu']) : 'all';

$whereClause = "WHERE is_deleted = 0";

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

$currentYear = date('Y');

if ($monthFilter === 'current') {
    $whereClause .= " AND MONTH(callDate) = MONTH(CURRENT_DATE()) AND YEAR(callDate) = '$currentYear'";
} elseif (in_array($monthFilter, ['Q1', 'Q2', 'Q3', 'Q4'])) {
    if ($monthFilter === 'Q1') $whereClause .= " AND MONTH(callDate) IN (1, 2, 3)";
    if ($monthFilter === 'Q2') $whereClause .= " AND MONTH(callDate) IN (4, 5, 6)";
    if ($monthFilter === 'Q3') $whereClause .= " AND MONTH(callDate) IN (7, 8, 9)";
    if ($monthFilter === 'Q4') $whereClause .= " AND MONTH(callDate) IN (10, 11, 12)";
    $whereClause .= " AND YEAR(callDate) = '$currentYear'";
} elseif ($monthFilter === 'custom') {
    $dateFrom = isset($_GET['dateFrom']) ? mysqli_real_escape_string($conn, trim($_GET['dateFrom'])) : '';
    $dateTo = isset($_GET['dateTo']) ? mysqli_real_escape_string($conn, trim($_GET['dateTo'])) : '';
    
    if (!empty($dateFrom) && !empty($dateTo)) {
        $whereClause .= " AND callDate BETWEEN '$dateFrom' AND '$dateTo'";
    } elseif (!empty($dateFrom)) {
        $whereClause .= " AND callDate >= '$dateFrom'";
    } elseif (!empty($dateTo)) {
        $whereClause .= " AND callDate <= '$dateTo'";
    }
} elseif ($monthFilter !== 'all' && preg_match('/^\d{2}$/', $monthFilter)) {
    $monthVal = intval($monthFilter);
    $whereClause .= " AND MONTH(callDate) = $monthVal AND YEAR(callDate) = '$currentYear'";
}

// SQL Query targeting accStatus and dynamic aggregate totals from encoded
$query = "SELECT accStatus, 
                 COUNT(*) as total_accounts, 
                 SUM(COALESCE(proposedPrice, 0)) as total_volume 
          FROM encoded 
          $whereClause 
          GROUP BY accStatus";

$result = mysqli_query($conn, $query);

// 🎯 FIXED KEY MAPPING ARRAY SCHEMAS HERE
$pipelineData = [
    '345' => ['status' => 'In The Works',   'accounts' => 0, 'volume' => 0.00],
    '346' => ['status' => 'For Delivery', 'accounts' => 0, 'volume' => 0.00],
    '230' => ['status' => 'Delivered',     'accounts' => 0, 'volume' => 0.00],
    '348' => ['status' => 'Lost',        'accounts' => 0, 'volume' => 0.00],
    '349' => ['status' => 'Dropped',     'accounts' => 0, 'volume' => 0.00]
];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $statusId = trim($row['accStatus']);
        
        if (array_key_exists($statusId, $pipelineData)) {
            $pipelineData[$statusId]['accounts'] = intval($row['total_accounts']);
            $pipelineData[$statusId]['volume'] = floatval($row['total_volume']);
        }
    }
    
    echo json_encode([
        'success' => true,
        'data' => $pipelineData
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error_message' => mysqli_error($conn),
        'data' => $pipelineData
    ]);
}

mysqli_close($conn);
?>