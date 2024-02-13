document.getElementById('submit').addEventListener('click', function(event) {
  event.preventDefault();
    // Get the table
      var calculatorInputJsonObject = {};
      var calculatorOutputJsonObject = {};
      var calculatorHttpRequestObject = {};
      var table=document.getElementById("excelvariablestable");
    for (var i = 0; i < table.rows.length; i++) {
        // Iterate through each cell in the current row
        var excelCellName = "";
        var excelCellValue  = "";

        for (var j = 0; j < table.rows[i].cells.length; j++) {
            //track the value of the html table cell and the position it's in the table
            // this tracked position will be used later to update the cell when the results of
            // calculator are obtained from the backend 
            var cellValueAndTablePositionObject = {};
            var cellIndexArray = [];
            cellIndexArray[0] = i;
            cellIndexArray[1] = j;
            var iotype = table.rows[i].cells[2].innerHTML;

            // to store the  ith and jth position of the cell in the html table
          // Generate a new value (you can replace this with your logic)
             if(i !=0){// ignore the table column header
                excelCellName = table.rows[i].cells[0].innerHTML;
                excelCellValue = table.rows[i].cells[3].innerHTML;
                cellValueAndTablePositionObject['cellvalue'] = excelCellValue;
                cellValueAndTablePositionObject['cellindex'] = cellIndexArray;
                cellValueAndTablePositionObject['celliotype'] = iotype;
                calculatorInputJsonObject [excelCellName] = cellValueAndTablePositionObject;

           }// end of the IF to check the column headers
      }// end the inner for loop for the html table

    } // end of the outer for loop for the html table

    var calculatorCellsDetailedMetaData = calculatorInputJsonObject;
      //alert("Detailed Cells Meta Data:"+JSON.stringify(calculatorCellsDetailedMetaData ));

     var calculatorInputCellsNameAndValuePairObject = {};
           for(let key in calculatorInputJsonObject){
            var iotype = calculatorInputJsonObject[key]['celliotype'];
              if(iotype=="input"){
              calculatorInputCellsNameAndValuePairObject[key] = calculatorInputJsonObject[key]['cellvalue'];
              }

           }// end of the foor loop for creating calculatorinputcells name and value pair

     var stringfiedcalculatorInputCellsNameAndValuePairObject =JSON.stringify(calculatorInputCellsNameAndValuePairObject);
     var stringfiedCalculatorInputJsonObject  =JSON.stringify(calculatorInputJsonObject);
     
     //alert(stringfiedCalculatorInputJsonObject);
      //alert(stringfiedcalculatorInputCellsNameAndValuePairObject);
    //prepare the http request object for computing the excel calculations
    // the request has two parts- a header object containing the session
    // and input variables object - containing the input variable key value pairs

    //check whether the current page (APITest.php has the product variables in the GET URL)
    var calculatorProductHeaderDetails =getCalculatorProductHeaderDetails();
           if(getCalculatorProductHeaderDetails!=null){
            session  = calculatorProductHeaderDetails;
            calculatorHttpRequestObject['input']=calculatorInputCellsNameAndValuePairObject ;
            calculatorHttpRequestObject ['header']= session;
           //alert("httprequestcalculator object before calling backend API:"+JSON.stringify(calculatorHttpRequestObject));
           var calculatorHttpJsonRequest   = JSON.stringify(calculatorHttpRequestObject);

    var xhrcall = new XMLHttpRequest();
    // CALCULATOR_URL = "session.php";
     var CALCULATOR_URL = "https://4889-196-216-86-91.ngrok-free.app /excelcode/calculate"
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
             var calculatorHttpResponseOject = JSON.parse(xhrcall.responseText);
             console.log(xhrcall.responseText);
             //alert("SERVER RESPONSE=>"+ xhrcall.responseText);
             //alert("Http Response JSON Data"+ JSON.stringify(calculatorHttpResponseOject['response']['data']));
             var httpResponseJSONData =calculatorHttpResponseOject ['response']['data'];
             for(let outputVariable in httpResponseJSONData){
                    for(let cellname in calculatorCellsDetailedMetaData){
                         if(outputVariable===cellname){
                          var cellIndex =calculatorCellsDetailedMetaData[cellname]['cellindex'];
                          var  rowindex = cellIndex[0];
                          var  columnindex =cellIndex[1];
                          var cellValue = httpResponseJSONData[outputVariable];
                          table.rows[rowindex].cells[columnindex].innerHTML = Math.round(cellValue).toLocaleString();
                          table.rows[rowindex].style.backgroundColor ="yellow";
                          //table.rows[rowindex].style.backgroundColor="red";
                          }
                     }
     }
    }
  };
     // Send the request with the data
     xhrcall.send(calculatorHttpJsonRequest);

      }

    else {
           // use the variables from session.php file
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
  if (xhr.readyState === 4 && xhr.status === 200) {
    // The response from the server (output of the PHP function) is in xhr.responseText
    console.log(xhr.responseText);
     session= xhr.responseText;
    //alert("session variable within own function22222222:" + xhr.responseText);
    calculatorHttpRequestObject['input']=calculatorInputCellsNameAndValuePairObject ;
     calculatorHttpRequestObject ['header']= JSON.parse(session);
     //alert("httprequestcalculator object before calling backend API:"+JSON.stringify(calculatorHttpRequestObject));
     var calculatorHttpJsonRequest   = JSON.stringify(calculatorHttpRequestObject);
     //alert("httprequestcalculator object before calling backend API:"+calculatorHttpJsonRequest);
     // call the calculator function
     //calculatorOutputJsonObject  = getExcelCalculatorResults(calculatorHttpJsonRequest );
    // alert("SERVER HTTP RESPONSE WAS=>"+calculatorOutputJsonObject );
      //Make the call to the EXCELCODE/calculate backend via calculatejavascript.php 
    
    var xhrcall = new XMLHttpRequest();
    // CALCULATOR_URL = "session.php";
     var CALCULATOR_URL = "https://4889-196-216-86-91.ngrok-free.app /excelcode/calculate"
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
             var calculatorHttpResponseOject = JSON.parse(xhrcall.responseText);
             console.log(xhrcall.responseText);
             //alert("SERVER RESPONSE=>"+ xhrcall.responseText);
             //alert("Http Response JSON Data"+ JSON.stringify(calculatorHttpResponseOject['response']['data']));
             var httpResponseJSONData =calculatorHttpResponseOject ['response']['data'];
             for(let outputVariable in httpResponseJSONData){
                    for(let cellname in calculatorCellsDetailedMetaData){
                         if(outputVariable===cellname){
                          var cellIndex =calculatorCellsDetailedMetaData[cellname]['cellindex'];
                          var  rowindex = cellIndex[0];
                          var  columnindex =cellIndex[1];
                          var cellValue = httpResponseJSONData[outputVariable];
                          table.rows[rowindex].cells[columnindex].innerHTML = Math.round(cellValue).toLocaleString();
                          table.rows[rowindex].style.backgroundColor ="yellow";
                          //table.rows[rowindex].style.backgroundColor="red";
                          }
                     }
     }
    }
  };
     // Send the request with the data
     xhrcall.send(calculatorHttpJsonRequest);
     //return "response was=>"+ xhr.responseText;
}      
    };

// Send the request with the data
   xhr.send("param=" + param);
  }

});

function getCalculatorProductHeaderDetails() {
  // Get input data or prepare any data you want to send to the PHP function  
 var  header = {};
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const context =  urlParams.get('context');
    if(context!=null & context>1){
   alert("querystring:"+ queryString);

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
    alert("product details from GET URL:"+ JSON.stringify(header));

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
        var CALCULATOR_URL = "https://4889-196-216-86-91.ngrok-free.app /excelcode/calculate"
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