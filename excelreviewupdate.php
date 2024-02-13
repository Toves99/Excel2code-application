<?php
session_start();
$email=$_SESSION['email'];
$productexcelvariables= $_SESSION['productexcelvariables'];
//extract the product varibles header JSON object and store in the session variable
// the header object will be recombined later with the cells object after the user has reviewed, edited and saved
// the excel variables.
$productexcelvariablesheader = $productexcelvariables['header'];
$_SESSION['productexcelvariablesheader'] =$productexcelvariablesheader;
//extract the product excel variables cell meta data object. The contents of this object will be loaded in the excel variable
// review page for the user to review and edit where necessary
// the excel variables.
$productexcelvariablescells = $productexcelvariables['cells'];
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

  
  <link href="assets/css/reviewupdateexcel.css" rel="stylesheet">

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
   <h3>Review and Update  Excel Calculator Variables</h3>
        <h6>We found the following variables from you excel calculator. Please review and where necessary update. To update a variable, click on the variable name and
         edit accordingly. Note the following:</h6>
         <span class="p34"><li>You cannot update variables whose type is formula.</li></span>
         <span class="p35"><li>Variables with undefined names need to be renamed to appropriate names before proceeding.</li></span>
	<form id="excelvariablesform" action="excelvariablesupdatedummy.php" method="post">
    <div class="cont">
        <table id="excelvariablestable">
          <tr>
		    
            <th>Cell Reference Id</th>
            <th>Cell Name</th>
			<th>Cell Label</th>
            <th>Cell Data Type</th>
            <th>Cell IO Type</th>
			<th>Cell Value</th>
			
          </tr>
		  <?php
		  
		  //print_r($productexcelvariables);
		 // $cellMetaData  = $productexcelvariables['variables'];
		  $inputCellMetaData = $productexcelvariablescells['input'];
		  $outputCellMetaData =$productexcelvariablescells['output'];
		  
		  foreach($inputCellMetaData as $cellRefId => $cellData){
			  
			  $cellName =  $cellData['cellname'];
			  $cellLabel = $cellData['celllabel'];
			  $celldatatype =$cellData['celldatatype'];
			  $celliotype = $cellData['celliotype'];
			  $cellValue  = $cellData['cellvalue'];
			  //$productid = $cellData['productid'];
			 // $userid = $variable['userid'];
			 // $orderid = $variable['orderid'];
			  
		  
		  echo "
		    <tr>
			<td>".$cellRefId."</td>
           <td contenteditable='true' >".$cellName."</td>
           <td contenteditable='true'>".$cellLabel."</td>
		   <td>".$celldatatype."</td>
		   <td>".$celliotype."</td>
		   <td>".$cellValue."</td>
	
			</tr>
	
		  ";
		  }
		  
			   foreach($outputCellMetaData as $cellRefId => $cellData){
			  
			  $cellName =  $cellData['cellname'];
			  $cellLabel = $cellData['celllabel'];
			  $celldatatype =$cellData['celldatatype'];
			  $celliotype = $cellData['celliotype'];
			  $cellValue  = $cellData['cellvalue'];
			  
		  echo "
		    <tr>
			<td>".$cellRefId."</td>
           <td contenteditable='true' >".$cellName."</td>
           <td contenteditable='true'>".$cellLabel."</td>
		   <td>".$celldatatype."</td>
		   <td>".$celliotype."</td>
		   <td>".$cellValue."</td>
	
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
	<button type="submit" name="updateexcelvariables" class="b1t" onclick="submitExcelVariablesForm()">Save</button>
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
/*
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
  */
</script>




<script>
    function submitExcelVariablesForm() {
        // Get table data
        var table = document.getElementById("excelvariablestable");
       // var data = [];
       //var rowData = [];
		var inputCellJsonDataObjects = {};
		var outputCellJsonDataObjects ={};
		var cellDataJsonObject = {};
        for (var i = 1; i < table.rows.length; i++) {   
			 var object = {};
			 var iotype ="";
			 var cellrefid ="";
			  
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                let tableValue = table.rows[i].cells[j].innerHTML;
				let variableName = "";
			if(j==0){
				variableName="cellrefid";
				cellrefid = tableValue;
				
			}else if(j==1){
				variableName ="cellname";
				
			}
			else if(j==2){
				variableName ="celllabel";
				
			}
			else if(j==3){
				variableName ="celldatatype";
				
			}
			else if(j==4){
				variableName ="celliotype";
				 iotype =tableValue;
				
			}
			else if(j==5){
				variableName ="cellvalue";
				
			}
			
			if(variableName!=='cellrefid'){
			object[variableName]= tableValue;
			 }
			 
			// let cellKeyValuePair  = {key:variableName, value:tableValue};
			  // rowData[variableName] = tableValue;
				  //rowData.push(object);
            }
			//var cellRefIdObject = {};
			
			//cellRefIdObject[cellrefid]= object;
			
			if(iotype==='input'){
			   inputCellJsonDataObjects [cellrefid] = object;	
				
			}
			else{
			   outputCellJsonDataObjects [cellrefid] = object;	
				
			}
			
			}
			cellDataJsonObject['input']=inputCellJsonDataObjects ;
			cellDataJsonObject['output']=outputCellJsonDataObjects ;
            //data.push(object);

        // Add the data to a hidden input field
        var dataInput = document.createElement("input");
        dataInput.type = "hidden";
        dataInput.name = "tableData";
        dataInput.value = JSON.stringify(cellDataJsonObject);
        document.getElementById("excelvariablesform").appendChild(dataInput);

        // Submit the form
        document.getElementById("excelvariablesform").submit();
    }
</script>

</body>

</html>