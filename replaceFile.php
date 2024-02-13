<?php
session_start();
$email = $_SESSION['email'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
include("fileuploadclient.php");
include("config.php");




if (isset($_POST['proceed'])) {
  $_SESSION['totalunit'] = $totalunit;
  $totalunit=$_SESSION['totalunit'];

  
}




$orderId=$_GET['orderid'];
$sqlordertb = "SELECT  servicename,validityperiod,count,orderprice,costperunit,packagename,DATE_FORMAT(orders.expirydate, '%Y-%m-%d') AS ExpiryDate FROM users,orders WHERE users.userId=orders.userId AND orders.id=$orderId";
$resultorder=mysqli_query($conn,$sqlordertb);
if($resultorder){
  $row=mysqli_fetch_assoc($resultorder);
  $servicename = $row['servicename'];
  $validityperiod = $row['validityperiod'];
  $count = $row['count'];
  $orderprice = $row['orderprice'];
  $packagename = $row['packagename'];
  $expiryDate = $row['ExpiryDate'];
  $costperunit = $row['costperunit'];

}


// Function to generate a random 11-digit number
function generateRandomNumber()
{
    $randNumber = mt_rand(10000000000, 99999999999);
    return $randNumber;
}

$_SESSION['productid'] = generateRandomNumber(); // Store the random number in the session
$user_id = $_SESSION['userId'];
$Password=$_SESSION['password'];
$product_id = $_SESSION['productid'];
$companyname=$_SESSION['companyname'];
$companyid = $_SESSION['companyid'];
$username=$_SESSION['username'];
// Check if 'orderId' is set in the session

if (isset($_SESSION['id'])) {
 // $orderId = $_SESSION['id'];
  //echo "orderId from the session: " . $orderId;
} else {
  //echo "orderId is not set in the session.";
  //print_r($_POST);
  $orderid=$_GET['orderid'];
  
}
if (isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    $orderId = $_SESSION['id'];
    $productCategory = $_POST['productCategory'];
    

    $directoryFolder="uploads/";
	
    $file=$_FILES["uploadfile"]["name"];
    $file_temp=$_FILES["uploadfile"]["tmp_name"];
    $data=[$file];
    $fileupload=implode('',$data);
	//print_r($directoryFolder.$file);
	$fileuploadurl="https://6431-196-216-86-77.ngrok-free.app/excelcode/upload";
	
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
     $fileuploadresponse= uploadFile($fileuploadurl,$directoryFolder.$file);
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
      $newUploadedTime = date('Y-m-d H:i:s', strtotime($validityperiod . ' months', strtotime('now')));
      $insert_query = "INSERT INTO `excelcalculatortb` (`productName`,`monthvalue`,`costperunit`,`totalCost`,`userId`,`productid`,`expiryDate`,`productCategory`,`uploadfile`,`id`,`companyid`)
			VALUES ('$productName','$validityperiod', '$costperunit','$orderprice','$user_id','$product_id','$newUploadedTime','$productCategory','$fileupload','$orderId','$companyid ')";
      $query_run = mysqli_query($conn, $insert_query);
      if($query_run){
       //move_uploaded_file($file_temp,$directoryFolder.$file);

       echo "
       <div id='alert' style='position:absolute;width:500px;height:200px;background-color:maroon;border:1px solid lightblue; margin-top:270px; margin-left:400px;border-radius:10px;z-index:100000;'>
         <p style='position:absolute;margin-top:70px;color:white;font-size:18px;margin-left:100px'>Uploading your Excel please wait....</p>
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
                   window.location.href = 'excelcalculatorreviewandupdate.php';
               }, 5000); // Hide the div after 7 seconds and redirect to 'excelcalculatorreviewandupdate.php'
       
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
         
      }else{
        echo "<script>alert('Error occurred while uploading your excel.');
                 window.location.href = 'uploadExcelOrder.php';</script>";
      }
			  
			  
		  }
		
    }
    else{
      error_log("file upload failed with status=".$fileHttpResponseCode,0,"C:/xampp/htdocs/webservices1/error.log");
    }
	

} 
 
  


//$count=$row['count'];
//$count=$_SESSION['count'];

// Retrieve the 'difference' parameter from the URL
if (isset($_GET['difference'])) {
    $difference = intval($_GET['difference']);
    
    // Now you can use $difference in your code
    // For example, you can echo it or perform other operations
    //echo "The difference is: " . $difference;
} else {
    // Handle the case when 'difference' parameter is not present in the URL
    //echo "Difference parameter not found.";
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

  
  <link href="assets/css/upload7.css" rel="stylesheet">

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
          
          <button class="p3"><img src="image/account.png" alt="" class="img"></button>
          <p class="p4"><?php echo $name;  ?></p>
		  
		  

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

    <form action="" method="post" enctype="multipart/form-data">
    
    
      
      <h3>Upload Excel Calculator</h3>
      <p style="position:absolute;margin-top:80px;color:black;margin-left:400px;">Order ID:<span style="margin-left:3px;font-size:20px;color:maroon;"><?php echo $orderId  ?></span></p>
      <p style="position:absolute;margin-top:80px;color:black;margin-left:550px;">Package Name:<span style="margin-left:3px;font-size:20px;color:maroon;"><?php echo $packagename  ?></span></p>
      <p style="position:absolute;margin-top:80px;color:black;margin-left:800px;">Current Package Expires On:<span style="margin-left:3px;font-size:20px;color:maroon;"><?php echo $expiryDate  ?></span></p>
      <p class="p5">Upload your first calculator and add the rest later.</p>

      <div class="textfield1">
        <label >Product Name</label>
        <input type="text" name="productName" placeholder="Enter Product Name" required>
      </div>

      <div class="textfield2">
        <label >Calculator ID</label>
        <input type="text" name="productid"  disabled value="<?php echo $product_id;  ?>">
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
        <input type="file" id="file-input" name="uploadfile">
        <label for="file-input" id="upload-button-label">Add files</label>
       </div>
	   <h6><?php //echo "The difference is: " . $difference;  ?></h6>
       <div id="file-preview"></div>
      </div>
      <input type="submit" name="submit" value="submit" class="sub">
      <?php
      if (isset($_SESSION['totalunit'])) {
        
        ?>
        <h4 style="color:white;"> total unit<?php echo isset($_SESSION['totalunit']) ? $_SESSION['totalunit'] : ''; ?></h4>
       <?php
      }
      ?>
      <h5>Your Subscriptions Details</h5>
      <div class="select">
      
        <h6 class="p111" >Service Type:   <span class="sp1"><?php echo $servicename;   ?></span></h6>
        
      <h6 class="p13">No.calculators ordered: <span class="sp3"><?php echo $count;  ?></span></h6>
      <h6 class="p14">Total cost: <span class="sp4"><?php echo $orderprice;   ?></span></h6>
      
      <h6 class="p15">Subscription Validity:<span class="sp5"><?php echo $validityperiod; ?>  months</span><h6>
      <h6 class="p16">Cost per calculator:<span class="sp6"><?php echo $costperunit; ?></span><h6>
      <h6 class="p18">Package Name:<span class="sp8"><?php echo isset($_SESSION['packagename']) ? $_SESSION['packagename'] : ''; ?></span><h6>
      <h6 class="p17">Un utilized Calculator:<span class="sp7"><?php echo $difference;  ?></span><h6>
	  
	  
      
      </div>
    </form>
    <button class="can">Cancel</button>

    <!-- Top up div start -->
    <div id="topup">
      <p style="position:absolute;color:white">costperunit<?php echo isset($_SESSION['costperunit']) ? $_SESSION['costperunit'] : ''; ?></p>
      <span style="position:absolute;color:white">prevous unit<?php echo $_SESSION['count']  ?></span>
      <h4 style="position:absolute;color:white">totalunit<?php echo isset($_SESSION['totalunit']) ? $_SESSION['totalunit'] : ''; ?></h4>
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

    function handleFiles(files) {
      if (files.length > 0) {
        var file = files[0];

        // Check if the number of selected files is within the allowed limit
        if (files.length <= maxAllowedFiles) {
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
            window.location.href = 'steps.php';
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
</script>



   




</body>

</html>