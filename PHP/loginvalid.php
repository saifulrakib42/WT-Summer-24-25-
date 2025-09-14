<?php
session_start();
include '../DB/admindata.php';

$username = $password = "";
$usernameError = $passwordError = $error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

    if (empty($_POST["username"])) {
        $usernameError = "username is required";
    } else {
        $username = $_POST["username"];
    }

    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
    } else {
        $password = $_POST["password"];
    }

    if (empty($usernameError) && empty($passwordError)) {
        $conn = createConnObj();

        $sql = "SELECT * FROM register WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            //  Clear old cookie first (forces fresh login experience)
            setcookie("welcomeName", "", time() - 3600, "/");

            //  Set session
             $_SESSION['admin_id'] = $row['id']; 
            $_SESSION['admin_username'] = $row['username'];
            $_SESSION['admin_fullname'] = $row['fullname'];

            //  Redirect to admin home page
            header("Location: ../view/home.php");
            exit();

        } else {
            $passwordError = "Invalid email or password";
        }

        mysqli_close($conn);
    }
}
?>