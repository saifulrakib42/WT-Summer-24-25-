<?php
session_start();
include '../DB/admindata.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // PHPMailer

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['sendOtp'])) {
    $email = $_POST['email'];
    $conn = createConnObj();

    $result = findAdminByEmail($conn, $email);

    if ($result && mysqli_num_rows($result) == 1) {
        $otp = rand(100000, 999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        saveOTP($conn, $email, $otp, $expiry);

        // PHPMailer
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0; // Change to 2 for debugging
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'saifulrakib4296@gmail.com'; // Your Gmail
        $mail->Password = 'kxncqvgakqzzaeyf';         // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('saifulrakib4296@gmail.com', 'YourSiteName');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset OTP';
        $mail->Body = "Your OTP code is: <b>$otp</b>. It expires in 10 minutes.";

        try {
            $mail->send();
            $_SESSION['reset_email'] = $email;
            header("Location: ../View/verify_otp.php");
            exit();
        } catch (Exception $e) {
            $message = "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    } else {
        $message = "Email not found!";
    }

    mysqli_close($conn);
}
?>
