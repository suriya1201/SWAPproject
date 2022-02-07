<?php 
include "db_connection.php";
include "navbar.php";
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/w3css/3/w3.css">
</head>
<body> 
<?php

$query="SELECT ID,Username,Email,Address,Phone_Number,User_type FROM user WHERE User_type = 'user'";
$pQuery=$con->prepare($query); 
$result=$pQuery->execute(); 
$result=$pQuery->get_result(); 
if(!$result){
    die("SELECT query failed<br>".$con->error);
}

$nrows=$result->num_rows; 

if($nrows>0){
    //draw the table header ONCE only
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Username</th>";
    echo "<th>Email</th>";
    echo "<th>Address</th>";
    echo "<th>Phone_Number</th>";
    echo "<th>User_type</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "</tr>";
    
    While($row=$result->fetch_assoc()){
        echo "<tr>";
        echo "<td>";
        echo $row['ID']; 
        echo "</td>";
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
        echo "<td>";
        echo $row['User_type'];
        echo "</td>";
        echo "<td>";
        echo "<a href='edit.php'>Edit</a>";
        echo "</td>";
        echo "<td>";
        echo "<a href='deleteuser.php'>Delete</a>";
        echo "</td>";

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