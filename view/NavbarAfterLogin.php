<nav class="navbar navbar-expand-lg fixed-top"
     style="background: rgba(252, 244, 244, 0); 
            backdrop-filter: blur(10px); 
            -webkit-backdrop-filter: blur(10px); 
            box-shadow: 0 4px 30px rgba(0,0,0,0.1); 
            z-index: 1000;">
<div class="container-fluid d-flex align-items-center justify-content-between">
    
    <!-- Left: Circular Logo + Company Name -->
    <a class="d-flex align-items-center text-decoration-none" href="../view/LandingPage.php">
      <img src="../data/images/logo.png" alt="Logo" 
           style="height:40px; width:40px; margin-right:10px; border-radius:50%;">
      <span class="navbar-brand fw-bold mb-0 ">ShopEase</span>
    </a>

    <!-- Center: Links -->
    <ul class="navbar-nav mx-auto d-flex flex-row gap-4">
      <li class="nav-item"><a class="nav-link active" href="../view/UserDashboard.php">Dashboard</a></li>
      <li class="nav-item"><a class="nav-link " href="../view/Products.php">Products</a></li>
      <li class="nav-item"><a class="nav-link " href="../view/wishlist.php">WishList</a></li>
      <li class="nav-item"><a class="nav-link " href="../view/MyOrdersView.php">My Orders</a></li>
    </ul>

<div class="d-flex align-items-center gap-3">
    <!-- Cart Icon -->
    <a href="cart.php" class="position-relative">
        <img src="https://cdn-icons-png.flaticon.com/512/1170/1170678.png" alt="Cart" width="35" height="35" style="cursor:pointer;">
        <!-- Optional: Cart Item Count Badge -->
        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            3
        </span>
    </a>

    <!-- Profile Dropdown -->
    <div class="profile-dropdown position-relative">
        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="profile" width="40" height="40" class="rounded-circle dropdown-toggle" style="cursor:pointer;">
        <div class="dropdown-menu-custom position-absolute end-0 mt-2 p-2 bg-dark text-white rounded shadow" style="display:none; min-width:180px; z-index:10000;">
            <div class="fw-bold px-2 py-1 border-bottom">
                <?php echo $_SESSION['user'] ?? 'Guest'; ?>
            </div>
            <a href="../view/AccountSettings.php" class="px-2 py-1 d-block text-white text-decoration-none mt-1">Account Settings</a>  
            <a href="../controller/logout.php" class="text-danger px-2 py-1 d-block text-decoration-none mt-1">Logout</a>
        </div>
    </div>
</div>

  </div>
</nav>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    // Toggle dropdown on profile click
    $('.profile-dropdown img').click(function(e){
        e.stopPropagation();
        $('.dropdown-menu-custom').toggle();
    });

    // Hide dropdown when clicking outside
    $(document).click(function(){
        $('.dropdown-menu-custom').hide();
    });

    // Prevent closing when clicking inside dropdown
    $('.dropdown-menu-custom').click(function(e){
        e.stopPropagation();
    });
});
</script>
