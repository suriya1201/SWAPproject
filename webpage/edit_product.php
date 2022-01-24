<?php include 'navbar.php' ?>

<html>
<head>
	<style>
	.center {
	   text-align: center;
	}
	</style>
</head>
<body>
<?php
$connect = mysqli_connect("localhost","root","","tp_amc");
$id = $_GET['id'];
$id = mysqli_real_escape_string($connect, $id);
$query="SELECT Product_Name, Product_Description, Price, Quantity, Item_points, Image FROM `products` WHERE ID='$id'";
$result=mysqli_query($connect, $query);
while($row=mysqli_fetch_array($result)){
?>
<form action="update_product.php" class="center" method="post">
<table align='center'>
<tr>
	<td>Name: (viewing only)</td>
	<td><input type="text" name="Product_Name" value=<?php echo $row['Product_Name'] ?> readonly><br></td>
</tr>
<tr>
	<td>Description: </td>
	<td><input type="text" name="Product_Description" value="<?php echo $row['Product_Description'] ?>"><br></td>
</tr>
<tr>
	<td>Price: </td>
	<td><input type="text" name="Price" value="<?php echo $row['Price'] ?>"><br></td>
</tr>
<tr>
	<td>Quantity: </td>
	<td><input type="text" name="Quantity" value="<?php echo $row['Quantity'] ?>"><br></td>
</tr>
<tr>
	<td>Points: </td>
	<td><input type="text" name="Item_points" value="<?php echo $row['Item_points'] ?>"><br></td>
</tr>
<tr>
	<td>Image: </td>
	<td><input type="file" name="Image" value="<?php echo $row['Image'] ?>"><br></td>
</tr>
<tr class="center">
	<td></td>
	<td><input type="Submit" value="Update"><br></td>
</tr>
</table>
</form>
<?php 
}
?>
</body>
</html>