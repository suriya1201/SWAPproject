<html>
<body>
<?php include 'navbar.php' ?>
<?php 

if ($_SESSION['Role'] != 'p_admin') { //ensure only p_admin can access this page
    echo "<script>alert('UNAUTHORIZED ACCESS IS NOT ALLOWED')</script>";
    die();
}

?>
<?php 
$connect = mysqli_connect("localhost","root","","tp_amc");
$id = $_GET['id'];
$id = mysqli_real_escape_string($connect, $id);
$query= $connect->prepare("DELETE FROM products WHERE ID='$id'"); //delete based on the id

if ($query->execute()) {
    echo "<script>alert('Query executed')</script>";
}

?>
</body>

<meta http-equiv="refresh" content="0;URL=display_product.php" />

</html>