<?php
$logFile = "C:/xampp/htdocs/excel2code/error.log";
$jsonstringrequest = $_POST;
//$jsonstringrequest=preg_replace("\\","",$jsonstringrequest);
//$jsonstringrequest=preg_replace("_",".",$jsonstringrequest);

$jsonrequest =$jsonstringrequest;
//jj$requestarray =json_decode($jsonrequest);

//$requestArrayAsString=implode("",$requestarray);
//print_r( $requestArrayAsString);
//$requestAsArray = json_decode($_POST);

//$headerRequestArray = $requestAsArray['header'];
//$inputRequestArray = $requestAsArray['input'];
//echo "header was=>" + $headerRequestArray;
//echo "input was=>" + $inputRequestArray;

$currentTimeStamp = getCurrentTimeStamp();
file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
//file_put_contents($logFile, $currentTimeStamp."|Calculatejavascript.php|Request Header Encoded HttpRequest=>".$_POST."\n", FILE_APPEND | LOCK_EX);




//$_POST;_
/*
print_r($_POST);

print_r($_POST);
*/

   $currentTimeStamp = getCurrentTimeStamp();
   file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
   file_put_contents($logFile, $currentTimeStamp."|Calculatejavascript.php|Json Encoded HttpRequest=>".json_encode($_POST)."\n", FILE_APPEND | LOCK_EX);

   //$logFile = "C:/xampp/htdocs/webservices1/error.log";
  // $currentTimeStamp = getCurrentTimeStamp();
  //file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
   //file_put_contents($logFile, $currentTimeStamp."|Calculatejavascript.php|HTTP Request as PHP Array=>".implode("=>",json_decode($_POST))."\n", FILE_APPEND | LOCK_EX);
   
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://4889-196-216-86-91.ngrok-free.app/excelcode/calculate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$jsonrequest,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
echo $response;


function getCurrentTimeStamp(){
   
  $currentTimestamp = time(); // Get the current timestamp
  $formattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp); // Format the timestamp

 return $formattedTimestamp; // Print the formatted timestamp
}

?>
