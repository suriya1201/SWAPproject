<?php
session_start();

include "db_connection.php";
include "regex.php";

$username = $_POST['username'];
$password = $_POST['password'];

if (!preg_match($username_regex, $username)){
    echo "Please ensure that your username contains only numbers and alphabets";
    $regex_check = 0;
}
if (!preg_match($username_regex, $password)){
    echo "Please ensure that your password contains only numbers and alphabets";
    $regex_check = 0;
}

if ($regex_check == 1) {
    $password = base64_encode(hash("sha256", validate($_POST['password'])));

    $sql = "SELECT * FROM user WHERE Username = ? AND Password = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $username, $password);
    $result = $stmt->execute();
    $result = $stmt->get_result();

    if(mysqli_num_rows($result) === 1 && $_POST['g-recaptcha-response'] != "") {
        $secret = '6LfM2lQeAAAAAPXIK0jKiTUAFbLrudkr5McE02Tv';
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        $row = mysqli_fetch_assoc($result);
        if(($row['Username'] === $username && $row['Password'] === $password) && $responseData->success) {
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
}


?>