<?php
session_start();
require '../config/db.php';

$conn = (new Database())->getConnection();

// Ensure user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ../view/Login.php");
    exit();
}

$userId = intval($_SESSION['userid']);

// Handle remove action
if (isset($_GET['remove_id'])) {
    $productId = intval($_GET['remove_id']);

    $stmt = $conn->prepare("UPDATE WishLists SET IsRemove = 1 WHERE productId = ? AND UserId = ?");
    $stmt->bind_param("ii", $productId, $userId);
    $stmt->execute();

    header("Location: ../view/wishlist.php");
    exit();
}

// Fetch wishlist items for the user
$stmt = $conn->prepare("
    SELECT p.id, p.Name, p.ProductImage, p.UnitPrice
    FROM WishLists w
    JOIN products p ON w.productId = p.id
    WHERE w.UserId = ? AND w.IsRemove = 0 AND p.IsRemove = 0
");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$wishlistItems = $result->fetch_all(MYSQLI_ASSOC);
