<?php
include "session_regen.php";
include "db_connection.php";

require "rewardspage.php";





if (isset($_POST['submit'])){


$User_id =$_SESSION['ID'];
$reward = $_POST['reward_item'];

$query = $con->prepare("SELECT reward_points FROM tp_amc.reward_types WHERE reward_item = ? ");
$query->bind_param('s', $reward);
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $reward_points = $row["reward_points"];
}}




$query=$con->prepare("UPDATE tp_amc.rewards SET Points = Points - ? WHERE User_id= ? ");
$query->bind_param('ii', $reward_points , $User_id);

}


require_once "fxdelete_userrewards.php";


?>