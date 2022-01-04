<?php 

function recal($Points,$User_id) {
$con = mysqli_connect("localhost","root","","");
if(!$con){
	die('could not connect:'.mysqli_connect_errno());
}



   
   require_once "create_purchase.php";
   $name_product = (string)($Product_Name);
   $item_points = (int)"SELECT Item_points FROM tp_amc.products WHERE Product_Name = $name_product ";
   $Points = (int)($quantity * $item_points + 200) ;

       $User_id =(int)$_SESSION['Id'];

	   $Query="SELECT EXISTS(SELECT * FROM tp_amc.rewards WHERE User_id = $User_id)" ;
	   $Result=mysqli_query($con,$Query);


	if (!$Result) {
		$query="INSERT INTO tp_amc.rewards (Points,User_id) 
		VALUES ('$Points','$User_id' )";
        $result=mysqli_query($con,$query);
		if (!$result) {
			printerror("Selecting $db_database",$con);
			die();
		}
		else printok($query);
	
		mysqli_close($con);
		printok("Closing connection");

    }
	else {


		$query="UPDATE tp_amc.rewards SET Points = $Points + Points
		WHERE User_id=$User_id ";
        $result=mysqli_query($con,$query);
		if (!$result) {
			printerror("Selecting $db_database",$con);
			die();
		}
		else printok($query);
	
		mysqli_close($con);
		printok("Closing connection");

	};





    mysqli_close($con);
	printok("Closing connection");








	




    



}

?>