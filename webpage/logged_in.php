<?php

include "session_regen.php";

if (!isset($_SESSION["Username"])){
    header("Location: Homepage.php");
    exit();
}

include "Homepage.php"
?>

