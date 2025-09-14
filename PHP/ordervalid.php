<?php
session_start();
include '../DB/orderdata.php';

$conn = createConnObj();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Update order status
    if (isset($_POST['updateStatus'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        updateOrderStatus($conn, $id, $status);
        header("Location: ../View/orders.php");
        exit();
    }
}

closeConn($conn);
?>
