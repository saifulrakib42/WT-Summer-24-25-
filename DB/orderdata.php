<?php
function createConnObj() {
    $conn = mysqli_connect("localhost", "root", "", "admin"); // change DB name if needed
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Get all orders with user info
function getAllOrders($conn) {
    $sql = "SELECT o.id, o.orderNumber, o.orderDate, o.totalAmount, o.status, 
                   u.Fullname AS customerName, u.email 
            FROM orders o
            JOIN user u ON o.userId = u.id";
    return mysqli_query($conn, $sql);
}

// Get all items of a specific order with product info
function getOrderItems($conn, $orderId) {
    $sql = "SELECT oi.id, oi.quantity, oi.unitPrice, oi.totalPrice, 
                   p.Name AS productName, p.ProductImage
            FROM orderitems oi
            JOIN products p ON oi.productId = p.id
            WHERE oi.orderId = $orderId";
    return mysqli_query($conn, $sql);
}

// Update order status
function updateOrderStatus($conn, $orderId, $status) {
    $sql = "UPDATE orders SET status='$status' WHERE id=$orderId";
    return mysqli_query($conn, $sql);
}

function closeConn($conn) {
    mysqli_close($conn);
}
?>
