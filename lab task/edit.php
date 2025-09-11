<?php
include "config.php";

$id = $_GET['id'];
$productnameErr = $productidErr = $timeErr = "";
$success = "";


$result = $conn->query("SELECT * FROM products WHERE id=$id");
$product = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productname = $_POST['productname'];
    $productid = $_POST['productid'];
    $time = $_POST['time'];

    if (empty($productname)) $productnameErr = "Product Name is required";
    if (empty($productid)) $productidErr = "Product Id is required";
    if (empty($time)) $timeErr = "Time is required";

    if (empty($productnameErr) && empty($productidErr) && empty($timeErr)) {
        $conn->query("UPDATE products SET productname='$productname', productid='$productid', time='$time' WHERE id=$id");
        header("Location: view.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="post">
            <label>Productname:</label>
            <input type="text" name="productname" value="<?php echo $product['productname']; ?>">
            <?php echo $productnameErr; ?><br><br>

            <label>Productid:</label>
            <input type="text" name="productid" value="<?php echo $product['productid']; ?>">
            <?php echo $productidErr; ?><br><br>

            <label>Time:</label>
            <input type="text" name="time" value="<?php echo $product['time']; ?>">
            <?php echo $timeErr; ?><br><br>

            <input type="submit" value="Update Product" class="btn">
        </form>
    </div>
</body>
</html>
