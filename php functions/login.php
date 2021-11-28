<?php
session_start();
include "db_connection.php";

if(isset($_POST['username']) && isset($_POST['password']))  {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$username = validate($_POST['username']);
$password = validate($_POST['password']);

if(empty($username)) {
    header("Location: Loginpage.php?erro=Username is required");
    exit();
}
else if(empty($pass)) {
    header("Location: Loginpage.php?erro=Username is required")
    exit();
}

$sql = "SELECT"
?>