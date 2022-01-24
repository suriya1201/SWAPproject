<?php
declare(strict_types=1);
require 'vendor/autoload.php';
 
$g =new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
$secret = $g->generateSecret();
$email="admin@gmail.com";
$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $email, $secret,'TP AMC SHOP');



 
if (isset($_POST['submit2'])){
    $code= $_POST['password2'];
    if ($g->checkCode($secret, $code)) {
        header("Location:http://localhost/SWAPproject/webpage/logged_in.php");
    } 
    else {
      echo '<script>alert("You have typed in the wrong OTP")</script>';
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
       
<form class="loginform" method="post">
  <br><br>
  <label for="OTP"><b>Scan QR code using google authenticator </b></label><br><br>
<img src="<?=$link?>">
  <div class="containerLogin">

    <label for="passcode"><b>Enter OTP from Google authenticator app </b></label>
    <input  type="text" placeholder="Enter OTP" name="password2"></input>
    <button class="loginbtn" type="submit" name="submit2">SUBMIT</button>
    
    
  </div> 
  
 
</form> 
</body><br>

<div>
<?php include "footer.php" ?>
</div>

</html>
