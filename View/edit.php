<?php include '../PHP/editvalid.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Account</title>
    <link rel="stylesheet" href="../Css/edit.css">
</head>
<body>
<div class="edit-container">

<h1>Edit Your Account</h1>

<?php if ($admindata) { ?>
<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $admindata['id']; ?>">
    <input type="hidden" name="old_photo" value="<?php echo $admindata['photo']; ?>">

    <input type="text" name="fullname" placeholder="Full Name" value="<?php echo $admindata['fullname']; ?>"><br>
    <input type="email" name="email" placeholder="Email Address" value="<?php echo $admindata['email']; ?>"><br>
    <input type="text" name="username" placeholder="Username" value="<?php echo $admindata['username']; ?>"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="confirm_password" placeholder="Confirm Password"><br>

    <p>Current photo: <?php echo $admindata['photo']; ?></p>
    <input type="file" name="photo"><br>

    <div class="gender-box">
        <label><input type="radio" name="gender" value="Male" <?php if ($admindata['gender']=="Male") echo "checked"; ?>> Male</label>
        <label><input type="radio" name="gender" value="Female" <?php if ($admindata['gender']=="Female") echo "checked"; ?>> Female</label>
        <label><input type="radio" name="gender" value="Other" <?php if ($admindata['gender']=="Other") echo "checked"; ?>> Other</label>
    </div>
    <?php echo $genderError ?? ""; ?><br>

    <input type="submit" name="update" value="Update">
    <a href="admindashboard.php">Back</a>
</form>
<?php } else { ?>
    <p>User not found or ID missing.</p>
<?php } ?>

</div>
</body>

</html>
