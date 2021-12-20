<html>
<head>
	<style>
	.center {
	   text-align: center;
	}
	</style>
</head>
<body>
<h4 align='center'>Create Rewards</h4>
<form class="right" action="createrewards.php" method="post">
<table align='center'>
<tr>
	<td>Reward: </td>
	<td><input type="text" name="reward_item"><br></td>
</tr>
<tr>
	<td>Points: </td>
	<td><input type="text" name="reward_points"><br></td>
</tr>
<tr class="center">
	<td></td>
	<td><input type="Submit" value="Create"><br></td>
</tr>
</table>
</form>
<?php
$connect = mysqli_connect("localhost","root","","tp_amc");
$query=$connect->prepare("SELECT ID, reward_item, reward_points FROM `reward_types`");
$query->execute();
$query->bind_result($id, $reward_item, $reward_points);
echo "<table align='center' border='1'><tr>";
echo "<th>Id</th><th>Rewards</th><th>Points</th>";
while($query->fetch())
{
    echo "<tr><td>".$id."</td>";
    echo "<td>".$reward_item."</td>";
    echo "<td>".$reward_points."</td>";
    echo "<td><a href='editrewards.php?id=".$id."'>edit</a></td>";
    echo "<td><a href='deleterewards.php?id=".$id."'>delete</a></td></tr>";
}
echo "</table>";
?>
</body>
</html>