<?php

if (isset($_POST["reset-password-submit"])){ //when button is pressed

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = htmlspecialchars($_POST["pwd"]); //prevent xss
    $passwordRepeat = htmlspecialchars($_POST["pwd-repeat"]); //prevent xss
    
    $regex_check = 1; //regex to prevent input of special characters like ! 

    $patterncheck = "/^[A-Za-z0-9 ]+$/";

    if(!preg_match($patterncheck, $password)){
        echo "<script>alert('Please ensure that the password contains only numbers and alphabets')</script>";
        $regex_check = 0;
    }
    
    if(!preg_match($patterncheck, $passwordRepeat)){
        echo "<script>alert('Please ensure that the repeated password contains only numbers and alphabets')</script>";
        $regex_check = 0;
    }

    if(empty($password) || empty($passwordRepeat)){

        header("Location: create-new-password.php?newpwd=empty"); //error will occur saying selector & validator is empty, supposed to happen because of newpwd=empty in url
        exit();
    } else if ($password != $passwordRepeat){
        header("Location: create-new-password.php?newpwd=pwdnotsame"); //error will occur saying selector & validator is empty, supposed to happen because of newpwd=pwdnotsame in url
        exit();
    } else if ($regex_check == 0){
        header("Location: create-new-password.php?newpwd=invalidchars"); //error will occur saying selector & validator is empty, supposed to happen because of newpwd=invalidchars in url
        exit();
    }

    $currentDate = date("U");

    require 'db_connection.php'; 

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpire >= ?"; //select the data from the table when we sent a request to reset password
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)){
            echo "You need to resubmit your request1"; //means either token expire or selector token (first token) is wrong
            exit();
        } else{
            
            $tokenBin = hex2bin($validator); //convert back to binary to check
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false){
                echo "You need to resubmit your request2"; //if second token is wrong
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail']; //bind the email to this variable

                $sql = "SELECT * FROM user WHERE Email=?;";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                echo "There was an error1"; //if cannot connect
                exit();
                } else{

                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)){
                     echo "There was an error2"; //if email field is empty somehow
                    exit();
                    } else{

                      $sql = "UPDATE user SET Password=? WHERE Email=?";
                      $stmt = mysqli_stmt_init($con);
                      if(!mysqli_stmt_prepare($stmt, $sql)){
                      echo "There was an error3"; //cannot update
                      exit();
                      } else {

                        $newPwdHash = base64_encode(hash("sha256", $password)); //encode the new password with sha256 and hash it
                        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                        mysqli_stmt_execute($stmt);

                        $sql ="DELETE FROM pwdReset WHERE pwdResetEmail=?"; //delete the entire row of data so attackers cannot see the history of emails being used
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