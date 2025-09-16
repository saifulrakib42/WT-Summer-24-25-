<?php
session_start();
require '../config/db.php';
$conn = (new Database())->getConnection();

// Get product ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$productId = intval($_GET['id']);

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ? AND IsRemove = 0");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Product not found!";
    exit();
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['Name']); ?> - ShopEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/product.css" rel="stylesheet">
</head>
<body>
    <?php include 'NavbarAfterLogin.php'; ?>

    <div class="container content">
        <div class="card shadow p-4">
            <img src="<?php echo htmlspecialchars($product['ProductImage']); ?>" class="product-image" alt="<?php echo htmlspecialchars($product['Name']); ?>">
            <div class="card-body">
                <h3 class="card-title"><?php echo htmlspecialchars($product['Name']); ?></h3>
                <p class="card-text"><?php echo htmlspecialchars($product['Description']); ?></p>
                <h4>Price: ৳<?php echo number_format($product['UnitPrice'], 2); ?></h4>
                <?php if ($product['InventoryQuantity'] > 0): ?>
                    <span class="badge bg-success mb-3">In Stock</span>
                <?php else: ?>
                    <span class="badge bg-danger mb-3">Out of Stock</span>
                <?php endif; ?>
                
               <div class="d-grid gap-3 mt-3">
                   <form method="POST" action="../controller/add_to_cart.php">
                      <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                      <button type="submit" style="width: 518px;" class="btn btn-modern btn-primary" <?php echo $product['InventoryQuantity'] == 0 ? 'disabled' : ''; ?>>
                                  Add to Cart
                      </button>
                   </form>                 
                   <form method="POST" action="../controller/add_to_wishlist.php">
                      <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                      <button type="submit" style="width: 518px;" class="btn btn-modern btn-outline-secondary">
                        Add to Wishlist
                      </button>
                   </form>   
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
