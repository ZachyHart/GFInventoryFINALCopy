<?php
require_once '../helpers/conn_helpers.php';

$product_name = $_POST['product_name'];
$product_category = $_POST['product_category'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$product_image = $_FILES['product_image']['name'];
// check fields if empty
if (empty($product_name) || empty($product_category) || empty($price) || empty($stock) || empty($product_image)) {
    header("Location: ../adminInventory.php?error=emptyfields");
    exit();
} else {
    // check if product name already exists
    $sql = "SELECT * FROM product_table WHERE product_name=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../adminInventory.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $product_name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if ($resultCheck > 0) {
            header("Location: ../adminInventory.php?error=productnametaken");
            exit();
        } else {
            // upload image
            $target_dir = "../img/products/";
            $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["product_image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                header("Location: ../adminInventory.php?error=notanimage");
                exit();
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                header("Location: ../adminInventory.php?error=fileexists");
                exit();
            }
            // Check file size
            if ($_FILES["product_image"]["size"] > 500000000) {
                header("Location: ../adminInventory.php?error=filetoolarge");
                exit();
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                header("Location: ../adminInventory.php?error=invalidfiletype");
                exit();
            }
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $sql = "INSERT INTO product_table (product_name, product_category, price, stock, product_image) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../adminInventory.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "sssss", $product_name, $product_category, $price, $stock, $product_image);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../adminInventory.php?addproduct=success");
                    exit();
                }
            } else {
                header("Location: ../adminInventory.php?error=uploadfailed");
                exit();
            }
        }
    }
}