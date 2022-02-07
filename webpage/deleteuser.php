<?php 
include "db_connection.php";
echo $_GET['id'];
$id = $_GET['id'];
$stmt = $con->prepare("DELETE FROM user WHERE ID=?");
$stmt->bind_param('s', $id);
if ($stmt->execute()) {
    echo "<script>alert('user deleted')</script>";
    header("view_users.php");
}
?>