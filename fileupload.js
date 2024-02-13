document.getElementById('fileuploadbutton3').addEventListener('click', function(event) {
    
    let formData = new FormData(); 
    formData.append("file", fileupload.files[0]);
    var xhr = new XMLHttpRequest();
       // CALCULATOR_URL = "session.php";
        FILEUPLOAD_URL ="fileupload.php";
        // Configure it: specify the type of request (POST), the URL, and whether it should be asynchronous
        xhr.open("POST", FILEUPLOAD_URL , true);
        // Set the request header to indicate that we are sending form data
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
        xhr.send(formData);

    
});