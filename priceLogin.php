<?php
// starting the session
session_start();
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
 
    $num_rows=mysqli_num_rows($result);
    // echo $num_rows;
    if($num_rows>0){
      if(password_verify($Password,$fetch_data['password'])){
        $_SESSION['username']=$username;
        $_SESSION['userId']=$user_id;
        $_SESSION['email']=$email;
        
        echo "<script>alert('Login successiful');
             window.location.href = 'pricing.php';</script>";
    }else{
      echo "<script>alert('Invalid details');
      window.location.href = 'priceLogin.php';</script>";
    }
    }else{
      echo "<script>alert('Invalid details');
      window.location.href = 'priceLogin.php';</script>";;
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>web</title>
    <link rel="stylesheet" href="loginstyle1.css">
</head>
<body>
    <h1>IDPU</h1>
    <div class="head">
        <h1>Login</h1>
    </div>
    <form action="" method="POST">
        <div class="textfield">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username/ company name">
        </div>

        <div class="textfield">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" id="password">
            <img src="image/close.png" alt="" class="passicon" id="eyeIcon">
        </div>

        <div class="btn">
            <input type="submit" name="submit" value="Login">
        </div>

        <div class="login">
            <p>New member?</p>
            <a href="priceSignUp.php">Sign in</a>
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