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

?>