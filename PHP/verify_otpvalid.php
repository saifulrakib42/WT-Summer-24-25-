<?php
// verify_otpvalid.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../DB/admindata.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verifyOtp'])) {

    // 1) Make sure we have the email in session
    if (!isset($_SESSION['reset_email']) || empty($_SESSION['reset_email'])) {
        die(" Session expired. No email found in session. Please request a new OTP.");
    }

    $email = $_SESSION['reset_email'];
    $otp   = trim($_POST['otp']);

    $conn = createConnObj();

    // 2) Safely build and run query (no NOW() alias here)
    $safeEmail = mysqli_real_escape_string($conn, $email);
    $sql = "SELECT reset_otp, otp_expiry FROM register WHERE email = '$safeEmail' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Show DB error and the query for debugging
        die(" SQL Error: " . mysqli_error($conn) . "<br>Query: " . htmlspecialchars($sql));
    }

    if (mysqli_num_rows($result) === 0) {
        die(" No user found with email: " . htmlspecialchars($email));
    }

    $row = mysqli_fetch_assoc($result);

    // DEBUG OUTPUT — remove this after you finish testing
    echo "<pre style='background:#f6f6f6;padding:10px;border:1px solid #ddd;'>";
    echo "DEBUG DATA:\n";
    print_r($row);
    echo "User Input OTP: " . htmlspecialchars($otp) . "\n";
    echo "Server Now (PHP): " . date("Y-m-d H:i:s") . "\n";
    echo "</pre>";

    $dbOtp = isset($row['reset_otp']) ? $row['reset_otp'] : null;
    $otpExpiry = isset($row['otp_expiry']) ? $row['otp_expiry'] : null;

    // 3) Validate presence
    if (empty($dbOtp) || empty($otpExpiry)) {
        $message = " No OTP stored or expiry missing. Please request a new OTP.";
    } else {
        // 4) Compare times using PHP to avoid server timezone mismatch
        $now = time();
        $expiryTs = strtotime($otpExpiry);

        if ($expiryTs === false) {
            $message = " Invalid expiry format in DB. Please request a new OTP.";
        } elseif ($now > $expiryTs) {
            $message = " OTP has expired. Please request a new OTP.";
        } elseif ($otp === $dbOtp) {
            //  valid: clear the otp, then redirect to reset page
            $clear = "UPDATE register SET reset_otp = NULL, otp_expiry = NULL WHERE email = '$safeEmail'";
            mysqli_query($conn, $clear);
            mysqli_close($conn);
            header("Location: reset_password.php");
            exit();
        } else {
            $message = " Invalid OTP. Please try again.";
        }
    }

    mysqli_close($conn);
}
?>
