<?php
require_once '../helpers/conn_helpers.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated data from the form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Check if a new image file has been uploaded
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        // Delete old image from directory
        $old_image_path = ''; // Set the path of the old image
        if (file_exists($old_image_path)) {
            unlink($old_image_path);
        }

        // Upload new image
        $upload_dir = '../img/products/'; // Set your upload directory
        $new_image_name = $_FILES['product_image']['name'];
        $new_image_path = $upload_dir . $new_image_name;
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $new_image_path)) {
            // Image uploaded successfully, update the database
            $sql = "UPDATE product_table SET product_category=?, price=?, stock=?, product_name=?, product_image=? WHERE product_id=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../adminInventory.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "sssssi", $product_category, $price, $stock, $product_name, $new_image_name, $product_id);
                mysqli_stmt_execute($stmt);
                header("Location: ../adminInventory.php?editproduct=success");
                exit();
            }
        } else {
            header("Location: ../adminInventory.php?error=imageuploaderror");
            exit();
        }
    } else {
        // No new image uploaded, update other product details only
        $sql = "UPDATE product_table SET product_category=?, price=?, stock=?, product_name=? WHERE product_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../adminInventory.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $product_category, $price, $stock, $product_name, $product_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../adminInventory.php?editproduct=success");
            exit();
        }
    }
} else {
    // Redirect to the inventory page if accessed directly without submitting the form
    header("Location: ../adminInventory.php");
    exit();
}
?>