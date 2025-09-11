<?php
//include '../model/userdb.php';
//include '../model/Admin_userdata.php';

//$conn = createUserConn();
//$users = getAllUsers($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>

    <h1>User Information</h1>

    <!-- Add User Link with spacing -->
    <p><a href="add_user.php"> Add New User</a></p>
    <br>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Address</th>
            <th>District</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php //while($row = mysqli_fetch_assoc($users)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['fname']); ?></td>
            <td><?php echo htmlspecialchars($row['lname']); ?></td>
            <td><?php echo htmlspecialchars($row['birthday']); ?></td>
            <td><?php echo htmlspecialchars($row['gend']); ?></td>
            <td><?php echo htmlspecialchars($row['phn']); ?></td>
            <td><?php echo htmlspecialchars($row['addr']); ?></td>
            <td><?php echo htmlspecialchars($row['dis']); ?></td>
            
            <!-- Edit Link in its own cell -->
            <td>
                <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a>
            </td>

            <!-- Delete Button in its own cell -->
            <td>
                <form method="post" action="../control/usercontrol.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="deleteUser" value="Delete">
                </form>
            </td>
        </tr>
        <?php //endwhile; ?>
    </table>

</body>
</html>

<?php //mysqli_close($conn); ?>