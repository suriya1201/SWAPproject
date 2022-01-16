<?php 
$con = mysqli_connect("localhost","root","","tp_amc");


$query= $con->prepare("DELETE FROM rewards WHERE Points= 0 ");
if ($query->execute()) {
    echo "Query executed.";
}












mysqli_close($con);
?>
