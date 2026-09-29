<?php
include('c:\\xampp\\htdocs\\e-dsr-cons\\php\\db_conn.php');

echo "Categories with field='Product Type':\n";
$res = mysqli_query($conn, 'SELECT id, category_name FROM categories WHERE field="Product Type" OR field LIKE "%Product%"');
while ($r = mysqli_fetch_assoc($res)) {
    echo $r['id'] . " => " . $r['category_name'] . "\n";
}

echo "\nSubcategories:\n";
$res2 = mysqli_query($conn, 'SELECT id, subcategory_name FROM subcategories WHERE category_id IN (SELECT id FROM categories WHERE field="Product Type" OR field LIKE "%Product%")');
while ($r = mysqli_fetch_assoc($res2)) {
    echo $r['id'] . " => " . $r['subcategory_name'] . "\n";
}

echo "\nSBU distinct values from encoded:\n";
$res3 = mysqli_query($conn, 'SELECT sbu, count(*) as count FROM encoded GROUP BY sbu');
while ($r = mysqli_fetch_assoc($res3)) {
    echo $r['sbu'] . " (" . $r['count'] . ")\n";
}

echo "\nProduct Types from product_details joined with encoded (count):\n";
$res4 = mysqli_query($conn, '
    SELECT c.category_name, pd.productTypeID, COUNT(*) as count 
    FROM product_details pd 
    JOIN categories c ON pd.productTypeID = c.id 
    GROUP BY pd.productTypeID
');
while ($r = mysqli_fetch_assoc($res4)) {
    echo $r['category_name'] . " (ID: " . $r['productTypeID'] . ") => " . $r['count'] . "\n";
}
?>
