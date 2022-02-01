<?php
include "db_connection.php";

require "rewards_user.php";






if (isset($_POST['submit5'])){

$User_id =$_SESSION['ID'];
$reward = $_POST['id'];

$query = $con->prepare("SELECT  reward_points FROM reward_types WHERE ID = ? ");
$query->bind_param('i', $reward);
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $reward_point = $row["reward_points"];
}}


$query=$con->prepare("UPDATE rewards SET Points = (Points - ?) WHERE User_id = ? ");
$query->bind_param('ii', $reward_point, $User_id);
$query->execute();

}





?>