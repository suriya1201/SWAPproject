<!DOCTYPE html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/w3css/3/w3.css">
</head>
<body class="loginbdy">
<?php include "navbar.php" ?>
<form class="loginform" action="login.php" method="post">

  <div class="containerLogin">
    <label for="username"><b>Username</b></label>
    <input class="logininput" type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input class="logininput" type="password" placeholder="Enter Password" name="password" required>
        
    <button class="loginbtn" type="submit" >Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
    
  </div> 
  <div>
  <?php
  if (isset($_GET["newpwd"])){

    if ($_GET["newpwd"] == "passwordupdated"){
      echo '<p class="signupsuccess">Your password has been reset</p>';
    }
  }
  ?>
  <a href="reset_password.php">Forgot password?</a><a>or</a>
   <a href="http://localhost/SWAPproject/webpage/Registerpage.php">Register</a>
  </div>
</form>
</body>
</html>