<?php
include "session_regen.php";
include "db_connection.php";

require "rewardspage.php";

$reward = $reward_item;
$reward_points = "SELECT reward_points FROM tp_amc.reward_types WHERE reward_item = $reward ";

$User_id =$_SESSION['ID'];



$query=$con->prepare("UPDATE tp_amc.rewards SET Points = Points - $reward_points WHERE User_id=$User_id ");
    
  

if ($query->execute()){
        echo "Query executed, Database updated";
    }
    else{
        echo $query->error;
        echo "You do not have enough points";
    }
require_once "fxdelete_userrewards.php";


mysqli_close($con);
?>