<!DOCTYPE html>
<head>

<style>
body {  
  display: block;
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;}
form {
  display: inline-block;
  border: 3px solid #f1f1f1;
  width: 600px;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
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

.container {
  padding-top: 50px;
  padding-right: 30px;
  padding-bottom: 50px;
  padding-left: 30px;
  width: 500px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
</style>
</head>
<body>

<form action="/Loginpage.php" method="post">

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>

    <a href="#">Forgot password?</a>
  </div>
</form>

</body>
</html>