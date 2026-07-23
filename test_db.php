<?php
include('php/db_conn.php');
$res = $conn->query("SELECT id, category_name FROM categories WHERE field = 'Product Type'");
while($row=$res->fetch_assoc()) print_r($row);
?>
