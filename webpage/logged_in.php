<?php

include "Homepage.php";

if (!isset($_SESSION["Username"])){
    header("Location: Homepage.php");
    exit();
}
?>

