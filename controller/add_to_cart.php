<?php
session_start();
require '../config/db.php';
$conn = (new Database())->getConnection();

// Check if product_id is provided
if (!isset($_POST['product_id'])) {
    header("Location: ../view/products.php");
    exit();
}

$productId = intval($_POST['product_id']);

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ? AND IsRemove = 0");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['cart_message'] = "Product not found!";
    header("Location: ../view/product.php?id=$productId");
    exit();
}

$product = $result->fetch_assoc();

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Current quantity in cart
$currentQty = $_SESSION['cart'][$productId]['quantity'] ?? 0;

// Check stock
if ($currentQty < $product['InventoryQuantity']) {
    $_SESSION['cart'][$productId] = [
        'id' => $product['id'], 
        'name' => $product['Name'],
        'price' => $product['UnitPrice'],
        'image' => $product['ProductImage'],
        'quantity' => $currentQty + 1
    ];
    $_SESSION['cart_message'] = "Product added to cart!";
} else {
    $_SESSION['cart_message'] = "Cannot add more than available stock!";
}

// Redirect back to product page
header("Location: ../view/UserDashboard.php?id=$productId");
exit();
