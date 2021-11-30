<html>
<body> 
<?php
$con = mysqli_connect("localhost","root","","swap_amc");
if (!$con){
die('Could not connect: ' . mysqli_connect_errno());
}

$query="SELECT ID,reward_item,reward_points FROM reward_types";
$pQuery=$con->prepare($query);
$result=$pQuery->execute();
$result=$pQuery->get_result();
if(!$result){
    die("SELECT query failed<br>".$con->error);
}
else{
    echo "SELECT QUERY SUCCESS<br>";
}

$nrows=$result->num_rows;
echo "number of rows=$nrows<br>";

if($nrows>0){
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>reward_item</th>";
    echo "<th>reward_points</th>";
    echo "</tr>";
    
    While($row=$result->fetch_assoc()){
        echo "<tr>";
        echo "<td>";
        echo $row['ID'];
        echo "</td>";
        echo "<td>";
        echo $row['reward_item'];
        echo "</td>";
        echo "<td>";
        echo $row['reward_points'];
        echo "</td>";
        echo "<td>";
        echo "</tr>";
        
    }
    echo "</table>";
    
    
}
else{
    echo "0 records<br>";
}


?>

</body>
</html>