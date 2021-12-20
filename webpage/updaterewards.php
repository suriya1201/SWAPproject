<?php
$connect = mysqli_connect("localhost","root","","tp_amc");
$query = $connect->prepare("UPDATE reward_types SET REWARD_POINTS=? WHERE REWARD_ITEM=?");
$reward_item = $_POST["reward_item"];
$reward_points = $_POST["reward_points"];
$query->bind_param('ss', $reward_points, $reward_item);
if ($query->execute()){
    echo "Query executed.";
}
?>
<meta http-equiv="refresh" content="0;URL=displayrewards.php" />