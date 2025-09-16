<?php
session_start();
require '../config/db.php';
require '../model/User.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../view/Login.php');
    exit;
}

// Connect to DB
$db = new Database();
$conn = $db->getConnection();

// Create User object
$userObj = new User($conn);

// Fetch user details
$userid = $_SESSION['userid'];
$userData = $userObj->getUserById($userid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings - ShopEase</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/accountsettings.css" rel="stylesheet">
 
</head>
<body>

<?php include 'NavbarAfterLogin.php'; ?> 

<div class="settings-card">
  <h3 class="mb-4">Account Settings</h3>
  <form action="../controller/UserController.php" method="POST">
    <input type="hidden" name="userid" value="<?php echo $userData['id']; ?>">
    
    <div class="mb-3">
      <label class="form-label">Full Name</label>
      <input type="text" class="form-control" name="fullname" value="<?php echo htmlspecialchars($userData['FullName']); ?>" required>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Email</label><small id="email-feedback" class="text-danger"></small>      
      <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Phone Number</label><small id="phone-feedback" class="text-danger"></small>
      <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($userData['phoneNo']); ?>" required>
    </div>
    
    <div class="mb-3">
      <label class="form-label">Address</label>
      <textarea class="form-control" name="address" rows="2" required><?php echo htmlspecialchars($userData['address']); ?></textarea>
    </div>
    
    <button type="submit" id="registerBtn" class="btn btn-primary w-100">Update Account</button>
  </form>

  <button type="button" class="btn btn-warning w-100 mt-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
  Change Password
</button>

<!-- Bootstrap Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="changePasswordForm">
          <input type="hidden" name="userid" value="<?php echo $userData['id']; ?>">
          <div class="mb-3">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control" name="current_password" required>
          </div>
          <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="new_password" required>
          </div>
          <div id="password-feedback" class="text-danger mb-2"></div>
          <button type="submit" class="btn btn-primary w-100">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/AccountSettings.js"></script>
</body>
</html>








