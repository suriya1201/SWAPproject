<?php 
session_start();
session_regenerate_id();
$inactive = 900;

if (isset($_SESSION["timeout"])) {
    $sessionTTL = time() - $_SESSION["timeout"];
    if ($sessionTTL > $inactive) {
        session_destroy();
    }
}
?>