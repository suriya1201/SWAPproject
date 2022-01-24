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
    <body>
        <?php include "navbar.php" ?> 
<img src="<?=$link?>">
</body><br>
<?php include 'footer.php' ?>
</html>