<?php
require __DIR__ . '/../php/db_conn.php';

$res = $conn->query("
    SELECT sc.subcategory_name as model, cons.consumable_name, COUNT(*) as count, SUM(pd.quantity) as total_qty, SUM(pd.quantity * pd.productAmount) as total_sales
    FROM encoded e
    JOIN product_details pd ON pd.encodedID = e.id AND pd.is_deleted = 0
    JOIN categories c ON pd.productTypeID = c.id
    LEFT JOIN subcategories sc ON pd.productSubcategoryID = sc.id
    LEFT JOIN consumables cons ON pd.deviceConditionID = cons.id
    WHERE (e.sbu = 'KM Kitbuyer' OR e.sbu = '342')
      AND (c.category_name = 'KM Color' OR pd.productTypeID = 393)
    GROUP BY sc.subcategory_name, cons.consumable_name
    ORDER BY count DESC
");

echo "Encoded breakdown under KM Kitbuyer & KM Color:\n";
while($r = $res->fetch_assoc()) {
    echo sprintf("%-15s | %-25s | Lines: %3d | Total Qty: %4d | Total Sales: ₱%s\n",
        $r['model'] ?? 'N/A',
        $r['consumable_name'] ?? 'N/A',
        $r['count'],
        $r['total_qty'],
        number_format($r['total_sales'], 2)
    );
}
