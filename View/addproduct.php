<?php include '../PHP/productvalid.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../Css/addproduct.css">

</head>
<body>
    

    <form method="post" enctype="multipart/form-data">
        <h2>Add Product</h2>
        <label>Product Name:</label><br>
        <input type="text" name="Name" required><br><br>

        <label>Description:</label><br>
        <textarea name="Description" required></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" name="UnitPrice" required><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="InventoryQuantity" required><br><br>

        <label>Product Image:</label><br>
        <input type="file" name="ProductImage"><br><br>

        <input type="submit" name="addProduct" value="Add Product">
        <p><a href="product.php">Back to Products</a></p>
    </form>

    
</body>
</html>
