<?php
session_start();
include '../DB/admininfodata.php';

$admindata = null; // initialize

if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];

    $conn = createConnObj();
    $result = selectAdmin($conn, $id);

    if ($result && mysqli_num_rows($result) === 1) {
        $admindata = mysqli_fetch_assoc($result);
    }

    closeConn($conn);
}
?>
