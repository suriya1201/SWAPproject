<?php
    $connect = mysqli_connect("localhost","root","","tp_amc");
    $query = $connect->prepare("INSERT INTO `purchase` (`Shipping_information`,`Credit_card`,`Product_Name`,`Username`,`Custom_word`) VALUES (?,?,?,?,?)");
    $Shipping_information = $_POST["Shipping_information"];
    $Credit_card = $_POST["Credit_card"];
    $Product_Name = $_POST["Product_Name"];
    $Username = $_POST["Username"];
    $Custom_word = $_POST["Custom_word"];
    $query->bind_param('sssss', $Shipping_information, $Credit_card, $Product_Name, $Username, $Custom_word);
    if ($query->execute()){
        echo "Query executed.";
    }
?>

<meta http-equiv="refresh" content="0;URL=displaypurchase.php" />