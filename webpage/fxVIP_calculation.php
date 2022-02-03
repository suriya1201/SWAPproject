
<?php 

include "db_connection.php";
require "create_product.php";


$name_product = $Product_Name;

$query = $con->prepare("SELECT Item_points FROM tp_amc.products WHERE Product_Name = ?");
$query->bind_param('s',$name_product );
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $item_points = $row["Item_points"];
}}

$Points = ($productquantity * $item_points + 50) ;



$user_id =$_SESSION['ID'];


$query=$con->prepare("SELECT EXISTS(SELECT User_id FROM tp_amc.rewards WHERE User_id = ?)");
$query->bind_param('i',$user_id );
$query->execute();
$result = $query->get_result();
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
         $User_id = $row["User_id"];
     }}
     
     if( !isset($User_id) || $User_id == ""){

    $query=$con->prepare("INSERT INTO tp_amc.rewards VALUES (?,?)");
    $query->bind_param('ii',$Points,$user_id );
    $query->execute();




     }
     else{
        $query=$con->prepare("UPDATE tp_amc.rewards SET Points = ? + Points WHERE User_id=? ");
        $query->bind_param('ii',$Points,$user_id );
        $query->execute();


     }


     $points = 0;
     $query= $con->prepare("DELETE FROM rewards WHERE Points  = ?");
     $query->bind_param('i', $points);
     $query->execute();
     }


?>