<?php
include '../DB/orderdata.php';
$conn = createConnObj();

$orderId = $_GET['id'];
$items = getOrderItems($conn, $orderId);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Items</title>
    <link rel="stylesheet" href="../css/orderitems.css">

</head>
<body>

    <h1>Order #<?php echo $orderId; ?> Items</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Product</th>
            <th>Image</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total Price</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($items)): ?>
        <tr>
            <td><?php echo $row['productName']; ?></td>
            <td>
                <?php if(!empty($row['ProductImage'])): ?>
                    <img src="../img/<?php echo $row['ProductImage']; ?>" width="60">
                <?php endif; ?>
            </td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['unitPrice']; ?></td>
            <td><?php echo $row['totalPrice']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="order.php">⬅ Back to Orders</a></p>

</body>
</html>

<?php mysqli_close($conn); ?>
