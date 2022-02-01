<?php
include "session_regen.php";
include "db_connection.php";


if (isset($_SESSION['Username'])  && $_SESSION['User_type']=="member") {
   require_once "fxmember_calculation.php";

   }

elseif(isset($_SESSION['Username'])  && $_SESSION['User_type']=="VIP"){
   require_once "fxVIP_calculation.php";

}
elseif(isset($_SESSION['Username'])  && $_SESSION['User_type']=="user"){
	require_once "fxuser_calculation.php";
}
else{
				
	
	die("");
}







?>