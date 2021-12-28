<?php

include "db_connection.php";

session_start();
if (isset($_SESSION['username'])  && $_SESSION['User_type']=="member") {
   require_once "member_recalculation.php";

   }

elseif(isset($_SESSION['username'])  && $_SESSION['User_type']=="VIP"){
   require_once "VIP_recalculation.php";

}
else{
    echo "<pre><h3>You have not signed up as a member or VIP member.</h3></pre>";
	debug();
	die("");
}




function debug() {
	echo "<pre>";
	echo "--------------------------------------------<br>";
	echo "_SESSION<br>";
	print_r($_SESSION);
	echo "_COOKIE<br>";
	print_r($_COOKIE);
	echo "session_name()= " . session_name();
	echo "<br>";
	echo "session_id()= " . session_id();
	echo "<br>";
	echo "</pre>";
}


?>