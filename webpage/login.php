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

$sql = "SELECT * FROM user WHERE Username = ? AND Password = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('ss', $username, $password);
$result = $stmt->execute();
$result = $stmt->get_result();

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['Username'] === $username && $row['Password'] === $password) {
        if ( empty($row['Verified_date']) ) {
            $email = $row['Email'];
            header("Location: email_verify.php?email=" . $email);
        }else{
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['Role'] = $row['User_type'];
            $_SESSION['ID'] = $row['ID'];
            $_SESSION['Email']=$row['Email'];
            $_SESSION['timeout'] = time();


            $action = "login";
            $username =$_SESSION['Username'];
            
            $query = $con->prepare("INSERT INTO tp_amc.login_log (User_name,Action) VALUES (?,?)");
            $query->bind_param('ss', $username , $action );
            $query->execute();

            

            if($row['User_type'] == 'p_admin'){
                header("Location: create_product_form.php");
            }else if ($row['User_type'] == 'r_admin'){
                header("Location: rewardspage.php");
            }else {
                header("Location: google_auth.php");
                
            }
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