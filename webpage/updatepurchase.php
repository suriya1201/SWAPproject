<?php
include "db_connection.php";
include "navbar.php";
if ($_SESSION['Role'] != 'prc_admin') {
    echo "<script>alert('UNAUTHORIZED ACCESS IS NOT ALLOWED')</script>";
    echo "<script>window.location.replace('Homepage.php')</script>";
}
$user_id = $_SESSION['ID'];

$Product_Name = $_POST["Product_Name"];
$Quantity = $_POST["Quantity"];
$Custom_word = $_POST["Custom_word"];
$ID = $_POST["ID"];

$query = $con->prepare("Update purchase SET Product_Name=?,Quantity=?,Custom_word=? where ID=?");
$query->bind_param('sisi',$Product_Name,$Quantity,$Custom_word,$ID);
if ($query->execute()){
	echo "<script>alert('Purchase updated.')</script>";
    echo "<script>window.location.replace('admin_purchase.php')</script>";
}
else{
    echo $query->error;
    echo "Error executing query";
}
?>