<?php
session_start();
require '../config/db.php';
$conn = (new Database())->getConnection();

// Fetch all products initially
$sql = "SELECT * FROM products WHERE IsRemove = 0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products - ShopEase</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/Products.css">
</head>
<body>

<?php include 'NavbarAfterLogin.php'; ?>

<div class="container content">
    <h2 class="text-center mb-4">Our Products</h2>

    <!-- Search Bar -->
    <div class="mb-4 d-flex justify-content-center">
        <input type="text" id="search" class="form-control w-50" placeholder="Search products...">
    </div>

    <!-- Products Grid -->
    <div class="row g-4" id="products-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <a href="product.php?id=<?php echo $product['id']; ?>" style="text-decoration:none; color:inherit;">
                        <div class="card shadow h-100">
                            <img src="<?php echo htmlspecialchars($product['ProductImage']); ?>" class="card-img-top product-image" alt="<?php echo htmlspecialchars($product['Name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['Name']); ?></h5>
                                <p class="card-text">Price: ৳<?php echo number_format($product['UnitPrice'], 2); ?></p>
                                <?php if ($product['InventoryQuantity'] > 0): ?>
                                    <span class="badge bg-success">In Stock</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Out of Stock</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <p>No products available.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="../js/products.js"></script>



</body>
</html>
