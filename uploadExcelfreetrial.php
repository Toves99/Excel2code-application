<?php
session_start();

//print_r($_FILES);
//print_r($_POST);
$file = $_FILES;
$companyid=$_SESSION['companyid'];
$email = $_SESSION['email'];
$serviceid="SE001";
$service="Excel calculator";
$servicename="Excel2codeAPI";
$count=0;
$totalCost=0;
$costperunit=0;
$subscriptionid=0;
$packagename="trial";
$totalunit=0;
$orderprice=0;
$monthValue=3;
$paymentAmount=0;

$paymentstatus=3;

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
$user_id = $_SESSION['userId'];
$Password=$_SESSION['password'];
$product_id = $_SESSION['productid'];
$username=$_SESSION['username'];

if (isset($_POST['submit'])) {


    $selectfromsystemsettings="SELECT parametername,parametervalue,unitofmeasurement FROM systemsettings";
    $resultsystemsettings=mysqli_query($conn,$selectfromsystemsettings);
    $row = mysqli_fetch_assoc($resultsystemsettings);
    $freetrialdays=$row['parametervalue'];
    $unitmeasurement=$row['unitofmeasurement'];
    
    $currentdatetime = new DateTime();
    $currentdatetime->modify("+" . $freetrialdays . " " . $unitmeasurement);
    $expirydate =$currentdatetime->format('Y-m-d H:i:s');
    
   
   
   $checkiffreetrialexist="SELECT * FROM orders WHERE nature='free trial'";
   $result=mysqli_query($conn,$checkiffreetrialexist);
   $num=mysqli_num_rows($result);

    if($num>0){
      echo "<script>alert('You are have existing free trial .');
                 window.location.href = 'uploadExcelfreetrial.php';</script>";
    } else{
    // Calculate the new timestamp by adding months to the current timestamp
    //$expirydate = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));
    $sqlquery="INSERT INTO `orders`(`userId`,`servicename`, `count`,`service`,`validityperiod`,`expirydate`,`paidamount`,`paymentstatus`,`paymentmessage`,`serviceid`,`orderprice`,`costperunit`,`packagename`,`subscriptionid`,`totalunit`,`nature`)
    VALUES ('$user_id', '$servicename','$count','$service','$monthValue','$expirydate','$paymentAmount','$paymentstatus','unpaid','$serviceid','$totalCost','$costperunit','$packagename','$subscriptionid','$totalunit','free trial')";
    $query_run = mysqli_query($conn,$sqlquery);
    if($query_run){
    $orderid = mysqli_insert_id($conn);
      // Store the 'orderId' in the session
      $_SESSION['orderid'] = $orderid;
      $_SESSION['expirydate'] = $expirydate;
      $_SESSION['serviceid'] = $serviceid;
      $_SESSION['servicename'] = $servicename;
      $_SESSION['packagename'] = $packagename;

      $expirydate=$_SESSION['expirydate'];
      //echo "expirydate is=>".$expirydate;
      //$orderId=$_SESSION['id'];
    //echo "<script>alert('We are yet to receieve your payment. Please Try again to verify');window.location.href = 'uploadExcel.php';</script>";
    //echo "<script>alert('We are yet to receieve your payment. Please Try again to verify');window.location.href = 'uploadExcel.php';</script>";
     }


    $productName = $_POST['productName'];
    $orderid = $_SESSION['orderid'];
    $productCategory = $_POST['productCategory'];
    $directoryFolder="uploads/";
    $filename=$_FILES['uploadfile']["name"];
    $filetemppath=$_FILES['uploadfile']["tmp_name"];
    //echo "uploaded file name=".$filename."uploaded file temp path=".$filetemppath;
    // die;

    $data=[$file];
    $fileupload=implode('',$data);
	//print_r($directoryFolder.$file);
	$fileuploadurl="https://4889-196-216-86-91.ngrok-free.app/excelcode/upload";
     $fileuploadresponse= uploadFile($fileuploadurl, $filetemppath);
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
      //$newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));
      $insert_query = "INSERT INTO `excelcalculatortb` (`productName`,`monthvalue`,`costperunit`,`totalCost`,`userId`,`productid`,`expiryDate`,`productCategory`,`uploadfile`,`orderid`,`companyid`,`nature`)
			VALUES ('$productName','$monthValue', '$costperunit','$totalCost','$user_id','$product_id','$expirydate','$productCategory','$fileupload','$orderid','$companyid','free trial')";
      $query_run = mysqli_query($conn, $insert_query);
      if($query_run){
       //move_uploaded_file($file_temp,$directoryFolder.$file);
       $geturlparams = "action=freetrial";
       // Move alert after the redirect
          echo "<script>window.location.href='excelCalculator.php?".$geturlparams."';</script>";
          echo "<script>alert('Your trial excel uploaded successfully');</script>";
        }         
				 
      }else{
        echo "<script>alert('Error Occurred while uploading your excel.');
                 window.location.href = 'uploadExcelfreetrial.php';</script>";
                 
      }

       
			
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
  <link href="assets/css/uploadtrial1.css" rel="stylesheet">

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
             <a href="updateprofile.php?direction=uploadExcel" style="position:absolute;margin-top:35px;margin-left:20px;font-size:15px;color:black;">Update Profile.</a>
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

    <form action="" method="post" enctype="multipart/form-data" id="myForm">
  
      <h3>Upload Excel Calculator to try or free</h3>
      <p class="exp">Only 1 excel upload is allowed</p>
      
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
        <input type="file" id="file-input" name="uploadfile" required  accept=".xls, .xlsx" >
        <label for="file-input" id="upload-button-label">Add files</label>
       </div>
	   <!---<h6><?php//echo "orderId from the session: " .$servicename; ?></h6>-->
       <div id="file-preview"></div>
       
      </div>
      <input type="submit" name="submit" value="submit" class="sub">
	  
      
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <!-- Add this script to your HTML file -->



 <script>
  const fileInput = document.getElementById('file-input');
  const fileDropArea = document.getElementById('file-drop-area');
  var removeButton = document.getElementById('remove-button');
  const filePreview = document.getElementById('file-preview');

  // Enable drag-and-drop
  fileDropArea.addEventListener('dragover', function (e) {
    e.preventDefault();
    fileDropArea.style.border = '2px dashed #000';
  });

  fileDropArea.addEventListener('dragleave', function () {
    fileDropArea.style.border = '2px dashed #ccc';
  });

  fileDropArea.addEventListener('drop', function (e) {
    e.preventDefault();
    fileDropArea.style.border = '2px dashed #ccc';

    fileInput.files = e.dataTransfer.files;
    displayFileName();
  });

  // Handle file input change
  fileInput.addEventListener('change', function () {
    displayFileName();
  });

  // Function to display selected file name
  function displayFileName() {
    const fileName = fileInput.files[0].name;
    filePreview.innerHTML = `Selected file: ${fileName}`;
  }

  removeButton.addEventListener('click', function () {
    // Clear the selected file and preview
    fileInput.value = null;
    filePreview.textContent = '';
  });

  // Update the accept attribute to accept only Excel files
  fileInput.accept = ".xls, .xlsx";
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