<?php
session_start();

$username = $password = "";
$usernameErr = $passwordErr = $error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = ($_POST["username"]);
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    
    if (empty($usernameErr) && empty($passwordErr)) {
        
        if ($username == "Admin" && $password == "1234") {
            $_SESSION["username"] = $username; 
            header("Location: dashboard.php");
            exit();
        } else {
            $error = " Invalid username or password!";
        }
    }
}
?>

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
            <?php echo $usernameErr; ?><br>

            
            <input type="password" name="password" placeholder="Password">
            <?php echo $passwordErr; ?><br>

            <button type="submit">Login</button>
            <a href="registration.php">Go To Registration</a>

            
            <p class="error"><?php echo $error; ?></p>
        </form>
    </div>
</body>
</html>
