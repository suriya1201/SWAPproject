<?php
include "db_connection.php";
include "regex.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

$mail = new PHPMailer(true);


$password_conf = $_POST['psw-confirm'];
$password = $_POST['psw'];

if($password == $password_conf) {
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
                    $otp = rand(100000,999999);

                    require "vendor/autoload.php";
                    $mail->SMTPDebug = 0;
    
                    $mail->isSMTP();
                    $mail->Host='smtp.gmail.com';
                    $mail->Port=587;
                    $mail->SMTPAuth=true;
                    $mail->SMTPSecure='tls';
    
                    $mail->Username='johnsontan241@gmail.com';
                    $mail->Password='b9@WL3$k^h$X#6qG^@LS';
    
                    $mail->setFrom('johnsontan241@gmail.com', 'Verification');
                    $mail->addAddress($_POST["email"]);
    
                    $mail->isHTML(true);
                    $mail->Subject="Your verify code";
                    $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>";
                    if(!$mail->send()){
                        ?>
                        <script> alert("<?php echo "Register Failed, Invalid Email "?>"); </script>
                        <?php
                    }else{
                        if($stmt = $con->prepare('INSERT INTO user (Username, Password, Email, Address, Phone_number, User_type, Otp) VALUES (?,?,?,?,?,?,?)')) {
                            $stmt->bind_param('sssssss', $username, $password, $email, $address, $contact, $role, $otp);
                            $stmt->execute();
                            header("Location: email_verify.php?email=" . $email);
                            
                        }
                        else {
                            echo 'Error1 Occurred';
                        }
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