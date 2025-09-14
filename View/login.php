
<?php include '../PHP/loginvalid.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="../Css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="post">
            
            <input type="text" name="username" placeholder="Username">
            <?php echo $usernameError; ?><br>

            
            <input type="password" name="password" placeholder="Password">
            <?php echo $passwordError; ?><br>
              <a href="forgot_password.php">Forgot Password?</a>

            <button type="submit" name="login">Login</button>
          

            <a href="registration.php">Go To Registration</a>

            
            <p class="error"><?php echo $error; ?></p>
        </form>
    </div>
</body>
</html>
