<?php include 'adminnavbar.php' ?>

<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","tp_amc.sql"); //connect to database
if (!$con){
die('Could not connect: ' . mysqli_connect_errno()); //return error is connect fail
}

$productname = htmlspecialchars($_POST['name']);
$productdescription = htmlspecialchars($_POST['description']);
$productprice = htmlspecialchars($_POST['price']);
$productquantity = htmlspecialchars($_POST['quantity']);
$productpoints = htmlspecialchars($_POST['points']);
$productimage = htmlspecialchars($_POST['image']);

$regex_check = 1;

$namepattern = "/A-Za-z0-9/";
if(!preg_match($namepattern, $productname)){
    echo "Please ensure that your username contains only numbers and alphabets";
    $regex_check = 0;
}

if ($regex_check == 1){

$query= $con->prepare("INSERT INTO `products` (`Product_Name`, `Product_Description`, `Price`, 
`Quantity`, `Item_points`, `Image`) VALUES (?,?,?,?,?,?)");
$query->bind_param('ssisss', $productname, $productdescription, $productprice, $productquantity, $productpoints, $productimage);

if ($query->execute()){ //execute query
    echo "Query executed.";
   }else{
    echo "Error executing query.";
   }
}

?>
<br>
<br>
<button onclick="window.location.href='display_product.php'">Update/Delete products here</button>
</body>
</html>


