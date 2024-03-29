      <?php 
        session_start();

            // echo '<pre>';
            // var_dump($_SESSION);
            // echo '</pre>';

        require_once('db/DbConnect.php');
        $db   = new DbConnect();
        $conn = $db->connect();
            
        require 'classes/cart.class.php';
        $objCart = new cart($conn);
        $customer['id'] = ($_SESSION['cid'] !== null) ? $objCart->setCid($_SESSION['cid']) : 0;
        // check
        $cartItems = ($_SESSION['cid'] !== null) ? $objCart->getAllCartItems() : [];

      ?>



    <link rel= apple-touch-icon type= image/png href= https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png />
    <link rel= shortcut icon type= image/x-icon href= https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico />
    <link rel= mask-icon type= image/x-icon href= https://cpwebassets.codepen.io/assets/favicon/logo-pin-b4b4269c16397ad2f0f7a01bcdf513a1994f4c94b8af2f191c09eb0d601762b1.svg color= #111 />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>E-commerce Cart</title>
  
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/boxicons@2.0.2/css/boxicons.min.css'>
  <link rel='stylesheet' href='nav/nav.css'>


  <script>
    window.console = window.console || function(t) {};
  </script>

  <script>
    window.console = window.console || function(t) {};
  </script>


<body translate="no">
  <div class="overlay"></div>

<div class="utility-nav d-none d-md-block">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6">
        <p class="small"><i class="bx bx-envelope"></i> logo@example.com | <i class="bx bx-phone"></i> +91-9876543210
        </p>
      </div>

      <div class="col-12 col-md-6 text-right">
        <p class="small">Free shipping on total of $99 of all products</p>
      </div>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-md navbar-light bg-light main-menu" style="box-shadow:none">
  <div class="container">

    <button type="button" id="sidebarCollapse" class="btn btn-link d-block d-md-none">
                <i class="bx bx-menu icon-single"></i>
            </button>

    <a class="navbar-brand" href="#">
      <img src="images/logo-udemy.svg" data-holder-rendered="true" height="42" style="width: auto;" />
    </a>

    <ul class="navbar-nav ml-auto d-block d-md-none">
      <li class="nav-item">
        <a class="cart btn btn-link" href="cart.php"><i class="bx bxs-cart icon-single"></i> <sup id="itemCountMobile" class="badge badge-danger"><?php echo count($cartItems); ?></sup></a>
      </li>
    </ul>

    <div class="collapse navbar-collapse">
    <form class="form-inline my-2 my-lg-0 mx-auto">
    <input class="form-control" type="search" placeholder="Search for products..." aria-label="Search">
    <button class="btn btn-success my-2 my-sm-0 h-100" type="submit"><i class="bx bx-search"></i></button>
</form>


      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="cart btn btn-link" href="cart.php"><i class="bx bxs-cart icon-single"></i> <sup id="itemCount" class="badge badge-danger"><?php echo count($cartItems); ?></sup></a>
        </li>
        <li class="nav-item ml-md-3">
          <a class="btn btn-primary" href="#"><i class="bx bxs-user-circle mr-1"></i> Log In / Register</a>
        </li>
      </ul>
    </div>

  </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light bg-light sub-menu">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item  active">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Support
                        </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Delivery Information</a>
            <a class="dropdown-item" href="#">Privacy Policy</a>
            <a class="dropdown-item" href="#">Terms &amp; Conditions</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="search-bar d-block d-md-none">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form class="form-inline mb-3 mx-auto">
          <input class="form-control" type="search" placeholder="Search for products..." aria-label="Search">
          <button class="btn btn-success" type="submit"><i class="bx bx-search"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Sidebar -->
<nav id="sidebar">
  <div class="sidebar-header">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-10 pl-0">
          <a class="btn btn-primary" href="#"><i class="bx bxs-user-circle mr-1"></i> Log In</a>
        </div>

        <div class="col-2 text-left">
          <button type="button" id="sidebarCollapseX" class="btn btn-link">
                            <i class="bx bx-x icon-single"></i>
                        </button>
        </div>
      </div>
    </div>
  </div>

  <ul class="list-unstyled components links">
    <li class="active">
      <a href="#"><i class="bx bx-home mr-3"></i> Home</a>
    </li>
    <li>
      <a href="#"><i class="bx bx-carousel mr-3"></i> Products</a>
    </li>
    <li>
      <a href="#"><i class="bx bx-book-open mr-3"></i> Schools</a>
    </li>
    <li>
      <a href="#"><i class="bx bx-crown mr-3"></i> Publishers</a>
    </li>
    <li>
      <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bx bx-help-circle mr-3"></i>
                    Support</a>
      <ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
          <a href="#">Delivery Information</a>
        </li>
        <li>
          <a href="#">Privacy Policy</a>
        </li>
        <li>
          <a href="#">Terms &amp; Conditions</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#"><i class="bx bx-phone mr-3"></i> Contact</a>
    </li>
  </ul>

  <h6 class="text-uppercase mb-1">Categories</h6>
  <ul class="list-unstyled components mb-3">
    <li>
      <a href="#">Category 1</a>
    </li>
    <li>
      <a href="#">Category 1</a>
    </li>
    <li>
      <a href="#">Category 1</a>
    </li>
    <li>
      <a href="#">Category 1</a>
    </li>
    <li>
      <a href="#">Category 1</a>
    </li>
    <li>
      <a href="#">Category 1</a>
    </li>
  </ul>

  <ul class="social-icons">
    <li><a href="#" target="_blank" title=""><i class="bx bxl-facebook-square"></i></a></li>
    <li><a href="#" target="_blank" title=""><i class="bx bxl-twitter"></i></a></li>
    <li><a href="#" target="_blank" title=""><i class="bx bxl-linkedin"></i></a></li>
    <li><a href="#" target="_blank" title=""><i class="bx bxl-instagram"></i></a></li>
  </ul>

</nav>


  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script> -->
  <script src='nav/nav.js'></script>
  

