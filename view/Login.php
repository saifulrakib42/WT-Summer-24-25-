<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - ShopEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/login.css" rel="stylesheet">


</head>
<body>

<?php include 'navbar.php'; ?> <!-- same navbar -->

<div class="login-card" style="height:587.39px">
  <!-- Left: Login form -->
  <div class="form-section" style="padding-top: 168px;">
    <h3>Login</h3>
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger">Invalid email or password!</div>
    <?php endif; ?>
    <form action="../controller/LoginController.php" method="POST">
      <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <p class="mt-3 text-center">Don’t have an account? <a href="register.php">Register</a></p>
  </div>

  <!-- Right: Branding -->
  <div class="branding-section">
    <img src="../data/images/logo.png" alt="ShopEase Logo">
    <h2>ShopEase</h2>
    <p>Your one-stop online store for amazing products</p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
