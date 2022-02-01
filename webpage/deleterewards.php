<html>
<body>
<?php 
include "db_connection.php";
$id = $_GET['id'];
$id = mysqli_real_escape_string($connect, $id);
$query= $con->prepare("DELETE FROM reward_types WHERE ID='$id'");
if ($query->execute()) {
    echo "Query executed.";
}
?>
</body>
<meta http-equiv="refresh" content="0;URL=rewardspage.php" />
</html>