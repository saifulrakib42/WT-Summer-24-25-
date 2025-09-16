<?php
session_start();
require '../config/db.php';

$conn = (new Database())->getConnection();

// Ensure user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: Login.php");
    exit();
}

$userId = intval($_SESSION['userid']);

// Fetch orders for this user
$sql = "SELECT id, orderNumber, orderDate, totalAmount, status 
        FROM orders 
        WHERE userId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/MyOrdersView.css">

</head>
<body>

<?php include 'NavbarAfterLogin.php'; ?>

<div class="container mt-5 pt-5">
    <h2 class="mb-4">My Orders</h2>
    
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['orderNumber']); ?></td>
                    <td><?php echo htmlspecialchars($row['orderDate']); ?></td>
                    <td><?php echo htmlspecialchars($row['totalAmount']); ?> ৳</td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <a href="#" class="order-details-btn" data-order-id="<?php echo $row['id']; ?>">
                            <img src="https://cdn-icons-png.flaticon.com/512/54/54481.png" alt="Details" width="24" height="24">
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">You have no orders yet.</div>
    <?php endif; ?>
</div>

<!-- Modern Minimal Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-sm rounded-4">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold" id="orderDetailsModalLabel">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4" id="order-details-content">
        <!-- AJAX content will be loaded here -->
      </div>
      <div class="modal-footer border-top-0">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/myordersview.js"></script>



</body>
</html>
