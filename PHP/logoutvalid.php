<?php
session_start();

// Remove all session data
session_unset();
session_destroy();

// Remove the welcome cookie
setcookie("welcomeName", "", time() - 3600, "/");

// Redirect to login page
header("Location: ../view/login.php");
exit();
?>