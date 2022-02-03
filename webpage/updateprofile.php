<?php
session_start();
include "db_connection.php";
include "regex.php";

if (!preg_match($username_regex, $username)){
    echo "Please ensure that your username contains only numbers and alphabets";
    $regex_check = 0;
}
if (!preg_match($username_regex, $password_conf)){
    echo "Please ensure that your password contains only numbers and alphabets";
    $regex_check = 0;
}
if (!preg_match($email_regex, $email)){
    echo "Please ensure that your email is correct";
    $regex_check = 0;
}
if (!preg_match($address_regex, $address)){
    echo "Please ensure that your address is correct";
    $regex_check = 0;
}
if (!preg_match($contact_regex, $contact)){
    echo "Only numbers within 8 digits is allowed";
    $regex_check = 0;
}
if ($regex_check == 1) {
    if (isset($_SESSION["Username"])) {
        $user = $_SESSION["Username"];
        $username = validate($_POST['username']);
        $email  = validate($_POST['email']);
        $address = validate($_POST['address']);
        $contact = validate($_POST['phone-num']);
        $sql = "UPDATE user SET Username=?,Email=?,Address=?,Phone_number=? WHERE Username='$user'";

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
}
?>