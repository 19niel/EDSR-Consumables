<?php
include('php/db_conn.php');
$res = mysqli_query($conn, 'SELECT * FROM categories');
while($row = mysqli_fetch_assoc($res)) {
    echo $row['id'] . ' - ' . $row['category_name'] . ' (Type: ' . $row['category_type'] . ')' . PHP_EOL;
}
?>
