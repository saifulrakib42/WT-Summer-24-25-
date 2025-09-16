<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['userid']) || !isset($_POST['orderId'])) {
    exit('Invalid request');
}

$conn = (new Database())->getConnection();
$orderId = intval($_POST['orderId']);

// Fetch order items
$stmt = $conn->prepare("
    SELECT p.Name, oi.quantity, oi.unitPrice, oi.totalPrice
    FROM orderItems oi
    JOIN products p ON oi.productId = p.id
    WHERE oi.orderId = ?
");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th>Product</th><th>Quantity</th><th>Unit Price</th><th>Total Price</th></tr></thead><tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row['Name']).'</td>';
        echo '<td>'.$row['quantity'].'</td>';
        echo '<td>'.$row['unitPrice'].' ৳</td>';
        echo '<td>'.$row['totalPrice'].' ৳</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No items found for this order.</p>';
}
?>
