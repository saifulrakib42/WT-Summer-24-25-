
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
      <span class="navbar-brand fw-bold mb-0 text-white">ShopEase</span>
    </a>

    <!-- Center: Links -->
    <ul class="navbar-nav mx-auto d-flex flex-row gap-4">
      <li class="nav-item"><a class="nav-link active text-white" href="../view/LandingPage.php">Home</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#">Products</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#">About</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#">Contact</a></li>
    </ul>

    <!-- Right: Buttons -->
    <div class="d-flex align-items-center gap-2">
      <a class="btn btn-primary" href="../view/Login.php">Login</a>
      <a class="btn btn-primary" href="../view/Registration.php">Registration</a>
    </div>

  </div>
</nav>