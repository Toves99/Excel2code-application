1. make productid dynamic in calculate.php
2 make the excel variables review page dynamic
3. logic to upload excel file to remote server
4. complete the select API page
5. test with various calculators


connection failorderId is not set in the session.
Warning: Undefined array key "userId" in C:\xampp\htdocs\webservices1\uploadExcel.php on line 19
No values stored in the session.
IDP
Products
Purchase
support
More


// Function to generate a random 11-digit number
function generateRandomNumber() {
    $randNumber = mt_rand(10000000000, 99999999999);
    return $randNumber;
}

$_SESSION['productid'] = generateRandomNumber(); // Store the random number in the session
include("config.php");






<?php
session_start();
$_SESSION['calcId'] = '10123435354';
include("config.php");

// Check if 'orderId' is set in the session
/*
if (isset($_SESSION['id'])) {
  $orderId = $_SESSION['id'];
  //echo "orderId from the session: " . $orderId;
} else {
  echo "orderId is not set in the session.";
}
*/
$user_id = $_SESSION['userId'];
if (isset($_SESSION['count']) && isset($_SESSION['totalCost']) && isset($_SESSION["monthvalue"]) && isset($_SESSION["costperunit"])) {
  $count = $_SESSION['count'];
  $totalCost = $_SESSION['totalCost'];
  $monthValue = $_SESSION["monthvalue"];
  $costPerUnit = $_SESSION["costperunit"];
} else {
  echo "No values stored in the session.";
}


if (isset($_POST['proceed'])) {
  $count = $_POST['count'];
  $_SESSION['count'] = $count;

// Calculate the total cost based on the input and store it in the session
  $totalCost = $count * 1000000;
  $_SESSION['totalCost'] = $totalCost;
   }
   // Check if the form has been submitted and update session variables if needed
    if (isset($_POST['individualService']) && isset($_POST['subscriptionPeriod'])) {
    $_SESSION['serviceName'] = $_POST['serviceName']; // Example product name
    $_SESSION['individualService'] = $_POST['individualService'];

    }


if (isset($_POST['submit'])) {
  $productName = $_POST['productName'];
  $calcId = "10123435354";
  //$orderId = $_SESSION['id'];
  $productCategory = $_POST['productCategory'];

  

 //echo "product id is " . $_SESSION['calcId'];
   $fileNames = $_FILES['']['name']; // Adjust this line based on your form structure
  // Split the file names into an array
  $fileNamesArray = explode(',', $fileNames);

  foreach ($fileNamesArray as $fileName) {
      // Calculate the new timestamp by adding months to the current timestamp
      $newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));

      $insert_query = "INSERT INTO `producttb` (`userId`,`productName`, `calcId`, `image`, `expiryDate`, `monthvalue`, `costperunit`, `totalCost`,`productCategory`) 
      VALUES ('$user_id','$productName', '$calcId','$fileName', '$newUploadedTime', '$monthValue', '$costPerUnit', '$totalCost','$productCategory')";
      
      $query_run = mysqli_query($conn, $insert_query);

      if (!$query_run) {
          echo "<script>alert('Failed to insert orderId: $fileName')</script>";
      }
  }
   // After successful insertion, count the rows and store the count in a session variable
   $count_query = "SELECT COUNT(*) AS rowCount FROM producttb";
   $count_result = mysqli_query($conn, $count_query);
 
   if ($count_result) {
       $row = mysqli_fetch_assoc($count_result);
       $rowCount = $row['rowCount'];
 
       // Store the row count in a session variable
       $_SESSION['productRowCount'] = $rowCount;
   } else {
       echo "Failed to count rows in the producttb table.";
   }
  echo "<script>alert('Excel uploaded successfully');
           window.location.href = 'uploadExcel.php';</script>";
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

  
  <link href="assets/css/upload14.css" rel="stylesheet">

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
        #file-list {
            padding: 0;
            margin-top:120px;
            list-style: none;
            font-size:14px;
            text-align: left; /* Align list items to the left */
        }
        #file-list li span{
          margin-right: 120px;
          font-size:14px;
          margin-left:34px;
        }
        #file-list li::before {
            content: none; /* Remove the dot (.) before each list item */
        }
    </style>
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
                <a href="service2.php">RPA as a service</a>
              </li>
              <li>
               <a href="service3.php">IDP.Excel.ExcelToPDF</a>
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

    <form action="" method="post" enctype="multipart/form-data">
    <h1><?php echo "product id is " . $_SESSION['calcId'];  ?></h1>
    <div class="steps">
   <span class="span2">1</span>
  <button class="p52">View and Select subscription plan.</button>

  <span class="span3">2</span>
  <p class="p53">Make payment.</p>

  <span class="span4">3</span>
  <p class="p54">Verify your payment.</p>

  <span class="span5">4</span>
  <p class="p55">Upload Excel calculator.</p>

  <span class="span6">5</span>
  <p class="p56">Review and update Excel calculator.</p>

  <span class="span7">6</span>
  <p class="p57">Add another Excel Calculator or proceed to product dashboard.</p>
    </div>
      
      <h3>Upload Excel Calculator</h3>
      <p class="p5">Upload your first calculator and add the rest later.</p>

      <div class="textfield1">
        <label >Product Name</label>
        <input type="text" name="productName" placeholder="Enter Product Name" required>
      </div>

      <div class="textfield2">
        <label >Calculator ID</label>
        <input type="text" name=""  disabled value="">
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
        <input type="file" id="file-input" name="image">
        <label for="file-input" id="upload-button-label">Add files</label>
        <ul id="file-list"></ul>
       </div>
       <div class="dis">
        <span class="d">File Name</span>
        <span class="d1">File Type</span>
        <span class="d2">File Size</span>
       </div>
      </div>
      <input type="hidden" id="file-names" name="fileNames" value="">
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
        if (isset($_SESSION['difference'])) {
          // Loop through the differences for all orderIds
          foreach ($_SESSION['difference'] as $orderId => $difference) {
              //echo "Difference for orderId $orderId is: $difference<br>";
              // You can perform actions with $difference as needed here
          }
        } else {
          echo "No differences found in the session.";
        }
         ?>
        <h6 class="p111" >Service Type:   <span class="sp1">ExcelCalculator2API</span></h6>
        <!---<h6 class="p12">Individual Service:  <span class="sp2"><?php //echo isset($_SESSION['individualService']) ? $_SESSION['individualService'] : ''; ?></span></h6>--->
        <?php
        if (isset($_SESSION['count']) && isset($_SESSION['totalCost'])) {
        
      ?>
      <h6 class="p13">No.calculators ordered: <span class="sp3"><?php echo $_SESSION['count']  ?></span></h6>
      <h6 class="p14">Total cost: <span class="sp4"><?php echo number_format($_SESSION['totalCost'])  ?></span></h6>
      <?php
      }
      ?>
      <h6 class="p15">Subscription Validity:<span class="sp5"><?php echo isset($_SESSION['monthvalue']) ? $_SESSION['monthvalue'] : ''; ?>  months</span><h6>
      <h6 class="p16">Cost per calculator:<span class="sp6"><?php echo isset($_SESSION['costperunit']) ? $_SESSION['costperunit'] : ''; ?></span><h6>
      <h6 class="p17">Cost per calculator:<span class="sp7"><?php echo $difference;   ?></span><h6>
      
      </div>
    </form>
    <button class="can">Cancel</button>
  
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
    const fileDropArea = document.getElementById('file-drop-area');
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');

    fileDropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileDropArea.style.border = '2px dashed #333';
    });

    fileDropArea.addEventListener('dragleave', () => {
        fileDropArea.style.border = '2px dashed #ccc';
    });

    fileDropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileDropArea.style.border = '2px dashed #ccc';
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
        fileInput.value = ''; // Clear the file input value to allow re-selection of the same file
    });

    function handleFiles(files) {
        const fileNames = [];

        for (const file of files) {
            const fileExtension = file.name.split('.').pop().toLowerCase();

            // Check if the file has an Excel extension (e.g., .xlsx or .xls)
            if (fileExtension === 'xlsx' || fileExtension === 'xls') {
                const listItem = document.createElement('li');
                const fileName = document.createElement('span');
                const fileType = document.createElement('span');
                const fileSize = document.createElement('span');

                // Extract the file name without the extension
                const fileNameWithoutExtension = file.name.split('.').slice(0, -1).join('.');

                fileName.textContent = `${fileNameWithoutExtension} `;
                fileType.textContent = `${fileExtension} `;
                fileSize.textContent = `${formatBytes(file.size)}`;

                listItem.appendChild(fileName);
                listItem.appendChild(fileType);
                listItem.appendChild(fileSize);
                fileList.appendChild(listItem);

                // Store the file name without extension in the array
                fileNames.push(fileNameWithoutExtension);
            } else {
                // Display an error message for non-Excel files (you can customize this)
                alert('Only Excel files (XLSX or XLS) are allowed.');
            }
        }

        // Set the hidden input field value to the list of file names
        document.getElementById('file-names').value = fileNames.join(',');
    }

    // Helper function to format file size
    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Add this event listener to the button
    document.getElementById('remove-button').addEventListener('click', () => {
        // Remove the last list item (image) from the list
        const listItems = fileList.querySelectorAll('li');
        if (listItems.length > 0) {
            listItems[listItems.length - 1].remove();
        }
    });
</script>

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






   




</body>

</html>




<?php
session_start();
// Function to generate a random 11-digit number
function generateRandomNumber() {
    $randNumber = mt_rand(10000000000, 99999999999);
    return $randNumber;
}

$_SESSION['productid'] = generateRandomNumber(); // Store the random number in the session
//$_SESSION['calcId'] = '10123435354';
include("config.php");

// Check if 'orderId' is set in the session
/*
if (isset($_SESSION['id'])) {
  $orderId = $_SESSION['id'];
  //echo "orderId from the session: " . $orderId;
} else {
  echo "orderId is not set in the session.";
}
*/
$user_id = $_SESSION['userId'];
if (isset($_SESSION['count']) && isset($_SESSION['totalCost']) && isset($_SESSION["monthvalue"]) && isset($_SESSION["costperunit"])) {
  $count = $_SESSION['count'];
  $totalCost = $_SESSION['totalCost'];
  $monthValue = $_SESSION["monthvalue"];
  $costPerUnit = $_SESSION["costperunit"];
} else {
  echo "No values stored in the session.";
}


if (isset($_POST['proceed'])) {
  $count = $_POST['count'];
  $_SESSION['count'] = $count;

// Calculate the total cost based on the input and store it in the session
  $totalCost = $count * 1000000;
  $_SESSION['totalCost'] = $totalCost;
   }
   // Check if the form has been submitted and update session variables if needed
    if (isset($_POST['individualService']) && isset($_POST['subscriptionPeriod'])) {
    $_SESSION['serviceName'] = $_POST['serviceName']; // Example product name
    $_SESSION['individualService'] = $_POST['individualService'];

    }


if (isset($_POST['submit'])) {
  $productName = $_POST['productName'];
  
  //$orderId = $_SESSION['id'];
  $fileNames = $_POST['fileNames']; // Retrieve the file names from the hidden input field
  $productCategory = $_POST['productCategory'];
  // Split the file names into an array
  $fileNamesArray = explode(',', $fileNames);

  foreach ($fileNamesArray as $fileName) {
      // Calculate the new timestamp by adding months to the current timestamp
      $newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));
	  
	  // Upload file to server
      $targetDirectory = "image/"; // Specify the directory where you want to store uploaded files
      $targetFile = $targetDirectory . basename($fileName);
	  if (move_uploaded_file($_FILES[$fileName]['tmp_name'], $targetFile)) {
	  
      $insert_query = "INSERT INTO `producttb` (`userId`,`productName`,`calcId`,`monthvalue`,`costperunit`,`image`,`totalCost`,`expiryDate`,`productCategory`) 
      VALUES ('$user_id','$productName', '$calcId','$monthValue', '$costPerUnit','$fileName', '$totalCost','$newUploadedTime','$productCategory')";
      
      $query_run = mysqli_query($conn, $insert_query);

      if (!$query_run) {
          echo "<script>alert('Failed to insert orderId: $fileName')</script>";
      }
	  }
  }
   // After successful insertion, count the rows and store the count in a session variable
   $count_query = "SELECT COUNT(*) AS rowCount FROM producttb";
   $count_result = mysqli_query($conn, $count_query);
 
   if ($count_result) {
       $row = mysqli_fetch_assoc($count_result);
       $rowCount = $row['rowCount'];
 
       // Store the row count in a session variable
       $_SESSION['productRowCount'] = $rowCount;
   } else {
       echo "Failed to count rows in the producttb table.";
   }
  echo "<script>alert('Excel uploaded successfully');
           window.location.href = 'excelCalculator.php';</script>";
}
?>




//Upload to the server
    $uploadDirectory = "https://0c4b-196-216-86-84.ngrok-free.app/excelcalculatorapi/calculatorapi?calculatorid=ilamcalculator/upload"; // Change this to your desired directory
    $targetFilePath = $uploadDirectory . basename($fileName);
	if (move_uploaded_file($_FILES['fileNames']['tmp_name'], $targetFilePath)) {
      echo "<script>alert('Excel uploaded successfully');
      window.location.href = 'excelCalculator.php';</script>";
    } else {
      echo "<script>alert('Error uploading file to the server');
      window.location.href = 'uploadExcel.php';</script>";
    }
	
	
	https://0c4b-196-216-86-84.ngrok-free.app/excelcalculatorapi/calculatorapi/upload
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
session_start();
include("fileuploadclient.php");
$email = $_SESSION['email'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
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
$product_id = $_SESSION['productid'];

if (isset($_SESSION['count']) && isset($_SESSION['totalCost']) && isset($_SESSION["monthvalue"]) && isset($_SESSION["costperunit"])) {
    $count = $_SESSION['count'];
    $totalCost = $_SESSION['totalCost'];
    $monthValue = $_SESSION["monthvalue"];
    $costPerUnit = $_SESSION["costperunit"];
} else {
    echo "No values stored in the session.";
}

if (isset($_POST['proceed'])) {
    $count = $_POST['count'];
    $_SESSION['count'] = $count;

    // Calculate the total cost based on the input and store it in the session
    $totalCost = $count * 1000000;
    $_SESSION['totalCost'] = $totalCost;
}

if (isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    //$orderId = $_SESSION['id'];
    $fileDetailsJSON = $_POST['fileNames']; // Retrieve the JSON string from the hidden input field
    $productCategory = $_POST['productCategory'];
    $totalCost = $_SESSION['totalCost'];
    $monthValue = $_SESSION["monthvalue"];
    $costPerUnit = $_SESSION["costperunit"];

    // Decode the JSON string to get an array of file details
    $fileDetailsArray = json_decode($fileDetailsJSON, true);

    foreach ($fileDetailsArray as $fileDetail) {
        // Extract file details
        $fileNameWithoutExtension = $fileDetail['name'];
        $fileExtension = $fileDetail['extension'];
        $filePath = $fileDetail['path'];
		$fileDetails = $filePath . '/' . $fileNameWithoutExtension . '.' . $fileExtension;
		print_r($fileDetail);

        // Calculate the new timestamp by adding months to the current timestamp
        $newUploadedTime = date('Y-m-d H:i:s', strtotime($monthValue . ' months', strtotime('now')));

        // Use $_FILES to get the full path of the uploaded file
        $uploadedFilePath = $filePath;
		$fileForUpload=$filePath . '/' . $fileNameWithoutExtension . '.' . $fileExtension;
		//print_r($fileForUpload);

        $uploadDirectory = "image/";  // Assuming "upload" is in the same directory as your script
        $destinationPath = $uploadDirectory . $fileNameWithoutExtension . '.' . $fileExtension;
        move_uploaded_file($uploadedFilePath, $destinationPath);
		$fileuploadresponse=uploadFile($uploadDirectory,$fileForUpload);
		if($fileuploadresponse==200){
			$insert_query = "INSERT INTO `excelcalculatortb` (`productName`,`monthvalue`,`costperunit`,`totalCost`,`userId`,`productid`,`expiryDate`,`productCategory`,`file`)
			VALUES ('$productName','$monthValue', '$costPerUnit','$totalCost','$user_id','$product_id','$newUploadedTime','$productCategory','$destinationPath')";

        $query_run = mysqli_query($conn, $insert_query);
		if($query_run){
			echo "<script>alert('Excel uploaded successfully');
                 window.location.href = 'excelCalculator.php';</script>";
		}
			
		}else{
			error_log("file upload failed with status=".$fileuploadresponse,0,"C:/xampp/htdocs/webservices1/error.log");
			echo "<script>alert('Excel uploaded successfully');
                 window.location.href = 'excelCalculator.php';</script>";
		}
				
	}			
		
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

  
  <link href="assets/css/upload15.css" rel="stylesheet">

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
        #file-list {
            padding: 0;
            margin-top:120px;
            list-style: none;
            font-size:14px;
            text-align: left; /* Align list items to the left */
        }
        #file-list li span{
          margin-right: 120px;
          font-size:14px;
          margin-left:34px;
        }
        #file-list li::before {
            content: none; /* Remove the dot (.) before each list item */
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
        <li class="dropdown megamenu"><a href="#"><span>Products</span></a>
            <ul>
              <li>
               <a href="#">IDP.Excel.Execalcalculator2API</a>
                <a href="#">IDP.Insurance.Instructions.Analyze</a>
                <a href="service2.php">RPA as a service</a>
              </li>
              <li>
               <a href="service3.php">IDP.Excel.ExcelToPDF</a>
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
        </ul>
        
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a href="login.php">
          <button class="p2">
            <img src="image/noti.png" alt="" class="img1">
          </button>
          </a>
          <button class="p3"><img src="image/account.png" alt="" class="img"></button>
          <p class="p4"><?php echo $name;  ?></p>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <form action="" method="post" enctype="multipart/form-data">
    <!--<h1><?php //echo "product id is " . $_SESSION['calcId'];  ?></h1>-->
    <div class="steps">
   <span class="span2">1</span>
  <button class="p52">View and Select subscription plan.</button>

  <span class="span3">2</span>
  <p class="p53">Make payment.</p>

  <span class="span4">3</span>
  <p class="p54">Verify your payment.</p>

  <span class="span5">4</span>
  <p class="p55">Upload Excel calculator.</p>

  <span class="span6">5</span>,
  <p class="p56">Review and update Excel calculator.</p>

  <span class="span7">6</span>
  <p class="p57">Add another Excel Calculator or proceed to product dashboard.</p>
    </div>
      
      <h3>Upload Excel Calculator</h3>
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
        <input type="file" id="file-input" name="image">
        <label for="file-input" id="upload-button-label">Add files</label>
        <ul id="file-list"></ul>
       </div>
       <div class="dis">
        <span class="d">File Name</span>
        <span class="d1">File Type</span>
        <span class="d2">File Size</span>
       </div>
      </div>
      <input type="hidden" id="file-names" name="fileNames" value="">
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
        if (isset($_SESSION['difference'])) {
          // Loop through the differences for all orderIds
          foreach ($_SESSION['difference'] as $orderId => $difference) {
              //echo "Difference for orderId $orderId is: $difference<br>";
              // You can perform actions with $difference as needed here
          }
        } else {
          echo "No differences found in the session.";
        }
         ?>
        <h6 class="p111" >Service Type:   <span class="sp1">ExcelCalculator2API</span></h6>
        <!---<h6 class="p12">Individual Service:  <span class="sp2"><?php //echo isset($_SESSION['individualService']) ? $_SESSION['individualService'] : ''; ?></span></h6>--->
        <?php
        if (isset($_SESSION['count']) && isset($_SESSION['totalCost'])) {
        
      ?>
      <h6 class="p13">No.calculators ordered: <span class="sp3"><?php echo $_SESSION['count']  ?></span></h6>
      <h6 class="p14">Total cost: <span class="sp4"><?php echo number_format($_SESSION['totalCost'])  ?></span></h6>
      <?php
      }
      ?>
      <h6 class="p15">Subscription Validity:<span class="sp5"><?php echo isset($_SESSION['monthvalue']) ? $_SESSION['monthvalue'] : ''; ?>  months</span><h6>
      <h6 class="p16">Cost per calculator:<span class="sp6"><?php echo isset($_SESSION['costperunit']) ? $_SESSION['costperunit'] : ''; ?></span><h6>
      <!--<h6 class="p17">Cost per calculator:<span class="sp7"><?php //echo $difference;   ?></span><h6>-->
	  
	  
      
      </div>
    </form>
    <button class="can">Cancel</button>
  
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
 <!-- Add this script to your HTML file -->
<script>
    const fileDropArea = document.getElementById('file-drop-area');
    const fileInput = document.getElementById('file-input');
    const fileList = document.getElementById('file-list');

    fileDropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        fileDropArea.style.border = '2px dashed #333';
    });

    fileDropArea.addEventListener('dragleave', () => {
        fileDropArea.style.border = '2px dashed #ccc';
    });

    fileDropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        fileDropArea.style.border = '2px dashed #ccc';
        handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
        fileInput.value = ''; // Clear the file input value to allow re-selection of the same file
    });

    function handleFiles(files) {
        const fileDetails = [];

        for (const file of files) {
            const fileExtension = file.name.split('.').pop().toLowerCase();

            // Check if the file has an Excel extension (e.g., .xlsx or .xls)
            if (fileExtension === 'xlsx' || fileExtension === 'xls') {
                const listItem = document.createElement('li');
                const fileName = document.createElement('span');
                const fileType = document.createElement('span');
                const fileSize = document.createElement('span');

                // Extract the file name without the extension
                const fileNameWithoutExtension = file.name.split('.').slice(0, -1).join('.');

                fileName.textContent = `${fileNameWithoutExtension} `;
                fileType.textContent = `${fileExtension} `;
                fileSize.textContent = `${formatBytes(file.size)}`;

                listItem.appendChild(fileName);
                listItem.appendChild(fileType);
                listItem.appendChild(fileSize);
                fileList.appendChild(listItem);

                // Store the file details in the array
                const fileDetail = {
                    name: fileNameWithoutExtension,
                    extension: fileExtension,
                    path: file.webkitRelativePath, // Store the path
                };
                fileDetails.push(fileDetail);
            } else {
                // Display an error message for non-Excel files (you can customize this)
                alert('Only Excel files (XLSX or XLS) are allowed.');
            }
        }

        // Convert the file details array to a JSON string and set it as the value of the hidden input field
        document.getElementById('file-names').value = JSON.stringify(fileDetails);
    }

    function formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Add this event listener to the button
    document.getElementById('remove-button').addEventListener('click', () => {
        // Remove the last list item (image) from the list
        const listItems = fileList.querySelectorAll('li');
        if (listItems.length > 0) {
            listItems[listItems.length - 1].remove();
        }
    });
</script>


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






   




</body>

</html>



<tr>
            <td>hee</td>
            <td>hee</td>
            <td>hee</td>
            <td>
              <select name="" id="">
                <option value="">user defined</option>
                <option value="">constant</option>
              </select>
            </td>
          </tr>
		  
		  
		  
		  
		  
		  
		  
		  <?php
       
       if($num>0){
         while($data=mysqli_fetch_assoc($result)){
           echo "
           <tr>
           <td>".$data['Excel Cell Reference']."</td>
           <td class='editable' data-variable-id='" . $data['Variable ID'] . "'>" . $data['Variable Name'] . "</td>
           <td>".$data['Variable Type']."</td>
           <td>
           <select class='variable-type' data-variable-id='" . $data['Variable ID'] . "'>
                <option value="">user defined</option>
                <option value="">constant</option>
              </select>
           </td>
           
           </tr>
           ";
         }
       }
       else{
         echo "
       <tr data-href='#'>
         <td colspan='6' class='error-message'>Error occurred please try to reload the page again</td>
       </tr>
        ";
       }
       
       ?>
	   
	   
	   <?php
session_start();
$email=$_SESSION['email'];
$productexcelvariables=$_SESSION['productexcelvariables'];
//print_r($productexcelvariables);
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
require_once "config.php";
$sql="SELECT inputVar FROM testtb";
$all_test=$conn->query($sql);

$sql2="SELECT inputVar FROM testtb";
$all_test2=$conn->query($sql2);

// Check if 'productRowCount' is set in the session and echo its value
if (isset($_SESSION['productRowCount'])) {
  $productRowCount = $_SESSION['productRowCount'];
  //echo "Number of rows in 'producttb' table: " . $productRowCount;
} else {
  //echo "productRowCount is not set in the session.";
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

  
  <link href="assets/css/reviewupdate.css" rel="stylesheet">

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
            margin-top:-80px;
            margin-left:540px;
            font-size:16px;
            border:1px solid black;
        }
        #file-list {
            padding: 0;
            margin-top:120px;
            list-style: none;
            font-size:14px;
            text-align: left; /* Align list items to the left */
        }
        #file-list li span{
          margin-right: 120px;
          font-size:14px;
          margin-left:34px;
        }
        #file-list li::before {
            content: none; /* Remove the dot (.) before each list item */
        }

        
        
    .hidden {
        display: none;
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
        <li class="dropdown megamenu"><a href="#"><span>Products</span></a>
            <ul>
              <li>
               <a href="#">IDP.Excel.Execalcalculator2API</a>
                <a href="#">IDP.Insurance.Instructions.Analyze</a>
                <a href="service2.php">RPA as a service</a>
              </li>
              <li>
               <a href="service3.php">IDP.Excel.ExcelToPDF</a>
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
          
        </ul>
        
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a href="login.php">
          <button class="p2">
            <img src="image/noti.png" alt="" class="img1">
          </button>
          </a>
          <button class="p3"><img src="image/account.png" alt="" class="img"></button>
          <p class="p4"><?php echo $name;  ?></p>
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
   <div class="form">
   
   <div class="steps">
   <span class="span2">1</span>
  <button class="p52">View and Select subscription plan.</button>

  <span class="span3">2</span>
  <p class="p53">Make payment.</p>

  <span class="span4">3</span>
  <p class="p54">Verify your payment.</p>

  <span class="span5">4</span>
  <p class="p55">Upload Excel calculator.</p>

  <span class="span6">5</span>
  <p class="p56">Review and update Excel calculator.</p>

  <span class="span7">6</span>
  <p class="p57">Add another Excel Calculator or proceed to product dashboard.</p>
    </div>
   
   <h3>Review and Update  Excel Calculator Variables</h3>
        <h6>We found the following variables from you excel calculator. Please review and where necessary update. To update a variable, click on the variable name and
         edit accordingly. Note the following:</h6>
         <span class="p34"><li>You cannot update variables whose type is formula.</li></span>
         <span class="p35"><li>Variables with undefined names need to be renamed to appropriate names before proceeding.</li></span>
	<form action="excelvariablesupdatedummy.php" method="POST">
    <div class="cont">
        <table>
          <tr>
		    
            <th>Cell Reference Id</th>
            <th>Cell Name</th>
			<th>Cell Label</th>
            <th>Cell Data Type</th>
            <th>Cell IO Type</th>
			<th>Cell Value</th>
			
          </tr>
		  <?php
		  foreach($productexcelvariables as $variable){
			  $cellRefid = $variable['cellrefid'];
			  $cellName =  $variable['cellname'];
			  $cellLabel = $variable['celllabel'];
			  $celldatatype =$variable['celldatatype'];
			  $celliotype = $variable['celliotype'];
			  $cellValue  = $variable['cellvalue'];
			  $productid = $variable['productid'];
			  $userid = $variable['userid'];
			  $orderid = $variable['orderid'];
			  
		  
		  echo "
		    <tr>
			<td><input type='text' name='cellrefid' value='$cellRefid'></td>
			<td><input type='text' name='cellname' value='$cellName'></td>
			<td><input type='text' name='celllabel' value='$cellLabel'></td>
			<td><input type='text' name='celldatatype' value='$celldatatype'></td>
			<td><input type='text' name='celliotype' value='$celliotype'></td>
			<td><input type='text' name='cellValue' value='$cellValue'></td>
			
	
			</tr>
	
		  ";
		  
		  
		  }
		  ?>
		  <!--<tr>
            <td>hee</td>
            <td>hee</td>
			<td>hee</td>
            <td>hee</td>
            <td>hee</td>
			<td>hee</td>
			<td>
			<select name="" id="">
			    <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
			</td>
          </tr>-->
        </table>
    </div>
	<button type="submit" name="updateexcelvariables" class="b1t">Save</button>
	</form>
      <a href="uploadExcel.php">
      <button class="b2t">Back</button>
      </a>
      
      
      
      
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
  <script>
    const label = document.getElementById('editableLabel');

    label.addEventListener('input', function() {
        // Handle changes to the label content here
        console.log('Label content changed to: ' + label.textContent);
    });
</script>



<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to each dropdown
    var dropdowns = document.querySelectorAll('.variable-type');
    dropdowns.forEach(function (dropdown) {
      dropdown.addEventListener('change', function () {
        var selectedValue = this.value;
        var variableId = this.getAttribute('data-variable-id');
        var editableCell = document.querySelector('.editable[data-variable-id="' + variableId + '"]');

        // Check if the selected value is 'user-defined' and make the cell editable
        if (selectedValue === 'user-defined') {
          editableCell.contentEditable = true;
          editableCell.style.border = '1px solid #ccc';
        } else {
          editableCell.contentEditable = false;
          editableCell.style.border = 'none';
        }
      });
    });
  });
</script>

</body>

</html>
	   
	   
	   
	   <li class="dropdown megamenu"><a href="#"><span>Products</span></a>
            <ul>
              <li>
                <a href="services.php">IDP.Excel.Execalcalculator2API</a>
                <a href="services1.php">IDP.Insurance.Instructions.Analyze</a>
                <a href="service2.php">RPA as a service</a>
              </li>
              <li>
                <a href="service3.php">IDP.Excel.ExcelToPDF</a>
              </li>
            </ul>
          </li>
		  
		  
		  
		  
		  
		  // Count the number of rows in the table
  $countQuery = "SELECT
    orders.id,
    COUNT(excelcalculatortb.producttId) AS counter
FROM
    orders
LEFT JOIN
    excelcalculatortb ON orders.id = excelcalculatortb.id
GROUP BY
    orders.id";
  $countResult = mysqli_query($conn, $countQuery);

  if ($countResult) {
    $rowCount = mysqli_fetch_assoc($countResult)['counter'];
    $_SESSION['rowCount'] = $rowCount;
    //echo "Number of rows in the table: " . $rowCount;
  } else {
    //echo "Failed to count rows in the table.";
  } 