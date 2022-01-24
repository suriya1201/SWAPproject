<?php
declare(strict_types=1);
require 'vendor/autoload.php';



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
 




include "retrieveprofile.php";


$secret= generateRandomString();

$link= \Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $email, $secret,'TP AMC SHOP');
 $g =new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
if (isset($_POST['submit'])){
    $pass =$_POST['passcode'];
   
    if ($g->checkCode($secret, $code)) {
        echo "YES \n";
    } else {
        echo "NO \n";
    }
    
}

?>


<html>

<img src="<?=$link?>">


</html>