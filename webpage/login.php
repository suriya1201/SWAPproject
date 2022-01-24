<?php
session_start();

include "db_connection.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = validate($_POST['username']);
$password = base64_encode(hash("sha256", validate($_POST['password'])));

$sql = "SELECT * FROM user WHERE Username = '$username' AND Password ='$password'";
$stmt = $con->prepare($sql);
$result = $stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['Username'] === $username && $row['Password'] === $password) {
        echo "Logged In";
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['Role'] = $row['User_type'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['timeout'] = time();
        if($row['User_type'] == 'p_admin'){
            header("Location: create_product_form.php");
        }else{
            header("Location: logged_in.php");
            exit();
        }
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