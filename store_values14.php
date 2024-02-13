<?php
session_start();

if (isset($_POST['count']) && isset($_POST['totalCost']) && isset($_POST['costperunit']) && isset($_POST['totalunit']) && isset($_POST['packagename'])) {
    // Update the session variables with the new values
    $_SESSION['count'] = $_POST['count'];
    $_SESSION['totalCost'] = $_POST['totalCost'];
    $_SESSION['costperunit'] = $_POST['costperunit'];
    $_SESSION['totalunit'] = $_POST['totalunit'];
    $_SESSION['packagename'] = $_POST['packagename'];

     // Store the data in PHP sessions
    $_SESSION["monthvalue"] = "12";
     //$_SESSION["costperunit"] = "6000";
     //$totalunit=5;
     //$_SESSION["totalunit"] = $totalunit;


     
    
    // Return a response if needed
    echo "Values updated in the session.";
} else {
    // Handle invalid or missing data
    echo "Invalid data received.";
}
?>