<?php
include "config.php";


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: view.php"); // Refresh page
    exit;
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Products</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Product List</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Time</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["productname"]."</td>
                        <td>".$row["productid"]."</td>
                        <td>".$row["time"]."</td>
                        <td>
                            <a href='edit.php?id=".$row["id"]."' class='edit'>Edit</a>
                            <a href='view.php?delete=".$row["id"]."' class='delete' onclick=\"return confirm('Are you sure?');\">Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No products found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
