<?php
session_start();
include '../DB/admininfodata.php';

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];
    $conn = createConnObj();

    // Step 1: Get the photo filename from DB
    $result = selectAdmin($conn, $id);
    if ($row = mysqli_fetch_assoc($result)) {
        $photoFile = $row['photo'];
        $filePath = "../img/" . $photoFile;

        // Step 2: Delete the photo file
        if (file_exists($filePath)) {
            unlink($filePath); // delete the photo
        }
    }

    // Step 3: Delete the DB record
    if (deleteAdmin($conn, $id)) {
        session_unset();
        session_destroy();
        setcookie("rememberPhone", "", time() - 3600);
        header("Location: login.php");
        exit();
    } else {
        echo "<p style='color:red;'>Failed to delete account: " . mysqli_error($conn) . "</p>";
    }

    closeConn($conn);
} else {
    echo "<p style='color:red;'>Invalid admin session.</p>";
}
?>