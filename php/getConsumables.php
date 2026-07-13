<?php
/**
 * getConsumables.php
 * Returns <option> elements for consumables belonging to a given model (subcategory) ID.
 * Called via AJAX: POST { model_id: <int> }
 */
include ('db_conn.php');

if (isset($_POST['model_id'])) {
    $model_id = intval($_POST['model_id']);

    $query = "SELECT id, consumable_name FROM consumables WHERE model_id = ? AND is_deleted = 0 ORDER BY id ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $model_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['consumable_name']) . "</option>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
