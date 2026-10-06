<?php
require_once __DIR__ . '/config.php';
$sname = "localhost";
$uname = "root";
$password = "";
// $password = "M1s@dm1n";

$db_name = "edsr-cons";

$conn = new mysqli($sname, $uname, $password, $db_name);

if (!$conn) {
    echo "Connection failed!";
}

// Auto-migration to ensure call_edit_access column exists
$checkColumnSql = "SHOW COLUMNS FROM users LIKE 'call_edit_access'";
$columnResult = $conn->query($checkColumnSql);
if ($columnResult && $columnResult->num_rows == 0) {
    $alterSql = "ALTER TABLE users ADD COLUMN call_edit_access TINYINT(1) DEFAULT 0";
    $conn->query($alterSql);
}

// Auto-migration to ensure RISO FII consumable options exist
require_once __DIR__ . '/auto_migrate_riso_options.php';

?>