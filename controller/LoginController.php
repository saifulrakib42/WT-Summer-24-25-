<?php
session_start();
require_once '../config/db.php';
require_once '../model/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $loggedInUser = $user->login($email, $password);

    if ($loggedInUser) {
        $_SESSION['email'] = $loggedInUser['email'];
        $_SESSION['user'] = $loggedInUser['username'];
        $_SESSION['userid'] = $loggedInUser['id'];
        $_SESSION['password'] = $loggedInUser['password'];


        header("Location: ../view/UserDashboard.php"); // redirect after login
        exit();
    } else {
        header("Location: ../view/login.php?error=1");
        exit();
    }
}
?>
