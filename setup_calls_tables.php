<?php
// Run this file in your browser to automatically create the calls and call_logs tables
include('php/db_conn.php');

$createCallsTable = "CREATE TABLE IF NOT EXISTS calls (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    sbu VARCHAR(100) NOT NULL,
    natureOfCall VARCHAR(100) NOT NULL,
    accountExecutive VARCHAR(100) NOT NULL,
    dateOfActivity DATE NOT NULL,
    activityBranch VARCHAR(50) NOT NULL,
    
    customerId VARCHAR(50),
    accountName VARCHAR(255) NOT NULL,
    clientBranch VARCHAR(50) NOT NULL,
    region VARCHAR(50) NOT NULL,
    address TEXT NOT NULL,
    contactPerson VARCHAR(100) NOT NULL,
    designation VARCHAR(100) NOT NULL,
    contactDetails VARCHAR(100) NOT NULL,
    emailAddress VARCHAR(100) NOT NULL,
    
    dateOfProgress DATE NOT NULL,
    accountsStatus VARCHAR(50) NOT NULL,
    remarks TEXT NOT NULL,
    
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$createCallLogsTable = "CREATE TABLE IF NOT EXISTS call_logs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    callID INT(11) NOT NULL,
    dateOfProgress DATE NOT NULL,
    accountsStatus VARCHAR(50) NOT NULL,
    remarks TEXT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (callID) REFERENCES calls(id) ON DELETE CASCADE
)";

$message = "";

if (mysqli_query($conn, $createCallsTable)) {
    $message .= "Table 'calls' created or already exists.\\n";
} else {
    $message .= "Error creating table 'calls': " . mysqli_error($conn) . "\\n";
}

if (mysqli_query($conn, $createCallLogsTable)) {
    $message .= "Table 'call_logs' created or already exists.\\n";
} else {
    $message .= "Error creating table 'call_logs': " . mysqli_error($conn) . "\\n";
}

// Add User Columns
$checkUserCol1 = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'email_address'");
if ($checkUserCol1 && mysqli_num_rows($checkUserCol1) == 0) {
    if(mysqli_query($conn, "ALTER TABLE users ADD email_address VARCHAR(100) NULL")) {
        $message .= "Column 'email_address' added to users table.\\n";
    }
}

$checkUserCol2 = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'contact_no'");
if ($checkUserCol2 && mysqli_num_rows($checkUserCol2) == 0) {
    if(mysqli_query($conn, "ALTER TABLE users ADD contact_no VARCHAR(50) NULL")) {
        $message .= "Column 'contact_no' added to users table.\\n";
    }
}

// Add Discount Columns to Encoded
$checkEncodedCol = mysqli_query($conn, "SHOW COLUMNS FROM encoded LIKE 'discountEnabled'");
if ($checkEncodedCol && mysqli_num_rows($checkEncodedCol) == 0) {
    if(mysqli_query($conn, "ALTER TABLE encoded ADD discountEnabled TINYINT(1) DEFAULT 0, ADD discountType VARCHAR(10) DEFAULT NULL, ADD discountValue DECIMAL(10,2) DEFAULT NULL")) {
        $message .= "Discount columns added to encoded table.\\n";
    }
}

// Add Call_ID to calls table
$checkCallIdCol = mysqli_query($conn, "SHOW COLUMNS FROM calls LIKE 'Call_ID'");
if ($checkCallIdCol && mysqli_num_rows($checkCallIdCol) == 0) {
    if(mysqli_query($conn, "ALTER TABLE calls ADD Call_ID VARCHAR(50) NULL AFTER id")) {
        $message .= "Column 'Call_ID' added to calls table.\\n";
    }
}

mysqli_close($conn);

echo "<script>
    alert(" . json_encode($message) . ");
    window.location.href = 'index.php';
</script>";
?>
