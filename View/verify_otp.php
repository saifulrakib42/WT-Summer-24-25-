<?php
include '../PHP/verify_otpvalid.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" href="forgot_password.css">

</head>
<body>
    <h2>Verify OTP</h2>
    <form method="post">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="verifyOtp">Verify</button>
    </form>
    <p style="color:red;"><?php echo $message; ?></p>
</body>
</html>
