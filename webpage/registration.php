<?php
include "db_connection.php";

if(isset($_POST['username']) && isset($_POST['psw'])  && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone-num']) )  {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$username = validate($_POST['username']);
$password = validate($_POST['psw']);
$email = validate($_POST['email']);
$address = validate($_POST['address']);
$contact = validate($_POST['phone-num']);

if(empty($username)) {
    header("Location: Loginpage.php?error=Username is required");
    exit();
}
else if(empty($password)) {
    header("Location: Loginpage.php?error=Password is required");
    exit();
}
else if(empty($email)) {
    header("Location: Loginpage.php?error=Email is required");
    exit();
}
else if(empty($address)) {
    header("Location: Loginpage.php?error=Address is required");
    exit();
}
else if(empty($contact)) {
    header("Location: Loginpage.php?error=Phone Number is required");
    exit();
}   

if($stmt = $con->prepare('SELECT ID, password FROM user WHERE username = ?')) {
    
}

?>