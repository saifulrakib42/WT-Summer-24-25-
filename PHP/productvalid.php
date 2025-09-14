<?php
session_start();
include '../DB/productdata.php';

$conn = createConnObj();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Add Product
    if (isset($_POST['addProduct'])) {
        $name = $_POST['Name'];
        $desc = $_POST['Description'];
        $price = $_POST['UnitPrice'];
        $qty = $_POST['InventoryQuantity'];

        // Image handling
        $image = $_FILES['ProductImage']['name'];
        if (!empty($image)) {
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $newImage = time() . "." . $ext;
            $uploadPath = "../img/" . $newImage;
            move_uploaded_file($_FILES['ProductImage']['tmp_name'], $uploadPath);
        } else {
            $newImage = null;
        }

        addProduct($conn, $name, $desc, $newImage, $price, $qty);
        header("Location: ../View/product.php");
        exit();
    }

    // Update Product
    if (isset($_POST['updateProduct'])) {
        $id = $_POST['id'];
        $name = $_POST['Name'];
        $desc = $_POST['Description'];
        $price = $_POST['UnitPrice'];
        $qty = $_POST['InventoryQuantity'];

        $oldImage = $_POST['oldImage'];
        $newImage = $_FILES['ProductImage']['name'];

        if (!empty($newImage)) {
            $ext = pathinfo($newImage, PATHINFO_EXTENSION);
            $imageFile = time() . "." . $ext;
            $uploadPath = "../img/" . $imageFile;
            move_uploaded_file($_FILES['ProductImage']['tmp_name'], $uploadPath);

            // delete old image
            if (!empty($oldImage) && file_exists("../img/" . $oldImage)) {
                unlink("../img/" . $oldImage);
            }
        } else {
            $imageFile = $oldImage;
        }

        updateProduct($conn, $id, $name, $desc, $imageFile, $price, $qty);
        header("Location: ../View/product.php");
        exit();
    }

    // Delete Product
    if (isset($_POST['deleteProduct'])) {
        $id = $_POST['id'];
        deleteProduct($conn, $id);
        header("Location: ../View/product.php");
        exit();
    }
}

closeConn($conn);
?>
