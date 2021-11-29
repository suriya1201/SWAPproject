<?php
session_start();
include "db_connection.php";
require_once "purchase.php";

function printmessage($message) {
	// echo "<script>console.log(\"$message\");</script>";
	echo "<pre>$message<br></pre>";
}

function checkpost($input) {

	$inputvalue=$_POST[$input];

	if (empty($inputvalue)) {
		printmessage("$input field is empty");
	
	}
	else {
		function pointsCalculation($quantity,$calpoints){

		};
	}
}
 $calpoints=$_POST['Points']

rewards($calpoints);

?>