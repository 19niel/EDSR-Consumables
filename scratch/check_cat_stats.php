<?php
require __DIR__ . '/../php/db_conn.php';

$res = $conn->query("
    SELECT sc.category_id, COUNT(DISTINCT sc.id) as model_cnt, COUNT(DISTINCT c.id) as cons_cnt, COUNT(ic.id) as item_cnt
    FROM subcategories sc
    JOIN consumables c ON c.model_id = sc.id AND c.is_deleted = 0
    LEFT JOIN item_codes ic ON ic.consumable_id = c.id AND ic.is_deleted = 0
    WHERE sc.category_id IN (351, 396) AND sc.is_deleted = 0
    GROUP BY sc.category_id
");
while($r = $res->fetch_assoc()) {
    echo "Category {$r['category_id']}: {$r['model_cnt']} models, {$r['cons_cnt']} consumables, {$r['item_cnt']} item codes\n";
}
