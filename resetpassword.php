<?php
session_start();
if(isset($_SESSION['userId'])){
  $user_id=$_SESSION['userId'];
}

include("config.php");
$message=null;

if(isset($_POST['submit'])){
    $Password=$_POST['password'];
    $Password_hash=password_hash($Password,PASSWORD_DEFAULT);
    $conpassword=$_POST['conpassword'];
    
    $uppercase = preg_match('@[A-Z]@', $Password);
    $lowercase = preg_match('@[a-z]@', $Password);
    $number    = preg_match('@[0-9]@', $Password);
    //$message ="Passwords must contain An uppercase,Lowercase,A special character a number and it must be equal or greater than 8";
   
    if($Password=="" or $conpassword==""){
		echo "<script>alert('Please fill all the fields!');
             window.location.href = 'signup.php';</script>";
        
    }
    
    // password and cofirm password condition
    else if($Password!=$conpassword){
	   echo "<script>alert('Passwords do not match!');
             window.location.href = 'signup.php';</script>";
    }
    
    elseif(!$uppercase || !$lowercase || !$number || strlen($Password) < 8){
	  echo "<script>alert('Password too weak.It must have uppercase,lowercase,a number and a special character.');
             window.location.href = 'signup.php';</script>";
      
    }
    else{
        $updatepassword_query= "UPDATE users SET password = '$Password_hash' WHERE userId = $user_id";
        $result=mysqli_query($conn,$updatepassword_query);
        if($result){
             
             echo "<script>alert('update successiful');
             window.location.href = 'login.php';</script>";
        }
		else{
			echo "<script>alert('update was not successfull try agian');
             window.location.href = 'forgotpass.php';</script>";
		}
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="assets/css/resetpass.css">
</head>
<body>
    <div class="header">
	<h3>Excel2code</h3>
	<a href="login.php">
	<button>Back to Home</button>
	</a>
	</div>
    <div class="head">
      <h1>Enter new password and confirm.</h1> 
    </div>
    <form action="" method="POST">
	
	
         <div class="textfield">
            <label>Password<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="password" name="password" placeholder="Enter your password" id="password">
            <img src="image/close.png" alt="" class="passicon" id="eyeIcon">
        </div>

        <div class="textfield">
            <label>Retype Password<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="password" name="conpassword" placeholder="Enter your password" id="password1">
            <img src="image/close.png" alt="" class="passicon" id="eyeIcon1">
        </div>
		
		<div class="btn">
            <input type="submit" name="submit" value="Update password">
        </div>

        
    </form>

   


    <script>
  let eyeIcon = document.getElementById("eyeIcon");
  let password = document.getElementById("password");
  eyeIcon.onclick = function () {
    if (password.type == "password") {
      password.type = "text";
      eyeIcon.src = "image/open.png";
    } else {
      password.type = "password";
      eyeIcon.src = "image/close.png";
    }
  }

  let eyeIcon1 = document.getElementById("eyeIcon1");
  let password1 = document.getElementById("password1");
  eyeIcon1.onclick = function () {
    if (password1.type == "password") {
      password1.type = "text";
      eyeIcon1.src = "image/open.png";
    } else {
      password1.type = "password";
      eyeIcon1.src = "image/close.png";
    }
  }
</script>
</body>
</html>