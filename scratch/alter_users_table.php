<?php
include('c:/xampp/htdocs/e-dsr-cons/php/db_conn.php');

$alterQuery = "ALTER TABLE users 
    ADD COLUMN email_address VARCHAR(255) NULL AFTER handled,
    ADD COLUMN contact_no VARCHAR(50) NULL AFTER email_address";

if (mysqli_query($conn, $alterQuery)) {
    echo "Columns 'email_address' and 'contact_no' added successfully to the 'users' table.\n";
} else {
    echo "Error altering table: " . mysqli_error($conn) . "\n";
}

mysqli_close($conn);
?>
