<?php
function createUserConn() {
    $servername = "localhost";
    $username   = "root";      // default XAMPP username
    $password   = "";          // default XAMPP password is empty
    $dbname     = "admin";     // your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function getAllUsers($conn) {
    $sql = "SELECT * FROM user";
    return mysqli_query($conn, $sql);
}

function getUserById($conn, $id) {
    $sql = "SELECT * FROM user WHERE id = $id";
    return mysqli_query($conn, $sql);
}

function addUser($conn, $FullName, $username, $email, $phoneNo, $password, $address, $createdDate) {
    $sql = "INSERT INTO user (FullName, username, email, phoneNo, password, address, createdDate)
            VALUES ('$FullName', '$username', '$email', '$phoneNo', '$password', '$address', '$createdDate')";
    return mysqli_query($conn, $sql);
}

function updateUser($conn, $id, $FullName, $username, $email, $phoneNo, $password, $address, $createdDate) {
    $sql = "UPDATE user 
            SET FullName='$FullName', username='$username', email='$email',
                phoneNo='$phoneNo', password='$password', address='$address', createdDate='$createdDate'
            WHERE id=$id";
    return mysqli_query($conn, $sql);
}

function deleteUser($conn, $id) {
    $sql = "DELETE FROM user WHERE id = $id";
    return mysqli_query($conn, $sql);
}
?>
