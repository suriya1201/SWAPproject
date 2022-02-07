<?php

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
$productname_regex = "/^[A-Za-z0-9]+$/";
$quantity_regex = "/\b\d{3}\b/";
?>