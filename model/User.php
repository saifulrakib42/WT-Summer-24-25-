<?php
class User {
    private $conn;
    private $table = "user"; // make sure your table is named 'user'

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($data) {
        $createdDate = date('Y-m-d H:i:s'); // current timestamp

        $sql = "INSERT INTO " . $this->table . " (FullName, username, email, phoneNo, password, address, createdDate)
                VALUES ('{$data['fullname']}', '{$data['username']}', '{$data['email']}', '{$data['phone']}', '{$data['password']}', '{$data['address']}', '{$createdDate}')";

        return $this->conn->query($sql);
    }


   public function emailExists($email) {
     $sql = "SELECT id FROM user WHERE email = ?";
     $stmt = $this->conn->prepare($sql);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->store_result();
     return $stmt->num_rows > 0;
    }

    public function phoneExists($phone) {
        $sql = "SELECT id FROM user WHERE phoneNo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }


    public function login($email, $password) {
        $sql = "SELECT id, FullName, username, email, phoneNo, password 
                FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $password) { // plain text check
                return $row;
            }
        }
        return false;
    }


    public function getUserById($id) {
    $sql = "SELECT id, FullName, username, email, phoneNo, address FROM " . $this->table . " WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}



public function updateUser($id, $fullname, $username, $email, $phone, $address) {
    $sql = "UPDATE user SET FullName=?, username=?, email=?, phoneNo=?, address=? WHERE id=?";
    $stmt = $this->conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $this->conn->error);
    }
    $stmt->bind_param("sssssi", $fullname, $username, $email, $phone, $address, $id);
    return $stmt->execute();
}


public function updatePassword($userid, $newPassword) {
    $sql = "UPDATE user SET password = ? WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("si", $newPassword, $userid);
    return $stmt->execute();
}






}
?>
