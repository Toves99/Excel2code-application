<?php
 //calls configftech back end service on being called by productapiclientcodegen.js
 $productrequestheader = $_POST;
  
  foreach($productrequestheader as $key=>$value){
    
    $productrequestheader = $key;

  }
// $productrequestheader;
  
$fileediturl="https://4889-196-216-86-91.ngrok-free.app/excelcode/configfetch";

$options = array(

    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => $productrequestheader,
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
$productvariables = $responseArray['response']['data']; 
$productrequest = $responseArray['request'];

$inputvariables = $productvariables ['input'];
$outputvariables = $productvariables ['output'];

$simpleinputvariables = array();
$simpleoutputvariables = array();
$simpleproductvariables = array();



$inputcount =1;
$outputcount =1;
$requestInputStructure = array();
$requestOuputStructure = array();

//construct the JSON request input object that will be attached to the to the text area of the 
// request section of the productapidemo.php page
foreach($inputvariables as $cellRefId => $cellData){
    $cellName =  $cellData['cellname'];
    $celldatatype =$cellData['celldatatype'];
    $celliotype =$cellData['celliotype'];
    $cellValue = $cellData['cellvalue'];
    $requestInputStructure[$cellName]=$cellValue;
}

foreach($outputvariables as $cellRefId => $cellData){
  $cellName =  $cellData['cellname'];
  $celldatatype =$cellData['celldatatype'];
  $celliotype =$cellData['celliotype'];
  $cellValue = "";
  $requestOutputStructure[$cellName]=$cellValue;
}

$codeGenerationVariables = array();
$codeGenerationVariables['header']=$productrequest;
$codeGenerationVariables['variables']['input']=  $requestInputStructure;
$codeGenerationVariables['variables']['output']=  $requestOutputStructure;
$codeGenerationVariablesJson =  json_encode($codeGenerationVariables);

echo $codeGenerationVariablesJson;


  //call the configFetch backend service













?>








