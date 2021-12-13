<?php
session_start();
unset($_SESSION["ID"]);
unset($_SESSION["Username"]);
header("Location: Homepage.php");
?>