<?php	// Creates the user table and setup accounts


function rewards($points, $Username) {

	require "config.php";
	
	function printerror($message, $con) {
		echo "<pre>";
		echo "$message<br>";
		if ($con) echo "FAILED: ". mysqli_error($con). "<br>";
		echo "</pre>";
	}

	function printok($message) {
		echo "<pre>";
		echo "$message<br>";
		echo "OK<br>";
		echo "</pre>";
	}

	try {
	$con=mysqli_connect($db_hostname,$db_username,$db_password);
	}
	catch (Exception $e) {
		printerror($e->getMessage(),$con);
	}
	if (!$con) {
		printerror("Connecting to $db_hostname", $con);
		die();
	}
	else printok("Connecting to $db_hostname");

	$result=mysqli_select_db($con, $db_database);
	if (!$result) {
		printerror("Selecting $db_database",$con);
		die();
	}
	else printok("Selecting $db_database");


	$query="INSERT INTO swap.rewards (Points,Username) 
		VALUES ('$Points', '$Username')";
	$result=mysqli_query($con,$query);
	if (!$result) {
		printerror("Selecting $db_database",$con);
		die();
	}
	else printok($query);

	mysqli_close($con);
	printok("Closing connection");



}