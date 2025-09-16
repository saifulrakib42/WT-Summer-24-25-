<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - ShopEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/registration.css" rel="stylesheet">


</head>
<body>

<?php include 'navbar.php'; ?> <!-- Include your navbar here -->

<div class="registration-card">
  
  <!-- Left: Form -->
  <div class="form-section">
    <h2     style="text-align: center">Create Account</h2>
    <form action="../controller/RegistrationController.php" method="POST">
      <input type="text" class="form-control" placeholder="Full Name" name="FullName" required>
      <input type="text" class="form-control" placeholder="Username" name="username" required>
      <input type="email" class="form-control" placeholder="Email Address" name="email" id="email" required>
      <small id="email-feedback" class="text-danger"></small>      
      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
      <small id="phone-feedback" class="text-danger"></small>
      <input type="password" class="form-control" placeholder="Password" name="password" required>
      <textarea class="form-control" placeholder="Address" name="address" rows="2" required></textarea>
      <button type="submit" class="btn btn-primary" id="registerBtn">Register</button>
      <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>

  <!-- Right: Branding -->
  <div class="branding-section">
    <img src="../data/images/logo.png" alt="ShopEase Logo">
    <h2>ShopEase</h2>
    <p>Your one-stop online store for amazing products</p>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../js/registration.js"></script>


</body>

</html>



