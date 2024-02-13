<?php
session_start();

if (isset($_POST['enteredValue']) && isset($_POST['totalCost'])) {
    $_SESSION['enteredValue'] = $_POST['enteredValue'];
    $_SESSION['totalCost'] = $_POST['totalCost'];

    // Optionally, you can send a success response back to the JavaScript
    //echo 'Values stored in session successfully.';
} else {
    // Handle the case where values are not set in the POST request
    //echo 'Error: Values not set in the POST request.';
}
?>