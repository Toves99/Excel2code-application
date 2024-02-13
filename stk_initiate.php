<?php
session_start();
$user_id=$_SESSION['userId'];
if (isset($_POST['submit'])) {

  date_default_timezone_set('Africa/Nairobi');

  # access token
  $consumerKey = 'nk16Y74eSbTaGQgc9WF8j6FigApqOMWr'; // Consumer Key
  $consumerSecret = '40fD1vRXCq90XFaU'; // Consumer Secret key

  # define the variables
  $BusinessShortCode = '174379';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

  $PartyA = $_POST['phone']; // This is your phone number
  $AccountReference = '66656';
  $TransactionDesc = 'subscription';
  $paymentAmount = $_POST['paymentAmount'];
  $ServiceId = 'SE001';
  $creditamount='0';

  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');

  # Generate a unique transaction ID (combination of timestamp and random number)
  $TransactionID = $Timestamp . mt_rand(1000, 9999);

  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode . $Passkey . $Timestamp);

  # Store relevant data in sessions for use on the verification page
  $_SESSION['TransactionID'] = $TransactionID;
  $_SESSION['Phone'] = $PartyA;
  $_SESSION['PaymentAmount'] = $paymentAmount;

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

  # M-PESA endpoint URLs
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # Callback URL
  $CallBackURL = 'https://87d4-196-216-86-91.ngrok-free.app/excel2code/callback_url.php';

  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
  $result = curl_exec($curl);
  echo "Response from Safaricom MPESA API Was=>".$result;
  


  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;
  curl_close($curl);

  

  # header for STK push
  $stkheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

  # Initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); // Setting custom header

  $curl_post_data = array(
    // Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $paymentAmount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc,
    'TransactionID' => $TransactionID, // Unique transaction ID
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  

  // Check if the response from Safaricom is successful
  $response_array = json_decode($curl_response, true);
  if ($response_array['ResponseCode'] == '0') {
    $CheckoutRequestID = $response_array['CheckoutRequestID'];
    $MerchantRequestID = $response_array['MerchantRequestID'];
    

    // Include your database connection configuration
    //$CheckoutRequestID = $callbackContent->Body->stkCallback->CheckoutRequestID;
    //{"Body":{"stkCallback":{"MerchantRequestID":"103346-69643348-1",
      //"CheckoutRequestID":"ws_CO_02112023123818629715185271","ResultCode":1037,
      //"ResultDesc":"DS timeout user cannot be reached"}}}

    require_once('config.php');

    // Insert payment data into the 'payment' table
    $sql = "INSERT INTO customerdebit (userId,transactionid,serviceid,accountnumber,businessnumber,debitamount,creditamount,phonenumber,checkoutid,merchantrequestid) VALUES ('$user_id','$TransactionID', '$ServiceId','$AccountReference','$BusinessShortCode',$paymentAmount,'$creditamount','$PartyA','$CheckoutRequestID','$MerchantRequestID')";
    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
      // Payment data inserted successfully
      echo "
   <div id='alert' style='position:absolute;width:500px;height:200px;background-color:maroon;border:1px solid lightblue; margin-top:100px; margin-left:400px;border-radius:10px;'>
        <p style='position:absolute;margin-top:70px;color:white;font-size:18px;margin-left:100px'>Processing your payment...please wait.</p>
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
            window.location.href = 'verifyPayments.php';
        }, 7000); // Hide the div after 7 seconds and redirect to 'verifyPayments.php'

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
    } else {
      // Error in inserting payment data
      echo "Error: " . mysqli_error($conn);
    }
  } 
  //print_r($curl_response);
 
}
?>
