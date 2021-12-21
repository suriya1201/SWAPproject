<?php
$con = mysqli_connect("localhost","root","","tp_amc"); //connect to database
if (!$con){
die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}

$productname = $_POST['name'];
$productdescription = $_POST['description'];
$productprice = $_POST['price'];
$productquantity = $_POST['quantity'];
$productpoints = $_POST['points'];
$productimage = $_POST['image'];


$query= $con->prepare("INSERT INTO `products` (`Product_Name`, `Product_Description`, `Price`, 
`Quantity`, `Item_points`, `Image`) VALUES
('$productname', '$productdescription', '$productprice', '$productquantity', '$productpoints', '$productimage')");


if ($query->execute()){ //execute query
 echo "Query executed.";
}else{
 echo "Error executing query.";
}
?>