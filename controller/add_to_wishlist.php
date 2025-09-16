<?php
session_start();
require '../config/db.php';

$conn = (new Database())->getConnection();

// Make sure user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ../view/Login.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    $userId = intval($_SESSION['userid']);

    // Check if the product is already in the wishlist
    $stmt = $conn->prepare("SELECT * FROM WishLists WHERE productId = ? AND UserId = ? AND IsRemove = 0");
    $stmt->bind_param("ii", $productId, $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Product already in wishlist!";
    } else {
        // Insert into wishlist
        $stmt = $conn->prepare("INSERT INTO WishLists (productId, UserId, IsRemove) VALUES (?, ?, 0)");
        $stmt->bind_param("ii", $productId, $userId);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Product added to wishlist!";
        } else {
            $_SESSION['error'] = "Failed to add product.";
        }
    }
}

// Redirect back to the product page
header("Location: ../view/product.php?id=" . $productId);
exit();
