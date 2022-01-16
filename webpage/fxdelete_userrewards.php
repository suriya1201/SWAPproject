<?php 
$connect = mysqli_connect("localhost","root","","tp_amc");


$query= $connect->prepare("DELETE FROM rewards WHERE Points= 0 ");
if ($query->execute()) {
    echo "Query executed.";
}













?>
