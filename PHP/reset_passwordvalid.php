<?php
session_start();
include '../DB/admindata.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['resetPass'])) {
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if (!isset($_SESSION['reset_email'])) {
        $message = "Session expired. Please try again.";
    } elseif ($password !== $confirm) {
        $message = "Passwords do not match!";
    } else {
        $email = $_SESSION['reset_email'];
        $conn = createConnObj();

        //  Use correct column names: reset_otp & otp_expiry
        $update = "UPDATE register 
                   SET password='$password', reset_otp=NULL, otp_expiry=NULL 
                   WHERE email='$email'";

        if (mysqli_query($conn, $update)) {
            unset($_SESSION['reset_email']);
            header("Location: login.php?reset=success");
            exit();
        } else {
            // Show real SQL error for debugging
            $message = "Failed to update password. Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
