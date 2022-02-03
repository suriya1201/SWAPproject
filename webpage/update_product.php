<?php include 'navbar.php' ?>
<?php 

if ($_SESSION['Role'] != 'p_admin') { //ensure only p_admin can access this page
    echo "<script>alert('UNAUTHORIZED ACCESS IS NOT ALLOWED')</script>";
    die();
}

?>
<?php
$connect = mysqli_connect("localhost","root","","tp_amc"); //connection to database

$productname = htmlspecialchars($_POST["Product_Name"]);
$productdescription = htmlspecialchars($_POST["Product_Description"]);
$productprice = htmlspecialchars($_POST["Price"]);
$productquantity = htmlspecialchars($_POST["Quantity"]);
$productpoints = htmlspecialchars($_POST["Item_points"]);
$productimage = htmlspecialchars($_POST["Image"]); //binding the inputs to variables

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

    $query = $connect->prepare("UPDATE products SET Product_Description=?, Price=?, Quantity=?, Item_points=?, Image=? WHERE PRODUCT_Name=?");
    $query->bind_param('ssssss', $productdescription, $productprice, $productquantity, $productpoints, $productimage, $productname);
    
    if ($query->execute()){ //execute query
        echo "<script>alert('Query executed')</script>";
       }else{
        echo "<script>alert('Duplicate field/fields')</script>";
       }
    }
?>
<meta http-equiv="refresh" content="0;URL=display_product.php" />