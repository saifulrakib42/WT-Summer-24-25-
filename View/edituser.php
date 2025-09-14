<?php
include '../PHP/uservalid.php';

$conn = createUserConn();

$id = $_GET['id']; // Get user ID from URL
$result = getUserById($conn, $id);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="../Css/edituser.css">

</head>
<body>

<form method="post">
    <h1>Edit User</h1>
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

    <table>
        <tr>
            <td><label for="FullName">Full Name:</label></td>
            <td><input type="text" id="FullName" name="FullName" value="<?php echo $user['FullName']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="username">username:</label></td>
            <td><input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required></td>
        </tr>
        <tr>
            <td><label for="email">Birthday:</label></td>
            <td><input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required></td>
        </tr>
        
        <tr>
            <td><label for="phoneNo">Phone:</label></td>
            <td><input type="int" id="phoneNo" name="phoneNo" value="<?php echo $user['phoneNo']; ?>" required></td>
        </tr>
        
        <tr>
            <td><label for="password">New Password:</label></td>
            <td><input type="password" id="password" name="password"> (leave blank to keep old)</td>
        </tr>
        <tr>
            <td><label for="address">Address:</label></td>
            <td><input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" required></td>
        </tr>
    </table>

    <br>
    <input type="submit" name="updateUser" value="Update User"><br>
    <a href="userdashboard.php">Back</a>
</form>

</body>
</html>

<?php mysqli_close($conn); ?>