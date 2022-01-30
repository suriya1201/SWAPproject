<?php

if (isset($_POST["reset-password-submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = htmlspecialchars($_POST["pwd"]);
    $passwordRepeat = htmlspecialchars($_POST["pwd-repeat"]);

    if(empty($password) || empty($passwordRepeat)){

        header("Location: create-new-password.php?newpwd=empty");
        exit();
    } else if ($password != $passwordRepeat){
        header("Location: create-new-password.php?newpwd=pwdnotsame");
        exit();
    }

    $currentDate = date("U");

    require 'db_connection.php'; 

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpire >= ?";
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)){
            echo "You need to resubmit your request1";
            exit();
        } else{
            
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false){
                echo "You need to resubmit your request2";
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM user WHERE Email=?;";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "There was an error1";
                exit();
                } else{

                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)){
                     echo "There was an error2";
                    exit();
                    } else{

                      $sql = "UPDATE user SET Password=? WHERE Email=?";
                      $stmt = mysqli_stmt_init($con);
                      if(!mysqli_stmt_prepare($stmt, $sql)){
                      echo "There was an error3";
                      exit();
                      } else {

                        $newPwdHash = base64_encode(hash("sha256", $password));
                        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                        mysqli_stmt_execute($stmt);

                        $sql ="DELETE FROM pwdReset WHERE pwdResetEmail=?";
                        $stmt = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            echo "There was an error4";
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            header("Location: Loginpage.php?newpwd=passwordupdated");
                        }
                        
                        
                      }


                    }

                }


            }
        }
    }


} else{
    header("Location: reset_password.php");
}

?>