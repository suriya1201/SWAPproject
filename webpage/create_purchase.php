<?php
    $connect = mysqli_connect("localhost","root","","tp_amc");
    $query = $connect->prepare("INSERT INTO `purchase` (`Product_Name`,`User_id`,`Quantity`,`Custom_word`) VALUES (?,?,?,?)");
    $Product_Name = $_POST["Product_Name"];
    $User_id = $_POST["User_id"];
    $Quantity = $_POST["Quantity"];
    $Custom_word = $_POST["Custom_word"];
    $query->bind_param('iiis',$Product_Name,$User_id,$Quantity, $Custom_word);
    if ($query->execute()){
        echo "Query executed.";
    }
?>

<meta http-equiv="refresh" content="0;URL=displaypurchase.php" />