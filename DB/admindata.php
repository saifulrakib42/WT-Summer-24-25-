<?php
// DATABASE CONNECTION 
function createConnObj() {
    $conn = mysqli_connect("localhost", "root", "", "admin");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function closeConn($conn) {
    mysqli_close($conn);
}

// ADMIN BASIC FUNCTIONS
function insertAdmin($conn, $fullname, $email, $username, $password, $photo, $gender) {
    $sql = "INSERT INTO register (fullname, email, username, password, photo, gender)
            VALUES ('$fullname', '$email', '$username', '$password', '$photo', '$gender')";
    return mysqli_query($conn, $sql);
}

function selectAdmin($conn, $id) {
    $sql = "SELECT * FROM register WHERE id='$id'";
    return mysqli_query($conn, $sql);
}

// FORGOT PASSWORD / OTP FUNCTIONS

// Check if email exists
function findAdminByEmail($conn, $email) {
    $sql = "SELECT * FROM register WHERE email='$email'";
    return mysqli_query($conn, $sql);
}

// Save OTP and expiry in DB
function saveOTP($conn, $email, $otp) {
    // OTP expires in 10 minutes
    $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));
    $sql = "UPDATE register SET reset_otp='$otp', otp_expiry='$expiry' WHERE email='$email'";
    return mysqli_query($conn, $sql);
}

// Verify OTP
function verifyOTP($conn, $email, $otp) {
    $sql = "SELECT * FROM register 
            WHERE email='$email' AND reset_otp='$otp' AND otp_expiry >= NOW()";
    return mysqli_query($conn, $sql);
}

//  Update password after OTP verification
function updatePassword($conn, $email, $newPassword) {
    $sql = "UPDATE register 
            SET password='$newPassword', reset_otp=NULL, otp_expiry=NULL 
            WHERE email='$email'";
    return mysqli_query($conn, $sql);
}
?>
