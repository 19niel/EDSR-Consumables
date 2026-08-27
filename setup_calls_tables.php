<?php
// Run this file in your browser to automatically create or update the calls and call_logs tables
include('php/db_conn.php');

$message = "";

// 1. Define Expected Schemas
$expectedCallsColumns = [
    'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
    'Call_ID' => 'VARCHAR(50) NULL AFTER id',
    'sbu' => 'VARCHAR(100) NOT NULL',
    'natureOfCall' => 'VARCHAR(100) NOT NULL',
    'accountExecutive' => 'VARCHAR(100) NOT NULL',
    'dateOfActivity' => 'DATE NOT NULL',
    'activityBranch' => 'VARCHAR(50) NOT NULL',
    'customerId' => 'VARCHAR(50)',
    'accountName' => 'VARCHAR(255) NOT NULL',
    'clientBranch' => 'VARCHAR(50) NOT NULL',
    'region' => 'VARCHAR(50) NOT NULL',
    'address' => 'TEXT NOT NULL',
    'contactPerson' => 'VARCHAR(100) NOT NULL',
    'designation' => 'VARCHAR(100) NOT NULL',
    'contactDetails' => 'VARCHAR(100) NOT NULL',
    'emailAddress' => 'VARCHAR(100) NOT NULL',
    'dateOfProgress' => 'DATE NOT NULL',
    'accountsStatus' => 'VARCHAR(50) NOT NULL',
    'remarks' => 'TEXT NOT NULL',
    'createdAt' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
];

$expectedCallLogsColumns = [
    'id' => 'INT(11) AUTO_INCREMENT PRIMARY KEY',
    'callID' => 'INT(11) NOT NULL',
    'dateOfProgress' => 'DATE NOT NULL',
    'accountsStatus' => 'VARCHAR(50) NOT NULL',
    'remarks' => 'TEXT NOT NULL',
    'createdAt' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
];

// Helper Function to Create Table or Add Missing Columns
function verifyAndSetupTable($conn, $tableName, $expectedColumns, &$message, $foreignKeyDef = null) {
    // Check if table exists
    $tableExists = mysqli_query($conn, "SHOW TABLES LIKE '$tableName'");
    
    if (mysqli_num_rows($tableExists) == 0) {
        // Build CREATE TABLE query
        $columnsSql = [];
        foreach ($expectedColumns as $col => $def) {
            // Strip AFTER clauses for CREATE TABLE
            $cleanDef = preg_replace('/ AFTER \w+/i', '', $def);
            $columnsSql[] = "$col $cleanDef";
        }
        if ($foreignKeyDef) {
            $columnsSql[] = $foreignKeyDef;
        }
        $createQuery = "CREATE TABLE $tableName (" . implode(", ", $columnsSql) . ")";
        if (mysqli_query($conn, $createQuery)) {
            $message .= "Table '$tableName' was created successfully.\n";
        } else {
            $message .= "Error creating table '$tableName': " . mysqli_error($conn) . "\n";
        }
    } else {
        $message .= "Table '$tableName' exists. Checking for missing columns...\n";
        // Check columns
        $existingColsResult = mysqli_query($conn, "SHOW COLUMNS FROM $tableName");
        $existingCols = [];
        while ($row = mysqli_fetch_assoc($existingColsResult)) {
            $existingCols[] = strtolower($row['Field']);
        }
        
        $missingCount = 0;
        foreach ($expectedColumns as $col => $def) {
            if (!in_array(strtolower($col), $existingCols)) {
                $alterQuery = "ALTER TABLE $tableName ADD $col $def";
                if (mysqli_query($conn, $alterQuery)) {
                    $message .= "- Added missing column: $col\n";
                    $missingCount++;
                } else {
                    $message .= "- Failed to add column $col: " . mysqli_error($conn) . "\n";
                }
            }
        }
        if ($missingCount == 0) {
            $message .= "- All columns in '$tableName' are complete and up-to-date.\n";
        }
    }
}

// 2. Setup calls table
verifyAndSetupTable($conn, 'calls', $expectedCallsColumns, $message);

// 3. Setup call_logs table
verifyAndSetupTable($conn, 'call_logs', $expectedCallLogsColumns, $message, "FOREIGN KEY (callID) REFERENCES calls(id) ON DELETE CASCADE");


// 4. Add User Columns
$checkUserCol1 = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'email_address'");
if ($checkUserCol1 && mysqli_num_rows($checkUserCol1) == 0) {
    if(mysqli_query($conn, "ALTER TABLE users ADD email_address VARCHAR(100) NULL")) {
        $message .= "Column 'email_address' added to users table.\n";
    }
}

$checkUserCol2 = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'contact_no'");
if ($checkUserCol2 && mysqli_num_rows($checkUserCol2) == 0) {
    if(mysqli_query($conn, "ALTER TABLE users ADD contact_no VARCHAR(50) NULL")) {
        $message .= "Column 'contact_no' added to users table.\n";
    }
}

// 5. Add Discount Columns to Encoded
$checkEncodedCol = mysqli_query($conn, "SHOW COLUMNS FROM encoded LIKE 'discountEnabled'");
if ($checkEncodedCol && mysqli_num_rows($checkEncodedCol) == 0) {
    if(mysqli_query($conn, "ALTER TABLE encoded ADD discountEnabled TINYINT(1) DEFAULT 0, ADD discountType VARCHAR(10) DEFAULT NULL, ADD discountValue DECIMAL(10,2) DEFAULT NULL")) {
        $message .= "Discount columns added to encoded table.\n";
    }
}

mysqli_close($conn);

// Output result (as alert and redirect, or plain text if run via CLI)
if (php_sapi_name() === 'cli') {
    echo $message;
} else {
    echo "<script>
        alert(" . json_encode($message) . ");
        window.location.href = 'index.php';
    </script>";
}
?>
