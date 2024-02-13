<?php
// starting the session
session_start();
include("config.php");
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    
    // query
    $select_query="Select * from `users` where email='$email'";
    //echo "select_query is". $select_query;
    $result=mysqli_query($conn,$select_query);
    $fetch_data=mysqli_fetch_assoc($result);
   
    $num_rows=mysqli_num_rows($result);
    // echo $num_rows;
    if($num_rows>0){
      
      echo "<script>alert('proceed to reset your password');
      window.location.href = 'resetpassword.php';</script>";
    
    }else{
      echo "<script>alert('Invalid details');
      window.location.href = 'forgotpass.php';</script>";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="assets/css/forgotpass1.css">
</head>
<body>
    <div class="header">
	<h3>Excel2code</h3>
	<a href="login.php">
	<button>Back to Login</button>
	</a>
	</div>
    <div class="head">
      <h1>Enter your email to Reset Password.</h1> 
    </div>
    <form action="" method="POST">
	
	
        <div class="textfield">
            <label >Email <span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="email" name="email" placeholder="Enter your email to reset password" required>
        </div>
		
	
        <div class="btn">
            <input type="submit" name="submit" value="Reset">
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