<?php
$connect = mysqli_connect("localhost","root","","tp_amc");
$query = $connect->prepare("UPDATE products SET Product_Description=?, Price=?, Quantity=?, Item_points=?, Image=? WHERE PRODUCT_Name=?");
$productname = $_POST["Product_Name"];
$productdescription = $_POST["Product_Description"];
$productprice = $_POST["Price"];
$productquantity = $_POST["Quantity"];
$productpoints = $_POST["Item_points"];
$productimage = $_POST["Image"];
$query->bind_param('ssssss', $productdescription, $productprice, $productquantity, $productpoints, $productimage, $productname);
if ($query->execute()){
    echo "Query executed.";
}
?>
<meta http-equiv="refresh" content="0;URL=display_product.php" />