<?php
require __DIR__ . '/../php/db_conn.php';

$res = $conn->query('
    SELECT sc.subcategory_name as model, COUNT(DISTINCT c.id) as cons_count, COUNT(ic.id) as item_count
    FROM subcategories sc
    JOIN consumables c ON c.model_id = sc.id AND c.is_deleted = 0
    JOIN item_codes ic ON ic.consumable_id = c.id AND ic.is_deleted = 0
    WHERE sc.category_id = 393 AND sc.is_deleted = 0
    GROUP BY sc.id
    ORDER BY sc.subcategory_name ASC
');
while($r = $res->fetch_assoc()) {
    echo sprintf("%-15s | Consumables: %2d | Item Codes: %2d\n", $r['model'], $r['cons_count'], $r['item_count']);
}
