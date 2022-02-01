<?php
include "db_connection.php";
$reward_item = htmlspecialchars($_POST["reward_item"]);
$reward_points = htmlspecialchars($_POST["reward_points"]);

$regex_check = 1;

$item_regex = "/^[A-Za-z ]+$/";
$point_regex = "/^[0-9]+$/";
if (!preg_match($item_regex, $reward_item)){
	echo "<script>alert('Please ensure that the item contains only alphabets')</script>";
	$regex_check = 0;
}
if (!preg_match($point_regex, $reward_points)){
    echo "<script>alert('Please ensure that the point contains only numbers')</script>";
    $regex_check = 0;
}

if ($regex_check == 1) {
    $query = $con->prepare("INSERT INTO `reward_types` (`reward_item`,`reward_points`) VALUES (?,?)");
    $query->bind_param('ss', $reward_item, $reward_points);
    if ($query->execute()){
        echo "Query executed.";
    }
}
?>

<meta http-equiv="refresh" content="0;URL=rewardspage.php" />