
var selectElement=document.getElementById('selectlanguage');
selectElement.addEventListener('change',function(){
    var selectedlanguage=selectElement.value;
   alert("selected language =>"+selectedlanguage);
      // Get the table
        var calculatorInputJsonObject = {};
        var calculatorOutputJsonObject = {};
        var calculatorHttpRequestObject = {};
        var calculatorProductHeaderDetails = {};
        var calculatorProductInputDetails = {};
       var languagetextarea  = document.getElementById("languagetextarea");
       var productrequestheader=getCalculatorProductHeaderDetails();

       //call configfetch api to return excelproductvariables
       var productrequestheaderjson= JSON.stringify(productrequestheader);
       alert("productrequestheader=>"+productrequestheaderjson);
       var encodedJsonRequest=encodeURIComponent(productrequestheaderjson);

      var xhrcall = new XMLHttpRequest();
      var CALCULATOR_URL = "configfetchjavascript.php";
       xhrcall.open("POST", CALCULATOR_URL , true);
       // Set the request header to indicate that we are sending form data
       xhrcall.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      // xhrcall.setRequestHeader("Content-type", "application/json");
       //xhrcall.setRequestHeader("language",selectedlanguage);
       // Define the callback function to handle the response
       xhrcall.onreadystatechange = function () {
           if (xhrcall.readyState == 4 && xhrcall.status == 200) {
               // The response from the server (output of the PHP function) is in xhr.responseText
               //callBackFunction(xhr.responseText);
               //var calculatorHttpResponseOject = JSON.parse(xhrcall.responseText);
               alert("serveresponse was=>"+xhrcall.responseText);
               console.log(xhrcall.responseText);
               //alert("SERVER RESPONSE=>"+ xhrcall.responseText);
               //alert("Http Response JSON Data"+ JSON.stringify(calculatorHttpResponseOject['response']['data']));
               languagetextarea.innerHTML = xhrcall.responseText;
              // var httpResponseJSONData =calculatorHttpResponseOject ['response']['data'];
        
      }
    };
       // Send the request with the data
       xhrcall.send( encodedJsonRequest)
  
  });
  
  function getCalculatorProductHeaderDetails() {
    // Get input data or prepare any data you want to send to the PHP function  
   var  header = {};
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const context =  urlParams.get('context');
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
         //xhr.setResponseHeader("Content-type","application/json");
  
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
          var CALCULATOR_URL = "https://4889-196-216-86-91.ngrok-free.app /excelcode/calculate";
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