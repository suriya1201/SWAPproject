<?php 
$con = mysqli_connect("localhost","root","","tp_amc");
if(!$con){
	die('could not connect:'.mysqli_connect_errno());
}

require "create_purchase.php";
$name_product = $Product_Name;
$item_points = "SELECT Item_points FROM tp_amc.products WHERE Product_Name = $name_product ";
$Points = ($quantity * $item_points + 400) ;

$User_id =$_SESSION['Id'];


$Query="SELECT EXISTS(SELECT User_id FROM tp_amc.rewards WHERE User_id = $User_id)" ;
$Result=mysqli_query($con,$Query);
if (!$Result) {
    $query=$con->prepare("INSERT INTO tp_amc.rewards VALUES (?,?)");
    
    $query->bind_param('ii','$Points','$User_id' );
    
}


else {


    $query=$con->prepare("UPDATE tp_amc.rewards SET Points = $Points + Points WHERE User_id=$User_id ");
    
  

};
if ($query->execute()){
        echo "Query executed, Database updated";
    }
    else{
        echo $query->error;
        echo "Error executiny query";
    }




mysqli_close($con);


?>