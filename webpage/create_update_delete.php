<?php
include "db_connection.php";
include "regex.php";
include "session_regen.php";

$user_id = $_SESSION['ID'];

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
    echo "Please ensure that the quantity contains only numbers";
    $regex_check = 0;
}
if (!preg_match($username_regex, $Custom_word)){
    echo "Please ensure that the custom word field contains only numbers and alphabets";
    $regex_check = 0;

}

if ($regex_check == 1) {
    if ($query->execute()){
        echo "Purchase Successful!";
    }
    else{
        echo $query->error;
        echo "Error Purchasing.";
        }
}
    





$name_product = $Product_Name;

$query = $con->prepare("SELECT Item_points FROM tp_amc.products WHERE Product_Name = ?");
$query->bind_param('s',$name_product );
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $item_points = $row["Item_points"];
}}

$Points = ($Quantity * $item_points ) ;






$query=$con->prepare("SELECT User_id FROM tp_amc.rewards WHERE User_id = ?");
$query->bind_param('i',$user_id );
$query->execute();
$result = $query->get_result();
    if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $User_id = $row["User_id"];
    }
     if( !isset($User_id) || $User_id == ""){

    $query=$con->prepare("INSERT INTO tp_amc.rewards (Points,User_id) VALUES (?,?)");
    $query->bind_param('ii',$Points,$user_id );
    $query->execute();




     }
     else{
        $query=$con->prepare("UPDATE rewards SET Points = (? + Points) WHERE User_id=? ");
        $query->bind_param('ii',$Points,$user_id );
        $query->execute();


     }

     $points = 0;
     $query= $con->prepare("DELETE FROM rewards WHERE Points  = ?");
     $query->bind_param('i', $points);
     $query->execute();
     

?>