<?php
session_start();

include "db_connection.php";

if (!isset($_SESSION['username'])) {
    header("Location: Loginpage.php");
}

if(isset($_POST['username']) && isset($_POST['password']))  {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$username = validate($_POST['username']);
$password = validate($_POST['password']);

if(empty($username)) {
    echo "<script>alert('Username is required')</script>";
    exit();
}
else if(empty($password)) {
    echo "<script>alert('Password is required')</script>";
    exit();
}

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