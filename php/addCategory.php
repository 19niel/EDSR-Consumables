<?php
include_once('config.php');
include ('db_conn.php');

if (isset($_POST['add_category_button'])) {
    $field = $_POST['field'];
    $category = $_POST['category'];

    $insert_category_query = "INSERT INTO categories (field, category_name) VALUES ('$field','$category')";
    $insert_category_result = mysqli_query($conn, $insert_category_query);

    if ($insert_category_result) {
        echo '<script>
                alert("Added a Category.");
                window.location.href = "'.BASE_URL.'pages/customize.php";
            </script>';
    } else {
        echo '<script>
                alert("Failed to add category.");
                window.location.href = "'.BASE_URL.'pages/customize.php";
            </script>';
    }
}
?>