<?php include 'navbar.php' ?>
<?php 

if ($_SESSION['Role'] != 'p_admin') { //ensure only p_admin can access this page
    echo "<script>alert('UNAUTHORIZED ACCESS IS NOT ALLOWED')</script>";
    echo "<script>window.location.replace('Homepage.php')</script>";
}

?>

<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","tp_amc"); //connect to database
if (!$con){
die('Could not connect: ' . mysqli_connect_errno()); //return error if connection fail
}


$productname = htmlspecialchars($_POST['name']);
$productdescription = htmlspecialchars($_POST['description']);
$productprice = htmlspecialchars($_POST['price']);
$productquantity = htmlspecialchars($_POST['quantity']);
$productpoints = htmlspecialchars($_POST['points']);
$productimage = htmlspecialchars($_POST['image']); //binding the inputs to variables

$regex_check = 1; //checking for the user input

$patterncheck = "/^[A-Za-z0-9 ]+$/";
$numbercheck = "/^[0-9]+$/";

if(!preg_match($patterncheck, $productname)){
    echo "<script>alert('Please ensure that the name contains only numbers and alphabets')</script>";
    $regex_check = 0;
}

if(!preg_match($patterncheck, $productdescription)){
    echo "<script>alert('Please ensure that the description contains only numbers and alphabets')</script>";
    $regex_check = 0;
}

if(!preg_match($numbercheck, $productprice)){
    echo "<script>alert('Please ensure that the price contains only numbers')</script>";
    $regex_check = 0;
}

if(!preg_match($numbercheck, $productquantity)){
    echo "<script>alert('Please ensure that the quantity contains only numbers')</script>";
    $regex_check = 0;
}

if(!preg_match($numbercheck, $productpoints)){
    echo "<script>alert('Please ensure that the points contains only numbers')</script>";
    $regex_check = 0;
}


if ($regex_check == 1){ //if the input is correct, insert into database

$query= $con->prepare("INSERT INTO products (Product_Name, Product_Description, Price, Quantity, Item_points, Image) VALUES (?,?,?,?,?,?)");
$query->bind_param('ssisss', $productname, $productdescription, $productprice, $productquantity, $productpoints, $productimage);

if ($query->execute()){ //execute query
    echo "<script>alert('Query executed')</script>";
   }else{
    echo "<script>alert('Duplicate field/fields')</script>";
   }
}

?>
<br>
<br>
<button onclick="window.location.href='display_product.php'">Update/Delete products here</button>
<button onclick="window.location.href='create_product_form.php'">Go back to adding</button>
</body>
</html>
