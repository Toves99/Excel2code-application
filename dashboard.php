<?php
session_start();
$email=$_SESSION['email'];
$user_id = $_SESSION['userId'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
include('config.php');
$username=$_SESSION['username'];
$select="SELECT 
              orders.orderid, 
              orders.totalunit,
              orders.servicename, 
              orders.service,
              orders.nature, 
              orders.count,
              orders.orderprice,
              orders.costperunit,
              orders.serviceid,
              orders.packagename,
              users.companyid,
              excelcalculatortb.productid,
              users.companyname,
              excelcalculatortb.productCategory,
              excelcalculatortb.productName,
              DATE_FORMAT(orders.transactiontime, '%Y-%m-%d') AS transactiontime, 
              DATE_FORMAT(orders.expirydate, '%Y-%m-%d') AS ExpiryDate, 
              orders.paymentmessage,
              
              COUNT(excelcalculatortb.orderid) AS product_count
            FROM users
            JOIN orders ON users.userid = orders.userid
            LEFT JOIN excelcalculatortb ON orders.orderid = excelcalculatortb.orderid
            WHERE users.username = '$username'
            GROUP BY orders.orderid";
   $result=mysqli_query($conn,$select);
   $num=mysqli_num_rows($result); 







   
  
   
$displaymessagequery="SELECT * FROM users,message WHERE users.userId=message.userId AND users.userId=$user_id";
$allusersmessages=$conn->query($displaymessagequery);

?>

<html lang="en">

<head>
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  
  <link href="assets/css/dashboardorder4.css" rel="stylesheet">

     <style>
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
       #extension{
        width:600px;
        height:300px;
        background-color:white;
        position:absolute;
        margin-left:450px;
        margin-top:100px;
        z-index: 10000;
        display:none;
        border:1px solid maroon;
       }
       #hidebtn{
        margin-left:550px;
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
             <a href="updateprofile.php?direction=dashboard" style="position:absolute;margin-top:35px;margin-left:20px;font-size:15px;color:black;">Update Profile.</a>
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


    <div id="extension">
    <button id="hidebtn">&#10006;</button>
      <h3 style="position:absolute;margin-top:10px;margin-left:20px;font-weight:bold;font-size:22px;color:black;text-decoration:underline;">Contact Us On</h3>
      <p style="position:absolute;margin-top:50px;margin-left:70px;font-weight:bold;font-size:20px;color:black;" ><img src="image/email.png" alt="">
      Email:</p>
      <span style="position:absolute;margin-top:80px;margin-left:100px;font-weight:bold;font-size:16px;color:black;text-decoration:underline">info@excel2code.com</span>
      <p style="position:absolute;margin-top:120px;margin-left:70px;font-weight:bold;font-size:20px;color:black;" ><img src="image/ph.png" alt="">
      Phone Call:</p>
      <span style="position:absolute;margin-top:160px;margin-left:100px;font-weight:bold;font-size:16px;color:black;text-decoration:underline">+254714161912</span>
     </div>
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
    <?php
    // Check if $rowproducts is set and is an array
    if (isset($rowproducts) && is_array($rowproducts)) {
        // Check if 'product_count' index exists in $rowproducts
        if (isset($rowproducts['product_count'])) {
            $count = intval($rowproducts['count']); // Convert to integer
            $difference = $count - $rowproducts['product_count'];
        } else {
            // Set $difference to null if 'product_count' index is not set
            $difference = null;
        }
    } else {
        // Set $difference to null if $rowproducts is not set or not an array
        $difference = null;
    }

    // Store the difference in a session variable
    $_SESSION['difference'] = $difference;
?>

    <div class="menu">
    <button class="btn5"><img src="image/order.png" alt="" style="height:30px;width:30px">
      My Order</button>
    <a href="subscription3.php">
      <button class="btn6"><img src="image/cartt.png" alt="" style="height:30px;width:30px">
        Make Order</button>
      </a>
      
      <a href="productOrder.php?action=myproducts">
      <button class="btn7"><img src="image/myproduct.png" alt="" style="height:30px;width:30px">
      My Product</button>
      </a>
    </div>
    <h2>My Subscription Dashboard</h2>
    <div class="container">
    <table>
      <tr>
        <th style="display:none;">serviceid</th>
       <th>Service name</th>
        <th>Subscription Id</th>
        <th>Ordered date</th>
        <th>Expiry Date</th>
        <th>Quantity Ordered</th>
        <th>Quantity utilized</th>
        <th>Unutilized quantity</th>
        <th>Cost per Unit</th>
        <th>Total Cost</th>
        <th>Payment status</th>
        <th>Type</th>
        <th><h6 style="position:absolute;margin-left:10px;font-family:Garamond;font-size:18px;">Action</h6></th>
        <th></th>
        
        
      </tr>
      <?php
 //$productPageUrl = "productOrder.php?orderid";
 //$addExcelPageUrl="uploadExcelOrder.php?orderid";

if ($num > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
       $serviceid=$data['serviceid'];
       $companyid=$data['companyid'];
       $packagename=$data['packagename'];
       $productid=$data['productid'];
       $servicename=$data['servicename'];
       $expirydate=$data['ExpiryDate'];
       $companyname=$data['companyname'];
       $productcategory=$data['productCategory'];
       $productname=$data['productName'];
       $totalunit=$data['totalunit'];
       $nature=$data['nature'];

      
		   $count = intval($data['count']); // Convert to integer
		   $difference=$count-$data['product_count'];;
        // Store the difference in a session variable
        $_SESSION['difference'] = $difference;

        echo "<tr data-href='#'>";
        echo "<td style='display:none;'>" . $data['serviceid'] . "</td>";
        echo "<td>" . $data['servicename']. "</td>";
        echo "<td>" . $data['orderid'] . "</td>";
        echo "<td>" . $data['transactiontime'] . "</td>";
        echo "<td>" . $data['ExpiryDate'] . "</td>";
        echo "<td>" . $data['count'] . "</td>";
        echo "<td>" . $data['product_count']. "</td>"; // Display total_product_rows
        if ($data['nature'] === 'free trial') {
          echo "<td>1</td>";
        } else {
          echo "<td>" . $difference . "</td>";
          }
        echo "<td>" .$data['costperunit']. "</td>";
        echo "<td>" .$data ['orderprice']. "</td>";
        echo "<td>" . $data['paymentmessage'] . "</td>";
        echo "<td style='color: white; padding: 5px;'>";
         echo "<div style='background-color:blue; height: 25px;padding-top:2px;border-radius:5px;'>" . $data['nature'] . "</div>";
        echo "</td>";
		
		// $addExcelPageUrl =  $addExcelPageUrl."=".$data['id'];
    echo "<td>
    <a href='uploadExcelOrder.php?orderid=" . $data['orderid'] . "&difference=" . $difference . "&context=2&productid=".$productid."&serviceid=".$serviceid."&companyid=".$companyid."&packagename=".$packagename."&servicename=".$servicename."&expirydate=".$expirydate."&productcategory=".$productcategory."&productname=".$productname."&totalunit=".$totalunit."'>
      <button class='but1'" . ($data['nature'] === 'free trial' ? ' disabled' : '') . ">Add product</button>
    </a>
    </td>";
        //$productPageUrl =  $productPageUrl."=".$data['id'];
        //echo "productpageurl=>".$productPageUrl;

        echo "<td>
            <a href='productOrder.php?orderid=" . $data['orderid'] . "&difference=" . $difference . "&serviceid=".$serviceid."&companyid=".$companyid."&companyname=".$companyname."&productcategory=".$productcategory."&productid=".$productid."&expirydate=".$expirydate."servicename=".$servicename."&productname=".$productname."&packagename=".$packagename."&context=2'>
              <button class='but1'  onclick='return checkExpiryDate(\"" . $expirydate . "\")'>view product</button>
            </a>
        </td>";

        echo "</tr>";
    }

} else {
    echo "
        <tr data-href='subscriptionneworder.php'>
          <td colspan='7' class='error-message'>You have not make  any subscription click to make an order</td>
        </tr>
    ";
}
?>

    </table>
	
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
function checkExpiryDate(expiryDate) {
    var currentDateTime = new Date();
    var expiryDateTime = new Date(expiryDate);
    var extension=document.getElementById('extension');
    var hidebtn=document.getElementById('hidebtn');

    hidebtn.addEventListener('click', function () {
      extension.style.display='none';
    });

    if (currentDateTime > expiryDateTime) {
      var alertDiv = document.createElement('div');
          alertDiv .style.position = 'fixed';
          alertDiv .style.top = '40%';
          alertDiv .style.left = '50%';
          alertDiv .style.transform = 'translate(-50%, -50%)';
          alertDiv .style.background = 'white';
          alertDiv .style.color='black';

          alertDiv .style.zIndex = '991';
          alertDiv .style.height='200px'
          alertDiv .style.width='500px';
          alertDiv .style.padding = '20px';
          alertDiv .style.borderRadius = '5px';
          alertDiv .style.boxShadow ='0px 2px 15px rgba(0, 0, 0, 0.1)';
          alertDiv .innerHTML = '<div style="margin-top: 40px;margin-left:60px;font-size:16px;font-weight:bold;color:black;">Your free trial period has expired.</div>';

          // Buy button
          var buybutton = document.createElement('button');
          var askbutton=document.createElement('button');
          var close = document.createElement('button');
          buybutton.style.marginLeft='100px';
          buybutton.style.position='absolute';
          buybutton.textContent = 'Buy Now';
          buybutton.style.backgroundColor='maroon';
          buybutton.style.width='130px';
          buybutton.style.height='40px';
          buybutton.style.color='white';
          buybutton.style.marginTop='50px';
          buybutton.style.border='0';



          askbutton.style.marginLeft='300px';
          askbutton.style.position='absolute';
          askbutton.textContent = 'Extension';
          askbutton.style.backgroundColor='maroon';
          askbutton.style.width='130px';
          askbutton.style.height='40px';
          askbutton.style.color='white';
          askbutton.style.marginTop='50px';
          askbutton.style.border='0';


          close.style.marginLeft='420px';
          close.style.position='absolute';
          close.textContent = 'X';
          close.style.backgroundColor='maroon';
          close.style.width='40px';
          close.style.height='30px';
          close.style.color='white';
          close.style.marginTop='-80px';
          close.style.border='0';

          buybutton.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            window.location.href = 'subscription3.php';
          });

          askbutton.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            extension.style.display='block';

            alertDiv.style.display='none';
          });

          close.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            alertDiv.style.display='none';
          });
          // Append the button to the div
          alertDiv.appendChild(buybutton);
          alertDiv.appendChild(askbutton);
          alertDiv.appendChild(close);
          document.body.appendChild(alertDiv);
          return false;
    } else{
      return true;
    }
}
</script>

  
  
  
  
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

</body>

</html>