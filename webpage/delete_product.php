<html>
<body>
<?php 
$connect = mysqli_connect("localhost","root","","tp_amc");
$id = $_GET['id'];
$id = mysqli_real_escape_string($connect, $id);
$query= $connect->prepare("DELETE FROM products WHERE ID='$id'");

if ($query->execute()) {
    echo "Query executed.";
}

?>
</body>

<meta http-equiv="refresh" content="0;URL=display_product.php" />

</html>