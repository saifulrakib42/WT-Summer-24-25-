<?php
session_start();

// Check if product ID is provided
if (!isset($_GET['id'])) {
    header("Location: cart.php");
    exit();
}

$productId = intval($_GET['id']);

// Remove the product from the cart
if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]);
}

// Redirect back to the cart page
header("Location: ../view/cart.php");
exit();
