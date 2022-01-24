<?php 
session_start();

$inactive = 900;

if (isset($_SESSION["timeout"])) {
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
    session_destroy();
   
?>