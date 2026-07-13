<?php
/**
 * getItemCodes.php
 * Returns <option> elements for item codes belonging to a given consumable ID.
 * Called via AJAX: POST { consumable_id: <int> }
 */
include ('db_conn.php');

if (isset($_POST['consumable_id'])) {
    $consumable_id = intval($_POST['consumable_id']);

    $query = "SELECT id, item_name FROM item_codes WHERE consumable_id = ? AND is_deleted = 0 ORDER BY id ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $consumable_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['item_name']) . "</option>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
