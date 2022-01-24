<html>
	<h1>Purchase Page</h1>
	
	
	<form action="q3.php" method="POST">
		<input type="SUBMIT" name="actiontype" value="List ALL">
	</form>
	<form action="q3.php" method="POST">
	
	<table border="1">
		<td>
		Action Type:
		<br>
		<input type="radio" name="actiontype" value="Add">Add
		<br>
		<input type="radio" name="actiontype" value="Update">Update
		<br>
		<input type="radio" name="actiontype" value="Delete">Delete
		</td>
	</table>
	<p>
	
	<table border="1">
		<tr>
			<td>Product Name: </td>
			<td><input type="text" name="Product_Name"></td>
		</tr>
		<tr>
			<td>User ID: </td>
			<td><input type="text" name="User_id"></td>
		</tr>
		<tr>
			<td>Quantity: </td>
			<td><input type="text" name="Quantity"></td>
		</tr>
		<tr>
			<td>Custom_word: </td>
			<td><input type="text" name="Custom_word"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="Action"></td>
		</tr>
		
</html>