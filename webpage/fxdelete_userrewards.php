<?php 
session_start();
include "db_connection.php"; 


$query= $con->prepare("DELETE FROM rewards WHERE Points= 0 ");
if ($query->execute()) {
    echo "Query executed.";
}












mysqli_close($con);
?>
