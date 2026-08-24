<?php
include('php/db_conn.php');
mysqli_query($conn, "ALTER TABLE encoded ADD discountEnabled TINYINT(1) DEFAULT 0, ADD discountType VARCHAR(10) DEFAULT NULL, ADD discountValue DECIMAL(10,2) DEFAULT NULL");
echo 'Success';
?>
