<?php
include '../DB/userdata.php';


$conn = createUserConn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //  Add New User
    if (isset($_POST['addUser'])) {
        $FullName    = $_POST['FullName'];
        $username    = $_POST['username'];
        $email       = $_POST['email'];      
        $phoneNo     = $_POST['phoneNo'];
        $password    = $_POST['password'];
        $address     = $_POST['address'];
        $createdDate = date('Y-m-d'); // auto today's date

        addUser($conn, $FullName, $username, $email, $phoneNo, $password, $address, $createdDate);
        header("Location: ../view/userdashboard.php");
        exit();
    }

    //  Update User
    if (isset($_POST['updateUser'])) {
        $id          = $_POST['id'];
        $FullName    = $_POST['FullName'];
        $username    = $_POST['username'];
        $email       = $_POST['email'];
        $phoneNo     = $_POST['phoneNo'];
        $address     = $_POST['address'];
        $createdDate = $_POST['createdDate'];

        if (!empty($_POST['password'])) {
            $password = $_POST['password']; // new password
        } else {
            // keep old password
            $userData = getUserById($conn, $id);
            $row = mysqli_fetch_assoc($userData);
            $password = $row['password'];
        }

        updateUser($conn, $id, $FullName, $username, $email, $phoneNo, $password, $address, $createdDate);
        header("Location: ../view/userdashboard.php");
        exit();
    }

    //  Delete User
    if (isset($_POST['deleteUser'])) {
        $id = $_POST['id'];
        deleteUser($conn, $id);
        header("Location: ../view/userdashboard.php");
        exit();
    }
}

mysqli_close($conn);
?>
