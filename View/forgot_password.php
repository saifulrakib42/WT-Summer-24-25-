<?php
include '../PHP/forgot_passwordvalid.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgot_password.css">

</head>
<body>
    <h2>Forgot Password</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Enter your registered email" required>
        <button type="submit" name="sendOtp">Send OTP</button>
    </form>
    <p style="color:red;"><?php echo $message; ?></p>
</body>
</html>
