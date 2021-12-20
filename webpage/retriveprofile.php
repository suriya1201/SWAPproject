<?php

include "db_connection.php";

if (isset($_SESSION["Username"])){

    $username = $_SESSION["Username"];

    $sql = "SELECT * FROM user WHERE Username = '$username'";
    $stmt = $con->prepare($sql);
    $result = $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows>0){
        $row = mysqli_fetch_assoc($result);
        $username = $row['Username'];
        $email = $row['Email'];
        $address = $row['Address'];
        $contact = $row['Phone_Number'];
    }
    else {
        echo "error1";
    }
}

?>