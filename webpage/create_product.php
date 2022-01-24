<?php include 'navbar.php' ?>
<?php include 'session_regen.php' ?>

<html>
<body>
<?php
$con = mysqli_connect("localhost","root","","tp_amc"); //connect to database
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


if ($regex_check == 1){

$query= $con->prepare("INSERT INTO products (Product_Name, Product_Description, Price, Quantity, Item_points, Image) VALUES (?,?,?,?,?,?)");
$query->bind_param('ssisss', $productname, $productdescription, $productprice, $productquantity, $productpoints, $productimage);

if ($query->execute()){ //execute query
    echo "Query executed.";
   }else{
    echo "Duplicate field/fields";
   }
}

?>
<br>
<br>
<button onclick="window.location.href='display_product.php'">Update/Delete products here</button>
<button onclick="window.location.href='create_product_form.php'">Go back to adding</button>
</body>
</html>
