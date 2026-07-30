<?php 
include('c:/xampp/htdocs/e-dsr-cons/php/db_conn.php'); 
$sql = "SELECT id, category_name FROM categories WHERE id IN (339, 342)";
$res = mysqli_query($conn, $sql); 
while($row = mysqli_fetch_assoc($res)) {
    echo "ID: " . $row['id'] . "\n";
    echo "Name: " . $row['category_name'] . "\n";
    echo "Hex: " . bin2hex($row['category_name']) . "\n";
}
?>
