<?php
$con = mysqli_connect("localhost","root","","tp_amc");
if (!$con){
	die('Could not connect: ' . mysqli_connect_errno());
}

$actiontype = $_POST["actiontype"];
$add = $actiontype === "Add"; //boolean type comparator to check actiontype value === checks value + type
$update = $actiontype === "Update";
$delete = $actiontype === "Delete";

if($add || $update || $delete ){ //Read in the form data assign to variables
    
    $Product_Name = $_POST["Product_Name"];
    $User_id = $_POST["User_id"];
    $Quantity = $_POST["Quantity"];
    $Custom_word = $_POST["Custom_word"];
    //echo "<tr><td>". $productID ."</td><td>". $productName ."</td><td>". $stockAmount . "</td><td>". $sellerContact. "</td><td>". $createdDate ."</td></tr>";
    //echo $add  ." ". $delete . " " . $update ;
    
    if($add){
        $query = $con->prepare("INSERT INTO `purchase` (`Product_Name`,`User_id`,`Quantity`,`Custom_word`) VALUES (?,?,?,?)");
        $query->bind_param('iiis',$Product_Name,$User_id,$Quantity,$Custom_word);
    }
    elseif($update){
        $query=$con->prepare("Update purchase SET Product_Name=?, User_id=?, Quantity=?, Custom_word=? where ID=?");
        $query->bind_param('iiis',$Product_Name,$User_id,$Quantity,$Custom_word,$ID);
    }
    else{
        $query=$con->prepare("Delete from purchase where ID=?");
        $query->bind_param('s',$ID);
    }
    if ($query->execute()){
        echo "Query executed, Database updated";
    }
    else{
        echo $query->error;
        echo "Error executiny query";
    }
    
}

else //select statement for list all
{
    $query=$con->prepare("Select Product_Name, User_id, Quantity, Custom_word, from purchase");
    $query->execute();
    $query->store_result();
    $query->bind_result($Product_Name,$User_id,$Quantity,$Custom_word);
    
    if($query->num_rows === 0)exit('No rows');
    echo "<h2>List of products</h2>";
    echo "<table border=1>";
    echo "<tr><td>Product Name</td><td>User ID</td><td>Quantity</td><td>Custom Word</td></tr>";
    
    while($query->fetch()){
        echo "<tr><td>". $Product_Name . "</td><td>". $User_id . "</td><td>". $Quantity . "</td><td>". $Custom_word. "</td></tr>";
    }
    echo "</table>";

}

$con->close();
?>