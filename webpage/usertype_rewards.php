<?php
session_start();


if (isset($_SESSION['username'])  && $_SESSION['User_type']=="member") {
   require_once "fxmember_calculation.php";

   }

elseif(isset($_SESSION['username'])  && $_SESSION['User_type']=="VIP"){
   require_once "fxVIP_calculation.php";

}
elseif(isset($_SESSION['username'])  && $_SESSION['User_type']=="user"){
	require_once "fxuser_calculation.php";
}
else{
				
	
	die("");
}







?>