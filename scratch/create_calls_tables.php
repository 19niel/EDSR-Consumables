<?php
include('c:/xampp/htdocs/e-dsr-cons/php/db_conn.php');

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

if (mysqli_query($conn, $createCallsTable)) {
    echo "Table 'calls' created successfully.\n";
} else {
    echo "Error creating table 'calls': " . mysqli_error($conn) . "\n";
}

if (mysqli_query($conn, $createCallLogsTable)) {
    echo "Table 'call_logs' created successfully.\n";
} else {
    echo "Error creating table 'call_logs': " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
