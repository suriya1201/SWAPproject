<?php
session_start();
include "db_connection.php";
if (isset($_SESSION["Username"])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $user = $_SESSION["Username"];
    $username = validate($_POST['username']);
    $email  = validate($_POST['email']);
    $address = validate($_POST['address']);
    $contact = validate($_POST['phone-num']);
    $sql = "UPDATE user SET Username=? , Email=? , Address=? , Phone_number=? WHERE Username = '$user'";

    if($stmt = $con->prepare($sql)) {
        $stmt->bind_param('ssss', $username, $email, $address, $contact);
        $stmt->execute();
        echo "<script>alert('Profile Updated')</script>";
        header("Location: Profile_page.php");
    }else {
        echo 'Error1 Occurred';
    }
}else {
    echo "Error";
}
?>