document.getElementById('updateexcelvariables').addEventListener('click', function(event) {
    event.preventDefault();

    var table = document.getElementById("excelvariablestable");
    // var data = [];
    //var rowData = [];
 var inputCellJsonDataObjects = {};
 var outputCellJsonDataObjects ={};
 var cellDataJsonObject = {};
     for (var i = 1; i < table.rows.length; i++) {   
    var object = {};
    var iotype ="";
    var cellrefid ="";
     
         for (var j = 0; j < table.rows[i].cells.length; j++) {
             let tableValue = table.rows[i].cells[j].innerHTML;
     let variableName = "";
   if(j==0){
     variableName="cellrefid";
     cellrefid = tableValue;
     
   }else if(j==1){
     variableName ="cellname";
     
   }
   else if(j==2){
     variableName ="celllabel";
     
   }
   else if(j==3){
     variableName ="celldatatype";
     
   }
   else if(j==4){
     variableName ="celliotype";
      iotype =tableValue;
     
   }
   else if(j==5){
     variableName ="cellvalue";
     
   }
   
   if(variableName!=='cellrefid'){
   object[variableName]= tableValue;
    }
    
   // let cellKeyValuePair  = {key:variableName, value:tableValue};
     // rowData[variableName] = tableValue;
       //rowData.push(object);
         }
   //var cellRefIdObject = {};
   
   //cellRefIdObject[cellrefid]= object;
   
   if(iotype==='input'){
      inputCellJsonDataObjects [cellrefid] = object;	
     
   }
   else{
      outputCellJsonDataObjects [cellrefid] = object;	
     
   }
   
   }
   

   cellDataJsonObject['input']=inputCellJsonDataObjects ;
   cellDataJsonObject['output']=outputCellJsonDataObjects ;
         //data.push(object);
         const queryString = window.location.search;
         console.log(queryString);
         const urlParams = new URLSearchParams(queryString);
         const orderid = urlParams.get('orderid');
         const productid = urlParams.get('productid');
         const serviceid = urlParams.get('serviceid');

         const companyid = urlParams.get('companyid');
         const companyname = urlParams.get('companyname');
         const packagename= urlParams.get('packagename');
         const expirydate= urlParams.get('expirydate');

        var configeditheader = {};
            configeditheader['orderid']=orderid;
            configeditheader['productid']=productid;
            configeditheader['serviceid']=serviceid;
            configeditheader['companyid']=companyid;
            configeditheader['companyname']=companyname;
            configeditheader['packagename']=packagename;
            configeditheader['expirydate']=expirydate;

       var configeditrequestobject = {};
       configeditrequestobject['header'] = configeditheader;
       configeditrequestobject['cells'] = cellDataJsonObject;

     // Add the data to a hidden input field
    // var dataInput = document.createElement("input");
    // dataInput.type = "hidden";
    // dataInput.name = "tableData";
    // dataInput.value = JSON.stringify(cellDataJsonObject);
     var configEditedJsonData = JSON.stringify(configeditrequestobject);
      //const POST_URL = "http://localhost/excel2code/excelvariablesupdatedummy.php";
      //const GET_URL = POST_URL+ +queryString;
     postEditedExcelConfig(  configeditrequestobject);
     //window.location =GET_URL;
     //document.getElementById("excelvariablesform").appendChild(dataInput);
     // Submit the form
     //document.getElementById("excelvariablesform").submit();

      // Get the table
        // return xhr.responseText;
      });
  
      function postEditedExcelConfig(configeditHttpRequestObject) {
          // Get input data or prepare any data you want to send to the PHP function
          const queryString = window.location.search;
           alert("querystring:"+ queryString);

          console.log(queryString);
          const urlParams = new URLSearchParams(queryString);
          const orderid = urlParams.get('orderid');
          const productid = urlParams.get('productid');
          const serviceid = urlParams.get('serviceid');

          const companyid = urlParams.get('companyid');
          const companyname = urlParams.get('companyname');
          const packagename= urlParams.get('packagename');
          const expirydate= urlParams.get('expirydate');
          const action= urlParams.get('freetrial');


         var configeditheader = {};
             configeditheader['orderid']=orderid;
             configeditheader['productid']=productid;
             configeditheader['']

//h          const expirydate= urlParams.get('expirydate');

         // console.log(newUser);
          //var param = "World";*/
  
          // Create a new XMLHttpRequest object
          var xhr = new XMLHttpRequest();
         // CALCULATOR_URL = "session.php";
        // console.log("queryString"+queryString);
       
         var CONFIG_EDIT_URL = "http://localhost/excel2code/excelvariablesupdatedummy.php"+queryString;
         const SELECT_LINK_URL = "http://localhost/excel2code/selectlink.php"+queryString;
          
          // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
          xhr.open("POST", CONFIG_EDIT_URL);
          // Set the request header to indicate that we are sending form data
         // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          // xhr.setRequestHeader("Content-type", "application/json");
         xhr.setRequestHeader("Content-type","application/json;charset=UTF-8");
  
          // Define the callback function to handle the response
          xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && xhr.status == 200) {
                  // The response from the server (output of the PHP function) is in xhr.responseText
                  //callBackFunction(xhr.responseText);
                  console.log("SERVERRESPONSE=>"+ xhr.responseText);
                  //window.location.href=CONFIG_EDIT_URL;
                    alert("SERVER RESPONSE:"+ xhr.responseText);
                  //navigate to the select link page
                  window.location.href =SELECT_LINK_URL;

              }
          };
          // Send the request with the data
          xhr.send(configeditHttpRequestObject);
          //return "response was=>"+ xhr.responseText;
         
      }