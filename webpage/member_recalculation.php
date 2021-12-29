<?php 

function recal($Points,$User_id) {
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



   require "create_purchase.php";


   $item_points = (int)"SELECT Item_points FROM tp_amc.products WHERE $Product_Name = ID ";
   $Points = $quantity * $item_points + 200 ;

       $ID =$_SESSION['Id'];

	   $Query="SELECT EXISTS(SELECT * FROM tp_amc.rewards WHERE User_id = $ID)" ;
	   $Result=mysqli_query($con,$Query);

	   
	if (!$Result) {
		printerror("Selecting $db_database",$con);
		die();
	}
	else printok($Query);

    mysqli_close($con);
	printok("Closing connection");


    if($Result=true){

    $query="INSERT INTO tp_amc.rewards (Points) WHERE User_id = $ID #insert values
    VALUES ('$Points','$User_id') ";
    }

    elseif($Result=false){

        $query="INSERT INTO tp_amc.rewards (Points,User_id) #insert values
    VALUES ('$Points','$User_id') ";


    }
	else{
		printerror("Selecting $db_database",$con);
		die();
	}




    $result=mysqli_query($con,$query);
	if (!$result) {
		printerror("Selecting $db_database",$con);
		die();
	}
	else printok($query);

    mysqli_close($con);
	printok("Closing connection");



}

?>