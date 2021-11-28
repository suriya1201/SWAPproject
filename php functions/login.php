<?php
$con = mysqli_connect("localhost","root","","swap");

if (!$con){
    die('Could not connect: ' . mysqli_connect_errno());
}
$query= $con->prepare("INSERT INTO `user` ( `USERNAME`, `PASSWORD`, `ADDRESS`, `PHONE_NUMBER` ) VALUES
(?,?,?,?)");

$name='user3';
$pwd = 'pass';
$address = 'ang mo kio ave 2';
$contact = '11223344';

$query->bind_param('ssss', $name, $pwd, $address,$contact);

if ($query->execute()){
 echo "Query executed.";
}
else{
 echo "Error executing query.";
}
?>