<?php
session_start();

include "db_connection.php";

$username = $_POST['username'];
$password = base64_encode(hash("sha256", $_POST['password']));

$sql = "SELECT * FROM user WHERE Username = '$username' AND Password ='$password'";
$stmt = $con->prepare($sql);
$result = $stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['Username'] === $username && $row['Password'] === $password) {
        echo "Logged In";
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['ID'] = $row['ID'];
        header("Location: logged_in.php");
        exit();
    }
    else{
        echo "<script>alert('Incorrect Username or Password')</script>";
        exit();
    }
}
else {
    header("Location: Loginpage.php");
    exit();
}

?>