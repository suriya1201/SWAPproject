<?php

if (isset($_POST["reset-password-submit"])){ //when button is pressed

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = htmlspecialchars($_POST["pwd"]); //prevent xss
    $passwordRepeat = htmlspecialchars($_POST["pwd-repeat"]); //prevent xss
    
    $regex_check = 1; //regex to prevent input of special characters like ! 

    $patterncheck = "/^[A-Za-z0-9 ]+$/";
    $uppercase1 = preg_match('[A-Z]', $password);
    $lowercase1 = preg_match('[a-z]', $password);
    $number1    = preg_match('[0-9]', $password);
    $specialcharacters1 = preg_match('[_!#$%&*^\w]', $password);
    $uppercase2 = preg_match('[A-Z]', $passwordRepeat);
    $lowercase2 = preg_match('[a-z]', $passwordRepeat);
    $number2    = preg_match('[0-9]', $passwordRepeat);
    $specialcharacters2 = preg_match('[_!#$%&*^\w]', $passwordRepeat);

    if(!preg_match($patterncheck, $password)){
        $regex_check = 0;
    }
    
    if(!preg_match($patterncheck, $passwordRepeat)){
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
    } else if (strlen($password)<6 || strlen($passwordRepeat)<6){
        header("Location: create-new-password.php?newpwd=6charactersatleast"); //error will occur saying selector & validator is empty, supposed to happen because of newpwd=6charactersatleast in url
        exit();
    } else if (!$uppercase1 || !$lowercase1 || !$number1 || !$specialcharacters1){
        header("Location: create-new-password.php?newpwd=passwordshouldinclude1uppercase1number1specialcharacter"); 
        exit();
    } else if (!$uppercase2 || !$lowercase2 || !$number2 || !$specialcharacters2){
        header("Location: create-new-password.php?newrepeatedpwd=passwordshouldinclude1uppercase1number1specialcharacter"); 
        exit();
    }

    $currentDate = date("U");

    require 'db_connection.php'; 

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpire >= ?"; //select the data from the table when we sent a request to reset password
    $stmt = mysqli_stmt_init($con);
    if(!mysqli_stmt_prepare($stmt, $sql)){ //either fields are missing or cannot connect
        echo "<script>alert('Connection error or missing fields')</script>";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)){
            echo "<script>alert('Token expired or token is wrong')</script>"; //means either token expire or selector token (first token) is wrong
            exit();
        } else{
            
            $tokenBin = hex2bin($validator); //convert back to binary to check
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]); //check whether both the binary for the token matches

            if ($tokenCheck === false){
                echo "<script>alert('Your validator token is not the same')</script>"; //if second token is wrong
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail']; //bind the email to this variable

                $sql = "SELECT * FROM user WHERE Email=?;";
                $stmt = mysqli_stmt_init($con);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "<script>alert('Cannot connect to database')</script>"; //if cannot connect
                exit();
                } else{

                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)){
                        echo "<script>alert('Email field is empty')</script>"; //if email field is empty 
                    exit();
                    } else{

                      $sql = "UPDATE user SET Password=? WHERE Email=?";
                      $stmt = mysqli_stmt_init($con);
                      if(!mysqli_stmt_prepare($stmt, $sql)){
                        echo "<script>alert('Cannot update')</script>"; //cannot update
                      exit();
                      } else {

                        $newPwdHash = base64_encode(hash("sha256", $password)); //encode the new password with sha256 and hash it
                        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                        mysqli_stmt_execute($stmt);

                        $sql ="DELETE FROM pwdReset WHERE pwdResetEmail=?"; //delete the entire row of data so attackers cannot see the history of emails being used
                        $stmt = mysqli_stmt_init($con);
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            echo "<script>alert('Connection error, cannot delete')</script>";
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