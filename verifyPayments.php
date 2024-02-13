<?php
session_start(); // Start or resume the session
// Function to generate a random 11-digit number
function generateRandomNumber()
{
    $randNumber = mt_rand(10000000000, 99999999999);
    return $randNumber;
}

$_SESSION['subscriptionid']=generateRandomNumber();

$companyid=$_SESSION['companyid'];
$username=$_SESSION['username'];
$email=$_SESSION['email'];

// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
$paymentstatus;
$user_id = $_SESSION['userId'];
$transactionID = $_SESSION['TransactionID'];
$phone = $_SESSION['Phone'];
$paymentAmount = $_SESSION['PaymentAmount'];
$costPerUnit = $_SESSION["costperunit"];
$totalunit=$_SESSION['totalunit'];
require_once('config.php');

if (isset($_SESSION['count']) && isset($_SESSION['totalCost']) && isset($_SESSION["monthvalue"]) && isset($_SESSION["costperunit"]) && isset($_SESSION["packagename"])  && isset($_SESSION["totalunit"])) {
  $count = $_SESSION['count'];
  $totalCost = $_SESSION['totalCost'];
  $monthValue = $_SESSION["monthvalue"];
  $costPerUnit = $_SESSION["costperunit"];
  $packagename = $_SESSION["packagename"];
  $totalunit=$_SESSION['totalunit'];


  
} else {
 // echo "No values stored in the session.";
}


   // Check if the form has been submitted and update session variables if needed
    if (isset($_POST['individualService']) && isset($_POST['subscriptionPeriod'])) {
    $_SESSION['serviceName'] = $_POST['serviceName']; // Example product name
    $_SESSION['individualService'] = $_POST['individualService'];
    $count = $_POST['count']; // Update $count from the form data
    $_SESSION['count'] = $count;

    }
if (isset($_POST['submit'])) {
  $transactionID=$_POST['transaction_id'];
  $phone=$_POST['phone'];
  $paymentAmount=$_POST['paymentAmount'];
  $count = $_POST['count'];
  $serviceName='Excel2codeAPI';
  $individualService='Excel calculator';
  $costPerUnit = $_SESSION["costperunit"];

  $subscriptionid=$_SESSION['subscriptionid'];
 
  
  
 // $sql="SELECT *FROM payment WHERE transaction_id = $transactionID AND Phone = '$phone' AND paymentAmount='$paymentAmount'";
 $sql="SELECT pr.amount as pramount, pr.checkoutid as prcheckoutid , pr.resultcode as prresultcode,
              cb.checkoutid as cbcheckoutid, cb.debitamount as cbamount, cb.userid
 FROM paymentreceipt pr, customerdebit cb WHERE pr.checkoutid=cb.checkoutid  AND 
 cb.userid =$user_id  AND cb.paymentstatus=0 ORDER BY cb.debitdatetime DESC limit 1";
 
 
  $result=mysqli_query($conn,$sql);
  $num=mysqli_num_rows($result);

  $fetch_data=mysqli_fetch_assoc($result);
  $resultcode=$fetch_data['prresultcode'];
  $cbcheckoutid=$fetch_data['cbcheckoutid'];
  echo "checkoutId".$cbcheckoutid;
  $num_rows=mysqli_num_rows($result);
  
  if($num_rows>0){
    if($resultcode!=0){
      echo "<script>alert('Your transaction payment was unsuccessiful we have cancelled your subscription please try again later');window.location.href = 'uploadExcel.php';</script>";
      $paymentstatus=1;
     
      $ServiceId = 'SE001';
      // Calculate the new timestamp by adding months to the current timestamp
       $newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));
      $sqlquery="INSERT INTO `orders`(`userId`,`servicename`, `count`,`service`,`validityperiod`,`expirydate`,`paidamount`,`paymentstatus`,`paymentmessage`,`serviceid`,`orderprice`,`costperunit`,`packagename`,`subscriptionid`,`totalunit`,`nature`)
      VALUES ('$user_id', '$serviceName','$count','$individualService','$monthValue','$newUploadedTime','$paymentAmount','$paymentstatus','paid','$ServiceId','$totalCost','$costPerUnit','$packagename','$subscriptionid','$totalunit','ordered')";
      $query_run = mysqli_query($conn,$sqlquery);
      if($query_run){
      $orderId = mysqli_insert_id($conn);
        // Store the 'orderId' in the session
        $_SESSION['orderid'] = $orderId;
		
		
    }
      $paymentstatus=2;
    }
    else{
      echo "<script>alert('Your transaction payment was successfully processed. Click the button below to start uploading your calculators');window.location.href = 'uploadExcel.php';</script>";
      $paymentstatus=1;
     
      $ServiceId = 'SE001';
      // Calculate the new timestamp by adding months to the current timestamp
       $newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));
      $sqlquery="INSERT INTO `orders`(`userId`,`servicename`, `count`,`service`,`validityperiod`,`expirydate`,`paidamount`,`paymentstatus`,`paymentmessage`,`serviceid`,`orderprice`,`costperunit`,`packagename`,`subscriptionid`,`totalunit`,`nature`)
      VALUES ('$user_id', '$serviceName','$count','$individualService','$monthValue','$newUploadedTime','$paymentAmount','$paymentstatus','paid','$ServiceId','$totalCost','$costPerUnit','$packagename','$subscriptionid','$totalunit','ordered')";
      $query_run = mysqli_query($conn,$sqlquery);
      if($query_run){
      $orderId = mysqli_insert_id($conn);
        // Store the 'orderId' in the session
        $_SESSION['orderid'] = $orderId;
		
		
    }
  }
  $sqlupdatestatus = "UPDATE customerdebit SET paymentstatus=$paymentstatus WHERE checkoutid = '$cbcheckoutid'";
  $update_result = mysqli_query($conn, $sqlupdatestatus);
}
else{
	echo "
   <div id='alert' style='position:absolute;width:500px;height:200px;background-color:maroon;border:1px solid lightblue; margin-top:170px; margin-left:450px;border-radius:10px;z-index:10000;'>
        <p style='position:absolute;margin-top:70px;color:white;font-size:16px;margin-left:40px'>Your transaction payment was successfully processed.</p>
        <div id='loading-bar' style='position:absolute;width:300px;height:20px;background-color:#ddd;margin-top:120px;margin-left:100px;border-radius:5px;'>
            <div id='progress' style='height:100%;width:0;background-color:blue;border-radius:5px;'></div>
        </div>
   </div>
   <script>
        let progressBar = document.getElementById('progress');
        let loadingBar = document.getElementById('loading-bar');
        let alertDiv = document.getElementById('alert');

        setTimeout(function(){
            alertDiv.style.display = 'none';
            window.location.href = 'uploadExcel.php';
        }, 7000); // Hide the div after 7 seconds and redirect to 'uploadExcel.php'

        // Simulate loading progress
        let progress = 0;
        let interval = setInterval(function(){
            progress += 10;
            progressBar.style.width = progress + '%';

            if(progress >= 100) {
                clearInterval(interval);
            }
        }, 700); // Adjust the interval based on your preference
  </script>
";
      $paymentstatus=1;
      $ServiceId = 'SE001';
      // Calculate the new timestamp by adding months to the current timestamp
       $newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));
      $sqlquery="INSERT INTO `orders`(`userId`,`servicename`, `count`,`service`,`validityperiod`,`expirydate`,`paidamount`,`paymentstatus`,`paymentmessage`,`serviceid`,`orderprice`,`costperunit`,`packagename`,`subscriptionid`,`totalunit`,`nature`)
      VALUES ('$user_id', '$serviceName','$count','$individualService','$monthValue','$newUploadedTime','$paymentAmount','$paymentstatus','paid','$ServiceId','$totalCost','$costPerUnit','$packagename','$subscriptionid','$totalunit','ordered')";
      $query_run = mysqli_query($conn,$sqlquery);
      if($query_run){
      $orderId = mysqli_insert_id($conn);
        // Store the 'orderId' in the session
        $_SESSION['orderid'] = $orderId;
        //$orderId=$_SESSION['id'];
  //echo "<script>alert('We are yet to receieve your payment. Please Try again to verify');window.location.href = 'uploadExcel.php';</script>";
  //echo "<script>alert('We are yet to receieve your payment. Please Try again to verify');window.location.href = 'uploadExcel.php';</script>";
}
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

  
  <link href="assets/css/verify5.css" rel="stylesheet">

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
             <a href="updateprofile.php?direction=verifyPayments" style="position:absolute;margin-top:35px;margin-left:20px;font-size:15px;color:black;">Update Profile.</a>
             <span style="position:absolute;margin-top:58px;background-color:lightgrey;height:1px;width:100%;color:transparent">t</span>
             <a href="#" style="position:absolute;margin-top:65px;margin-left:20px;font-size:15px;color:black;">Help.</a>
             <span style="position:absolute;margin-top:90px;background-color:lightgrey;height:1px;width:100%;color:transparent">t</span>
             <a href="logout.php" style="position:absolute;margin-top:95px;margin-left:20px;font-size:15px;color:black;">Logout.</a>
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
  
 <!-- index.html -->
 
 <form action="" method="POST">
   <h3>Verify Your Payment.</h3>
   <p class="vp">Please click the button below to
     verify payment</p>
     <input type="hidden" name="count" value="<?php echo $count;  ?>">
     <input type="hidden" name="phone" value="<?php echo $phone;  ?>">
     <input type="hidden" name="transaction_id" value="<?php echo $transactionID;  ?>">
     <input type="hidden" name="paymentAmount" value="<?php echo $paymentAmount;  ?>">
    <button type="submit" name="submit">Verify</button>
    <h6><?php //echo "subscription id =>".$subscriptionid ?></h6>
  </form>
  
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







</body>

</html>