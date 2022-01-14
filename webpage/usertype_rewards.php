<?php


session_start();
if (isset($_SESSION['username'])  && $_SESSION['User_type']=="member") {
   require_once "fxmember_calculation.php";

   }

elseif(isset($_SESSION['username'])  && $_SESSION['User_type']=="VIP"){
   require_once "fxVIP_calculation.php";

}
else{
	require_once "fxuser_calculation.php";				
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