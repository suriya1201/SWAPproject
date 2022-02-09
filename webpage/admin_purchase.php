<?php 
include "db_connection.php";
include "navbar.php";

if ($_SESSION['Role'] != 'prc_admin') {
    echo "<script>alert('UNAUTHORIZED ACCESS IS NOT ALLOWED')</script>";
    echo "<script>window.location.replace('Homepage.php')</script>";
}
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

$query="SELECT ID,Product_Name,Quantity,Custom_word FROM purchase";
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
    echo "<th>Product_Name</th>";
    echo "<th>Quantity</th>";
    echo "<th>Custom_word</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "</tr>";

    While($row=$result->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $row['ID']; ?></td>
        <td><?php echo $row['Product_Name']; ?></td>
        <td><?php echo $row['Quantity']; ?></td>
        <td><?php echo $row['Custom_word']; ?></td>
        <td><a href='showingupdate.php'>Edit</a></td>
        <td><a href='deletepurchase.php?id=<?php echo $row["ID"]; ?>'>Delete</a></td>
    </tr>
       <?php 
    }
    echo "</table>";


}
else{
    echo "0 records<br>";
}


?>

</body>
</html>