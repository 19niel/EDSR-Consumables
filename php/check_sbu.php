<?php
include('db_conn.php');
$res = mysqli_query($conn, "SELECT * FROM categories WHERE field='SBU/Segment'");
echo "Categories for SBU/Segment:\n";
while($row = mysqli_fetch_assoc($res)) print_r($row);

$res = mysqli_query($conn, "SELECT * FROM categories WHERE field='SBU'");
echo "Categories for SBU:\n";
while($row = mysqli_fetch_assoc($res)) print_r($row);

echo "\nSBU values in encoded:\n";
$res2 = mysqli_query($conn, "SELECT id, sbu FROM encoded ORDER BY id DESC LIMIT 5");
while($row = mysqli_fetch_assoc($res2)) print_r($row);
?>
