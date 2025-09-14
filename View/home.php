<?php include '../PHP/homevalid.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../Css/home.css">
  <title>Admin Home</title>
</head>
<body>

  <div class="container">

    <!-- Welcome message -->
    <h2><?php echo $welcomeMessage; ?></h2>

    <!-- Top bar -->
    <div class="top-bar">
        <a href="admindashboard.php">Admin Info</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Profile picture -->
    <?php if (!empty($pic)): ?>
        <img src="../img/<?php echo $pic; ?>" alt="Admin Picture">
    <?php else: ?>
        <p>No profile picture found.</p>
    <?php endif; ?>

    <!-- Dashboard links (grid layout) -->
    <div class="dashboard-links">
        <a href="userdashboard.php">User Details</a>
        <a href="product.php">Show Products</a>
        <a href="order.php">Show Orders</a>
    </div>
</div>



</body>
</html>