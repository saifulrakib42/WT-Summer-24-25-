<?php
session_start();
if (!isset($_SESSION['admin_username']) || !isset($_SESSION['admin_fullname'])) {
    header("Location: ../view/login.php");
    exit();
}
//  Welcome message with cookie
if (!isset($_COOKIE['welcomeName'])) {
    setcookie("welcomeName", $_SESSION['admin_fullname'], time() + 3600, "/"); // 1 hour
    $welcomeMessage = "Welcome, " . $_SESSION['admin_fullname'] . "!";
} else {
    $welcomeMessage = "Welcome back, " . $_COOKIE['welcomeName'] . "!";
}

//  Load admin picture from database
include '../DB/admindata.php';
$conn = createConnObj();
$username = $_SESSION['admin_username'];

$result = mysqli_query($conn, "SELECT photo FROM register WHERE username='$username'");
$pic = ""; // default
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $pic = $row['photo'] ?? "";
}

mysqli_close($conn);
?>