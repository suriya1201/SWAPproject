<?php
session_start();
include "db_connection.php";
require_once "purchase.php";


if (isset($_SESSION["username"]))
{
	echo "<pre><b>Login done</b><br></pre>";
	echo "<pre><h3>Welcome back <u>" . $_SESSION['username']. "</u></h3></pre>";
	debug();
}
else {
	echo "<pre><b>Login not done</b><br></pre>";
	echo "<pre><h3><a href=loginform.php>You have not logged in. Please go back to login page</a></h3></pre>";
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

function printmessage($message) {
	// echo "<script>console.log(\"$message\");</script>";
	echo "<pre>$message<br></pre>";
}

function checkpost($input) {

	$inputvalue=$_POST[$input];

	if (empty($inputvalue)) {
		printmessage("$input field is empty");
	
	}
	return true;
}

function calculatepoints($quantity){
    



}



?>