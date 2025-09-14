<?php
include '../DB/userdata.php';

$conn = createUserConn();
$users = getAllUsers($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../Css/userdashboard.css">

</head>
<body>

    <h1>User Information</h1>

    <!-- Add User Link -->
    <p><a href="home.php"> Home Page</a>

    <br><br>

        <a href="adduser.php"> Add New User</a></p>
       
    <br>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Password</th>
            <th>Created Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($users)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['FullName']); ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['address']); ?></td>
            <td><?php echo htmlspecialchars($row['phoneNo']); ?></td>
            <td><?php echo htmlspecialchars($row['password']); ?></td>
            <td><?php echo htmlspecialchars($row['createdDate']); ?></td>

            <!-- Edit Link -->
            <td>
                <a href="edituser.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>

            <!-- Delete Button -->
            <td>
                <form method="post" action="../PHP/uservalid.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="deleteUser" value="Delete">
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>

<?php mysqli_close($conn); ?>
