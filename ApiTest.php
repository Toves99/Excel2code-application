<?php
session_start();
$username=$_SESSION['username'];
// the route does not matter
$user_id = null;
$expirydate = null;
if(isset($_SESSION['userId'])){
  $user_id = $_SESSION['userId'];
}
if(isset($_GET['expirydate'])){
  $expirydate = $_GET['expirydate'];
}
//variable tells the trigger to this route
$apiTextRoutecontext =0;
//route dependent variables
$packagename =null;
$companyname = null;
$companyid =null;
$serviceid = null;
$productid =null;
$orderId = null;

  if(isset($_GET['context'])){
    $apiTextRoutecontext = $_GET['context'];
  }

  if($apiTextRoutecontext>1){  
  $companyname=$_GET['companyname'];
 // $userid = $_GET['userId'];
  $productid = $_GET['productid'];
  $companyid = $_GET['companyid'];
  $serviceid=$_GET['serviceid'];
  $orderid = $_GET['orderid'];
  $packagename=$_GET['packagename'];
  }
 else{
  $companyname=$_SESSION['companyname'];
 // $userid = $_GET['userId'];
  $productid = $_SESSION['productid'];
  $companyid = $_SESSION['companyid'];
  $serviceid=$_SESSION['serviceid'];
  $orderid = $_SESSION['orderid'];
  $packagename=$_SESSION['packagename'];

 }

  //echo "orderid=>".$orderid;
  

//print_r($_SERVER['QUERY_STRING']);

//fetch the excel config variables for the current product then load in the page
// for the user to edit
$excelConfigVariablesArrayFetchRequest = array();
$excelConfigVariablesArrayFetchRequest ['serviceid']=$serviceid;
$excelConfigVariablesArrayFetchRequest ['companyid']=$companyid;
$excelConfigVariablesArrayFetchRequest ['productid']=$productid;
$excelConfigVariablesArrayFetchRequest ['orderid']=$orderid;
$excelConfigVariablesJsonFetchRequest =json_encode($excelConfigVariablesArrayFetchRequest);
//$orderid="null";
$_SESSION['orderid'] = $orderid;

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
$result = file_get_contents($fileediturl, false, $context);
//print_r($result);
// Check for errors
if ($result === FALSE) {
    die('Error occurred while making the request');
}
$responseArray  = json_decode($result,true);




$transactionstatuscode = $responseArray['response']['status']['transactionstatuscode'];
$httpstatuscode= $responseArray['response']['status']['httpstatuscode'];
       if($httpstatuscode != 200 || $transactionstatuscode!=200){
		   
		   die('Error occurred while making the request');
		   
		   
	   }
	   else{
		   
		
		
		

		
		   
	   }

$email=$_SESSION['email'];
//$productexcelvariables=$_SESSION['productexcelvariables'];
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

  
  <link href="assets/css/apitest4.css" rel="stylesheet">

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
             <a href="updateprofile.php?direction=apitest&orderid=<?php echo $orderid; ?>&productid=<?php echo $productid;?>&packagename=<?php echo $packagename;  ?>&expirydate=<?php echo $expirydate;?>&companyid=<?php echo $companyid; ?>&serviceid=<?php echo $serviceid;?>&companyname=<?php echo $companyname;?>" style="position:absolute;margin-top:35px;margin-left:20px;font-size:15px;color:black;">Update Profile.</a>
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

   <div class="form">
   <div class="menu1">
    <a href="uploadExcel.php">
    <button class="btn5"><img src="image/ap.png" alt="" style="height:30px;width:30px">
      API TEST</button>
    </a>
    <a href="dashboard.php">
      <button class="btn6"><img src="image/order.png" alt="" style="height:30px;width:30px">
        My Order</button>
      </a>
      
      <a href="productOrder.php?orderid=<?php echo $orderid  ?>&apitest=apitest">
      <button class="btn10"><img src="image/myproduct.png" alt="" style="height:30px;width:30px">
        My Product</button>
      </a>
    </div>

   <?php //echo "<h3>Calculator for Your Product</h3>".$productid ?>
   <p style="position:absolute;margin-top:70px;margin-left:100px;font-weight:bold;color:black">OrderID:<span style="margin-left:5px;color:maroon;font-size:18px;"><?php echo $orderid;  ?></span></p>
   <p style="position:absolute;margin-top:70px;margin-left:300px;font-weight:bold;color:black">Product:<span style="margin-left:5px;color:maroon;font-size:18px;"><?php echo $productid;  ?></span></p>
   <p style="position:absolute;margin-top:70px;margin-left:600px;font-weight:bold;color:black">Package:<span style="margin-left:5px;color:maroon;font-size:18px;"><?php echo $packagename;  ?></span></p>
   <p style="position:absolute;margin-top:70px;margin-left:800px;font-weight:bold;color:black">Expiry Date:<span style="margin-left:5px;color:maroon;font-size:18px;"><?php echo $expirydate;  ?></span></p>
       <h3>Test Your Calculator Here.</h3>
        <h6>In the  table below you can text your excel calculator by keying in input values in the value column and then you press calculate button to see your
          output result:</h6>
	<form id="excelvariablesform" >
    <div class="cont">
        <table id="excelvariablestable">
          <tr>
		    
            
            <th style="display:none">Cell Name</th>
			<th>Parameter</th>
            <th>Type</th>
			<th>Value</th>
			
          </tr>
		  <?php
		  
		  //print_r($productexcelvariables);
		 // $cellMetaData  = $productexcelvariables['variables'];
		  $inputCellMetaData = $responseArray ['response']['data']['input'];
		  $outputCellMetaData =$responseArray ['response']['data']['output'];
		  
		  foreach($inputCellMetaData as $cellRefId => $cellData){
			  
			  $cellName =  $cellData['cellname'];
			  $cellLabel = $cellData['celllabel'];
			  $celldatatype =$cellData['celldatatype'];
			  $celliotype = $cellData['celliotype'];
			  $cellValue  = "";
			  //$productid = $cellData['productid'];
			 // $userid = $variable['userid'];
			 // $orderid = $variable['orderid'];
			  
		  
		  echo "
		    <tr>
			
           <td style='display:none'>".$cellName."</td>
           <td >".$cellLabel."</td>
		   <td >".$celliotype."</td>
		   <td contentEditable='true'>".$cellValue."</td>
	
			</tr>
	
		  ";
		  }
		  
			   foreach($outputCellMetaData as $cellRefId => $cellData){
			  
			  $cellName =  $cellData['cellname'];
			  $cellLabel = $cellData['celllabel'];
			  $celldatatype =$cellData['celldatatype'];
			  $celliotype = $cellData['celliotype'];
			  $cellValue  = "";
			  
		  echo "
		    <tr>
			
           <td style='display:none'>".$cellName."</td>
           <td>".$cellLabel."</td>
		      <td >".$celliotype."</td>
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
	<button class="b1t" id="submit">Calculate</button>
	</form>
      
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
            <h3>EXCEL2CODE</h3>
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
  <script src="calculate.js"></script>
  
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



<script>
    /*
    document.getElementById('submit').addEventListener('click', function(event) {
      event.preventDefault();
        // Get the table
          var calculatorInputJsonObject = {};
          var calculatorOutputJsonObject = {};
           var


        for (var i = 0; i < table.rows.length; i++) {
            // Iterate through each cell in the current row
            var excelCellName = "";
            var excelCellValue  = "";

            for (var j = 0; j < table.rows[i].cells.length; j++) {
                
                //track the value of the html table cell and the position it's in the table
                // this tracked position will be used later to update the cell when the results of
                // calculator are obtained from the backend 
                var cellValueAndTablePositionObject = {};
                var cellIndexArray = [];
                cellIndexArray[0] = i;
                cellIndexArray[1] = j;
                var iotype = table.rows[i].cells[2].innerHTML;

                // to store the  ith and jth position of the cell in the html table
              // Generate a new value (you can replace this with your logic)
                 if(i !=0){// ignore the table column header
                    excelCellName = table.rows[i].cells[0].innerHTML;
                    excelCellValue = table.rows[i].cells[3].innerHTML;
                    cellValueAndTablePositionObject['cellvalue'] = excelCellValue;
                    cellValueAndTablePositionObject['cellindex'] = cellIndexArray;
                    cellValueAndTablePositionObject['celliotype'] = iotype;
                    
                    calculatorInputJsonObject [excelCellName] = cellValueAndTablePositionObject;

               }// end of the IF to check the column headers
          }// end the inner for loop for the html table

        } // end of the outer for loop for the html table


         var calculatorInputCellsNameAndValuePairObject = {};
               for(let key in calculatorInputJsonObject){
                var iotype = calculatorInputJsonObject[key]['celliotype'];
                  if(iotype=="input"){
                  calculatorInputCellsNameAndValuePairObject[key] = calculatorInputJsonObject[key]['cellvalue'];
                  }

               }// end of the foor loop for creating calculatorinputcells name and value pair

         var stringfiedcalculatorInputCellsNameAndValuePairObject =JSON.stringify(calculatorInputCellsNameAndValuePairObject);
         var stringfiedCalculatorInputJsonObject  =JSON.stringify(calculatorInputJsonObject);
         
         //alert(stringfiedCalculatorInputJsonObject);
          //alert(stringfiedcalculatorInputCellsNameAndValuePairObject);
         
        //prepare the http request object for computing the excel calculations
        // the request has two parts- a header object containing the session
        // and input variables object - containing the input variable key value pairs
      /*  var param = "World";
    // Create a new XMLHttpRequest object
      var xhr = new XMLHttpRequest();
    // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
       xhr.open("POST", "session.php", true);
      // Set the request header to indicate that we are sending form data
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      // xhr.setResponseHeader("Content-type","application/json");
      // Define the callback function to handle the response
      xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        // The response from the server (output of the PHP function) is in xhr.responseText
        console.log(xhr.responseText);
         session= xhr.responseText;
        alert("session variable within own function22222222:" + xhr.responseText);
        calculatorHttpRequestObject['input']=calculatorInputCellsNameAndValuePairObject ;
         calculatorHttpRequestObject ['header']= JSON.parse(session);
         //alert("httprequestcalculator object before calling backend API:"+JSON.stringify(calculatorHttpRequestObject));
         var calculatorHttpJsonRequest   = JSON.stringify(calculatorHttpRequestObject);
         alert("httprequestcalculator object before calling backend API:"+calculatorHttpJsonRequest);
        } 
        };
// Send the request with the data
       xhr.send("param=" + param);

    });

      
    function getApplicationSessionVariables(xmlHttpRequestCallBack) {
            // Get input data or prepare any data you want to send to the PHP function
            var param = "World";

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
            xhr.open("POST", "session.php", true);

            // Set the request header to indicate that we are sending form data
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           // xhr.setResponseHeader("Content-type","application/json");

            // Define the callback function to handle the response
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // The response from the server (output of the PHP function) is in xhr.responseText
                    console.log(xhr.responseText);
                    alert("session variable within own function:" + xhr.responseText);
                    xmlHttpRequestCallBack(xhr.responseText);
                }
            };

            // Send the request with the data
            xhr.send("param=" + param);
           // return xhr.responseText;
        }

     
        function getExcelCalculatorResults(calculatorHttpRequestObject, callBackFunction ) {
            // Get input data or prepare any data you want to send to the PHP function
            var param = "World";

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();
           // CALCULATOR_URL = "session.php";
            var CALCULATOR_URL = "https://b1b2-196-216-86-93.ngrok-free.app/excelcode/calculate"
            //CALCULATOR_URL ="calculatejavascript.php";
            // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
            xhr.open("POST", CALCULATOR_URL , true);
            // Set the request header to indicate that we are sending form data
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.setRequestHeader("Content-type", "application/json");
           // xhr.setResponseHeader("Content-type","application/json");

            // Define the callback function to handle the response
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // The response from the server (output of the PHP function) is in xhr.responseText
                    callBackFunction(xhr.responseText);
                    console.log(xhr.responseText);
                    //alert(xhr.responseText);
                }
            };

            // Send the request with the data
            xhr.send(calculatorHttpRequestObject);
            //return "response was=>"+ xhr.responseText;
          
        }

      */

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