<?php
declare(strict_types=1);
require 'vendor/autoload.php';




 





$g =new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
$email="admin@gmail.com";
$secret = $g->generateSecret();

$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $email, $secret,'TP AMC SHOP');
 
if (isset($_POST['submit'])){
    $pass =$_POST['passcode'];
   
    if ($g->checkCode($secret, $code)) {
        echo "YES \n";
    } else {
        echo "NO \n";
    }
    
}

?>
<!DOCTYPE html>

<html>

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    </head> 
    
    <?php include "navbar.php" ?> 

    <body class="loginbdy">
       
<form class="loginform" action="submit" method="post">
<img src="<?=$link?>">
  <div class="containerLogin">

    <label for="OTP"><b>Enter OTP from Google authenticator app </b></label>
    <input  type="password" placeholder="Enter OTP" name="password" required>
        
    <button class="loginbtn" type="submit" >Login</button>
    
    
  </div> 
  
 
</form> <br>
</body>

<footer><?php include 'footer.php' ?></footer>

</html>
