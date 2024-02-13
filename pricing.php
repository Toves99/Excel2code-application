<?php
session_start();

if (isset($_POST['proceed'])) {
    $count = $_POST['count'];
    $_SESSION['count'] = $count;
    

    // Calculate the total cost based on the input and store it in the session
    $totalCost = $count * 1000000;
    $_SESSION['totalCost'] = $totalCost;
    $_SESSION['costPerUnit'] = '1,000,000';
}
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

  
  <link href="assets/css/subscribe2.css" rel="stylesheet">

  
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
  <?php
session_start(); // Start the PHP session

// Check if the form has been submitted and update session variables if needed
if (isset($_POST['productType']) && isset($_POST['subscriptionPeriod'])) {
    $_SESSION['productName'] = 'IDP.Excel.Execalcalculator2API'; // Example product name
    $_SESSION['productType'] = $_POST['productType'];
    
}
?>
  <section id="hero" class="d-flex align-items-center">
    <div class="dire">
      <p>Purchase/ Pricing</p>
      <p class="p">View MyOrders</p>
    </div>
  <div class="msg1" style="display: none;">
  <select id="rateSelect" onchange="updateCostPerCalculator()">
  <option value="1">1</option>
  <option value="2-5">3</option>
  <option value="6-10">6</option>
  <option value="10 and above">12</option>
    </select>
    <p>Cost per Excel Calculator upload:</p>
    <input type="number" placeholder="Enter number of calculator">
    <p class="p11">The Total Amount you need to pay is:</p>
    <a href="uploadExcel.php">
    <button class="bt3">Proceed</button>
    </a>
  </div>
  <div class="buttons1">
  <button class="b active" onclick="activateButton(this)">6 months Subscription</button>
  <a href="subscription3.php">
  <button class="b1" onclick="activateButton(this)">12 months Subscription</button>
  </a>
  </div>
  <div class="cont1">
  <div class="box">
        <span>IDP.Excel.Excel2API rate 1</span>
        <div class="ksh" style="background-color: lightblue;">
            <p>KSh 1,000,000</p>
            <p class="s">Cost per Excel calculator</p>
            <img src="image/ldown.png" alt="">
        </div>
        <p id="sp">1 Calculator upload only</p>
        <p id="sp1">Expires after 6 months from the day of subscription</p>
        <p id="sp2">Renewable after expiration period</p>
        <div id="d1" style="display: none;">
            <button id="hide">&#10006;</button>
            <div id="d11">
          <form method="post" action="selectpricing.php">
          <label>Enter exact number of calculator:</label>
          <input type="number" id="calculatorCount1" name="count" placeholder="Enter exact Number of calculator" min="1" max="1" step="1" value="1">
          <h4 id="costPerUnit">KSh 1,000,000 per unit</h4>
          <h4 id="totalCost1">Total cost: <span>1000,000</span></h4>
          <p style="color:transparent;position:absolute;">6</p>
          <button type="submit" id="bt11" name="proceed">proceed</button>
         </form>
        </div>
        </div>
        <button id="orderNow">Order Now</button>
    </div>
    <div class="box">
    <span>IDP.Excel.Excel2API rate 2-5</span>
      <div class="ksh" style="background-color:#54C571;">
        <p>KSh 60,000</p>
        <p class="s">Cost per Excel calculator</p>
        <img src="image/ldown1.png" alt="">
      </div>
      <p id="sp">2-5 Calculator uploads </p>
      <p id="sp1">Expires after 6 month from the day of subscription</p>
      <p id="sp2">Renewable after expiration period</p>
      <div id="d2" style="display: none;">
      <button id="hide1">&#10006;</button>
      <div id="d11">
    <label>Enter exact number of calculator 2-5:</label>
    <input type="number" id="calculatorCount" placeholder="Slect exact Number of calculator" min="2" max="5" step="1">
    <h4>KSh 60,000 per unit</h4>
    <h4 id="totalCost">Total cost:<span></span></4>
    <p style="color:transparent;position:absolute;">6</p>
    <a href="selectpricing.php">
    <button id="bt12">proceed</button>
    </a>
    </div>
      </div>
      <button id="orderNow1">Order Now</button>
    </div>
    <div class="box">
    <span>IDP.Excel.Excel2API rate 6-10</span>
      <div class="ksh" style="background-color:#872657;">
        <p>KSh 90,000</p>
        <p class="s">Cost per Excel calculator</p>
        <img src="image/ldown2.png" alt="">
      </div>
      <p id="sp">6-10 Calculator upload only</p>
      <p id="sp1">Expires after 6 month from the day of subscription</p>
      <p id="sp2">Renewable after expiration period</p>
      <div id="d3" style="display: none;">
      <button id="hide2">&#10006;</button>
      <div id="d11">
        <label>Enter exact number of calculator 6-10:</label>
        <input type="number" id="calculatorCount3" placeholder="Slect exact Number of calculator" min="6" max="10" step="1" >
        <h4>KSh 90,000 per unit</h4>
        <h4 id="totalCost3">Total cost:<span></span></h4>
        
        <p style="color:transparent;position:absolute;">6</p>
        <a href="selectpricing.php">
        <button id="bt11">proceed</button>
        </a>
         </div>
      </div>
      <button id="orderNow2">Order Now</button>
    </div>
    <div class="box">
    <span>IDP.Excel.Excel2API rate 10 and above</span>
      <div class="ksh" style="background-color:#B5A642;">
        <p>KSh 600,000</p>
        <p class="s">Cost per Excel calculator</p>
        <img src="image/ldown3.png" alt="">
      </div>
      <p id="sp">Above 10 Calculator uploads</p>
      <p id="sp1">Expires after 6 month from the day of subscription</p>
      <p id="sp2">Renewable after expiration period</p>
      <div id="d4" style="display: none;">
      <button id="hide3">&#10006;</button>
      <div id="d11">
        <label>Enter exact number of calculator:</label>
        <input type="number" id="calculatorCount4" placeholder="Enter exact Number of calculator" min="10" max="1000" step="1" value="10">
        <h4>KSh 600,000 per unit</h4>
        <h4 id="totalCost4">Total cost:<span></span></h4>
        <p style="color:transparent;position:absolute;">6</p>
        <a href="selectpricing.php">
        <button id="bt11">proceed</button>
        </a>
         </div>
      </div>
      <button id="orderNow3">Order Now</button>
    </div>
    
  </div>
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
  <script src="assets/js/select.js"></script>
  <script>
    // Get references to the input and totalCost elements
    const calculatorCountInput = document.getElementById("calculatorCount");
    const totalCostElement = document.getElementById("totalCost").querySelector("span");

    // Add an event listener to the input field
    calculatorCountInput.addEventListener("input", updateTotalCost);

    // Function to update the total cost
    function updateTotalCost() {
        const count = parseInt(calculatorCountInput.value, 10);
        if (!isNaN(count)) {
            const totalCost = count * 60000;
            totalCostElement.textContent = totalCost;
            

            // Send values to a PHP script using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "store_values2.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("count=" + count + "&totalCost=" + totalCost);
        }
    }

    // Initialize the total cost with the default value (2) on page load
    updateTotalCost();
</script>

<script>
    // Get references to the input and totalCost elements
    const calculatorCountInput3 = document.getElementById("calculatorCount3");
    const totalCostElement3 = document.getElementById("totalCost3").querySelector("span");

    // Add an event listener to the input field
    calculatorCountInput3.addEventListener("input", updateTotalCost3);

    // Function to update the total cost
    function updateTotalCost3() {
        const count3 = parseInt(calculatorCountInput3.value, 10);
        if (!isNaN(count3)) {
            const totalCost3 = count3 * 90000;
            totalCostElement3.textContent = totalCost3;
            

            // Send values to a PHP script using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "store_values1.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("count=" + count3 + "&totalCost=" + totalCost3);
        }
    }

    // Initialize the total cost with the default value (2) on page load
    updateTotalCost3();
</script>


<script>
    // Get references to the input and totalCost elements
    const calculatorCountInput4 = document.getElementById("calculatorCount4");
    const totalCostElement4 = document.getElementById("totalCost4").querySelector("span");
    

    // Add an event listener to the input field
    calculatorCountInput4.addEventListener("input", updateTotalCost4);

    // Function to update the total cost
    function updateTotalCost4() {
        const count4 = parseInt(calculatorCountInput4.value, 10);
        if (!isNaN(count4)) {
            const totalCost4 = count4 * 600000;
            totalCostElement4.textContent = totalCost4;
            // Send values to a PHP script using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "store_values.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("count=" + count4 + "&totalCost=" + totalCost4);
        }
    }

    // Initialize the total cost with the default value (10) on page load
    updateTotalCost4();
</script>




</body>

</html>