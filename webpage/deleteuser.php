<?php 
include "db_connection.php";

$user = $_SESSION("username");
$stmt = $con->prepare("DELETE FROM user WHERE Username=?");
$stmt->bind_param('s', $user);
if ($stmt->execute()) {
    echo "Query executed.";
}
?>