<?php include '../PHP/uservalid.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New User</title>
    <link rel="stylesheet" href="../Css/adduser.css">

</head>
<body>



<form method="post">
    <h1>Add New User</h1>
    <table>
        <tr>
            <td><label for="FullName">Full Name:</label></td>
            <td><input type="text" id="FullName" name="FullName" required></td>
        </tr>
        <tr>
            <td><label for="username">username:</label></td>
            <td><input type="text" id="username" name="username" required></td>
        </tr>
        <tr>
            <td><label for="email">Email:</label></td>
            <td><input type="email" id="email" name="email" required></td>
        </tr>
        
        <tr>
            <td><label for="phoneNo">Phone:</label></td>
            <td><input type="int" id="phoneNo" name="phoneNo" required></td>
        </tr>
       
        <tr>
            <td><label for="password">Password:</label></td>
            <td><input type="password" id="password" name="password" required></td>
        </tr>
         <tr>
            <td><label for="address">Address:</label></td>
            <td><input type="text" id="address" name="address" required></td>
        </tr>
    </table>

    <br>
    <input type="submit" name="addUser" value="Add User">
</form>

</body>
</html>