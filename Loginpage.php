<!DOCTYPE html>
<head>
  <style>
.loginbdy {  
  display: block;
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;}

.loginform {
  display: inline-block;
  border: 3px solid #f1f1f1;
  width: 600px;
}

.logininput[type=text], .logininput[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.loginbtn {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.containerLogin {
  padding-top: 50px;
  padding-right: 30px;
  padding-bottom: 50px;
  padding-left: 30px;
  width: 500px;
}
</style>


</head>
<body class="loginbdy">

<form class="loginform" action="http://localhost/SWAPproject/logged_in.php" method="post">

  <div class="containerLogin">
    <label for="username"><b>Username</b></label>
    <input class="logininput" type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input class="logininput" type="password" placeholder="Enter Password" name="password" required>
        
    <button class="loginbtn" type="submit" href="http://localhost/SWAPproject/logged_in.php">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>

   
  </div> 
  <div>
  <a href="#">Forgot password?</a><a>or</a>
   <a href="http://localhost/SWAPproject/Registerpage.php">Register</a>
  </div>
</form>

</body>
</html>