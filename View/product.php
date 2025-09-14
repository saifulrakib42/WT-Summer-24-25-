<?php
include '../DB/productdata.php';
$conn = createConnObj();
$products = getAllProducts($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Dashboard</title>
    <link rel="stylesheet" href="../Css/product.css">

</head>
<body>
    <div class="container">
    <div class="header">
        <a href="addproduct.php">Add New Product</a>
        <h1>Product Management</h1>
        <a href="home.php">Back to Home</a>
    </div>
    
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($products)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Description']; ?></td>
            <td><?php echo $row['UnitPrice']; ?></td>
            <td><img src="../img/<?php echo $row['ProductImage']; ?>" width="80"></td>
            <td><a href="editproduct.php?id=<?php echo $row['id']; ?>">Edit</a></td>
            <td>
                <form method="post" action="../PHP/productvalid.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="deleteProduct" value="Delete">
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
<?php mysqli_close($conn); ?>
