<?php
session_start();
include "db_connection.php";

if(isset($_POST['username']) && isset($_POST['password']))  {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$username = validate($_POST['username']);
$password = validate($_POST['password']);

if(empty($username)) {
    header("Location: Loginpage.php?error=Username is required");
    exit();
}
else if(empty($pass)) {
    header("Location: Loginpage.php?error=Username is required")
    exit();
}

$sql = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $username $$ $row['password'] === $passward) {
        echo "Logged In";
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['id'] = $row['id'];
        header("Location: logged_in.php");
        exit()
    }
    else{
        header("Location: Loginpage.php?error=Incorrect Username or Password");
        exit();
    }
}
else {
    header("Location: Loginpage.php");
    exit();
}

?>