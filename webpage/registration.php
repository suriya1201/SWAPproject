<?php

include "db_connection.php";
include "email_verification.php";
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}
$regex_check = 1;

$username_regex = "/^[A-Za-z0-9 ]+$/"; #For password also
$email_regex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+/";
$contact_regex = "/\b\d{8}\b/";
$address_regex = "/^[A-Za-z0-9 .,#-]+$/";

$password_conf = $_POST['psw-confirm'];
$password = $_POST['psw'];

if($password == $password_conf){ 
    $username = validate($_POST['username']);
    $password = validate(base64_encode(hash("sha256", $_POST['psw'])));
    $email = validate($_POST['email']);
    $address = validate($_POST['address']);
    $contact = validate($_POST['phone-num']);
    $role = 'user';

    $stmt = $con->prepare("SELECT * FROM user WHERE Email=?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows==0) {
        $username = validate($_POST['username']);
        $password = validate(base64_encode(hash("sha256", $_POST['psw'])));
        $email = validate($_POST['email']);
        $address = validate($_POST['address']);
        $contact = validate($_POST['phone-num']);
        $role = 'user';
        

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
            if($stmt = $con->prepare('SELECT ID, Password FROM user WHERE Username = ?')) {
                $stmt->bind_param('s', $username);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows>0) {
                    echo 'Username Already Exists. Try Again';
                }
                else {
                    $token = bin2hex(random_bytes(50));
                    $verified = false;

                    if($stmt = $con->prepare('INSERT INTO user (Username, Password, Email, Address, Phone_number, User_type) VALUES (?,?,?,?,?,?)')) {
                        $stmt->bind_param('ssssss', $username, $password, $email, $address, $contact, $role);
                        $stmt->execute();

                        sendVerificationEmail($email, $token);


                        header("Location: Loginpage.php");
                        echo "<script>alert('Successfully Registered')</script>";
                    }
                    else {
                        echo 'Error1 Occurred';
                    }
                }
            }
            else {
                echo 'Error2 Occurred';
            } 
        }
        
    }
    else {
        echo "<script>alert('Email already exisits')</script>";
    }
} 
else {
    echo "<script>alert('The two passwords do not match')</script>";
}
?>