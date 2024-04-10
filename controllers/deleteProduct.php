<?php

require_once '../helpers/conn_helpers.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the product_id from the form
    $product_id = $_POST['product_id'];

    // Delete the product entry in the database
    $sql = "DELETE FROM product_table WHERE product_id=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../adminInventory.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $product_id);
        mysqli_stmt_execute($stmt);
        header("Location: ../adminInventory.php?deleteproduct=success");
        exit();
    }
} else {
    // Redirect to the inventory page if accessed directly without submitting the form
    header("Location: ../adminInventory.php");
    exit();
}