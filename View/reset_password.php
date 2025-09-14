<?php include '../PHP/reset_passwordvalid.php'; ?>
<!DOCTYPE html>
<html>
<head><title>Reset Password</title></head>
<body>
    <h2>Reset Password</h2>
    <form method="post">
        <input type="password" name="password" placeholder="New Password" required><br>
        <input type="password" name="confirm" placeholder="Confirm Password" required><br>
        <button type="submit" name="resetPass">Change Password</button>
    </form>
    <p style="color:red;"><?php echo $message; ?></p>
</body>
</html>
