<?php



session_start();
$serviceid = $_SESSION['serviceid'];
$orderid = $_SESSION['orderid'];
$productid = $_SESSION['productid'];
$companyid = $_SESSION['companyid'];
$userid =   $_SESSION['userId'];
$username = $_SESSION['username'];

$sessionArray = array();
$sessionArray['serviceid']=$serviceid;
$sessionArray['orderid']=$orderid;
$sessionArray['productid']=$productid;
$sessionArray['companyid']=$companyid;
$sessionArray['userid']= $userid;
$sessionArray['username']=$username;

   $logFile = "C:/xampp/htdocs/excel2code/error.log";
   $currentTimeStamp = getCurrentTimeStamp();
   file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
   file_put_contents($logFile, $currentTimeStamp."|Session.php|FileUpload HTTP Response was=>".json_encode($_POST)."\n", FILE_APPEND | LOCK_EX);



   //$logFile = "C:/xampp/htdocs/webservices1/error.log";
   $currentTimeStamp = getCurrentTimeStamp();
   file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
   //file_put_contents($logFile, $currentTimeStamp."|Session.php|FileUpload HTTP Response was=>".$sessionArray."\n", FILE_APPEND | LOCK_EX);

echo json_encode($sessionArray);

function getCurrentTimeStamp(){
   
    $currentTimestamp = time(); // Get the current timestamp
    $formattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp); // Format the timestamp
  
   return $formattedTimestamp; // Print the formatted timestamp
  }
?>