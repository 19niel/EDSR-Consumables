<?php
require __DIR__ . '/../php/db_conn.php';
$res = $conn->query('SELECT ic.item_name FROM item_codes ic WHERE ic.consumable_id = 780');
while($r = $res->fetch_assoc()) echo $r['item_name'] . "\n";
