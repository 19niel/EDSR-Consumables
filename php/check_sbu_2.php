<?php
include('c:\\xampp\\htdocs\\e-dsr-cons\\php\\db_conn.php');
$res = mysqli_query($conn, 'SELECT sbu, count(*) as c FROM encoded GROUP BY sbu');
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        echo $r['sbu'] . " => " . $r['c'] . "\n";
    }
} else {
    echo mysqli_error($conn);
}
?>
