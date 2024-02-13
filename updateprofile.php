<?php

session_start();
$user_id=$_SESSION['userId'];
include("config.php");
$sqlfromuser = "SELECT username,email,companyname FROM users WHERE userId='$user_id'";
$result = mysqli_query($conn, $sqlfromuser);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
	$companyname=$_POST['companyname'];
    
    $updatequery="UPDATE `users` SET `username`='$username',`email`='$email',`companyname`='$companyname' WHERE `userId`=$user_id";
    $queryrun=mysqli_query($conn,$updatequery);
    if($queryrun){
             echo "<script>alert('update successifully');
             window.location.href = 'updateprofile.php';</script>";
        }
    
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="assets/css/updateprofile.css">


    <script type="text/javascript">
     function preback(){
      window.history.forward();
    }
      setTimeout("preback()",0);
      window.onunload=function(){
        null
      };
     
    </script>
</head>
<body>
    <div class="header">
	<h3>Excel2code</h3>
    <?php
    
    if(isset($_GET['direction'])){
        $userlastaction = $_GET['direction'];
        }
        
        //$orderId=$_GET['orderid'];
        //$difference=$_GET['difference'];
    if($userlastaction=='uploadExcelOrder'){
        $orderId=$_GET['orderid'];
        $difference=$_GET['difference'];
       echo"<a href='uploadExcelOrder.php?orderid=".$orderId."&difference=".$difference."'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='productOrder'){
        $orderId=$_GET['orderid'];
        $difference=$_GET['difference']=null;
        echo"<a href='productOrder.php?orderid=".$orderId."&difference=".$difference."'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='uploadExcel'){
        $orderId=$_GET['orderid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='uploadExcel.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='verifyPayments'){
        $orderId=$_GET['orderid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='verifyPayments.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='paymentmode'){
        $orderId=$_GET['orderid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='paymentMode.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='subscription'){
        
        $orderId=$_GET['orderid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='subscription3.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='step'){
        $orderId=$_GET['orderid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='steps.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='myapi'){
        $orderId=$_GET['orderid'];
        $productid=$_GET['productid'];
        $packagename=$_GET['packagename'];
        $expirydate=$_GET['expirydate'];
        $difference=$_GET['difference']=null;
        echo"<a href='myapi.php?orderid=".$orderId."&productid=".$productid."&packagename=".$packagename."&expirydate=".$expirydate."'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='describe'){
        $orderId=$_GET['orderid'];
        $productid=$_GET['productid'];
        $packagename=$_GET['packagename'];
        $expirydate=$_GET['expirydate'];
        $difference=$_GET['difference']=null;
        echo"<a href='descr.php?orderid=".$orderId."&productid=".$productid."&packagename=".$packagename."&expirydate=".$expirydate."'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='excelrev'){
        $orderId=$_GET['orderid'];
        $productid=$_GET['productid'];
        $packagename=$_GET['packagename'];
        $expirydate=$_GET['expirydate'];
        $companyid=$_GET['companyid'];
        $difference=$_GET['difference']=null;
        echo"<a href='excelcalculatorreviewandupdate.php?orderid=".$orderId."&productid=".$productid."&packagename=".$packagename."&expirydate=".$expirydate."&companyid=".$companyid."'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='excelcalculator'){
        $orderId=$_SESSION['orderid'];
         $productid=$_SESSION['productid'];
         $packagename=$_SESSION['packagename'];
         $serviceid=$_SESSION['serviceid']=null;
         $companyid=$_SESSION['companyid'];
        $expirydate=$_SESSION['expirydate'];
        echo"<a href='excelCalculator.php?orderid=".$orderId."&productid=".$productid."&packagename=".$packagename."&expirydate=".$expirydate."&companyid=".$companyid."'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='select'){
        $orderid=$_SESSION['orderid'];
        $productid=$_SESSION['productid'];
        $packagename=$_SESSION['packagename'];
        $serviceid=$_SESSION['serviceid'];
        $companyid=$_SESSION['companyid'];
        $expirydate=$_SESSION['expirydate'];
        $companyname=$_SESSION['companyname'];
        echo"<a href='selectlink.php?orderid=".$orderid."&productid=".$productid."&packagename=".$packagename."&expirydate=".$expirydate."&companyid=".$companyid."'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='apitest'){
        $orderid=$_GET['orderid'];
        $productid=$_GET['productid'];
        $packagename=$_GET['packagename'];
        $expirydate=$_GET['expirydate'];
        $companyid=$_GET['companyid'];
        $companyname=$_GET['companyname'];
        $serviceid=$_GET['serviceid'];
        $difference=$_GET['difference']=null;
        echo"<a href='ApiTest.php?orderid=".$orderid."&productid=".$productid."&packagename=".$packagename."&expirydate=".$expirydate."&companyid=".$companyid."&serviceid=".$serviceid."&companyname=".$companyname."'>
        <button>Go Back</button>
        </a>";
    }

    elseif($userlastaction=='about'){
        $orderid=$_GET['orderid']=null;
        $productid=$_GET['productid']=null;
        $packagename=$_GET['packagename']=null;
        $expirydate=$_GET['expirydate']=null;
        $companyid=$_GET['companyid']=null;
        $companyname=$_GET['companyname']=null;
        $serviceid=$_GET['serviceid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='aboutus.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='contact'){
        $orderid=$_GET['orderid']=null;
        $productid=$_GET['productid']=null;
        $packagename=$_GET['packagename']=null;
        $expirydate=$_GET['expirydate']=null;
        $companyid=$_GET['companyid']=null;
        $companyname=$_GET['companyname']=null;
        $serviceid=$_GET['serviceid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='contact.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='privacy'){
        $orderid=$_GET['orderid']=null;
        $productid=$_GET['productid']=null;
        $packagename=$_GET['packagename']=null;
        $expirydate=$_GET['expirydate']=null;
        $companyid=$_GET['companyid']=null;
        $companyname=$_GET['companyname']=null;
        $serviceid=$_GET['serviceid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='privacy.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='terms'){
        $orderid=$_GET['orderid']=null;
        $productid=$_GET['productid']=null;
        $packagename=$_GET['packagename']=null;
        $expirydate=$_GET['expirydate']=null;
        $companyid=$_GET['companyid']=null;
        $companyname=$_GET['companyname']=null;
        $serviceid=$_GET['serviceid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='termsandcondition.php'>
        <button>Go Back</button>
        </a>";
    }
    elseif($userlastaction=='product'){
        $orderid=$_GET['orderid']=null;
        $productid=$_GET['productid']=null;
        $packagename=$_GET['packagename']=null;
        $expirydate=$_GET['expirydate']=null;
        $companyid=$_GET['companyid']=null;
        $companyname=$_GET['companyname']=null;
        $serviceid=$_GET['serviceid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='servicelogin.php'>
        <button>Go Back</button>
        </a>";
    }
    else{
        $orderId=$_GET['orderid']=null;
        $difference=$_GET['difference']=null;
        echo"<a href='dashboard.php'>
        <button>Go Back</button>
        </a>";
    }
	
    ?>
	</div>
    <div class="head">
        <h1>Update Your Account.</h1>
    </div>
    <form action="" method="POST">
    
        <div class="textfield">
            <label>Email<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="email" name="email" value="<?php echo $row['email'] ?>">
        </div>
		<div class="textfield">
            <label>Company name<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="text" name="companyname" value="<?php echo $row['companyname'] ?>">
        </div>

        <div class="textfield">
            <label>Username<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="text" name="username" value="<?php echo $row['username'] ?>">
        </div>

        
         <h6><?php  //echo $userlastaction;  ?></h6>
        <div class="btn">
            <input type="submit" name="submit" value="Update">
        </div>

        
    </form>


    <script>
  let eyeIcon = document.getElementById("eyeIcon");
  let password = document.getElementById("password");
  eyeIcon.onclick = function () {
    if (password.type == "password") {
      password.type = "text";
      eyeIcon.src = "image/open.png";
    } else {
      password.type = "password";
      eyeIcon.src = "image/close.png";
    }
  }

  let eyeIcon1 = document.getElementById("eyeIcon1");
  let password1 = document.getElementById("password1");
  eyeIcon1.onclick = function () {
    if (password1.type == "password") {
      password1.type = "text";
      eyeIcon1.src = "image/open.png";
    } else {
      password1.type = "password";
      eyeIcon1.src = "image/close.png";
    }
  }
</script>
</body>
</html>