<?php
session_start();
include("config.php");
include("excelconfigfetch.php");
$orderId = $_SESSION['id'];
$username=$_SESSION['username'];
$user_id=$_SESSION['userId'];
$email=$_SESSION['email'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
$orderId=$_GET['orderid'];
$productid=$_GET['productid'];
$packagename=$_GET['packagename'];
$expirydate=$_GET['expirydate'];
$username =null;
$password = null;
$companyid=$_SESSION['companyid'];
$serviceid =$_SESSION['serviceid'];


$productexcelvariables  = fetchExcelProductVariables
($username, $password, $productid,$orderId, $companyid,$serviceid);

if ($result === FALSE) {
  die('Error occurred while making the request');
}
$responseArray  = json_decode($result,true);
$transactionstatuscode = $responseArray['response']['status']['transactionstatuscode'];
$httpstatuscode= $responseArray['response']['status']['httpstatuscode'];
     if($httpstatuscode != 200 || $transactionstatuscode!=200){
     
     die('Error occurred while making the request');
     
   }


$productvariables = $responseArray['response']['data']; 
$GLOBALS['CURRENT_PRODUCT_VARIABLES']=$productvariables;

$inputvariables = $productvariables ['input'];
$outputvariables = $productvariables ['input'];

$simpleinputvariables = array();
$simpleoutputvariables = array();
$simpleproductvariables = array();
  
//fetch product variables

/*
session_start();
include("config.php");

// Check if 'orderId' is set in the session
if (isset($_SESSION['id'])) {
  $orderId = $_SESSION['id'];
  //echo "orderId from the session: " . $orderId;
} else {
  echo "orderId is not set in the session.";
}*/
$displaymessagequery="SELECT * FROM users,message WHERE users.userId=message.userId AND users.userId=$user_id";
$allusersmessages=$conn->query($displaymessagequery);
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

  
  <link href="apiimplementaionspecs.css" rel="stylesheet">
 
  <style>
  /* Style the tab */
.tab {
	
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: maroon;
  
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  color:white;
  cursor: pointer;
  padding: 12px 129px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: black;
  color:white;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-top: none;
  background-color:#f4f4f4;
  max-height: 400px; /* Set a maximum height for the content */
  overflow-y: auto;
}
.tabcontent h3{
	text-align:center;
}
.tabcontent p{
	text-align:center;
	width:50%;
	margin-left:250px;
	font-size:15px;
	
}
.ttab{
	position:absolute;
	margin-top:130px;
	margin-left:250px;
	width:900px;
	background-color:#f4f4f4;
}
 </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="index.html">excel2code</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
        <li class="dropdown"><a href="#"><span>Products</span></i></a>
            <ul>
              <li><a href="services.php">Execal2code</a></li>
             
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
          <li class="dropdown"><a href="#"><span>Support</span></i></a>
            <ul>
            <li><a href="services.php">API Reference</a></li>
              <li><a href="services1.php">Live Demos</a></li>
              <li><a href="services1.php">Code Samples</a></li>
              <li><a href="services1.php">New Releases</a></li>
            </ul>
          </li>
		  
		  
          <li class="dropdown"><a href="#"><span>More</span></i></a>
            <ul>
              <li><a href="services.php">About Us</a></li>
              <li><a href="contact.php">Contact Us</a></li>
            </ul>
          </li>
        </ul>
        
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
          <?php
          $select_rows = mysqli_query($conn, "SELECT * FROM users, message where users.userId=message.userId AND users.userId=$user_id") or die('query failed');
          $row_count = mysqli_num_rows($select_rows);
           ?>
          <button class="p2" id="p2Button">
            <img src="image/noti.png" alt="" class="img1">
            <p style="margin-left:50px;margin-top:-40px;position:absolute;font-weight:bold;color:white;background-color:maroon;border-radius:60px;width:20px;font-family:Garamond;"><?php echo $row_count   ?></p>
          </button>
          
          <button class="p3" id="p3Button"><img src="image/account.png" alt="" class="img"></button>
        <p class="p4"><?php echo $name;  ?></p>
        <div id="accountDiv" style="position:absolute;width:210px;height:120px;background-color:white;margin-left:1010px;margin-top:180px;display:none;box-shadow:0 0 28px rgba(0,0,0,0.15);border-bottom-right-radius:5px;border-bottom-left-radius:5px;">
             <p style="position:absolute;margin-left:20px;margin-top:5px;color:black;">Logged In as<span style="margin-left:4px;font-weight:bold;color:black;font-size:18px;"><?php echo $username;  ?></span></p>
             <span style="position:absolute;margin-top:30px;background-color:lightgrey;height:1px;width:100%;color:transparent">t</span>
             <a href="updateprofile.php?direction=describe&orderid=<?php echo $orderId  ?>&productid=<?php echo $productid  ?>&packagename=<?php echo $packagename  ?>&expirydate=<?php echo $expirydate  ?>" style="position:absolute;margin-top:35px;margin-left:20px;font-size:15px;color:black;">Update Profile.</a>
             <span style="position:absolute;margin-top:58px;background-color:lightgrey;height:1px;width:100%;color:transparent">t</span>
             <a href="#" style="position:absolute;margin-top:65px;margin-left:20px;font-size:15px;color:black;">Help.</a>
             <span style="position:absolute;margin-top:90px;background-color:lightgrey;height:1px;width:100%;color:transparent">t</span>
             <a href="#" style="position:absolute;margin-top:95px;margin-left:20px;font-size:15px;color:black;">Logout.</a>
          </div>
    </div>
  </header><!-- End Header -->
  <div class="message" id="messageDiv">
		<p>Notifications</p>
		<span>d</span>
    
		<div class="cont">
    <?php
     if (mysqli_num_rows($allusersmessages) > 0) {
    while ($row = mysqli_fetch_assoc($allusersmessages)) {
    ?>
      <a href="#">
		<div class="box">
		<h3><?php echo $row['messagehead'] ?></h3>
    <p><?php echo $row['messagebody'] ?></p>
		</div>
    </a>
    <?php
    }
    } else {
    echo '<p>No Notifications.</p>';
    }
   ?>
		</div>
		</div>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
  <div class="menu1">
    <a href="#">
    <button class="btn5">My API</button>
    </a>
      <a href="productOrder.php?orderid=<?php echo $orderId  ?>">
      <button class="btn7">My Product</button>
      </a>
      <a href="#">
      <a href="dashboard.php">
      <button class="btn10">My order</button>
      </a>
      </a>
      
    </div>
 <!-- index.html -->
 <p style="position:absolute;margin-top:-1200px;margin-left:50px;color:black;">Order ID:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $orderId;  ?></span></p>
 <p style="position:absolute;margin-top:-1200px;margin-left:210px;color:black;">ProductId:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $productid;  ?></span></p>
 <p style="position:absolute;margin-top:-1200px;margin-left:450px;color:black;">Package:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $packagename;  ?></span></p>
 <p style="position:absolute;margin-top:-1200px;margin-left:620px;color:black;">Expiry Date:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $expirydate;  ?></span></p>
 <div class="menu">
 <button class="doc1">API Specs</button>

 <a href="myapi.php?orderid=<?php echo $orderId  ?>&productid=<?php echo $productid  ?>&packagename=<?php echo $packagename  ?>&expirydate=<?php echo $expirydate  ?>">
    <button class="des1">API Implementation</button>
    </a>
 </div>

 <div style="margin-top:-300px;margin-left:-500px;">
 <span style="position:absolute;margin-top:-320px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:18px;">1</span>
 <p style="position:absolute;margin-top:-320px;margin-left:80px;color:black;font-size:20px;font-weight:bold;">Product API EndPoint</p>
 <p style="position:absolute;margin-top:-290px;margin-left:100px;color:black;font-size:18px;">Below is your API End Point copy it and embed it in your application</p>
 <div style="position:absolute;margin-top:-260px;margin-left:100px;width:850px;height:40px;border:1px solid lightblue">
 <button style="position:absolute;margin-top:5px;margin-left:20px;width:70px;background-color:maroon;color:white;border:0;">URL</button>
 <p class="link2" style="position:absolute;margin-top:5px;margin-left:150px;color:blue;font-size:16px;">https://f2eb-105-161-170-72.ngrok-free.app/excelcode/configedit</p>
 <img src="image/copy.png" alt="" style="position:absolute;margin-top:5px;margin-left:800px;width:30px;" id="copyButton1">
 </div>
 </div>

 <div style="margin-top:510px;">
 <span style="position:absolute;margin-top:-320px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:18px;">2</span>
 <p style="position:absolute;margin-top:-320px;margin-left:80px;color:black;font-size:20px;font-weight:bold;">Product API Input Parameters</p>
 </div>

 <div style="margin-top:700px;">
 <span style="position:absolute;margin-top:-320px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:18px;">3</span>
 <p style="position:absolute;margin-top:-320px;margin-left:80px;color:black;font-size:20px;font-weight:bold;">Product API Output Parameters</p>
 </div>


 <div style="margin-top:900px;">
 <span style="position:absolute;margin-top:-320px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:18px;">4</span>
 <p style="position:absolute;margin-top:-320px;margin-left:80px;color:black;font-size:20px;font-weight:bold;">Product API Request Structure</p>
 </div>


 <div style="margin-top:1100px;">
 <span style="position:absolute;margin-top:-320px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:18px;">5</span>
 <p style="position:absolute;margin-top:-320px;margin-left:80px;color:black;font-size:20px;font-weight:bold;">Product API Response Structure</p>
 </div>


 <div style="margin-top:1300px;">
 <span style="position:absolute;margin-top:-320px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:18px;">6</span>
 <p style="position:absolute;margin-top:-320px;margin-left:80px;color:black;font-size:20px;font-weight:bold;">Language Specific Implementation</p>
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
  <script src="copycode.js"></script>

  <script>
    // Get references to the elements
    const copyButton = document.getElementById("copyButton1");
    const linkElement = document.querySelector(".link2");

    // Add a click event listener to the copy button
    copyButton.addEventListener("click", function () {
      // Create a new text area element to hold the text
      const textArea = document.createElement("textarea");
      textArea.value = linkElement.textContent;

      // Append the text area to the body
      document.body.appendChild(textArea);

      // Select the text in the text area and copy it to the clipboard
      textArea.select();
      document.execCommand("copy");

      // Remove the text area from the DOM
      document.body.removeChild(textArea);

      // Show an alert to indicate that the text has been copied
      alert("Copied: " + linkElement.textContent);
    });
  </script>
  
  
  <script>
  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

  // Trigger click event on the first tab button after the page has loaded
  window.onload = function () {
    document.querySelector('.tablinks').click();
  };
</script>
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js" integrity="sha512-tDoxNcR9EGOn3Fv5x+ZiT6H9vX12KhFH/DAah8Qx4qmgPW7Wja/09sYKnm3faN/uPRvSnp94xTCBfpSBZzgFqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Include Prism Line Numbers Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/line-numbers/prism-line-numbers.min.js" integrity="sha512-2hhoE/6vmZ/xz8J9CebVEuowbBo7Droj1lU01XOQDxVfvO7OuVcyF5/kdKWp1l0LDDXk8KwJjHmn4uu7KX7dAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var p2Button = document.getElementById('p2Button');
        var messageDiv = document.getElementById('messageDiv');

        // Toggle message div visibility when p2 button is clicked
        p2Button.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevents the click event from reaching the document
            messageDiv.style.display = (messageDiv.style.display === 'block') ? 'none' : 'block';
        });

        // Hide message div when clicking anywhere outside of it
        document.addEventListener('click', function () {
            messageDiv.style.display = 'none';
        });

        // Prevent the click on the message div from closing it
        messageDiv.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevents the click event from reaching the document
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        var p3Button = document.getElementById('p3Button');
        var accountDiv = document.getElementById('accountDiv');

        // Toggle message div visibility when p2 button is clicked
        p3Button.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevents the click event from reaching the document
            accountDiv.style.display = (accountDiv.style.display === 'block') ? 'none' : 'block';
        });

        // Hide message div when clicking anywhere outside of it
        document.addEventListener('click', function () {
          accountDiv.style.display = 'none';
        });

        // Prevent the click on the message div from closing it
        accountDiv.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevents the click event from reaching the document
        });
    });
</script>
 
</body>

</html>