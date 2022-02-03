<?php
$con = mysqli_connect("localhost","root","","tp_amc");
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno());
}


$Product_Name = $_POST["Product_Name"];
$Quantity = $_POST["Quantity"];
$Custom_word = $_POST["Custom_word"];


    
    $query = $con->prepare("INSERT INTO `purchase` (`Product_Name`,`Quantity`,`Custom_word`) VALUES (?,?,?)");
    $query->bind_param('sis',$Product_Name,$Quantity,$Custom_word);
    
    
    
    if ($query->execute()){
        echo "Query executed, Database updated";
    }
    else{
        echo $query->error;
        echo "Error executing query";
    }
    



$con->close();
?>