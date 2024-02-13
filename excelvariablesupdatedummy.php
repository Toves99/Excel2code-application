<?php
session_start();
//print_r($_POST['tableData']);
//$_POST;
$editedExcelCellObjects = json_decode($_POST['tableData'], true);
$productexcelvariablesheader = $_SESSION['productexcelvariablesheader'];
$editedExcelConfigFileObject = array();
$editedExcelConfigFileArrayObject['header']= $productexcelvariablesheader;
$editedExcelConfigFileArrayObject['cells']= $editedExcelCellObjects;
$editedExcelConfigFileJsonObject = json_encode($editedExcelConfigFileArrayObject);
//print_r($editedExcelConfigFileObject);
//$editedExcelVariables = json_decode($_POST['tableData'],true);
$variableName ="";
$variableValue ="";

// Check if 'productid' is set in the session
if (isset($_SESSION['productid'])) {
    $productid = $_SESSION['productid'];
    //echo "Product ID from the session: " . $productid;
} else {
    //echo "Product ID is not set in the session.";
}
			   
$user_id = $_SESSION['userId'];
 $productid = $_SESSION['productid'];

//echo "productid=".$productid;
//echo "query conditions=".$queryconditions;
/*{"object":"excelproductvariables","command":"update",
"conditions":"productid=83213878321 AND cellrefid='D6'",
"fieldvaluelist":{"cellname":"interestrate"},
 "limit":0
 }
 */

//foreach ($editedExcelVariables as $variable){
  
  //$productid = $variable['productid'];
    
// The URL you want to send the POST request to
//$url = 'https://96db-196-216-86-93.ngrok-free.app/talanta2/talanta.api.josdap';
$fileediturl="https://4889-196-216-86-91.ngrok-free.app/excelcode/configedit";
/*$transactionStatus = false;
    foreach($editedExcelVariables as $excelVariable){
		
		$cellrefid  = $excelVariable['cellrefid'];
		$queryconditions = "cellrefid='".$cellrefid."' AND productid=".$productid;
		$JosdapUpdateRequestObject = array();
	    $JosdapUpdateRequestObject['command']='update';
		$JosdapUpdateRequestObject['object']='excelproductvariables';
		$JosdapUpdateRequestObject['conditions']=$queryconditions;
		$JosdapUpdateRequestObject['limit']=0;
		$JosdapUpdateRequestObject['fieldvaluelist']=$excelVariable;
		//echo json_encode($JosdapUpdateRequestObject);
		*/
	
// Create HTTP headers for the request

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => $editedExcelConfigFileJsonObject,
    ),
);

// Create the stream context
$context  = stream_context_create($options);

// Make the POST request
$result = file_get_contents($fileediturl, false, $context);

// Check for errors
if ($result === FALSE) {
    die('Error occurred while making the request');
}

// Handle the result (e.g., print it)
//echo $result;
//$responseArray  = json_decode($result,true);
//$responsestatuscode = $responseArray['output']['status']['statuscode'];
   //if($responsestatuscode==2000){
	  // $transactionStatus = true;
   //}
	
	echo "
   <div id='alert' style='position:absolute;width:500px;height:200px;background-color:maroon;border:1px solid lightblue; margin-top:100px; margin-left:400px;border-radius:10px;'>
        <p style='position:absolute;margin-top:70px;color:white;font-size:18px;margin-left:100px'>Saving your changes ... Please wait.</p>
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
            window.location.href = 'selectlink.php';
        }, 5000); // Hide the div after 7 seconds and redirect to 'selectlink.php'

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
	
	
	

/*$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://211a-196-216-86-75.ngrok-free.app/talanta2/talanta.api.josdap',
 CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"object":"excelproductvariables","command":"update",
  "conditions":'.$queryconditions.',
"fieldvaluelist":'.$jsonVariable.',
 "limit":0
  
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$array=json_decode($response,true);
curl_close($curl);
//break;
//echo "Response was=>".$response;

*/


?>

<html>
<head>
<title>
alert
</title>

<style>
#lertt{
	position:absolute;
	width:300px;
	height:300px;
	background-color:white;
	border:1px solid lightblue;
	margin-top:200px;
	margin-left:400px;
}
</style>
</head>
<body>
<div id="alert">

</div>

</body>
</html>