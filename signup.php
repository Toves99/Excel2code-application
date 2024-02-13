<?php
session_start();
include("config.php");
$message=null;
// Function to generate a random 11-digit number
function generateRandomNumber()
{
    $randNumber = mt_rand(100000, 999999);
    return $randNumber;
}

$_SESSION['companyid'] = generateRandomNumber();
$companyid = $_SESSION['companyid'];
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
	$companyname=$_POST['companyname'];
    $Password=$_POST['password'];
    $Password_hash=password_hash($Password,PASSWORD_DEFAULT);
    $conpassword=$_POST['conpassword'];
    
    $uppercase = preg_match('@[A-Z]@', $Password);
    $lowercase = preg_match('@[a-z]@', $Password);
    $number    = preg_match('@[0-9]@', $Password);
    //$message ="Passwords must contain An uppercase,Lowercase,A special character a number and it must be equal or greater than 8";
   
    // exist query
    $select_data="Select * from `users` where email='$email' and username='$username'";
    $result=mysqli_query($conn,$select_data);
    $num_rows=mysqli_num_rows($result);
    if($username=="" or $email=="" or $Password=="" or $conpassword==""){
		echo "<script>alert('Please fill all the fields!');
             window.location.href = 'signup.php';</script>";
        
    }
    if($num_rows>0){
		echo "<script>alert('Email or username already exist!');
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
        $insert_query="insert into `users` (username,email,companyname,companyid,password) values ('$username','$email','$companyname','$companyid','$Password_hash')";
        $result=mysqli_query($conn,$insert_query);
        if($result){
             
             $geturlparams = "action=buy";

       // Move alert after the redirect
          echo "<script>window.location.href='login.php?".$geturlparams."';</script>";
          echo "<script>alert('Registration successiful');</script>";
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="assets/css/signup.css">
</head>
<body>
    <div class="header">
  <a href="index.php">
	<h3>Excel2code</h3>
  </a>
	<p>Already have an account?</p>
	<a href="login.php?action=buy">
	<button>Log In</button>
	</a>
	</div>
    <div class="head">
        <h1>Create your account.</h1>
    </div>
    <form action="" method="POST">
    <?php echo $message ?>
        <div class="textfield">
            <label>Email<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="email" name="email" placeholder="Enter your email address">
        </div>
		<div class="textfield">
            <label>Company name<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="text" name="companyname" placeholder="Company name">
        </div>

        <div class="textfield">
            <label>Username<span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="text" name="username" placeholder="Username">
        </div>

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
            <input type="submit" name="submit" value="Register">
        </div>

        
    </form>

    <div class="sidebar">
        <img src="image/backimage.png" alt="" >
    </div>


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