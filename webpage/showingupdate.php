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


<form action="updatepurchase.php" method="POST">

<table border="1">
	<tr>
		<td>ID: </td>
		<td> <input type="text" name="ID"></td>
	</tr>
	<tr>
		<td>Product Name: </td>
		<td> <input type="text" name="Product_Name"></td>
	</tr>
	<tr>
		<td>Quantity: </td>
		<td> <input type="text" name="Quantity"></td>
	</tr>
	<tr>
		<td>Custom_word: </td>
		<td> <input type="text" name="Custom_word"></td>
	</tr>
	<tr>
		<td></td>
		<td> <input type="submit" value="Action"></td>
	</tr>

</table>