<?php

$sql="SELECT * FROM  Username = ?"
$stmt->bind_param('s', $username);
$stmt=$con->prepare($sql);
$result = $stmt->execute();
$result = $stmt->get_result();

if(!$result)
?>