<?php
// starting the session
session_start();
$companyid=null;
$userlastaction=null;
include("config.php");

if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $Password=$_POST['password'];
    // query
    
    $select_query="Select * from `users` where username='$username'";
    //echo "select_query is". $select_query;
    $result=mysqli_query($conn,$select_query);
    $fetch_data=mysqli_fetch_assoc($result);
    // get the user id against the user whose username is $uname
    $user_id=$fetch_data['userId'];
    $email=$fetch_data['email'];
	  $companyname=$fetch_data['companyname'];
    $companyid=$fetch_data['companyid'];
    //echo "companyid=>".$companyid;
    
	
 
    $num_rows=mysqli_num_rows($result);
    // echo $num_rows;
    if($num_rows>0){
      if(password_verify($Password,$fetch_data['password'])){
        $_SESSION['username']=$username;
        $_SESSION['userId']=$user_id;
		   $_SESSION['companyname']=$companyname;
        $_SESSION['companyid']=$companyid;
        $_SESSION['email']=$email;
        $_SESSION['password'] = $Password;

        if(isset($_GET['action'])){
          $userlastaction = $_GET['action'];
          }
        if($userlastaction=='buy'){
          echo "<script>alert('Login successiful');
          window.location.href = 'subscription3.php';</script>";
        }elseif($userlastaction=='freetrial'){
          $geturlparams = "action=freetrial";

       // Move alert after the redirect
          echo "<script>window.location.href='uploadExcelfreetrial.php?".$geturlparams."';</script>";
          echo "<script>alert('Login successiful');</script>";
        }
        
        else{
        
          echo "<script>alert('Login successiful');
          window.location.href = 'dashboard.php';</script>";
        }
        
    }else{
      echo "<script>alert('Invalid details');
      window.location.href = 'login.php';</script>";
    }
    }else{
      echo "<script>alert('Invalid details');
      window.location.href = 'login.php';</script>";;
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="assets/css/loginstyle4.css">
</head>
<body>
    <div class="header">
  <a href="index.php">
	<h3>Excel2code</h3>
  </a>
	<p>Don't have an account?</p>
	<a href="signup.php">
	<button>Sign Up</button>
	</a>
	</div>
    <div class="head">
      <h1>Log in to your account</h1> 
    </div>
    <form action="" method="POST">
	
	
        <div class="textfield">
            <label >Username <span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="text" name="username" placeholder="Enter your username/ company name">
        </div>

        <div class="textfield">
            <label>Password <span style="color: red;font-size:23px;margin-top:2px;position:absolute;">*</span></label>
            <input type="password" name="password" placeholder="Enter your password" id="password">
            <img src="image/close.png" alt="" class="passicon" id="eyeIcon">
        </div>

        <div class="btn">
            <input type="submit" name="submit" value="Login">
            <h6><?php //echo "companyid".$companyid;  ?></h6>
        </div>

        <div class="login">
		<a href="forgotpass.php">
            <p>Forgot Password?</p>
		</a>	
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