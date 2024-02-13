<?php
session_start();
//$orderId = $_SESSION['id'];
$username=$_SESSION['username'];
$user_id = $_SESSION['userId'];
$email=$_SESSION['email'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
include('config.php');

if(isset($_GET['action'])){
   $userction=$_GET['action'];
}
$userction=null;
$orderid=null;
if($userction =='myproducts'){
  $sqlordertb = "SELECT * FROM excelcalculatortb";
  $resultorder = mysqli_query($conn,$sqlordertb);
  $num=mysqli_num_rows($resultorder);
}
else {
if (isset($_GET['orderid'])) {
  $orderid = $_GET['orderid'];
}

if (isset($_GET['serviceid'])) {
  $serviceid = $_GET['serviceid'];
}
if (isset($_GET['companyname'])) {
  $companyname = $_GET['companyname'];
}
if (isset($_GET['companyid'])) {
  $companyid = $_GET['companyid'];
}

if (isset($_GET['differnce'])) {
  $differnce = $_GET['differnce'];
}

if (isset($_GET['productid'])) {
  $productid = $_GET['productid'];
}

if (isset($_GET['packagename'])) {
  $packagename = $_GET['packagename'];
}
if (isset($_GET['expirydate'])) {
  $expirydate = $_GET['expirydate'];
}
if (isset($_GET['productcategory'])) {
  $productcategory = $_GET['productcategory'];
}


if (isset($_GET['productname'])) {
  $productname = $_GET['productname'];
}

if (isset($_GET['totalunit'])) {
  $totalunit = $_GET['totalunit'];
}

$sqlordertb = "SELECT 
                    DATE_FORMAT(o.expirydate, '%Y-%m-%d') AS ExpiryDate,
                    o.paymentmessage,
                    o.packagename,
                    ec.productName,
                    ec.productCategory,
                    ec.productid,
                    ec.monthvalue,
                    o.serviceid,
                    ec.companyid,
                    u.companyname
                FROM 
                    excelcalculatortb ec
                JOIN 
                    users u ON ec.userId = u.userId
                JOIN 
                    orders o ON ec.orderid = o.orderid
                WHERE 
                    o.orderid = $orderid";
$resultorder = mysqli_query($conn,$sqlordertb);
$num=mysqli_num_rows($resultorder);

// Retrieve the 'difference' parameter from the URL
if (isset($_GET['difference'])) {
  $difference = intval($_GET['difference']);
} 

if (isset($_GET['apitest'])) {
  $userlastaction = $_GET['apitest'];
  
  // Check if 'apitest' parameter is present and has the value 'apitest'
  if ($userlastaction == 'apitest') {
    $difference = '';
  } else {
    // If 'apitest' is present but has a different value, use 'difference' parameter
    $difference = isset($_GET['difference']) ? intval($_GET['difference']) : 0; // Set a default value if 'difference' is not present
  }
} else {
  // If 'apitest' parameter is not present, check 'difference' parameter
  $difference = isset($_GET['difference']) ? intval($_GET['difference']) : 0; // Set a default value if 'difference' is not present
}
}





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

  
  <link href="assets/css/productstable3.css" rel="stylesheet">

  <style>
        /* Styles for the context menu */
        .context-menu {
            display: none;
            position: absolute;
            background-color: black;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width:170px;
            
        }

        .context-menu li {
            padding: 8px 10px;
            list-style: none;
            cursor: pointer;
            font-size:14px;
            color:white;
            margin-left:-30px;
            padding-left:20px;
        }

        .context-menu li:hover {
            background-color: maroon;
            color:white;
        }

        .calldiv{
        position: absolute;
        width:800px;
        height:250px;
        margin-top:130px;
        background-color:white;
        margin-left:20%;
        z-index: 991;
        display:none;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
       }
       #hide{
        margin-left:750px;
        margin-top:10px;
        background-color:transparent;
        border:0;
        position: absolute;
       color: red;
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
        <li class="dropdown"><a href="#"><span>Product</span></i></a>
            <ul>
              <li><a href="servicelogin.php">Execal2Code</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Purchase</span></i></a>
            <ul>
              <li><a href="subscription3.php">Buy Now</a></li>
              <li><a href="subscription3.php">Pricing Information</a></li>
              <li><a href="#">Free Trials</a></li>
              <li><a href="privacy.php">Policies</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Support</span></i></a>
            <ul>
            <li id="call"><a href="#"><img src="image/call1.png" alt="" style="height:30px;width:30px;position:absolute;margin-left:70px;margin-top:-3px;">
                Make A call</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>More</span></i></a>
            <ul>
              <li><a href="aboutus.php">About Us</a></li>
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
             <a href="updateprofile.php?direction=productOrder&orderid=<?php echo $orderid  ?>" style="position:absolute;margin-top:35px;margin-left:20px;font-size:15px;color:black;">Update Profile.</a>
             <span style="position:absolute;margin-top:58px;background-color:lightgrey;height:1px;width:100%;color:transparent">t</span>
             <a href="#" style="position:absolute;margin-top:65px;margin-left:20px;font-size:15px;color:black;">Help.</a>
             <span style="position:absolute;margin-top:90px;background-color:lightgrey;height:1px;width:100%;color:transparent">t</span>
             <a href="logout.php" style="position:absolute;margin-top:95px;margin-left:20px;font-size:15px;color:black;">Logout.</a>
          </div>
		
    </div>
  </header><!-- End Header -->
   
    <!-------calldiv------------------------------------>
    <div class="calldiv">
     <button id="hide">&#10006;</button>

     <h3 style="font-size:17px;font-weight:bold;margin-top:70px;margin-left:130px;position:absolute;text-decoration:underline;color:black">Call For Help.</h3>
     <img src="image/phone.png" alt="" style="width:40px;height:40px;margin-top:100px;margin-left:150px;position:absolute;">
     <a href="tel:+254714161912">
     <p style="font-size:20px;font-weight:bold;margin-top:120px;margin-left:190px;position:absolute;background-color:maroon;color:white;width:170px;height:40px;border-radius:10px;padding-left:10px;padding-top:5px;">+254714161912</p>
      </a>
      <span style="font-size:18px;font-weight:bold;margin-top:120px;margin-left:420px;position:absolute;color:maroon"> or </span>
      <h3 style="font-size:17px;font-weight:bold;margin-top:70px;margin-left:520px;position:absolute;text-decoration:underline;color:black">Chat with us on whatsapp.</h3>
      <img src="image/what.png" alt="" style="width:40px;height:40px;margin-top:100px;margin-left:540px;position:absolute;">
      <a href="https://wa.me/+254714161912?text=Hello%20there!">
        <p style="font-size:20px;font-weight:bold;margin-top:110px;margin-left:600px;position:absolute;background-color:maroon;color:white;width:120px;height:40px;border-radius:10px;padding-left:10px;padding-top:5px;">Click here</p>
      </a>
     </div>
    <!-------endcalldiv------------------------------------>

  <div class="message" id="messageDiv">
		<p>Notifications</p>
		<span>d</span>
    
		<div class="cont">
    <?php
    
     if (mysqli_num_rows($allusersmessages) > 0) {
    while ($row = mysqli_fetch_assoc($allusersmessages)) {
    ?>
      <a href="#">
		<div class="box1">
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
    <div class="bigcont">
  
    <div class="menu">
    <button class="btn5"><img src="image/myproduct.png" alt="" style="height:30px;width:30px">
      My Product</button>

      
      
      <a href="#">
      <a href="dashboard.php">
      <button class="btn10"><img src="image/order.png" alt="" style="height:30px;width:30px">
        My order</button>
      </a>
      
    </div>
    <h2>Product Dashboard</h2>
    <div class="container">
    
    <table>
    <tr>
        <th>Product Name</th>
        <th>Product category</th>
        <th>Calculator ID</th>
        <th>Duration(month)</th>
        <th>Expiry Date</th>
        <th>payment status</th>
        <th>Package Name</th>
        
        <th>Action</th>
      </tr>
      <?php
      $action=null;
      //$serviceid = null;
if ($num > 0) {
    while ($data = mysqli_fetch_assoc($resultorder)) {
           $serviceid=$data['serviceid'];
           $companyid=$data['companyid'];
           $companyname=$data['companyname'];
        echo "<tr data-href='#'>";
        echo "<td>" . $data['productName'] . "</td>";
        echo "<td>" . $data['productCategory'] . "</td>";
        echo "<td>" . $data['productid'] . "</td>";
        echo "<td>" . $data['monthvalue'] . "</td>";
        echo "<td>" . $data['ExpiryDate'] . "</td>";
        echo "<td>" . $data['paymentmessage'] . "</td>";
        echo "<td>" . $data['packagename'] . "</td>";
       
        
        // Add another button in the same row
        echo "<td>
        <button class='context-trigger but2'><img src='image/contex.png' title='Right click here'></button>
        <ul class='context-menu'>
            <a href='descr.php?productid=" . $data['productid'] . "&orderid=".$orderid."&packagename=".$data['packagename']."&expirydate=".$data['ExpiryDate']."&context=3&serviceid=".$serviceid."'>
                <li class='menu-item-1'>Product API</li>
            </a>
            <a href='ApiTest.php?productid=" . $data['productid'] . "&expirydate=".$data['ExpiryDate']."&packagename=".$data['packagename']."&serviceid=".$serviceid."&companyid=".$companyid."&orderid=".$orderid."&context=3&companyname=".$companyname."'>
                <li class='menu-item-2'>Product Web Form</li>
            </a>
            <a href='excelcalculatorreviewandupdate.php?productid=".$data['productid'] ."&orderid=".$orderid."&context=3&packagename=".$companyname."&companyid=".$companyid."&expirydate=".$data['ExpiryDate']."&serviceid=".$serviceid."'>
                <li class='menu-item-3'>Review  Excel</li>
            </a>

            <a href='uploadExcelOrder.php?productid=" . $data['productid'] . "&action=replacefile&orderid=".$orderid."&difference=".$difference."&productname=".$data['productName']."&productcategory=".$data['productCategory']."&context=3&serviceid=".$serviceid."&packagename=".$data['packagename']."&expirydate=".$data['ExpiryDate']."&companyid=".$companyid."'>
                <li class='menu-item-3'>Replace Excel File</li>
            </a>
        </ul>
    </td>";

        echo "</tr>";
    }

} else {
    echo "
        <tr data-href='uploadExcelOrder.php?orderid=".$orderid."'>
          <td colspan='7' class='error-message'>You have not uploaded any product.</td>
        </tr>
    ";
}
?>
    </table>
    <h6><?php //echo "serviceid is".$serviceid;  ?></h6>
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
            <h3>Excel2code</h3>
            <p>
              
              Nairobi<br>
              Kenya <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@excel2code.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="aboutus">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="termsandcondition.php">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="privacy.php">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Excel2code</a></li>
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
            &copy; Copyright <strong><span>Excel2code</span></strong>. All Rights Reserved
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


    document.addEventListener('DOMContentLoaded', function () {
    var call = document.getElementById('call');
    var calldiv = document.querySelector('.calldiv');
    var hide = document.getElementById('hide');
  
    // Toggle message div visibility when call li is clicked
    call.addEventListener('click', function (event) {
      event.stopPropagation(); // Prevents the click event from reaching the document
      calldiv.style.display = (calldiv.style.display === 'block') ? 'none' : 'block';
    });

    // Hide message div when clicking anywhere outside of it
    document.addEventListener('click', function () {
      calldiv.style.display = 'none';
    });

    // Prevent the click on the message div from closing it
    calldiv.addEventListener('click', function (event) {
      event.stopPropagation(); // Prevents the click event from reaching the document
    });

     
    // Toggle message div visibility when call li is clicked
    hide.addEventListener('click', function (event) {
      
      calldiv.style.display = 'none';
    });

  });
</script>





<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all elements with the class 'context-trigger'
        var contextTriggers = document.querySelectorAll('.context-trigger');
        var contextMenus = document.querySelectorAll('.context-menu');

        // Show the context menu
        function showContextMenu(index, x, y) {
            contextMenus[index].style.display = 'block';
            contextMenus[index].style.left = x + 'px';
            contextMenus[index].style.top = y + 'px';
        }

        // Hide all context menus
        function hideAllContextMenus() {
            contextMenus.forEach(function (menu) {
                menu.style.display = 'none';
            });
        }

        // Handle right-click on any context trigger element
        contextTriggers.forEach(function (trigger, index) {
            trigger.addEventListener('contextmenu', function (e) {
                e.preventDefault(); // Prevent the default context menu
                hideAllContextMenus(); // Hide all other context menus
                showContextMenu(index, e.clientX, e.clientY); // Show the current context menu
            });
        });

        // Hide context menus on document click
        document.addEventListener('click', function () {
            hideAllContextMenus();
        });

        // Hide context menus on window resize
        window.addEventListener('resize', function () {
            hideAllContextMenus();
        });
    });
</script>

</body>

</html>