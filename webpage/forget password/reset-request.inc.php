<?php

if(isset($_POST["reset-request-submit"])){ //when the button is pressed

    $selector = bin2hex(random_bytes(8)); //generate a first token with random bytes and convert to hexadecimal so we can use later
    $token = random_bytes(32); //generate a second token with random bytes

    $url = "http://localhost/swapproject/webpage/create-new-password.php?selector=" . $selector ."&validator=" . bin2hex($token); //convert the second token to hexadecimal 

    $expires = date("U") + 1800; //+ 1800 is one hour from now. so token will expire 1hr from the time created

    require 'db_connection.php';
    require 'sendemail.php';  

    $userEmail = $_POST["email"]; //set the variable to whatever email the user inputted

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;"; //delete all existing token/tokens
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpire) VALUES (?, ?, ?, ?);"; //insert into the password reset database
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error";
        exit();
    } else{
        
        $hashedToken = password_hash($token, PASSWORD_DEFAULT); //hash the second token so if the attacker gets hold of the database somehow, he will not be able to see
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);

    $to = $userEmail;

    $subject = 'Reset your password';

    $message = '<p>We received a password reset request. The link to reset your password is below. If you did not make this request, you can ignore this email</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From Darius <dariustan1502@gmail.com>\r\n";
    $headers .= "Reply-To: dariustan1502@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    sendEmail($to, $subject, $message);

    header("Location: reset_password.php?reset=success"); //when the email is sent



} else{
    header("Location: reset_password.php");
}
?>
