<?php
$con = mysqli_connect("localhost","root","","tp_amc.sql");

if (!$con){
    die('Could not connect: ' . mysqli_connect_errno());
}

?>