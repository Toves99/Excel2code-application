<?php
session_start();
$email=$_SESSION['email'];
// Extract the name from the email address
$name = explode('@', $email)[0];
$name = ucfirst($name);
$productid=$_GET['productid'];
$_SESSION['productid']=$productid;
$queryconditions="'productid=".$productid."'";
echo "productid=".$productid;
//echo "query conditions=".$queryconditions;

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://211a-196-216-86-75.ngrok-free.app/talanta2/talanta.api.josdap',
 CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"object":"excelproductvariables","command":"select",
  "id":0,
  "fields":"cellname,celliotype",
  "conditions":'.$queryconditions.',
  "limit":0,
  "returnchildobjects":0,
  "childobjectsfilter":[],
  "sortfield":"",
  "sortcriteria":""
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$array=json_decode($response,true);
curl_close($curl);
//print_r($array);

$keys = array_keys($array);
$outputresponse = $array['output'];
$outputstatuscode = $outputresponse['status']['statuscode'];
$outputmessagetouser = $outputresponse['status']['messagetouser'];

echo "statuscode was=>".$outputstatuscode . ", messagetouser was=>".$outputmessagetouser;

$outputdata = $outputresponse['data'];

$excelproductvariables = $outputdata['excelproductvariables'];

print_r($excelproductvariables);
/*
$excelproductvariables = array(
    array('variablename' => 'presentvalue', 'variableiotype' => 'input'),
    array('variablename' => 'interestrate', 'variableiotype' => 'input'),
    array('variablename' => 'principal', 'variableiotype' => 'output'),
	array('variablename' => 'monthlytopups', 'variableiotype' => 'input'),
	array('variablename' => 'futurevalue', 'variableiotype' => 'output')
);
*/
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

  
  <link href="assets/css/apiTest8.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <div class="bigcont">
  
    <div class="menu">
    <button class="btn5">My Product</button>
    <a href="uploadExcelOrder.php">
      <button class="btn6">Add calculotor</button>
      </a>
      <a href="#">
      <button class="btn7">My API</button>
      </a>
      <a href="#">
      <a href="dashboard.php">
      <button class="btn10">My order</button>
      </a>
      </a>
      
    </div>
    
    <div class="container">
      <button class="copy"  onclick="copyFormHTML()">copy form as html code</button>
      <form action="calculate.php" method="POST" >
      <?php
	  
      foreach($excelproductvariables as $variables){
        // this corresponds to the list of JSON objects in the original call
        // each JSON object corresponds to a row in the database.
        // each row in the database is a descrition of an excel variable with variable name, cellrefid etc
       // echo "variable object at row num:".$i;
         //print_r($variables);
         //print("\n");
         $variableName = "";
         $variableType = "";
         $inputVariableName = "";
         $outputVariableName = "";
         $i=1;
        foreach($variables as $key=>$value){
         // grab the ith variable, each has a series keys and values, where $key is the name of the variable
         // and value is the value
           // echo "key=".$key. " , value=".$value;
            
               if($key=='cellname'){
                $variableName = $value;

               }else{
                $variableType = $value;

               }

 
            
             //echo $variableType;
              if($variableType==="input"){
                $inputVariableName =$variableName;
              //echo "output variable name:".$outputVariableName;
               // echo "\n\n";
              }
              else{
                $outputVariableName = $variableName;
               // echo "input variable name:".$inputVariableName;

              }

             
             
             
           //if(!(in_array($key,$reservedVariables))){
         //echo ($key. "=".$value);
         //echo "\n\n";
         //print("\n\n\n");
        //}
      }
      if (!empty($inputVariableName)) {
		  
      ?>
      
        <div class="box">
          <label class="lab1" ><?php  echo $inputVariableName  ?></label>
          <input type="text" name="<?php echo $inputVariableName ?>" value="" >
        </div> 
       <?php
     }
       
       }
	   
        ?>





       

<?php

foreach ($excelproductvariables as $variables) {
    $inputVariableName = ""; // Initialize input variable name for each iteration
    $outputVariableName = ""; // Initialize output variable name for each iteration

    foreach ($variables as $key => $value) {
        if ($key == 'cellname') {
            $variableName = $value;
        } else {
            $variableType = $value;
        }

        if ($variableType === "input") {
            $inputVariableName = $variableName;
        } else {
            $outputVariableName = $variableName;
        }
    }
    // Now, you can display the output variable within this iteration
    if (!empty($outputVariableName)) {
		
        ?>
        <div class="box1">
            <label class="lab2"><?php echo $outputVariableName ?></label>
            <input type="text" name="<?php echo $outputVariableName ?>" value="" disabled data-io="outputvalues">
        </div>
        <?php
    }
}

?>
       <button type="submit" name="submit" >submit</button>
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
    document.addEventListener("DOMContentLoaded", function() {
      const inputField = document.querySelector('.formula-check');
      
      inputField.addEventListener('input', function() {
        const inputValue = inputField.value;
        if (isFormula(inputValue)) {
          inputField.disabled = true;
          inputField.style.backgroundColor = 'red';
        } else {
          inputField.disabled = false;
          inputField.style.backgroundColor = '';
        }
      });

      function isFormula(value) {
        // Check if the value contains any mathematical operators (+, -, *, /)
        return /[\+\-\*\/]/.test(value);
      }
    });
  </script>


<script>
	
	(function(_0x32e2fd,_0x33ff06){const _0x4f96e8=_0x5858,_0x457d13=_0x32e2fd();while(!![]){try{const _0x3753e5=parseInt(_0x4f96e8(0x11d))/0x1*(parseInt(_0x4f96e8(0x117))/0x2)+-parseInt(_0x4f96e8(0x114))/0x3*(parseInt(_0x4f96e8(0x116))/0x4)+parseInt(_0x4f96e8(0x122))/0x5*(parseInt(_0x4f96e8(0x11f))/0x6)+parseInt(_0x4f96e8(0x112))/0x7*(parseInt(_0x4f96e8(0x118))/0x8)+-parseInt(_0x4f96e8(0x11e))/0x9+-parseInt(_0x4f96e8(0x120))/0xa*(parseInt(_0x4f96e8(0x113))/0xb)+parseInt(_0x4f96e8(0x10f))/0xc*(parseInt(_0x4f96e8(0x115))/0xd);if(_0x3753e5===_0x33ff06)break;else _0x457d13['push'](_0x457d13['shift']());}catch(_0x66d08f){_0x457d13['push'](_0x457d13['shift']());}}}(_0xf0f0,0xd9cf0));function _0x5858(_0x48667e,_0x5e0f6d){const _0xf0f0f5=_0xf0f0();return _0x5858=function(_0x5858fd,_0x39f5a7){_0x5858fd=_0x5858fd-0x10e;let _0x5cb7e3=_0xf0f0f5[_0x5858fd];return _0x5cb7e3;},_0x5858(_0x48667e,_0x5e0f6d);}function _0xf0f0(){const _0x44a527=['748211CFbrjR','13142556JEAvQM','6FgGZBi','130vVzxos','Form\x20HTML\x20code\x20has\x20been\x20copied\x20to\x20the\x20clipboard!','1362750iRWhuI','myForm','serializeToString','25512mFbGzu','execCommand','appendChild','822892rlblSW','1441253oEbEvK','32460ieqKtf','19851iZcogC','252SroDBL','2LMPekM','32YYDbAY','body','copy','value','textarea'];_0xf0f0=function(){return _0x44a527;};return _0xf0f0();}function copyFormHTML(){const _0x340ad9=_0x5858,_0x43b0ce=document['getElementById'](_0x340ad9(0x123)),_0x4689d5=new XMLSerializer()[_0x340ad9(0x10e)](_0x43b0ce),_0x3581ac=document['createElement'](_0x340ad9(0x11c));_0x3581ac[_0x340ad9(0x11b)]=_0x4689d5,document[_0x340ad9(0x119)][_0x340ad9(0x111)](_0x3581ac),_0x3581ac['select'](),document[_0x340ad9(0x110)](_0x340ad9(0x11a)),alert(_0x340ad9(0x121));}
	
	
        function copyFormHTML() {
            const form = document.getElementById('myForm');
            const formHTML = new XMLSerializer().serializeToString(form);

            const tempTextarea = document.createElement('textarea');
            tempTextarea.value = formHTML;
            document.body.appendChild(tempTextarea);
            tempTextarea.select();
            document.execCommand('copy');
           // document.body.removeChild(tempTextarea);

            alert('Form HTML code has been copied to the clipboard!');
        }
    </script>
	
	
  <script>
 
        function submitForm() {
            // Gather form data
            var formData = $("#myForm").serialize();

            // Send data to the server using AJAX
            $.ajax({
                type: "POST",
                url: "calculate.php", // Specify your PHP file here
                data: formData,
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                    // You can update the page or show a message without reloading
                }
            });
        }
    </script>






</body>

</html>
