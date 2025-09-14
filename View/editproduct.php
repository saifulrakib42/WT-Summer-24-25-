<?php
include '../DB/productdata.php';

$conn = createConnObj();
$id = $_GET['id'] ?? 0;
$product = getProductById($conn, $id);
$row = mysqli_fetch_assoc($product);
closeConn($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../Css/editproduct.css">

</head>
<body>
    

    <form method="post" enctype="multipart/form-data" action="../PHP/productvalid.php">
        <h2>Edit Product</h2>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="oldImage" value="<?php echo $row['ProductImage']; ?>">

        <label>Product Name:</label><br>
        <input type="text" name="Name" value="<?php echo $row['Name']; ?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="Description" required><?php echo $row['Description']; ?></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" name="UnitPrice" value="<?php echo $row['UnitPrice']; ?>" required><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="InventoryQuantity" value="<?php echo $row['InventoryQuantity']; ?>" required><br><br>

        <p>Current Image: <?php echo $row['ProductImage']; ?></p>
        <label>New Image:</label><br>
        <input type="file" name="ProductImage"><br><br>

        <input type="submit" name="updateProduct" value="Update Product">
        <p><a href="product.php">Back to Products</a></p>
    </form>

    
</body>
</html>
