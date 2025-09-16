<?php
require_once '../config/db.php';
require_once '../model/user.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if(isset($_POST['type']) && isset($_POST['value'])) {
    $type = $_POST['type'];
    $value = $_POST['value'];

    if($type === 'email') {
        if($user->emailExists($value)) {
            echo 'exists';
        } else {
            echo 'not exists';
        }
    }
    if($type === 'phone') {
        if($user->phoneExists($value)) {
            echo 'exists';
        } else {
            echo 'not exists';
        }
    }
}
?>
