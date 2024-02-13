<?php
 		header("Content-Type: application/json");

     $response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     }';
 
     // DATA
     $mpesaResponse = file_get_contents('php://input');
     $logFile = "C:/xampp/htdocs/excel2code/mpesa.log";
    $currentTimeStamp = getCurrentTimeStamp();
    file_put_contents($logFile, "\n", FILE_APPEND | LOCK_EX);
    file_put_contents($logFile, $currentTimeStamp."|Safaricom response was=>".$mpesaResponse."\n", FILE_APPEND | LOCK_EX);

     $callbackContent = json_decode($mpesaResponse);
     $Resultcode = $callbackContent->Body->stkCallback->ResultCode;
     $CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
     $Amount = $callbackContent->Body->stkCallback->CallbackMetadata->Item[0]->Value;
     $MpesaReceiptNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[1]->Value;
     $PhoneNumber = $callbackContent->Body->stkCallback->CallbackMetadata->Item[4]->Value;
     $MerchantRequestID = $callbackContent->Body->stkCallback->MerchantRequestID;
     $TransactionID = $callbackContent->Body->stkCallback->CallbackMetadata->Item[3]->Value; // Extract TransactionID
    //Resultcode == 0
    include('config.php');
    $BusinessShortCode = '174379';
    $AccountReference = '66656';
    $sql = "INSERT INTO paymentreceipt(phonenumber,accountnumber,receiptnumber,amount,resultcode,transactionid,businessnumber,checkoutid,merchantrequestid) VALUES ('$PhoneNumber','$AccountReference','$MpesaReceiptNumber','$Amount','$Resultcode','$TransactionID','$BusinessShortCode','$CheckoutRequestID','$MerchantRequestID')";
    $result = mysqli_query($conn,$sql);
          unset($mpesaResponse);

     echo $response;

     function getCurrentTimeStamp(){
   
      $currentTimestamp = time(); // Get the current timestamp
      $formattedTimestamp = date("Y-m-d H:i:s", $currentTimestamp); // Format the timestamp
    
     return $formattedTimestamp; // Print the formatted timestamp
    }
