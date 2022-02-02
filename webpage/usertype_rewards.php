<?php
include "session_regen.php";
include "db_connection.php";


if (isset($_SESSION['Username'])  && $_SESSION['User_type']=="member") {
   header("Location: fxmember_calculation.php");

   }

elseif(isset($_SESSION['Username'])  && $_SESSION['User_type']=="VIP"){
   header("Location: fxVIP_calculation.php");

}
elseif(isset($_SESSION['Username'])  && $_SESSION['User_type']=="user"){
	header("Location: fxuser_calculation.php");
}
else{
				
	
	die("");
}







?>