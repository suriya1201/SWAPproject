<?php 
session_start();
include "db_connection.php"; 


$query= $con->prepare("DELETE FROM rewards WHERE Points= 0 ");
$query->execute();












mysqli_close($con);
?>
