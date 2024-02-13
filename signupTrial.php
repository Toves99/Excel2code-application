<?php
session_start();
include("config.php");
$message=null;
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $Password=$_POST['password'];
    $Password_hash=password_hash($Password,PASSWORD_DEFAULT);
    $conpassword=$_POST['conpassword'];
    
    $uppercase = preg_match('@[A-Z]@', $Password);
    $lowercase = preg_match('@[a-z]@', $Password);
    $number    = preg_match('@[0-9]@', $Password);
    //$message ="Passwords must contain An uppercase,Lowercase,A special character a number and it must be equal or greater than 8";
   
    // exist query
    $select_data="Select * from `users` where email='$email'";
    $result=mysqli_query($conn,$select_data);
    $num_rows=mysqli_num_rows($result);
    if($username=="" or $email=="" or $Password=="" or $conpassword==""){
        $message = "<div class='alert alert-danger'>Please fill all the fields!</div>";
        
    }
    if($num_rows>0){
        $message = "<div class='alert alert-danger'>Email already exist!</div>";
    }
    
    // password and cofirm password condition
    else if($Password!=$conpassword){
       $message = "<div class='alert alert-danger'>Passwords do not match!</div>";
    }
    
    elseif(!$uppercase || !$lowercase || !$number || strlen($Password) < 8){
      $message = "<div class='alert alert-danger'>Password too weak.It must have uppercase,lowercase,a number and a special character.</div>";
      
    }
    else{
        $insert_query="insert into `users` (username,email,password) values ('$username','$email','$Password_hash')";
        $result=mysqli_query($conn,$insert_query);
        if($result){
             
             echo "<script>alert('Registration successiful');
             window.location.href = 'login.php';</script>";
        }
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="style5.css">
</head>
<body>
    <h1>IDPU</h1>
    <div class="head">
        <h1>sign In</h1>
    </div>
    <form action="" method="POST">
    <?php echo $message ?>
        <div class="textfield">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email address">
        </div>

        <div class="textfield">
            <label>Username</label>
            <input type="text" name="username" placeholder="Username/company name">
        </div>

        <div class="textfield">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" id="password">
            <img src="image/close.png" alt="" class="passicon" id="eyeIcon">
        </div>

        <div class="textfield">
            <label>Retype Password</label>
            <input type="password" name="conpassword" placeholder="Enter your password" id="password1">
            <img src="image/close.png" alt="" class="passicon" id="eyeIcon1">
        </div>

        <div class="btn">
            <input type="submit" name="submit" value="Register">
        </div>

        <div class="login">
            <p>Already a member?</p>
            <a href="loginTrial.php">Login</a>
        </div>
    </form>

    <div class="sidebar">
        <img src="image/back.png" alt="" >
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