<?php
    $connect = mysqli_connect("localhost","root","","tp_amc");
    $query = $connect->prepare("INSERT INTO `rewards` (`reward_item`,`reward_points`) VALUES (?,?)");
    $reward_item = $_POST["reward_item"];
    $reward_points = $_POST["reward_points"];
    $query->bind_param('ss', $id, $reward_item, $reward_points);
    if ($query->execute()){
        echo "Query executed.";
    }
?>
<meta http-equiv="refresh" content="0;URL=displayrewards.php" />