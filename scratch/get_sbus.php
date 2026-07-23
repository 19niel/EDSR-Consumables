<?php
include('c:\xampp\htdocs\e-dsr-cons\php\db_conn.php');
$res = mysqli_query($conn, 'SELECT DISTINCT sbu FROM encoded');
while($row = mysqli_fetch_assoc($res)) {
    echo "[" . $row['sbu'] . "]\n";
}
?>
