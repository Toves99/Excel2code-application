
document.getElementById('productapidemosubmitbutton').addEventListener('click', function(event) {
  event.preventDefault();
    // Get the table
      var calculatorInputJsonObject = {};
      var calculatorOutputJsonObject = {};
      var calculatorHttpRequestObject = {};
      var calculatorProductHeaderDetails = {};
      var calculatorProductInputDetails = {};
     // var table=document.getElementById("excelvariablestable");
     var productRequestHeaderDiv = document.getElementById("productapidemorequestheaderdiv");
     var productRequestInputTextArea  = document.getElementById("productapidemorequesttextarea");
     var  productApiDemoResponseDiv  = document.getElementById("productapidemoresponsediv");
     //alert ("productRequestHeaderDiv.innerHTML=>"+productRequestHeaderDiv.innerHTML);

     // alert ("productRequestInputTextArea.innerHTML=>"+productRequestInputTextArea .innerHTML);

      var htmlRequestJsonText = (productRequestHeaderDiv.innerHTML.trim().concat("",productRequestInputTextArea .innerHTML)).trim();
      //alert("htmlRequestJSONText:"+htmlRequestJsonText);


    //  calculatorProductHeaderDetails = JSON.parse(productRequestHeaderDiv.innerHTML);
    //calculatorProductInputDetails = JSON.parse( productRequestInputTextArea.innerHTML);

    // calculatorHttpRequestObject['input']= calculatorProductInputDetails ;
     //calculatorHttpRequestObject ['header']=  calculatorProductHeaderDetails;
    //alert("httprequestcalculator object before calling backend API:"+JSON.stringify(calculatorHttpRequestObject));
    var calculatorHttpJsonRequest = JSON.stringify(JSON.parse(htmlRequestJsonText));
       
    var encodedJsonRequest  = encodeURIComponent(calculatorHttpJsonRequest);
   // var calculatorHttpJsonRequest   = JSON.stringify(calculatorHttpRequestObject);
     //alert("productapidemo.php=>current API JSON request is:"+ calculatorHttpJsonRequest );
    var xhrcall = new XMLHttpRequest();
    // CALCULATOR_URL = "session.php";
     var CALCULATOR_URL = "https://d05f-196-216-86-91.ngrok-free.app/excelcode/calculate";
     CALCULATOR_URL ="calculatejavascript.php";
     // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
     xhrcall.open("POST", CALCULATOR_URL , true);
     // Set the request header to indicate that we are sending form data
     xhrcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //xhrcall.setRequestHeader("Content-type", "application/json");
    // xhr.setResponseHeader("Content-type","application/json");

     // Define the callback function to handle the response
     xhrcall.onreadystatechange = function () {
         if (xhrcall.readyState == 4 && xhrcall.status == 200) {
             // The response from the server (output of the PHP function) is in xhr.responseText
             //callBackFunction(xhr.responseText);
             //var calculatorHttpResponseOject = JSON.parse(xhrcall.responseText);
             console.log(xhrcall.responseText);
             //alert("SERVER RESPONSE=>"+ xhrcall.responseText);
             //alert("Http Response JSON Data"+ JSON.stringify(calculatorHttpResponseOject['response']['data']));
            
             productApiDemoResponseDiv.innerHTML = xhrcall.responseText;
            // var httpResponseJSONData =calculatorHttpResponseOject ['response']['data'];
      
    }
  };
     // Send the request with the data
     xhrcall.send(encodedJsonRequest);

});

function getCalculatorProductHeaderDetails() {
  // Get input data or prepare any data you want to send to the PHP function  
 var  header = {};
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const context =  urlParams.get('context');
    if(context!=null & context>1){
   //alert("querystring:"+ queryString);

  console.log(queryString);
 
  const orderid = urlParams.get('orderid');
  const productid = urlParams.get('productid');
  const serviceid = urlParams.get('serviceid');
  const companyid = urlParams.get('companyid');
  const companyname = urlParams.get('companyname');
  const packagename= urlParams.get('packagename');
  const expirydate= urlParams.get('expirydate');

      header['orderid']=orderid;
      header['productid']=productid;
      header['serviceid'] =serviceid;
      header['companyid'] =companyid;
      header['packagename'] =packagename;
      header['expirydate'] = expirydate;
    }
    //alert("product details from GET URL:"+ JSON.stringify(header));

    return header;
}


function getApplicationSessionVariables(xmlHttpRequestCallBack) {
        // Get input data or prepare any data you want to send to the PHP function
        var param = "World";

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
        xhr.open("POST", "session.php", true);

        // Set the request header to indicate that we are sending form data
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       // xhr.setResponseHeader("Content-type","application/json");

        // Define the callback function to handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // The response from the server (output of the PHP function) is in xhr.responseText
                console.log(xhr.responseText);
                //alert("session variable within own function:" + xhr.responseText);
                xmlHttpRequestCallBack(xhr.responseText);
            }
        };

        // Send the request with the data
        xhr.send("param=" + param);
       // return xhr.responseText;
    }

 
    function getExcelCalculatorResults(calculatorHttpRequestObject) {
        // Get input data or prepare any data you want to send to the PHP function
        //var param = "World";

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
       // CALCULATOR_URL = "session.php";
        var CALCULATOR_URL = "https://d05f-196-216-86-91.ngrok-free.app /excelcode/calculate"
        CALCULATOR_URL ="calculatejavascript.php";
        // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
        xhr.open("POST", CALCULATOR_URL , true);
        // Set the request header to indicate that we are sending form data
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
         xhr.setRequestHeader("Content-type", "application/json");
       // xhr.setResponseHeader("Content-type","application/json");

        // Define the callback function to handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // The response from the server (output of the PHP function) is in xhr.responseText
                //callBackFunction(xhr.responseText);
                console.log(xhr.responseText);
                //alert(xhr.responseText);
            }
        };

        // Send the request with the data
        xhr.send(calculatorHttpRequestObject);
        //return "response was=>"+ xhr.responseText;
      
    }