<?php
$connect = mysqli_connect("localhost","root","","tp_amc.sql");
$query = $connect->prepare("UPDATE products SET Product_Description=?, Price=?, Quantity=?, Item_points=?, Image=? WHERE PRODUCT_Name=?");
$productname = htmlspecialchars($_POST["Product_Name"]);
$productdescription = htmlspecialchars($_POST["Product_Description"]);
$productprice = htmlspecialchars($_POST["Price"]);
$productquantity = htmlspecialchars($_POST["Quantity"]);
$productpoints = htmlspecialchars($_POST["Item_points"]);
$productimage = htmlspecialchars($_POST["Image"]);
$query->bind_param('ssssss', $productdescription, $productprice, $productquantity, $productpoints, $productimage, $productname);
if ($query->execute()){
    echo "Query executed.";
}
?>
<meta http-equiv="refresh" content="0;URL=display_product.php" />