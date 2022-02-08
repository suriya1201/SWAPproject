<?php 
include "db_connection.php";
echo $_GET['id'];
$id = $_GET['id'];
$stmt = $con->prepare("DELETE FROM purchase WHERE ID=?");
$stmt->bind_param('s', $id);
if ($stmt->execute()) {
    echo "<script>alert('Purchase deleted.')</script>";
    header("admin_purchase.php");
}
?>