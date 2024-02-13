<?php
function fetchExcelProductVariables($username, $password, $productid,$orderid,$companyid,$serviceid){
    $excelConfigVariablesArrayFetchRequest = array();
    $excelConfigVariablesArrayFetchRequest ['serviceid']=$serviceid;
    $excelConfigVariablesArrayFetchRequest ['companyid']=$companyid;
    $excelConfigVariablesArrayFetchRequest ['productid']=$productid;
    $excelConfigVariablesArrayFetchRequest ['orderid']=$orderid;
    $excelConfigVariablesArrayFetchRequest ['username']=$username;
    $excelConfigVariablesArrayFetchRequest ['password']=$password;
    $excelConfigVariablesJsonFetchRequest =json_encode($excelConfigVariablesArrayFetchRequest);
    //$orderid="null";
   // $_SESSION['id'] = $orderid;
    //call the  /http////excelcode/configfetch url.
    
    $fileediturl="https://4889-196-216-86-91.ngrok-free.app /excelcode/configfetch";
    
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

    return $result;

}
// test function
//$serviceid="SE001";
//$companyid=902352;
//$productid=51774674764;
//$orderid=242;
//$username="clinton";
//$password="clinton12";

//$result = fetchExcelProductVariables($username, $password, $productid,$orderid,$companyid,$serviceid);

//echo "variables=>".$result;

?>