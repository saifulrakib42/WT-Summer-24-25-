<?php
require_once '../config/db.php';
require_once '../model/user.php';

class RegistrationController {
    private $user;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->user = new User($db);
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'fullname' => $_POST['FullName'],
                'username' => $_POST['username'],
                'email'    => $_POST['email'],
                'phone'    => $_POST['phone'],
                'password' => $_POST['password'],
                'address'  => $_POST['address']
            ];

            if ($this->user->register($data)) {
                header("Location: ../view/Registration.php?success=1");
                exit;
            } else {
                $error = "Error registering user.";
                require '../views/register.php';
            }
        } else {
            require '../views/register.php';
        }
    }
}

// Create instance and run
$controller = new RegistrationController();
$controller->register();
?>
