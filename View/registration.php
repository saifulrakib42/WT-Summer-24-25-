<?php
$fullname = $email = $username = $gender = "";
$fullnameErr = $emailErr = $usernameErr = $passwordErr = $confirmErr = $genderErr = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Full Name
    if (empty($_POST["fullname"])) {
        $fullnameErr = "Full Name is required";
    } else {
        $fullname = ($_POST["fullname"]);
    }

    // Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = ($_POST["email"]);
    }

    // Username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = ($_POST["username"]);
    }

    // Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } elseif (strlen($_POST["password"]) < 4) {
        $passwordErr = "Password must be at least 6 characters";
    } else {
        $password = $_POST["password"];
    }

    // Confirm Password
    if (empty($_POST["confirm_password"])) {
        $confirmErr = "Confirm your password";
    } elseif ($_POST["confirm_password"] != $_POST["password"]) {
        $confirmErr = "Passwords do not match";
    }

    // Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Select your gender";
    } else {
        $gender = $_POST["gender"];
    }

    // Registration successful
    if (empty($fullnameErr) && empty($emailErr) && empty($usernameErr) && empty($passwordErr) && empty($confirmErr) && empty($genderErr)) {
        $success = " Registration successful! Now you can login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="../Css/reg.css">
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <form action="" method="post">

            
            <input type="text" name="fullname" placeholder="Full Name">
            <?php echo $fullnameErr; ?><br>

            
            <input type="email" name="email" placeholder="Email Address">
            <?php echo $emailErr; ?><br>

           
            <input type="text" name="username" placeholder="Username">
            <?php echo $usernameErr; ?><br>

           
            <input type="password" name="password" placeholder="Password">
            <?php echo $passwordErr; ?><br>

            
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <?php echo $confirmErr; ?><br>

           
            <div class="gender-box">
                <label><input type="radio" name="gender" value="Male"> Male</label>
                <label><input type="radio" name="gender" value="Female"> Female</label>
                <label><input type="radio" name="gender" value="Other"> Other</label>
            </div>
            <?php echo $genderErr; ?><br>

           
            <button type="submit">Register</button>
            <a href="login.php">Already have an account? Login</a>

            
            <p class="success"><?php echo $success; ?></p>
        </form>
    </div>
</body>
</html>
