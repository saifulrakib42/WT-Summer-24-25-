<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user']; // contains user data from login
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/userDashboard.css" rel="stylesheet">

</head>
<body>
    <!-- Navbar -->
    <?php include 'NavbarAfterLogin.php'; ?> 


    <!-- Dashboard Content -->
    <div class="container content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow p-4">
                    <h3 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?> 🎉</h3>
                    <p class="text-center">You are now logged in with email: <b><?php echo htmlspecialchars($_SESSION['email']); ?></b></p>
                    <hr>
                    <p class="text-center">This is your dashboard. From here, you can manage your profile, view data, or perform other tasks.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
