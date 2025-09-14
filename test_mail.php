<?php
// test_mail.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php'; // make sure path is correct

$mail = new PHPMailer(true);

try {
    // Enable verbose debug output
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'saifulrakib4296@gmail.com'; // your Gmail
    $mail->Password   = 'kxncqvgakqzzaeyf';             // your 16-char app password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('saifulrakib4296@gmail.com', 'Saiful Rakib');
    $mail->addAddress('saifulrakib4296@gmail.com', 'Saiful Rakib'); // test sending to yourself

    $mail->isHTML(true);
    $mail->Subject = 'Test OTP Mail';
    $mail->Body    = '<b>This is a test OTP email!</b>';

    $mail->send();
    echo 'Message has been sent successfully!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
