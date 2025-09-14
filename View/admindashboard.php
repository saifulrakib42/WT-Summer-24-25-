<?php include '../PHP/admindashboardvalid.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Css/admindashboard.css">
</head>

<body>
    
<div class="dashboard">
   <p><a href="home.php">Back</a> 


<?php if ($admindata) { ?>
    <h1>Welcome Admin <?php echo $admindata['fullname']; ?>!</h1>

    

    <!-- Profile photo -->
    <?php 
    $photoPath = "../img/" . $admindata['photo']; 
    if (!empty($admindata['photo']) && file_exists($photoPath)) {
        echo "<img src='$photoPath' alt='Profile Photo'><br><br>";
    } else {
        echo "<p style='color:red;'>No profile photo found.</p>";
    }
    ?>

    <h3>Your Information</h3>
    <table>
        <tr><td>Full Name</td><td><?php echo $admindata['fullname']; ?></td></tr>
        <tr><td>Email</td><td><?php echo $admindata['email']; ?></td></tr>
        <tr><td>Username</td><td><?php echo $admindata['username']; ?></td></tr>
        <tr><td>Gender</td><td><?php echo $admindata['gender']; ?></td></tr>
    </table>

    <h3>Account Options</h3>
    <ul>
        <li><a href="edit.php?id=<?php echo $admindata['id']; ?>">Edit Account</a></li>
        <li><a href="delete.php?id=<?php echo $admindata['id']; ?>" 
               onclick="return confirm('Are you sure you want to delete your account?');">
               Delete Account</a></li>
    </ul>
<?php } else { ?>
    <p style="color:red;">No user found or session expired. Please <a href="login.php">login</a>.</p>
<?php } ?>

</div>
</body>

</html>
