<?php

include "session_regen.php";

if (!isset($_SESSION["Username"])){
    header("Location: Homepage.php");
}

include "Homepage.php"
?>

