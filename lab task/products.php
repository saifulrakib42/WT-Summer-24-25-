<?php
include "config.php";

$productname = $productid = $time = "";
$productnameErr = $productidErr = $timeErr = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["productname"])) {
        $productnameErr = "Product Name is required";
    } else {
        $productname = $_POST["productname"];
    }

    if (empty($_POST["productid"])) {
        $productidErr = "Product Id is required";
    } else {
        $productid = $_POST["productid"];
    }

    if (empty($_POST["time"])) {
        $timeErr = "Time is required";
    } else {
        $time = $_POST["time"];
    }

    
    if (isset($_POST["add"])) {
        if (empty($productnameErr) && empty($productidErr) && empty($timeErr)) {
            $sql = "INSERT INTO products (productname, productid, time) VALUES ('$productname', '$productid', '$time')";
            if ($conn->query($sql) === TRUE) {
                $success = " Product added successfully!";
            } else {
                $success = " Error: " . $conn->error;
            }
        }
    }

    
    if (isset($_POST["view"])) {
        header("Location: view.php");
        exit;
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Product</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add a new Product</h2>
        <form method="post" action="">
            <label>Productname:</label>
            <input type="text" name="productname">
            <?php echo $productnameErr; ?><br><br>
 
            <label>Productid:</label>
            <input type="text" name="productid">
            <?php echo $productidErr; ?><br><br>
 
            <label>Time:</label>
            <input type="text" name="time">
            <?php echo $timeErr; ?><br><br>
 
            <input type="submit" name="add" value="Add Product" class="btn"><br><br>
            <input type="submit" name="view" value="View Product" class="btn">
        </form>
 
        <p class="success"><?php echo $success; ?></p>
    </div>
</body>
</html>
