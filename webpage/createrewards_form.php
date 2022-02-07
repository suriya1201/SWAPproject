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
</body>
</html>
<?php include 'footer.php' ?>