<?php
include "db_connection.php";
require "rewards_user.php";

if (isset($_POST['submit5'])){
$User_id =$_SESSION['ID'];
$reward = htmlspecialchars($_POST['id']);

$reward_regex = "/^[0-9]+$/";
$regex_check = 1;
if (!preg_match($reward_regex, $reward)){
	echo "<script>alert('Please ensure that the item contains only numbers')</script>";
    $regex_check = 0;
}
elseif($regex_check == 1) {
$query = $con->prepare("SELECT  reward_points FROM reward_types WHERE ID = ? ");
$query->bind_param('i', $reward);
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $reward_point = $row["reward_points"];
}}
else{
    $reward_point= 0;
}



$query=$con->prepare("UPDATE rewards SET Points = (Points - ?) WHERE User_id = ? ");
$query->bind_param('ii', $reward_point, $User_id);
$query->execute();

}

$points = 0;
$query= $con->prepare("DELETE FROM rewards WHERE Points  = ?");
$query->bind_param('i', $points);
$query->execute();
}
?>