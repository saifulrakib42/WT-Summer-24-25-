<?php
session_start(); 


include '../DB/admindata.php'; // model file for DB connection

// Initialize error variables
$fullnameError = $emailError =$genderError= $usernameError = $passwordError = $confirmPasswordError = $photoError = "";

// Initialize form field variables
$fullname = $email = $username = $password = $confirm_password = $gender = $photo = "";

// Validation flag
$isValid = true;

if (isset($_REQUEST["Register"])) {

    if (empty($_REQUEST["fullname"])) {
        $fullnameError = "Invalid fullname ";
        $isValid = false;
    } else {
        $fullname = $_REQUEST["fullname"];
        if (!preg_match("/^[A-Z][a-z]/", $fullname)) {
            $fullnameError = "Name must start with a capital letter and follow with lowercase letters, spaces allowed";
            $isValid = false;
        }
    }

    if (empty($_REQUEST["email"])) {
        $emailError = "Invalid email <br>";
        $isValid = false;
    } else {
        $email = $_REQUEST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format <br>";
            $isValid = false;
        }
    }

    if (empty($_REQUEST["username"])) {
        $usernameError = "username required";
        $isValid = false;
    } else {
        $username = $_REQUEST["username"];
        if (!preg_match("/^[a-z]+[0-9]/", $username)) {
            $usernameError = "name must start with lowercase letters, spaces not allowed <br>";
            $isValid = false;
        }
    }

    if (empty($_REQUEST["password"])) {
        $passwordError = "Password required";
        $isValid = false;
    } elseif (strlen($_REQUEST["password"]) < 4) {
        $passwordError = "Password must be at least 4 characters long";
        $isValid = false;
    } else {
        $password = $_REQUEST["password"];
    }

    if (empty($_REQUEST["confirm_password"])) {
        $confirmPasswordError = "Confirm Password required";
        $isValid = false;
    } elseif ($_REQUEST["confirm_password"] != $_REQUEST["password"]) {
        $confirmPasswordError = "Passwords do not match";
        $isValid = false;
    } else {
        $confirm_password = $_REQUEST["confirm_password"];
    }
     if (empty($_POST["gender"])) {
        $genderError = "Gender is required";
        $isValid = false;
    } else {
        $gender = $_POST["gender"];
    }
    //  File check (only get name & prepare path — don't move yet)
    if ($_FILES["photo"]["name"] == "") {
        $photoError = "Insert your profile picture";
        $isValid = false;
    } else {
        $rakib = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);  // <- Your name 😄
        $photo = time() . "." . $rakib;
        $uploadPath = "../img/" . $photo;
    }


    if ($isValid) {
         $conn = createConnObj();
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadPath)) {
            insertAdmin($conn, $fullname, $email, $username, $password, $photo,$gender );
            closeConn($conn);
            header("Location: ../view/login.php");
            exit();
        } else {
            $photoError = "File upload failed";
            closeConn($conn);
        }
    } else {
        if (isset($conn)) {
            closeConn($conn);
        }
    }
}
?>