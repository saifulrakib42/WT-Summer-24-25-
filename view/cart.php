<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p class='text-center mt-5'>Your cart is empty!</p>";
    exit();
}

$cart = $_SESSION['cart'];

$orderNumber = 'ORD-' . strtoupper(bin2hex(random_bytes(4)));

$grandTotal = 0;
foreach($cart as $item) {
    $grandTotal += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Shopping Cart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Your Cart</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($cart as $id => $item): ?>
            <tr>
                <td>
                    <img src="<?php echo $item['image']; ?>" width="50" height="50">
                    <?php echo htmlspecialchars($item['name']); ?>
                </td>
                <td>৳<?php echo number_format($item['price'],2); ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td>৳<?php echo number_format($item['price'] * $item['quantity'],2); ?></td>
                <td>
                    <a href="../controller/remove_from_cart.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remove</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>৳<?php echo number_format($grandTotal,2); ?></strong></td>
            </tr>
        </tbody>
    </table>

    <!-- Checkout Button -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutModal">Checkout</button>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Order Summary</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Order Number:</strong> <?php echo $orderNumber; ?></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cart as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td>৳<?php echo number_format($item['price'],2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>৳<?php echo number_format($item['price'] * $item['quantity'],2); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Grand Total</strong></td>
                    <td><strong>৳<?php echo number_format($grandTotal,2); ?></strong></td>
                </tr>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <form method="POST" action="../controller/confirm_order.php">
            <input type="hidden" name="orderNumber" value="<?php echo $orderNumber; ?>">
            <button type="submit" class="btn btn-primary">Proceed</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
