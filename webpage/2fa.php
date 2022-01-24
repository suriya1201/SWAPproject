<?php
declare(strict_types=1);
require 'vendor/autoload.php';
$secret='E6k35NIUQM';
$link =\Sonata\GoogleAuthenticator\GoogleQrUrl::generate('TP AMC SHOP', $secret, 'Tp-amc');
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