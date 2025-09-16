<?php
require '../controller/WishlistController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Wishlist - ShopEase</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/wishlist.css" rel="stylesheet">

</head>
<body>
<?php include 'NavbarAfterLogin.php'; ?>

<div class="container mt-5">
    <h2>My Wishlist</h2>
    <?php if(empty($wishlistItems)): ?>
        <p class="text-center mt-5">Your wishlist is empty!</p>
    <?php else: ?>
        <div class="row">
            <?php foreach($wishlistItems as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="<?php echo htmlspecialchars($item['ProductImage']); ?>" class="product-image" alt="<?php echo htmlspecialchars($item['Name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['Name']); ?></h5>
                            <p class="card-text">৳<?php echo number_format($item['UnitPrice'], 2); ?></p>
                            <div class="d-grid gap-2">
                                <a href="product.php?id=<?php echo $item['id']; ?>" class="btn btn-primary btn-modern">View Product</a>
                                <a href="../controller/WishlistController.php?remove_id=<?php echo $item['id']; ?>" class="btn btn-danger btn-modern">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
