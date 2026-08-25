<?php
include('db_conn.php');
include('autoRedirect.php');

// Initialize variables to avoid undefined index warnings
$accountExecutive = '';
$accountName = '';
$callDate = '';
$globalSearch = '';

// Safe fallback for session parameters if not explicitly instantiated
$category = $_SESSION['category'] ?? $category ?? 'User';
$name = $_SESSION['name'] ?? $name ?? '';
$dept = $_SESSION['dept'] ?? $dept ?? ''; // Prevents manager lookup from breaking

// Capture explicit filters from GET requests
if (isset($_GET['accountExecutiveSearch'])) {
    $accountExecutive = $_GET['accountExecutiveSearch'];
}

if (isset($_GET['accountName'])) {
    $accountName = $_GET['accountName'];
}

if (isset($_GET['callDate'])) {
    $callDate = $_GET['callDate'];
}

// Check if user actively requested date ranges via Advanced Filters modal
$callDateStart = isset($_GET['callDateStart']) ? $_GET['callDateStart'] : '';
$callDateEnd = isset($_GET['callDateEnd']) ? $_GET['callDateEnd'] : '';

// Capture the global search parameter from the big search input box
if (isset($_GET['globalSearch'])) {
    $globalSearch = trim($_GET['globalSearch']);
}

// Construct the WHERE clause based on the form input
$whereConditions = [];

// Role-based restrictions mapping to table aliases 'c.'
if ($category == 'Manager') {
    if ($name == 'Ron Cabrera') {
        $whereConditions[] = "c.activityBranch IN ('MM', 'ANG', 'CAB', 'LAU', 'BAT', 'NAG', 'SUB', 'BAC', 'CEB', 'DUM', 'ILO', 'TAC', 'CDO', 'DAV', 'GEN', 'ZAM')"; // Assuming managers can see branches
    }
    if (!empty($accountExecutive)) {
        $whereConditions[] = "c.accountExecutive LIKE '%" . mysqli_real_escape_string($conn, $accountExecutive) . "%'";
    }
}

if ($category == 'Admin' || $category == 'VP') {
    if (!empty($accountExecutive)) {
        $whereConditions[] = "c.accountExecutive LIKE '%" . mysqli_real_escape_string($conn, $accountExecutive) . "%'";
    }
}

// 🔒 PERSONAL ISOLATION LAYER: Regular users are strictly locked to their own encoded records
if ($category == 'User') {
    $escapedName = mysqli_real_escape_string($conn, $name);
    $whereConditions[] = "c.accountExecutive = '$escapedName'";
}

// Structural Modal Filters
if (!empty($accountName)) {
    $whereConditions[] = "c.accountName LIKE '%" . mysqli_real_escape_string($conn, $accountName) . "%'";
}

if (!empty($callDate)) {
    $whereConditions[] = "c.dateOfActivity = '" . mysqli_real_escape_string($conn, $callDate) . "'";
}

// Date Range Filter
if (!empty($callDateStart) && !empty($callDateEnd)) {
    $whereConditions[] = "c.dateOfActivity BETWEEN '" . mysqli_real_escape_string($conn, $callDateStart) . "' AND '" . mysqli_real_escape_string($conn, $callDateEnd) . "'";
}

// Global Search tracking
if (!empty($globalSearch)) {
    $escapedSearch = mysqli_real_escape_string($conn, $globalSearch);
    $whereConditions[] = "(c.Call_ID LIKE '%$escapedSearch%' 
                          OR c.customerId LIKE '%$escapedSearch%' 
                          OR c.accountName LIKE '%$escapedSearch%' 
                          OR c.contactPerson LIKE '%$escapedSearch%'
                          OR c.accountExecutive LIKE '%$escapedSearch%')";
}

// Combine conditions with AND
$condition = implode(" AND ", $whereConditions);

// Pagination Setup
$records_per_page = 20;
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($current_page < 1) { $current_page = 1; }
$start_record = ($current_page - 1) * $records_per_page;

// Count total records matching final built criteria
$sql_count = "SELECT COUNT(*) as total FROM calls c";
if (!empty($condition)) {
    $sql_count .= " WHERE $condition";
}
$result_count = mysqli_query($conn, $sql_count);
$total_records = mysqli_fetch_assoc($result_count)['total'] ?? 0;

// Main execution query
$sql = "SELECT c.* FROM calls c";
if (!empty($condition)) {
    $sql .= " WHERE $condition";
}
$sql .= " ORDER BY c.id DESC LIMIT $start_record, $records_per_page";

// Execute the paginated query for array access looping in UI
$accountResult = mysqli_query($conn, $sql);

// Calculate total pages safely
$total_pages = $total_records > 0 ? ceil($total_records / $records_per_page) : 1;
?>
