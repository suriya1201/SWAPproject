<?php
include('db_connection.php');

//Include required phpmailer files
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($recipient, $subject, $message){
    //Create instance of PHPMailer
    $mail = new PHPMailer();
    //Set mailer to use SMTP
    $mail->isSMTP();
    //Define smtp host
    $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
    $mail->SMTPAuth = true;
    //set type of encryption (ssl/tls)
    $mail->SMTPSecure = 'ssl';
    //set port to conenct SMTP
    $mail->Port = '465';
    //set gmail username
    $mail->Username = 'dariustan0433@gmail.com';
    //set gmail password
    $mail->Password = 'dtan1502';
    //set email subject
    $mail->Subject = $subject;
    //set sender email
    $mail->SetFrom('dariustan0433@gmail.com');
    //enable html
    $mail->isHTML();
    // email body
    $mail->Body = $message;
    //add recipient
    $mail->AddAddress($recipient);
  
    //send email
    if( $mail->Send() ){
      echo "Email Sent!";
    }else {
      echo "Error!";
    }
    //closing smtp connection
    $mail->smtpClose();
  }
?>