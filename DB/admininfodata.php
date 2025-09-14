<?php
// Database connection
function createConnObj() {
    $conn = mysqli_connect("localhost", "root", "", "admin"); // adjust DB name if different
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Select single admin by ID
function selectAdmin($conn, $id) {
    $sql = "SELECT * FROM register WHERE id='$id'";
    return mysqli_query($conn, $sql);
}

// Update admin data
function updateAdmin($conn, $id, $fullname, $email, $username, $password, $gender, $photo) {
    $sql = "UPDATE register 
            SET fullname='$fullname', 
                email='$email', 
                username='$username', 
                password='$password', 
                gender='$gender', 
                photo='$photo'
            WHERE id='$id'";
    return mysqli_query($conn, $sql);
}

// Delete admin
function deleteAdmin($conn, $id) {
    $sql = "DELETE FROM register WHERE id='$id'";
    return mysqli_query($conn, $sql);
}

// Close connection
function closeConn($conn) {
    mysqli_close($conn);
}
?>
