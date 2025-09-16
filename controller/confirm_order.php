<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Cart is empty!";
    exit();
}

$userId = $_SESSION['userid'] ?? null; // Make sure user ID is stored in session
if (!$userId) {
    echo "You must be logged in to place an order.";
    exit();
}

$cart = $_SESSION['cart'];
$totalAmount = 0;
foreach ($cart as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

// Generate unique order number
$orderNumber = 'ORD-' . strtoupper(uniqid());

// Database connection
$conn = (new Database())->getConnection();

// Start transaction
$conn->begin_transaction();

try {
    // Insert into orders
    $stmt = $conn->prepare("INSERT INTO orders (orderNumber, userId, orderDate, totalAmount, status) VALUES (?, ?, NOW(), ?, 'Pending')");
    $stmt->bind_param("sid", $orderNumber, $userId, $totalAmount);
    $stmt->execute();
    $orderId = $stmt->insert_id; // Last inserted order ID

    // Insert each item into orderItems
    $stmtItem = $conn->prepare("INSERT INTO orderItems (orderId, productId, quantity, unitPrice, totalPrice) VALUES (?, ?, ?, ?, ?)");
    foreach ($cart as $item) {
        $itemTotal = $item['price'] * $item['quantity'];
        $stmtItem->bind_param("iiidd", $orderId, $item['id'], $item['quantity'], $item['price'], $itemTotal);
        $stmtItem->execute();

        // Reduce stock manually
        $conn->query("UPDATE products SET InventoryQuantity = InventoryQuantity - {$item['quantity']} WHERE id = {$item['id']} AND InventoryQuantity >= {$item['quantity']}");
    }

    // Commit transaction
    $conn->commit();

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to order summary page
    header("Location: ../view/UserDashboard.php");
    exit();

} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to place order: " . $e->getMessage();
}
?>
