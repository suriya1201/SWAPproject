<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","swap"); //connect to database
if (!$con){
die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
$query= $con->prepare("INSERT INTO `products` (`Product_Name`, `Product_Description`, `Price`, 
`Quantity`, `Item_points`) VALUES
(?,?,?,?,?)");
$productname='product1';
$productdescription = 'this is a test';
$productprice = '$10';
$productquantity = '50';
$productpoints = '20';
$query->bind_param('sssss', $productname, $productdescription, $productprice, 
$productquantity, $productpoints); //bind the parameters
if ($query->execute()){ //execute query
 echo "Query executed.";
}else{
 echo "Error executing query.";
}
?>
</body>
</html>