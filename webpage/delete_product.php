<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","tpshop"); //connect to database
if (!$con){
die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}
$query= $con->prepare("DELETE FROM products WHERE Product_Name=?");
$productname = 'product1';
$query->bind_param('s', $productname); //bind the parameters
if ($query->execute()){
 echo "Query executed.";
}else{
 echo "Error executing query.";
}
?>
</body>
</html>