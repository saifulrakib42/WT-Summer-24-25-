<?php
include '../DB/orderdata.php';
$conn = createConnObj();
$orders = getAllOrders($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
    <link rel="stylesheet" href="../Css/order.css">

</head>
<body>

    <h1>All Orders</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Order #</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th>Items</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($orders)): ?>
        <tr>
            <td><?php echo $row['orderNumber']; ?></td>
            <td><?php echo $row['customerName']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['orderDate']; ?></td>
            <td><?php echo $row['totalAmount']; ?></td>
            <td><?php echo $row['status']; ?></td>
            
            <td>
                <a href="orderitems.php?id=<?php echo $row['id']; ?>">View Items</a>
            </td>

            <td>
                <form method="post" action="../PHP/ordervalid.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
                        <option value="Shipped" <?php if($row['status']=="Shipped") echo "selected"; ?>>Shipped</option>
                        <option value="Delivered" <?php if($row['status']=="Delivered") echo "selected"; ?>>Delivered</option>
                    </select>
                    
                </form>
            </td>
        </tr>
        
        <?php endwhile; ?>
    </table>
    <p><a href="home.php">Back to Home Page</a>

</body>
</html>

<?php mysqli_close($conn); ?>
