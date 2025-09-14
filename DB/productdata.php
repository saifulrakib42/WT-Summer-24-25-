<?php
function createConnObj() {
    $conn = mysqli_connect("localhost", "root", "", "admin"); // change db name
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function getAllProducts($conn) {
    $sql = "SELECT * FROM products WHERE IsRemove = 0";
    return mysqli_query($conn, $sql);
}

function getProductById($conn, $id) {
    $sql = "SELECT * FROM products WHERE id = $id";
    return mysqli_query($conn, $sql);
}

function addProduct($conn, $Name, $Description, $ProductImage, $UnitPrice, $InventoryQuantity) {
    $sql = "INSERT INTO products (Name, Description, ProductImage, UnitPrice, InventoryQuantity, IsRemove)
            VALUES ('$Name', '$Description', '$ProductImage', '$UnitPrice', '$InventoryQuantity', 0)";
    return mysqli_query($conn, $sql);
}

function updateProduct($conn, $id, $Name, $Description, $ProductImage, $UnitPrice, $InventoryQuantity) {
    $sql = "UPDATE products 
            SET Name='$Name', Description='$Description', ProductImage='$ProductImage', 
                UnitPrice='$UnitPrice', InventoryQuantity='$InventoryQuantity'
            WHERE id=$id";
    return mysqli_query($conn, $sql);
}

function deleteProduct($conn, $id) {
    // get product image first
    $result = getProductById($conn, $id);
    if ($row = mysqli_fetch_assoc($result)) {
        $imageFile = $row['ProductImage'];
        if (!empty($imageFile) && file_exists("../img/" . $imageFile)) {
            unlink("../img/" . $imageFile);
        }
    }

    // then delete from DB
    $sql = "DELETE FROM products WHERE id = $id";
    return mysqli_query($conn, $sql);
}


function closeConn($conn) {
    mysqli_close($conn);
}
?>
