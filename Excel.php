<?php
/*
$url ='https://0fdf-196-216-86-84.ngrok-free.app';
$data = array(
    'userID'      => 'a7664093-502e-4d2b-bf30-25a2b26d6021',
    'itemKind'    => 0,
    'value'       => 1,
    'description' => 'Boa saudaÁ„o.',
    'itemID'      => '03e76d0a-8bab-11e0-8250-000c29b481aa'
  );

$options = array(
    'http' => array(
      'method'  => 'POST',
      'content' => json_encode( $data ),
      'header'=>  "Content-Type: application/json\r\n" .
                  "Accept: application/json\r\n"
      )
  );
  
 $context  = stream_context_create( $options );
  $result = file_get_contents( $url, false, $context );
  $response = json_decode( $result );
  echo $response;

*/


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://f3e9-196-216-86-84.ngrok-free.app/talanta2/talanta.api.josdap',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"object":"excelproductvariables","command":"select",
  "id":0,
  "fields":"variablename, variabletype, variablesrequiresuseinput",
  "conditions":"productid=10123435353",
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
//$keys = array_keys($array);
$outputresponse = $array['output'];
$outputstatuscode = $outputresponse['status']['statuscode'];
$outputmessagetouser = $outputresponse['status']['messagetouser'];

//echo "statuscode was=>".$outputstatuscode . ", messagetouser was=>".$outputmessagetouser;
$outputdata = $outputresponse['data'];
$excelproductvariables = $outputdata['excelproductvariables'];

$i =1;
$reservedVariables = array("productid","serviceid","orderid","userid","id","datatime");



foreach($excelproductvariables as $variables){
       // this corresponds to the list of JSON objects in the original call
       // each JSON object corresponds to a row in the database.
       // each row in the database is a descrition of an excel variable with variable name, cellrefid etc
       echo "variable object at row num:".$i;
        //print_r($variables);
        print("\n");
       foreach($variables as $key=>$value){
        // grab the ith variable, each has a series keys and values, where $key is the name of the variable
        // and value is the value


          //if(!(in_array($key,$reservedVariables))){
        echo ($key. "=".$value);
        echo "\n\n";
        print("\n\n\n");
       //}
        


       }
       $i++;
}


//print_r($excelproductvariables);

?>