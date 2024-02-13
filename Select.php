<?php
session_start();
include("config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected values from the form and store in session
    $_SESSION['serviceName'] = $_POST['serviceName'];
    $_SESSION['individualService'] = $_POST['individualService'];
    $_SESSION['subscriptionPeriod'] = $_POST['subscriptionPeriod'];

    // Redirect the user to a confirmation page or wherever you want
    header("Location: subscription3.php");
    exit;
}

$sqlSelect = "SELECT serviceName, individualService FROM product";
$result = mysqli_query($conn, $sqlSelect);
$row = mysqli_fetch_assoc($result);
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  
  <link href="assets/css/selectStyle8.css" rel="stylesheet">

  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.html">IDP</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
        <li class="dropdown megamenu"><a href="#"><span>Products</span></a>
            <ul>
              <li>
                <a href="#">IDP.Excel.Execalcalculator2API</a>
                <a href="#">IDP.Insurance.Instructions.Analyze</a>
                <a href="#">Column 1 link 3</a>
              </li>
              <li>
                <a href="#">Column 2 link 1</a>
                <a href="#">Column 2 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Purchase</span></i></a>
            <ul>
              <li><a href="#">Buy Now</a></li>
              <li><a href="#">Pricing Information</a></li>
              <li><a href="#">Free Trials</a></li>
              <li><a href="#">Temporary License</a></li>
              <li><a href="#">Policies</a></li>
              <li><a href="#">My Order</a></li>
              <li><a href="#">Renew an Order</a></li>
              <li><a href="#">Upgrade an order</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto " href="#portfolio">support</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">More</a></li>
          <a href="login.php">
          <button class="p2">
            <img src="image/acct.png" alt="">
          </button>
          </a>
          <button class="p3"><img src="image/se.png" alt="" class="img"></button>
        </ul>
        
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
          
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
  <span class="span1">1</span>
  <p class="p51">Select Service family and individual service</p>

  <span class="span2">2</span>
  <p class="p52">View and Select subscription plan</p>

  <span class="span3">3</span>
  <p class="p53">Make payment</p>

  <span class="span4">4</span>
  <p class="p54">Verify your payment</p>

  <span class="span5">5</span>
  <p class="p55">Upload your first Excel calculator</p>

  <span class="span6">6</span>
  <p class="p56">Review and update your Excel calculator</p>

  <span class="span7">7</span>
  <p class="p57">Add another Excel Calculator by clicking add Excel or proceed to your product dashboard by clicking
    My Products</p>

 



  <h6>Service category</h6>
 <!-- index.html -->
 <form action="" method="post" onsubmit="return validateForm();">
    <div class="product">
        <span>1</span>
        <span class="sp"></span>
        <label>Select a service Family</label>
        <select name="serviceName" id="serviceName">
            <option value="">Select a service Family</option> <!-- Add an empty option -->
            <option value="Excel2code"<?php if ($row['serviceName'] === 'Excel2code') echo 'selected'; ?>>Excel2codeAPI</option>
            <option value="Excelform"<?php if ($row['serviceName'] === 'Excelform') echo 'selected'; ?>>Excel2WebForm</option>
        </select>
    </div>

    <div class="product">
        <span>2</span>
        
        <label>Select an Individual Service</label>
        <select name="individualService" id="individualService">
            <option value="">Select an Individual service</option> <!-- Add an empty option -->
            <option value="Insurance" <?php if ($row['individualService'] === 'Insurance') echo 'selected'; ?>>Insurance</option>
            <option value="Excelform" <?php if ($row['individualService'] === 'Excelform') echo 'selected'; ?>>Excel2WebForm</option>
        </select>
    </div>
    <button class="bt" type="submit">Proceed</button>
</form>
   <img src="image/pp2.png" alt="">
   <p class="pp1">Service category and the specific service solution.</p>
   <p class="pp3">service A</p>
   <p class="pp2">service B</p>
   <p class="pp4">service C</p>
  </section><!-- End Hero -->

 

  <main id="main">

  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Techie</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container">

      <div class="copyright-wrap d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
          <div class="copyright">
            &copy; Copyright <strong><span>Techie</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/techie-free-skin-bootstrap-3/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
          <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
          <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
          <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
          <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!--<div id="preloader"></div>-->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    function validateForm() {
        var serviceName = document.getElementById('serviceName').value;
        var individualService = document.getElementById('individualService').value;

        if (serviceName === '' || individualService === '') {
            alert('Please select a Product Family and an Individual Product before proceeding.');
            return false;
        }
        return true;
    }
</script>


</body>

</html>






<span class="span2">1</span>
  <p class="p52">View and Select subscription plan</p>

  <span class="span3">2</span>
  <p class="p53">Make payment</p>

  <span class="span4">3</span>
  <p class="p54">Verify your payment</p>

  <span class="span5">4</span>
  <p class="p55">Upload your first Excel calculator</p>

  <span class="span6">5</span>
  <p class="p56">Review and update your Excel calculator</p>

  <span class="span7">6</span>
  <p class="p57">Add another Excel Calculator by clicking add Excel or proceed to your product dashboard by clicking
    My Products</p>