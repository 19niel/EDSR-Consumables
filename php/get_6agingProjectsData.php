<?php
error_reporting(0);
ini_set('display_errors', 0);

include('db_conn.php');
header('Content-Type: application/json');

// 🎯 Step 1: Query the custom aging threshold distance from dashboard_settings
$thresholdDays = 60; // System baseline fallback limit if not found in DB
$settingsQuery = "SELECT setting_value FROM dashboard_settings WHERE setting_key = 'aging_days_threshold' LIMIT 1";
$settingsResult = mysqli_query($conn, $settingsQuery);

if ($settingsResult && mysqli_num_rows($settingsResult) > 0) {
    $settingsRow = mysqli_fetch_assoc($settingsResult);
    $thresholdDays = intval($settingsRow['setting_value']);
}

$sbuFilter = isset($_GET['sbu']) ? mysqli_real_escape_string($conn, $_GET['sbu']) : 'all';

$sbuCondition = "";
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
    $sbuCondition = " AND (" . implode(" OR ", $sbuConditions) . ")";
}

// 🎯 Step 2: Use the dynamic $thresholdDays variable in the DATEDIFF filter
// Fully independent of month variables to show critical unattended items from oldest to newest
$query = "SELECT 
            id,
             lid,
            COALESCE(NULLIF(TRIM(accName), ''), 'Unknown Client') as client_name,
            COALESCE(DATE_FORMAT(progressDate, '%m/%d/%Y'), 'N/A') as formatted_date
          FROM encoded 
          WHERE is_deleted = 0 
            AND progressDate IS NOT NULL 
            AND accStatus IN (345, 346)
            $sbuCondition
            AND DATEDIFF(NOW(), progressDate) >= $thresholdDays
          ORDER BY progressDate ASC"; // Oldest unattended items prioritized at the top of the table

$result = mysqli_query($conn, $query);
$agingList = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $agingList[] = [
            'id' => $row['id'],
            'LID' => $row['lid'],
            'accName' => ucwords(strtolower($row['client_name'])),
            'progressDate' => $row['formatted_date']
        ];
    }
    
    echo json_encode([
        'success' => true, 
        'data' => $agingList,
        'threshold' => $thresholdDays
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