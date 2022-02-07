<?php
include "db_connection.php";
include "regex.php";
$con = mysqli_connect("localhost","root","","tp_amc");
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno());
}


$Product_Name = validate($_POST["Product_Name"]);
$Quantity = validate($_POST["Quantity"]);
$Custom_word = validate($_POST["Custom_word"]);
    
$query = $con->prepare("INSERT INTO `purchase` (`Product_Name`,`Quantity`,`Custom_word`) VALUES (?,?,?)");
$query->bind_param('sis',$Product_Name,$Quantity,$Custom_word);

if (!preg_match($productname_regex, $Product_Name)){
    echo "Please ensure that the product name field contains only alphabets";
    $regex_check = 0;
}
if (!preg_match($quantity_regex, $Quantity)){
    echo "Please ensure that your password contains only numbers";
    $regex_check = 0;
}
if (!preg_match($username_regex, $Custom_word)){
    echo "Please ensure that the custom word field contains only numbers and alphabets";
    $regex_check = 0;

}
if ($query->execute()){
    echo "Purchase Successful!";
}
else{
    echo $query->error;
    echo "Error Purchasing.";
    }
    



$con->close();
?>