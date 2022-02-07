<?php include "navbar.php";
if ($_SESSION['Role'] != 'r_admin') { //ensure only r_admin can access this page
    echo "<script>alert('UNAUTHORIZED ACCESS IS NOT ALLOWED')</script>";
    die();
}
?>
<html>
<head>
	<style>
	.center {
	   text-align: center;
	}
	</style>
</head>
<body>
<?php
include "db_connection.php";
$id = $_GET['id'];
$id = mysqli_real_escape_string($con, $id);
$query="SELECT reward_item, reward_points FROM `reward_types` WHERE ID='$id'";
$result=mysqli_query($con, $query);
while($row=mysqli_fetch_array($result)){
?>
<form action="updaterewards.php" class="center" method="post">
<table align ='center'>
<tr>
	<td>Reward: </td>
	<td><input type="text" name="reward_item" value=<?php echo $row['reward_item'] ?>><br></td>
</tr>
<tr>
	<td>Points: </td>
	<td><input type="text" name="reward_points" value="<?php echo $row['reward_points'] ?>"><br></td>
</tr>
<tr class="center">
	<td></td>
	<td><input type="Submit" value="Update"><br></td>
</tr>
</table>
</form>
<?php 
}
?>
</body>
</html>
<?php include 'footer.php' ?>