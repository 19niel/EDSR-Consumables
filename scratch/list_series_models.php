<?php
require __DIR__ . '/../php/db_conn.php';

$res = $conn->query("
    SELECT sc.id, sc.category_id, c.category_name, sc.subcategory_name
    FROM subcategories sc
    JOIN categories c ON sc.category_id = c.id
    WHERE (sc.subcategory_name LIKE 'SF%' 
        OR sc.subcategory_name LIKE 'MZ%' 
        OR sc.subcategory_name LIKE 'RZ%' 
        OR sc.subcategory_name LIKE 'EZ%')
      AND sc.is_deleted = 0
    ORDER BY sc.subcategory_name, sc.category_id
");

echo "All matching subcategories:\n";
while($r = $res->fetch_assoc()) {
    echo "  Model: {$r['subcategory_name']} | Subcategory ID: {$r['id']} | Category: {$r['category_name']} (Cat ID: {$r['category_id']})\n";
}
