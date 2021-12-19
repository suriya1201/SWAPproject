<?php

if (isset($_SESSION["Username"])){

    $username = $_SESSION["Username"];


    $sql="SELECT * FROM  Username = '$username'"
    $stmt->bind_param('s', $username);
    $stmt=$con->prepare($sql);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows>0){
        $username = $row['Username'];
        $password = $row['Password'];
        $email = $row['Email'];
        $address = $row['Address'];
        $contact = $row['Phone_number'];
    }
}





?>