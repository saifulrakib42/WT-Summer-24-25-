<?php
session_start();
include '../DB/admininfodata.php';

$admindata = null;

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $conn = createConnObj();

    //  Fetch user data
    $result = selectAdmin($conn, $id); 
    if ($result && mysqli_num_rows($result) === 1) {
        $admindata = mysqli_fetch_assoc($result);
    }

    // Update form submitted
    if (isset($_POST['update'])) {
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $gender = $_POST['gender'] ?? '';

        $old_photo = $_POST['old_photo'];
        $new_photo = $_FILES["photo"]["name"];

        //  Handle profile photo
        if (!empty($new_photo)) {
            $ext = pathinfo($new_photo, PATHINFO_EXTENSION);
            $photo = time() . "." . $ext;
            $uploadPath = '../img/' . $photo;

            // Delete old if exists
            if (!empty($old_photo)) {
                $oldPath = '../img/' . $old_photo;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadPath);
        } else {
            $photo = $old_photo;
        }

       //  Password update (only if filled & matched)
if (!empty($password) && $password === $confirm_password) {
    $newPassword = $password;   // save plain password
} else {
    $newPassword = $admindata['password']; // keep old one
}


        //  Update user in DB
        updateAdmin($conn, $id, $fullname, $email, $username, $newPassword, $gender, $photo);

        // Refresh session & redirect
        $_SESSION['admin_name'] = $fullname;
        header("Location: ../view/admindashboard.php");
        exit();
    }

    closeConn($conn);
    
}
?>
