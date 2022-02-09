<?php 
include "db_connection.php";
echo $_GET['id'];
$id = $_GET['id'];
$stmt = $con->prepare("DELETE FROM user WHERE ID=?");
$stmt->bind_param('s', $id);
if ($stmt->execute()) {
    echo "<script>alert('User deleted!')</script>";
    echo "<script>window.location.replace('view_users.php')</script>";
}
?>