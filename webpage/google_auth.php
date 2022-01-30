<?php
include "session_regen.php";
require 'vendor/autoload.php';
include "db_connection.php";
 
$g =new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
$secret = $g->generateSecret();
$userid= $_SESSION['ID']
$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $userid , $secret,'TP AMC SHOP');


?>


























<?php  

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













<script> //prevent form resubmission
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>



