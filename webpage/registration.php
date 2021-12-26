<?php
include "db_connection.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = validate($_POST['username']);
$password = validate(base64_encode(hash("sha256", $_POST['psw'])));
$email = validate($_POST['email']);
$address = validate($_POST['address']);
$contact = validate($_POST['phone-num']);
$role = 'user';

if($stmt = $con->prepare('SELECT ID, Password FROM user WHERE Username = ?')) {
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0) {
        echo 'Username Already Exists. Try Again';
    }
    else {
        if($stmt = $con->prepare('INSERT INTO user (Username, Password, Email, Address, Phone_number, User_type) VALUES (?,?,?,?,?,?)')) {
            $stmt->bind_param('ssssss', $username, $password, $email, $address, $contact, $role);
            $stmt->execute();
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

?>