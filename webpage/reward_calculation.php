<?php

include "db_connection.php";
session_start();
if (isset($_SESSION['username'])  && $_SESSION['User_type']=="member") {
   function recal(){

   }
}
elseif(isset($_SESSION['username'])  && $_SESSION['User_type']=="regular"){
	

}
else{
    echo "<pre><h3><a href=loginform.php>You have not signed up as a member. This page is only for authorised users</a></h3></pre>";
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