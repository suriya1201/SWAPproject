<?php 
session_start();

if ($_SESSION['Role'] != 'p_admin') {
    echo "<script>alert('UNAUTHORIZED ACCESS IS NOT ALLOWED')</script>";
    die();
}

?>

<?php include 'navbar.php' ?>

<html>
<body>

<form action="create_product.php" method="POST">
    <input type="text" name="name" placeholder="productname">
    <br>
    <br>
    <input type="text" name="description" placeholder="productdescription">
    <br>
    <br>
    <input type="text" name="price" placeholder="productprice">
    <br>
    <br>
    <input type="text" name="quantity" placeholder="productquantity">
    <br>
    <br>
    <input type="text" name="points" placeholder="productpoints">
    <br>
    <br>
    <input type="file" name="image" placeholder="productimage">
    <br>
    <br>
    <button type="submit" name="submit">Add Product</button>
</form>

</body>
</html>