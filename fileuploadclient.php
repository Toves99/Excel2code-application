<?php
	// Specify the target URL where you want to upload the file
//$target_url = "https://1ba6-196-216-86-84.ngrok-free.app/excelcalculatorapi/upload";
//$sampleFilePath = "C:/Users/toves/Downloads/ilamcalculator2.xls";
function uploadFile($httpUrl, $fullFilePath){
    // Initialize cURL session
	$curl = curl_init($httpUrl);
	
	if (isset($_SESSION['orderid'])) {
    $orderid = $_SESSION['orderid'];
  //echo "orderId from the session: " . $orderId;
   }   else {
   //echo "orderId is not set in the session.";
    }
	$orderid = $_SESSION['orderid'];
	$product_id = $_SESSION['productid'];
	$user_id = $_SESSION['userId'];
    $Password=$_SESSION['password'];
	$companyid = $_SESSION['companyid'];
	$productName = $_POST['productName'];
	$productCategory = $_POST['productCategory'];
	$companyname=$_SESSION['companyname'];
	$serviceid = $_SESSION['serviceid'];
	$servicename=$_SESSION['servicename'];
	$username=$_SESSION['username'];
	

// Set cURL options
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, [
    'file' => new CURLFile($fullFilePath)
	]);
	
	

// Set other cURL options as needed (e.g., authentication, headers, etc.)
// curl_setopt($curl, CURLOPT_USERPWD, 'username:password');
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: multipart/form-data;boundary====1699900817025===',
		'orderid: ' .$orderid,
        'userid: ' . $user_id,
        'password: ' . $Password,
        'productid: ' . $product_id,
		'companyid: ' . $companyid,
		'productname: ' . $productName,
		'productcategory: ' . $productCategory,
		'companyname: ' . $companyname,
		'serviceid: ' . $serviceid,
		'servicename: ' . $servicename,
		'username: ' . $username,
    ]);
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

// Execute cURL session and store the result
	$response = curl_exec($curl);
	//$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	//$responseJson= "{'httpcode':".$httpCode.",'data':".$response."}";
	$logFile = "C:/xampp/htdocs/excel2code/error.log";
   $currentTimeStamp = getCurrentTimeStamp();
   file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
   file_put_contents($logFile, $currentTimeStamp."|FileUpload HTTP Response was=>".$response."\n", FILE_APPEND | LOCK_EX);
   
   //echo "httpresponse from the file client app was=>".$response;
	
	return $response;
	
	curl_close($curl);
	
	
	
	
	
}

function uploadFileV2($httpUrl, $fullFilePath, $serviceid, $servicename, $companyid,$companyname,
 $orderid, $productid,$productname,$productcategory, $userid, $username,
                     $password){
    // Initialize cURL session
	$curl = curl_init($httpUrl);

// Set cURL options
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, [
    'file' => new CURLFile($fullFilePath)
	]);
	
	

// Set other cURL options as needed (e.g., authentication, headers, etc.)
// curl_setopt($curl, CURLOPT_USERPWD, 'username:password');
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: multipart/form-data;boundary====1699900817025===',
		'orderid: ' .$orderid,
        'userid: ' . $userid,
        'password: ' . $password,
        'productid: ' . $productid,
		'companyid: ' . $companyid,
		'productname: ' . $productname,
		'productcategory: ' . $productcategory,
		'companyname: ' . $companyname,
		'serviceid: ' . $serviceid,
		'servicename: ' .$servicename,
		'username: ' . $username,
    ]);
	
	curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

// Execute cURL session and store the result
	$response = curl_exec($curl);
	//$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	//$responseJson= "{'httpcode':".$httpCode.",'data':".$response."}";
	$logFile = "C:/xampp/htdocs/excel2code/error.log";
   $currentTimeStamp = getCurrentTimeStamp();
   file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
   file_put_contents($logFile, $currentTimeStamp."|FileUpload HTTP Response was=>".$response."\n", FILE_APPEND | LOCK_EX);
   
   //echo "httpresponse from the file client app was=>".$response;
	
	return $response;
	
	curl_close($curl);
	
	
}



  function getCurrentTimeStamp(){
   
  $currentTimestamp = time(); // Get the current timestamp
  $formattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp); // Format the timestamp

 return $formattedTimestamp; // Print the formatted timestamp
}


   
 
 //$response  = uploadFile($target_url,$sampleFilePath);
 //echo $response;




?>