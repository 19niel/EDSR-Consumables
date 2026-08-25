<?php
include('db_conn.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Check if the user wants to delete
    $query = "DELETE FROM calls WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Call record successfully deleted.');
            window.location.href = '../pages/search_calls.php';
        </script>";
    } else {
        echo "<script>
            alert('Error deleting call record: " . mysqli_error($conn) . "');
            window.location.href = '../pages/search_calls.php';
        </script>";
    }
}
?>
