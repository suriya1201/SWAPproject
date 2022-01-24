<?php include 'navbar.php' ?>

<?php
$connect = mysqli_connect("localhost","root","","tp_amc.sql");
$query=$connect->prepare("SELECT ID, Product_Name, Product_Description, Price, Quantity, Item_points, Image FROM `products`");
$query->execute();
$query->bind_result($id, $productname, $productdescription, $productprice, $productquantity, $productpoints, $productimage );
echo "<table align='center' border='1'><tr>";
echo "<th>Id</th><th>Name</th><th>Description</th><th>Price</th><th>Quantity</th><th>Points</th><th>Image</th>";
while($query->fetch())
{
    echo "<tr><td>".$id."</td>";
    echo "<td>".$productname."</td>";
    echo "<td>".$productdescription."</td>";
    echo "<td>".$productprice."</td>";
    echo "<td>".$productquantity."</td>";
    echo "<td>".$productpoints."</td>";
    echo "<td>".$productimage."</td>";
    echo "<td><a href='delete_product.php?id=".$id."'>delete</a></td>";
    echo "<td><a href='edit_product.php?id=".$id."'>edit</a></td></tr>";
}
echo "</table>";
?>
