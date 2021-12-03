<?php

$sql="SELECT * FROM  Username = ?"
$stmt->bind_param('s', $username);
$stmt=$con->prepare($sql);
$result = $stmt->execute();
$result = $stmt->get_result();

if(!$result) {
    die("SELECT query failed<br>".$con->error);
}else{
    echo "SELECT QUERY SUCCESS<br>";
}

$nrows=$result->num_rows;
echo "number of rows=$nrows<br>";

if($nrows>0){
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>Username</th>";
    echo "<th>Email</th>";
    echo "<th>Address</th>";
    echo "<th>Phone_Number</th>";
    
}

While($row=$result->fetch_assoc()){
    echo "<tr>";
    echo "<td>";
    echo $row['Username'];
    echo "</td>";
    echo "<td>";
    echo $row['Email'];
    echo "</td>";
    echo "<td>";
    echo $row['Address'];
    echo "</td>";
    echo "<td>";
    echo $row['Phone_Number'];
    echo "</td>";
   
    echo "</tr>";
    
}
echo "</table>";
else{
    echo "0 records<br>";
}

?>