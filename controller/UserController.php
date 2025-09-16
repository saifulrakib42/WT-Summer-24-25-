<?php
session_start();
require '../config/db.php';
require '../model/User.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../view/Login.php');
    exit;
}

// Connect DB
$db = new Database();
$conn = $db->getConnection();

// Create User object
$userObj = new User($conn); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //  Check if this is a password change request
    if (isset($_POST['current_password']) && isset($_POST['new_password'])) {
        $userid = $_POST['userid'];
        $currentPassword = trim($_POST['current_password']);
        $newPassword = trim($_POST['new_password']);

        // Update password in DB
        if ($userObj->updatePassword($userid, $newPassword)) {
            $_SESSION['password'] = $newPassword; // update session too
            echo "success";
        } else {
            echo "Failed to update password";
        }
        exit; // stop here, don’t run account update below
    }

    
// Get form data
$userid   = $_POST['userid'];
$fullname = trim($_POST['fullname']);
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$phone    = trim($_POST['phone']);
$address  = trim($_POST['address']);

// Update user
$updated = $userObj->updateUser($userid, $fullname, $username, $email, $phone, $address);

if ($updated) {
    $_SESSION['success'] = "Account updated successfully!";
    $_SESSION['user']=$username;
    $_SESSION['userid']=$userid;
    $_SESSION['email']=$email;
    header("Location: ../view/AccountSettings.php");
    exit;
} else {
    $_SESSION['error'] = "Something went wrong while updating.";
    header("Location: ../view/AccountSettings.php");
    exit;
}
}


