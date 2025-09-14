<?php include '../PHP/regvalid.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="../Css/reg.css">
</head>
<body>
    <div class="container">
        <h2>Registration</h2>
        <form action="" method="post" enctype="multipart/form-data">

            
            <input type="text" name="fullname" placeholder="Full Name">
            <?php echo $fullnameError; ?><br>

            
            <input type="email" name="email" placeholder="Email Address">
            <?php echo $emailError; ?><br>

           
            <input type="text" name="username" placeholder="Username">
            <?php echo $usernameError; ?><br>

           
            <input type="password" name="password" placeholder="Password">
            <?php echo $passwordError; ?><br>

            
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <?php echo $confirmPasswordError; ?><br>

            <input type="file" name="photo" placeholder="Select file">
            <?php echo $photoError; ?><br>

           
            <div class="gender-box">
                <label><input type="radio" name="gender" value="Male"> Male</label>
                <label><input type="radio" name="gender" value="Female"> Female</label>
                <label><input type="radio" name="gender" value="Other"> Other</label>
            </div>
            <?php echo $genderError; ?><br>

           
            <button type="submit"  name="Register">Register</button>
            <a href="login.php">Already have an account? Login</a>

            
        
        </form>
    </div>
</body>
</html>
