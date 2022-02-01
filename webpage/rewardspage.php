<?php 
include "session_regen.php";
if ($_SESSION['Role'] != 'r_admin') {
    header("Location: rewards_user.php");


}elseif($_SESSION['Role'] == 'r_admin'){
    header("Location: rewards_admin.php");


}

?>



