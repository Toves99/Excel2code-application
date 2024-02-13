<?php
session_start();
$username=$_SESSION['username'];
include("config.php");
//include("excelconfigfetch.php");
//$orderId = $_SESSION['id'];

$user_id=$_SESSION['userId'];
$email=$_SESSION['email'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
$orderid=$_GET['orderid'];
$productid=$_GET['productid'];
$packagename=$_GET['packagename'];
$expirydate=$_GET['expirydate'];
//$username =null;
$password = null;
$companyid=$_SESSION['companyid'];
$serviceid =$_GET['serviceid'];

$excelConfigVariablesArrayFetchRequest = array();
$excelConfigVariablesArrayFetchRequest ['serviceid']=$serviceid;
$excelConfigVariablesArrayFetchRequest ['companyid']=$companyid;
$excelConfigVariablesArrayFetchRequest ['productid']=$productid;
$excelConfigVariablesArrayFetchRequest ['orderid']=$orderid;
$excelConfigVariablesArrayFetchRequest ['username']=$username;
$excelConfigVariablesArrayFetchRequest ['password']=$password;
$excelConfigVariablesJsonFetchRequest =json_encode($excelConfigVariablesArrayFetchRequest);
//$orderid="null";
// $_SESSION['id'] = $orderid;
//call the  /http////excelcode/configfetch url.

$fileediturl="https://4889-196-216-86-91.ngrok-free.app/excelcode/configfetch";

$options = array(

    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => $excelConfigVariablesJsonFetchRequest,
    ),
);

// Create the stream context
$context  = stream_context_create($options);

// Make the POST request
$productexcelvariables = file_get_contents($fileediturl, false, $context);

//$productexcelvariables  = fetchExcelProductVariables
//($username, $password, $productid,$orderId, $companyid,$serviceid);


if ($productexcelvariables === FALSE) {
  die('Error occurred while making the request');
}
$responseArray = array();
$responseArray  = json_decode($productexcelvariables,true);
$transactionstatuscode = $responseArray['response']['status']['transactionstatuscode'];
$httpstatuscode= $responseArray['response']['status']['httpstatuscode'];
     if($httpstatuscode != 200 || $transactionstatuscode!=200){
     
     die('Error occurred while making the request');
     
   }


$productvariables = $responseArray['response']['data']; 
$productrequestheader = $responseArray['request'];
$productrequestheader = array();
$productrequestheader = $excelConfigVariablesJsonFetchRequest;
//$productrequestheader = str_replace("\\","",$productrequestheader );

//$GLOBALS['CURRENT_PRODUCT_VARIABLES']=$productvariables;

$inputvariables = $productvariables ['input'];
$outputvariables = $productvariables ['output'];

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

  
  <link href="assets/css/apispecs3.css" rel="stylesheet">
 
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
        <li class="dropdown"><a href="#"><span>Products</span></i></a>
            <ul>
              <li><a href="servicelogin.php">Execal2code</a></li>
             
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
             <a href="updateprofile.php?direction=describe&orderid=<?php echo $orderid  ?>&productid=<?php echo $productid  ?>&packagename=<?php echo $packagename  ?>&expirydate=<?php echo $expirydate  ?>" style="position:absolute;margin-top:35px;margin-left:20px;font-size:15px;color:black;">Update Profile.</a>
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
<div class="bigcont">
  
    <div class="menu">
    <a href="#">
    <button class="apispecs"><img src="image/exp.png" alt="" style="height:30px;width:30px">
      API Specs</button>
    </a>
      <a href="productOrder.php?orderid=<?php echo $orderid  ?>">
      <button class="btn7"><img src="image/myproduct.png" alt="" style="height:30px;width:30px">
        My Product</button>
      </a>
      <a href="#">
      <a href="dashboard.php">
      <button class="btn10"><img src="image/order.png" alt="" style="height:30px;width:30px">
        My order</button>
      </a>
      

        <a href="productapidemo.php?orderid=<?php echo $orderid  ?>&productid=<?php echo $productid  ?>&packagename=<?php echo $packagename  ?>&expirydate=<?php echo $expirydate  ?>&serviceid=<?php  echo $serviceid; ?>">
        <button class="demo"><img src="image/demo.png" alt="" style="height:30px;width:30px">
          Product API Live Demo</button>
        </a>

        <a href="myapi.php?orderid=<?php echo $orderid  ?>&productid=<?php echo $productid  ?>&packagename=<?php echo $packagename  ?>&expirydate=<?php echo $expirydate  ?>&serviceid=<?php echo $serviceid;   ?>&companyid=<?php echo $companyid;  ?>">
          <button class="apiimplement"><img src="image/co.png" alt="" style="height:30px;width:30px">
            API Implementation</button>
          </a>
    </div>
    <p style="position:absolute;margin-top:20px;margin-left:70px;color:black;font-weight:bold;">Order ID:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $orderid;  ?></span></p>
     <p style="position:absolute;margin-top:20px;margin-left:210px;color:black;font-weight:bold;">ProductId:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $productid;  ?></span></p>
     <p style="position:absolute;margin-top:20px;margin-left:450px;color:black;font-weight:bold;">Package:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $packagename;  ?></span></p>
     <p style="position:absolute;margin-top:20px;margin-left:620px;color:black;font-weight:bold;">Expiry Date:<span style="margin-left:4px;font-size:18px;color:maroon;"><?php echo $expirydate;  ?></span></p>
    <div class="container">
      
     <!-- API Endpoint -->
     <div style="margin-top:60px;margin-left:10">
        <span style="position:absolute;margin-top:3px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:15px;">1</span>
        <p style="margin-top:40px;margin-left:80px;color:black;font-size:18px;font-weight:bold">Product API EndPoint</p>
        <p style="margin-top:10px;margin-left:100px;color:black;font-size:17px;">Below is your API End Point copy it and embed it in your application</p>
       <div style="margin-top:20px;margin-left:100px;width:710px;height:42px;box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);">
        <button style="margin-top:0px;margin-left:0px;width:100px;background-color:maroon;color:white;border:0;height:40px">URL</button>
        <p class="link2" style="position:absolute;margin-top:-30px;margin-left:150px;color:maroon;font-size:17px;font-style:italic">https://f2eb-105-161-170-72.ngrok-free.app/excelcode/calculate</p>
        <img src="image/copy.png" alt="" style="position:absolute;margin-top:5px;margin-left:570px;width:30px;" id="copyButton1">
       </div>
     </div>
      <!-- End API Endpoint -->



      <!-- start of input variable -->
      <div  class="cont1">
         <span style="position:absolute;margin-top:2px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-weight:bold;font-size:15px;">2</span>
         <p style="margin-top:30px;margin-left:80px;color:black;font-size:18px;font-weight:bold;">Product Input and Output Parameters</p>
         <table>
    <tr>
        <th>#</th>
        <th>Parameter Name</th>
        <th>Data Type</th>
        <th>IO Type</th>
      </tr>
      <?php
		  
      //print_r($productexcelvariables);
     // $cellMetaData  = $productexcelvariables['variables'];
      
      $inputcount =1;
      $outputcount =1;
      $requestInputStructure = array();
      foreach($inputvariables as $cellRefId => $cellData){
          
          $cellName =  $cellData['cellname'];
          $celldatatype =$cellData['celldatatype'];
          $celliotype =$cellData['celliotype'];
          $cellValue = $cellData['cellvalue'];
          $requestInputStructure[$cellName]=$cellValue;
         
      echo "
        <tr>
        <td>".$inputcount."</td>
       <td>".$cellName."</td>
       <td>".$celldatatype."</td>
       <td>".$celliotype."</td>
        </tr>

      ";
      $inputcount++;
      }

      $responseOutputStructure = array();
      foreach($outputvariables as $cellRefId => $cellData){
          
        $cellName =  $cellData['cellname'];
        $celldatatype =$cellData['celldatatype'];
        $celliotype =$cellData['celliotype'];
        $cellValue = $cellData['cellvalue'];
        $responseOutputStructure[$cellName]=$cellValue;
       
    echo "
      <tr>
      <td>".$inputcount."</td>
     <td>".$cellName."</td>
     <td>".$celldatatype."</td>
     <td>".$celliotype."</td>
      </tr>

    ";
    $inputcount++;
    }
    ?>
    </table>
<!-- table for output variable -->
      
  


    <!-- start of request structure -->
    <div style="margin-top:100px;height:30px">
    <span style="position:absolute;margin-top:-30px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-size:15px;">3</span>
    <p style="position:absolute;margin-top:-30px;margin-left:80px;color:black;font-size:18px;font-weight:bold;">Product API Request Structure</p>
    </div>
    <div style="width:900px;height:auto;background-color:white;color:maroon;margin-left:100px;font-size:15px;word-wrap: break-word;padding-left:10px;padding-right:10px; box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.1);font-weight:bold"> 
       
      <?php
       $calculateRequestStructure['header'] = $productrequestheader;
       $calculateRequestStructure['input'] = $requestInputStructure;

       $request = json_encode($calculateRequestStructure);
       $request = str_replace("\\","",$request);
       echo $request;
      ?>

    </div>

    <div style="margin-top:100px;height:30px">
    <span style="position:absolute;margin-top:-30px;margin-left:50px;background-color:maroon;width:20px;color:white;border-radius:20px;padding-left:5px;font-size:15px;">4</span>
    <p style="position:absolute;margin-top:-30px;margin-left:80px;color:black;font-size:18px;font-weight:bold;">Product API Response Structure</p>
    </div>
    <div style="width:900px;height:auto;background-color:white;color:maroon;margin-left:100px;font-size:15px;word-wrap: break-word;padding-left:10px;padding-right:10px;box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.1);font-weight:bold"> 
       
      <?php
      $responseBody = array();
      $response = array();
      $responseBody['request']= $request;
      $responseStatus = array();
      $responseStatus['httpstatuscode']=200;
      $responseStatus['transactionstatuscode']=200;

      $responseData=$responseOutputStructure;
      $response['status']=$responseStatus;
      $response['data']=$responseData;
      $responseBody['response']=$response;

      $responseBody = json_encode($responseBody);
      $responseBody =str_replace("\\","",$responseBody);
      echo $responseBody;
      ?>

    </div>
     </div>
      <!-- End of input variable -->

      

      

     
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
      //alert("Copied: " + linkElement.textContent);
      var alertDiv=document.createElement('div');
          alertDiv.style.position = 'fixed';
          alertDiv.style.top = '50%';
          alertDiv.style.left = '60%';
          alertDiv.style.transform = 'translate(-50%, -50%)';
          alertDiv.style.background = 'white';
          alertDiv.style.color='black';

          alertDiv.style.zIndex = '1000000';
          alertDiv.style.height='100px'
          alertDiv.style.width='200px';
          alertDiv.style.padding = '20px';
          alertDiv.style.borderRadius = '5px';
          alertDiv.style.boxShadow ='0px 2px 15px rgba(0, 0, 0, 0.1)';
          alertDiv.innerHTML = '<div style="margin-top: 10px;margin-left:30px;font-size:16px;font-weight:bold;color:black;">URL copied.</div>';
          
          var okButton = document.createElement('button');
          okButton.textContent = 'Ok';
          okButton.style.position='absolute';
          okButton.style.backgroundColor='maroon';
          okButton.style.marginLeft='60px';
          okButton.style.width='60px';
          okButton.style.height='30px';
          okButton.style.color='white';
          okButton.style.border='0';
          okButton.style.marginTop='10px';
          // Append the div to the body
          alertDiv.appendChild(okButton);
          document.body.appendChild(alertDiv);
          copyButton.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            
            alertDiv.style.display = 'block';
          });

          okButton.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            
            alertDiv.style.display = 'none';
          });
    });
  </script>
</body>

</html>