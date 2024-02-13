<?php
session_start();
$email = $_SESSION['email'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
include("fileuploadclient.php");
include("config.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to generate a random 11-digit number
function generateRandomNumber()
{
    $randNumber = mt_rand(10000000000, 99999999999);
    return $randNumber;
}

$_SESSION['productid'] = generateRandomNumber(); // Store the random number in the session
$companyname=$_SESSION['companyname'];
$user_id = $_SESSION['userId'];
$Password=$_SESSION['password'];
$productid = $_SESSION['productid'];
$companyid = $_SESSION['companyid'];
$serviceid=$_SESSION['serviceid'];
$username=$_SESSION['username'];

if (isset($_SESSION['count']) && isset($_SESSION['totalCost']) && isset($_SESSION["monthvalue"]) && isset($_SESSION["costperunit"])) {
    $count = $_SESSION['count'];
    $totalCost = $_SESSION['totalCost'];
    $monthValue = $_SESSION["monthvalue"];
    $costPerUnit = $_SESSION["costperunit"];
} else {
   // echo "No values stored in the session.";
}

if (isset($_POST['proceed'])) {
    $count = $_POST['count'];
    $_SESSION['count'] = $count;
    $_SESSION['totalunit'] = $totalunit;

    $totalunit=$_SESSION['totalunit'];

    // Calculate the total cost based on the input and store it in the session
    $totalCost = $count * 1000000;
    $_SESSION['totalCost'] = $totalCost;
}
// Check if 'orderId' is set in the session

if (isset($_SESSION['orderid'])) {
  $orderid = $_SESSION['orderid'];
  //echo "orderId from the session: " . $orderId;
} else {
  //echo "orderId is not set in the session.";
}
$selectfromorder="SELECT servicename,serviceid FROM orders,users WHERE users.userId=orders.userId";
$resultorder=mysqli_query($conn,$selectfromorder);
$fetch_data=mysqli_fetch_assoc($resultorder);
$servicename=$fetch_data['servicename'];
$serviceid=$fetch_data['serviceid'];

$_SESSION['servicename']=$servicename;
$_SESSION['serviceid']=$serviceid;






if (isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    $orderid = $_SESSION['orderid'];
    $productCategory = $_POST['productCategory'];
    $totalCost = $_SESSION['totalCost'];
    $monthValue = $_SESSION["monthvalue"];
    $costPerUnit = $_SESSION["costperunit"];

    $directoryFolder="uploads/";
	
    $file=$_FILES["uploadfile"]["name"];
    $filetemppath=$_FILES["uploadfile"]["tmp_name"];
    $data=[$file];
    $fileupload=implode('',$data);
	//print_r($directoryFolder.$file);
	$fileuploadurl="https://4889-196-216-86-91.ngrok-free.app/excelcode/upload";
	
	$logFile = "C:/xampp/htdocs/excel2code/error.log";
   $currentTimeStamp = getCurrentTimeStamp();
   file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
   file_put_contents($logFile, $currentTimeStamp."|FileUpload path was=>".$directoryFolder.$file."\n", FILE_APPEND | LOCK_EX);
	
	/*$insert_query = "INSERT INTO `excelcalculatortb` (`productName`,`monthvalue`,`costperunit`,`totalCost`,`userId`,`productid`,`expiryDate`,`productCategory`,`uploadfile`)
			VALUES ('$productName','$monthValue', '$costPerUnit','$totalCost','$user_id','$product_id','$newUploadedTime','$productCategory','$fileupload')";
      $query_run = mysqli_query($conn, $insert_query);
	  if($query_run){
        move_uploaded_file($file_temp,$directoryFolder.$file);
       echo "<script>alert('Excel uploaded successfully');
                 window.location.href = 'excelCalculator.php';</script>";
	  }
	  else{
		  echo "<script>alert('Failed to  uploaded Excel');
                 window.location.href = 'excelCalculator.php';</script>";
	  }*/
     $fileuploadresponse= uploadFile($fileuploadurl,$filetemppath);
	 //echo "httpresponse was=>".$fileuploadresponse;
	 
	 $logFile = "C:/xampp/htdocs/excel2code/error.log";
     $currentTimeStamp = getCurrentTimeStamp();
     file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
     file_put_contents($logFile, $currentTimeStamp."|FileUpload HTTP Response was=>".$fileuploadresponse."\n", FILE_APPEND | LOCK_EX);
	 
	 //echo $fileuploadresponse;
	 
	 $fileResponseArray = json_decode($fileuploadresponse,true);
	 //print_r($fileResponseArray);
	 $_SESSION['productexcelvariables']= $fileResponseArray['output']['data'];
	 
	$fileHttpResponseCode = $fileResponseArray['output']['status']['httpstatuscode'];
	$fileTransactionStatusCode = $fileResponseArray['output']['status']['transactionstatuscode'];
	
	//$fileResponseData  = $fileResponseArray['data'];
	//echo "<script>alert('Excel uploaded successfully');
    //           window.location.href = 'excelCalculator.php';</script>";
    if($fileHttpResponseCode==200){
		  // HTTP response was ok
		
		  if($fileTransactionStatusCode ){
		https://6de2-196-216-86-68.ngrok-free.app	  
		   // the file upload transaction is well formed and obeys all the service contract rules
		   // Calculate the new timestamp by adding months to the current timestamp
      $newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));
      $insert_query = "INSERT INTO `excelcalculatortb` (`productName`,`monthvalue`,`costperunit`,`totalCost`,`userId`,`productid`,`expiryDate`,`productCategory`,`uploadfile`,`orderid`,`companyid`,`nature`)
			VALUES ('$productName','$monthValue', '$costPerUnit','$totalCost','$user_id','$productid','$newUploadedTime','$productCategory','$fileupload','$orderid','$companyid','ordered')";
      $query_run = mysqli_query($conn, $insert_query);
      if($query_run){
       //move_uploaded_file($filetemppath,$directoryFolder.$file);
       $geturlparams = "orderid=".$orderid."&productid=".$productid."&serviceid=".$serviceid."&packagename=".$packagename."&companyid=".$companyid."&expirydate=".$expirydate;

       // Move alert after the redirect
       echo "<script>window.location.href='excelcalculatorreviewandupdate.php?".$geturlparams."';</script>";
       echo "<script>alert('Excel Calculator uploaded successfully');</script>"; 
      }else{
        echo "<script>alert('Error Occurred while uploading the excel.');
                 window.location.href = 'uploadExcelTopup.php';</script>";
      }
			  
			  
		  }
		
    }
    else{
      error_log("file upload failed with status=".$fileHttpResponseCode,0,"C:/xampp/htdocs/exce2code/error.log");
    }
	

} 

$select = "SELECT 
    orders.servicename, 
    orders.service, 
    orders.count,
    orders.orderprice,
    orders.costperunit,
    orders.packagename,
    DATE_FORMAT(orders.transactiontime, '%Y-%m-%d') AS transactiontime, 
    DATE_FORMAT(orders.expirydate, '%Y-%m-%d') AS ExpiryDate, 
    orders.paymentmessage,
    COUNT(excelcalculatortb.orderid) AS product_count
FROM users
JOIN orders ON users.userid = orders.userid
LEFT JOIN excelcalculatortb ON orders.id = excelcalculatortb.orderid
WHERE orders.orderid = '$orderid'
GROUP BY orders.orderid";

$result = mysqli_query($conn, $select);

$num = mysqli_num_rows($result);

if ($num > 0) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);

    // Check if the product_count column is set in the result
    if (isset($row['product_count'])) {
        $productCount = $row['product_count'];
        $expiryDate = $row['ExpiryDate'];
        $packagename = $row['packagename'];
        //echo "Product Count: $productCount";

        // You can also access other columns in the same way
        $count = $row['count'];
        //echo "Count: $count";

        // Add similar lines for other columns as needed
    } else {
        //echo "Product count is not set in the result.";
    }
} else {
    //echo "No results found.";
}

// Remember to free the result set
mysqli_free_result($result);





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

  
  <link href="assets/css/uploadd6.css" rel="stylesheet">

  <style>
        body {
            font-family: Arial, sans-serif;
        }
        #file-drop-area {
            border: 2px dashed #ccc;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            margin-top:70px;
            width:700px;
            margin-left:20px;
            height:100px;
            
        }
        #file-drop-area .te{
          color:black;
          margin-left:70px; 
          text-decoration:none;
          font-size:15px;
        }
        #file-input {
            display: none; /* Hide the default file input */
        }
        #upload-button {
            background-color: #0074D9; /* Button background color */
            color: #fff; /* Text color */
            padding: 10px 20px; /* Adjust the padding as needed */
            cursor: pointer;
            width:100px;
        }
        /* Style for the file input's label (button-like appearance) */
        #upload-button-label {
            display: block;
            position: absolute;
            background-color: white; /* Button background color */
            color: black; /* Text color */
            padding: 10px 10px; /* Adjust the padding as needed */
            cursor: pointer;
            text-align: center;
            width:130px;
            height:40px;
            margin-top:-120px;
            margin-left:540px;
            font-size:16px;
            border:1px solid black;
        }
        #file-preview{
          margin-left:20px;
          margin-top:20px;
          font-size:20px;
          color:black;
        }
        #topup{
          position:absolute;
          display: none;
          width:770px;
          height:400px;
          background-color:white;
          z-index: 10000;
          margin-left:300px;
          margin-top:130px;
          border:1px solid lightblue;
          border-radius:10px;

        }
        #topup input[type="text"]{
          position:absolute;
          margin-left:230px;
          margin-top:150px;
          width:300px;
          height:40px;
          border:1px solid lightblue;
          border-radius:10px;
        }
        #topup label{
          position:absolute;
          margin-left:230px;
          margin-top:100px;
          color:black;
          font-size:18px;
        }
        #topup button{
          position:absolute;
          margin-left:270px;
          margin-top:250px;
          width:200px;
          height:50px;
          background-color:maroon;
          color:white;
          border:0;
          border-radius:10px;
        }
        #topup #hide{
          position:absolute;
          margin-left:720px;
          margin-top:10px;
          color:white;
          background-color:red;
          width:30px;
          height:30px;
          border-radius:0;
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
              <li><a href="services1.php">Contact Us</a></li>
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
          <button class="p3"><img src="image/account.png" alt="" class="img"></button>
          <p class="p4"><?php echo $name;  ?></p>
		
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
  
    <form action="" method="post" enctype="multipart/form-data"  id="myForm">
      
      <h3>Upload Excel Calculator</h3>
      <p style="position:absolute;margin-top:80px;color:black;margin-left:400px;">Order ID:<span style="margin-left:3px;font-size:20px;color:maroon;"><?php echo $orderid  ?></span></p>
      <p style="position:absolute;margin-top:80px;color:black;margin-left:550px;">Package Name:<span style="margin-left:3px;font-size:20px;color:maroon;"><?php echo $packagename  ?></span></p>
      <p style="position:absolute;margin-top:80px;color:black;margin-left:800px;">Current Package Expires On:<span style="margin-left:3px;font-size:20px;color:maroon;"><?php echo $expiryDate  ?></span></p>
      <p class="p5">Upload your first calculator and add the rest later.</p>

      <div class="textfield1">
        <label >Product Name</label>
        <input type="text" name="productName" placeholder="Enter Product Name" required>
      </div>

      <div class="textfield2">
        <label >Calculator ID</label>
        <input type="text" name="productid"  disabled value="<?php echo $productid;  ?>">
      </div>

      <div class="textfield3">
        <label >Product Category</label>
        <select name="productCategory" id="productCategory">
          <option value="loan calculator">loan calculator</option>
          <option value="pricing and quotation Calculator">pricing and quotation Calculator</option>
          <option value="Others">Others</option>
        </select>
      </div>
      
      <div class="img3">
      <button class="bt7" id="remove-button">Remove File</button>
      <div id="file-drop-area">
        <p class="te">Drag and drop your Excel files here or click add file.</p>
        <input type="file" id="file-input" name="uploadfile"required >
        <label for="file-input" id="upload-button-label">Add files</label>
       </div>
	   <!---<h6><?php//echo "orderId from the session: " .$servicename; ?></h6>-->
       <div id="file-preview"></div>
       
      </div>
      <input type="submit" name="submit" value="submit" class="sub">
	  
      <h5>Your Subscriptions Details</h5>
      <div class="select">
      <?php
       if (isset($_POST['proceed'])) {
      $count = $_POST['count'];
      $_SESSION['count'] = $count;

    // Calculate the total cost based on the input and store it in the session
      $totalCost = $count * 1000000;
      $_SESSION['totalCost'] = $totalCost;
      $_SESSION['costperunit'] = '1,000,000';
      
       }
       // Check if the form has been submitted and update session variables if needed
        if (isset($_POST['individualService']) && isset($_POST['subscriptionPeriod'])) {
        $_SESSION['serviceName'] = $_POST['serviceName']; // Example product name
        $_SESSION['individualService'] = $_POST['individualService'];
  
        }
        $difference=$count-$productCount;
         ?>
        <h6 class="p111" >Service Type:   <span class="sp1">ExcelCalculator2API</span></h6>
        <!---<h6 class="p12">Individual Service:  <span class="sp2"><?php //echo isset($_SESSION['individualService']) ? $_SESSION['individualService'] : ''; ?></span></h6>--->
        <?php
        if (isset($_SESSION['count']) && isset($_SESSION['totalCost']) && isset($_SESSION['totalunit'])) {
        
      ?>
      <h6 class="p13">No.calculators ordered: <span class="sp3"><?php echo $count  ?></span></h6>
      <h6 class="p14">Total cost: <span class="sp4"><?php echo number_format($_SESSION['totalCost'])  ?></span></h6>
      <?php
      }
      ?>
      <h6 class="p15">Subscription Validity:<span class="sp5"><?php echo isset($_SESSION['monthvalue']) ? $_SESSION['monthvalue'] : ''; ?>  months</span><h6>
      <h6 class="p16">Cost per calculator:<span class="sp6"><?php echo isset($_SESSION['costperunit']) ? $_SESSION['costperunit'] : ''; ?></span><h6>
      <h6 class="p17">Unused Calculator:<span class="sp7"><?php echo $difference;   ?></span><h6>
      <h6 class="p18">Package Name:<span class="sp8"><?php echo $packagename ?></span><h6>
      <h4 style="color:white;"> total unit<?php echo isset($_SESSION['totalunit']) ? $_SESSION['totalunit'] : ''; ?></h4>
	  
	  
      
      </div>
    </form>
     <!-- Top up div start -->
     <div id="topup">
      <p style="position:absolute;color:white">costperunit<?php echo isset($_SESSION['costperunit']) ? $_SESSION['costperunit'] : ''; ?></p>
      <span style="position:absolute;color:white">prevous unit<?php echo $_SESSION['count']  ?></span>
      <h4 style="position:absolute;color:blue">totalunit<?php echo isset($_SESSION['totalunit']) ? $_SESSION['totalunit'] : ''; ?></h4>
      <?php
      $differenceunitvalue=$_SESSION['totalunit']-$count;
      ?>
      <h5 style="position:absolute;margin-left:20px;color:white">difference is<?php echo $differenceunitvalue   ?></h5>
      <h6 style="position:absolute;margin-top:210px;margin-left:240px">Total Cost is: <span id="totalCost"></span>0</h6>
     <button id="hide">&#10006;</button>
      <label>Enter the top up number below:</label>
      <input type="text" name="value" id="topupInput" oninput="validateTopup()">
      <h6 style="position:absolute;margin-top:60px;margin-left:240px">You can add upto :<?php echo $differenceunitvalue ?> calculator</h6>
      <button onclick="proceedTopup()">proceed</button>
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
              <strong>Email:</strong> info@example.com<br>
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <!-- Add this script to your HTML file -->
 

<script>
      // Retrieve the values from sessionStorage
const selectedCount = sessionStorage.getItem('selectedCount');
const totalCost = sessionStorage.getItem('totalCost');

// Update the text content of the <h3> elements
const countValue = document.getElementById('countValue');
const totalCostValue = document.getElementById('totalCostValue');

if (selectedCount !== null) {
    countValue.textContent = `Selected Count: ${selectedCount}`;
}

if (totalCost !== null) {
    totalCostValue.textContent = `Total Cost: ${totalCost}`;
}
</script>

<!-- Add this script to your HTML file -->

<!-- Add this script to your HTML file -->
<!-- Add this script to your HTML file -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var fileDropArea = document.getElementById('file-drop-area');
    var fileInput = document.getElementById('file-input');
    var filePreview = document.getElementById('file-preview');
    var removeButton = document.getElementById('remove-button');
    var maxAllowedFiles = <?php echo $difference; ?>; // Get the maximum allowed files from PHP

    fileDropArea.addEventListener('dragover', function (e) {
      e.preventDefault();
      fileDropArea.style.border = '2px dashed #000'; // Highlight the drop area when dragging over
    });

    fileDropArea.addEventListener('dragleave', function () {
      fileDropArea.style.border = '2px dashed #ccc'; // Remove highlight when leaving the drop area
    });

    fileDropArea.addEventListener('drop', function (e) {
      e.preventDefault();
      fileDropArea.style.border = '2px dashed #ccc'; // Remove highlight when dropping

      var files = e.dataTransfer.files;
      handleFiles(files);
    });

    fileInput.addEventListener('change', function () {
      var files = fileInput.files;
      handleFiles(files);
    });

    removeButton.addEventListener('click', function () {
      // Clear the selected file and preview
      fileInput.value = null;
      filePreview.textContent = '';
    });

    function getCurrentDate() {
    var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

    function handleFiles(files) {
      if (files.length > 0) {
        var file = files[0];

        // Check if the number of selected files is within the allowed limit
        // to ensure someone does to upload a new file if they have exceeded the limit
       // do not apply this rule for someone who is replacing an exisiting file
       // note that the GET URL will have the parameter action =replacefile, if the current user
       // intention is to replace an existing excel file
       // therefore begin  by extracting the GET URL query string, check the value the action param
       // and exclude accordingly
      /*const QUERY_STRING  = window.location.search;
      const urlParams = new URLSearchParams(QUERY_STRING);
      const action =  urlParams.get('action');
      const expirydate =  urlParams.get('expirydate');
      const orderid =  urlParams.get('orderid');
      const packagename =  urlParams.get('packagename');

        var currentDate = getCurrentDate();
            //curentDate  = formatDate(currentDate);

        alert("current date ="+currentDate+" expirydate="+expirydate);
         if(expirydate<currentDate){
          // Create a div element for the alert

          var alertDivrenew = document.createElement('div');
          alertDivrenew .style.position = 'fixed';
          alertDivrenew .style.top = '50%';
          alertDivrenew .style.left = '50%';
          alertDivrenew .style.transform = 'translate(-50%, -50%)';
          alertDivrenew .style.background = 'white';
          alertDivrenew .style.color='black';

          alertDivrenew .style.zIndex = '991';
          alertDivrenew .style.height='200px'
          alertDivrenew .style.width='500px';
          alertDivrenew .style.padding = '20px';
          alertDivrenew .style.borderRadius = '5px';
          alertDivrenew .style.boxShadow ='0px 2px 15px rgba(0, 0, 0, 0.1)';
          alertDivrenew .innerHTML = '<div style="margin-top: 40px;margin-left:60px;font-size:16px;font-weight:bold;color:black;">Your Order no:'+orderid+' expired on:'+expirydate+'.Do you want to renew your order?</div>';

          // Create an "NO" button
          var Nobutton = document.createElement('button');
          var YesButton = document.createElement('button');
          Nobutton.style.marginLeft='40px';
          Nobutton.style.position='absolute';
          Nobutton.textContent = 'Yes';
          Nobutton.style.backgroundColor='maroon';
          Nobutton.style.width='130px';
          Nobutton.style.height='40px';
          Nobutton.style.color='white';
          Nobutton.style.marginTop='30px';
          Nobutton.style.border='0';

          //Yes button properties
          YesButton.textContent = 'No';
          YesButton.style.position='absolute';
          YesButton.style.backgroundColor='maroon';
          YesButton.style.marginLeft='350px';
          YesButton.style.width='100px';
          YesButton.style.height='40px';
          YesButton.style.color='white';
          YesButton.style.border='0';
          YesButton.style.marginTop='30px';




          Nobutton.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            window.location.href = 'dashboard.php';
          });

          YesButton.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            window.location.href = 'dashboard.php';
          });
          // Append the button to the div
          alertDivrenew.appendChild(Nobutton);
          alertDivrenew.appendChild(YesButton);
          // Append the div to the body
          document.body.appendChild(alertDivrenew);



         }*/
        if(files.length <= maxAllowedFiles) {
          // Display the file name as a preview
          filePreview.textContent = 'You Selected: ' + file.name;
        } else {
          // Create a div element for the alert
          var alertDiv = document.createElement('div');
          alertDiv.style.position = 'fixed';
          alertDiv.style.top = '50%';
          alertDiv.style.left = '50%';
          alertDiv.style.transform = 'translate(-50%, -50%)';
          alertDiv.style.background = 'white';
          alertDiv.style.color='black';

          alertDiv.style.zIndex = '991';
          alertDiv.style.height='200px'
          alertDiv.style.width='500px';
          alertDiv.style.padding = '20px';
          alertDiv.style.borderRadius = '5px';
          alertDiv.style.boxShadow ='0px 2px 15px rgba(0, 0, 0, 0.1)';
          alertDiv.innerHTML = '<div style="margin-top: 40px;margin-left:60px;font-size:16px;font-weight:bold;color:black;">You exceeded the maximum allowed Excel uploads.</div>';

          // Create an "OK" button
          var okButton2 = document.createElement('button');
          var okButton1 = document.createElement('button');
          var okButton = document.createElement('button');

          okButton2.style.marginLeft='40px';
          okButton2.style.position='absolute';
          okButton2.textContent = 'My Orders';
          okButton2.style.backgroundColor='maroon';
          okButton2.style.width='130px';
          okButton2.style.height='40px';
          okButton2.style.color='white';
          okButton2.style.marginTop='30px';
          okButton2.style.border='0';
          
          okButton.textContent = 'Top Up';
          okButton.style.position='absolute';
          okButton.style.backgroundColor='maroon';
          okButton.style.marginLeft='350px';
          okButton.style.width='100px';
          okButton.style.height='40px';
          okButton.style.color='white';
          okButton.style.border='0';
          okButton.style.marginTop='30px';

          okButton1.style.marginLeft='200px';
          okButton1.style.position='absolute';
          okButton1.textContent = 'New order';
          okButton1.style.backgroundColor='maroon';
          okButton1.style.width='100px';
          okButton1.style.height='40px';
          okButton1.style.color='white';
          okButton1.style.marginTop='30px';

          
          okButton1.style.border='0';

          var topupDiv = document.getElementById('topup');
          okButton.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
             // Display the topup div

             var differenceValue = <?php echo $differenceunitvalue; ?>;
             var packagename= "<?php echo $packagename ?>";

          // Check if the differenceValue is 0
          if (differenceValue === 0) {
           // Do not display the topup div
           alert("You have exhausted all your calculator in"+packagename+".Click new Subscription to add a new order.");
           topupDiv.style.display = 'none';
           
            return;
            }
              topupDiv.style.display = 'block';

            //window.location.href = window.location.href;
          });

          // Add an event listener to the "Hide" button in the topup div
         document.getElementById('hide').addEventListener('click', function () {
        // Hide the topup div
          topupDiv.style.display = 'none';
          });



          okButton1.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            window.location.href = 'subscription3.php';
          });


          okButton2.addEventListener('click', function () {
            // Redirect to the same page (adjust the URL as needed)
            window.location.href = 'dashboard.php';
          });

          

          // Append the button to the div
          alertDiv.appendChild(okButton2);
          alertDiv.appendChild(okButton1);
          alertDiv.appendChild(okButton);
        

          // Append the div to the body
          document.body.appendChild(alertDiv);
        }
      }
    }
  });



  //validate if the number is correct
  function validateTopup() {
        var inputField = document.getElementById('topupInput');
        var enteredValue = parseInt(inputField.value);
        var differenceValue = <?php echo $differenceunitvalue; ?>;
        var costPerUnit = <?php echo isset($_SESSION['costperunit']) ? $_SESSION['costperunit'] : 0; ?>;
        var totalCostElement = document.getElementById('totalCost');

         // Disable the input field if differenceValue is 0
         if (differenceValue === 0) {
        inputField.disabled = true;
        alert('The input field is disabled because the differenceValue is 0.');
        return;
         }

        if (isNaN(enteredValue) || enteredValue > differenceValue) {
            alert('Please enter a valid number that is less than or equal to the difference.' + differenceValue);
            inputField.value = '';
        } else {
            // Calculate and display the product in real-time
            var totalCost = enteredValue * costPerUnit;
            totalCostElement.textContent = totalCost;
        }
    }

    function proceedTopup() {
        var inputField = document.getElementById('topupInput');
        var enteredValue = parseInt(inputField.value);
        var differenceValue = <?php echo $differenceunitvalue; ?>;
        var totalCost = document.getElementById('totalCost').textContent;

        if (differenceValue === 0) {
        alert('Unable to proceed. DifferenceValue is 0.');
        return;
        // You can add additional actions for a differenceValue of 0, such as displaying an alert.
      }

        // Make an AJAX request to the server to store values in session
        $.ajax({
            type: 'POST',
            url: 'topup.php', // Replace with the actual URL of your PHP script
            data: {
                enteredValue: enteredValue,
                totalCost: totalCost
            },
            success: function(response) {
                // Handle the response from the server if needed
                console.log(response);

                // Redirect to payment.php after successful storage in session
                window.location.href = 'paymentModetopup.php';
            },
            error: function(error) {
                // Handle the error if the request fails
                console.error(error);
            }
        });
    }


    document.getElementById('myForm').addEventListener('submit', function (e) {
        // Check if the file input is empty
        if (fileInput.files.length === 0) {
            // Display an alert or perform any desired action
            alert('Please select a file before submitting.');
            e.preventDefault(); // Prevent the form from submitting
        }
    });
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