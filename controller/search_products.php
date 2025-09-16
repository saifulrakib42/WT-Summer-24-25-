<?php
session_start();
require '../config/db.php';
$conn = (new Database())->getConnection();

$search = '';
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

// Fetch products matching search query
if ($search != '') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE IsRemove = 0 AND Name LIKE ?");
    $like = "%{$search}%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM products WHERE IsRemove = 0";
    $result = $conn->query($sql);
}

// Return HTML for products
if ($result->num_rows > 0) {
    while ($product = $result->fetch_assoc()) {
        ?>
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
        <?php
    }
} else {
    echo '<div class="col-12 text-center"><p>No products found.</p></div>';
}
