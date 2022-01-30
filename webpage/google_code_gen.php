<?php
include "session_regen.php";
require 'vendor/autoload.php';
include "db_connection.php";

$userid = 24;
$email = "LANZEXI26@GMAIL.COM" ;
$g =new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
include "navbar2.php";


//sql prepared statement 

$query = $con->prepare("SELECT google_auth FROM user WHERE ID = ?");
$query->bind_param('i', $userid);
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $googleAuth = $row["google_auth"];
}}

if(!isset($googleAuth) || $googleAuth == ""){
    
     
     $secret = $g->generateSecret();

     $query = $con->prepare("UPDATE tp_amc.user SET google_auth = ? WHERE ID = ?");
     $query->bind_param('si', $secret , $userid);
     $query->execute();

     $query = $con->prepare("SELECT google_auth FROM user WHERE ID = ?");
     $query->bind_param('i', $userid);
     $query->execute();
     $result = $query->get_result();
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
         $googleAuth1 = $row["google_auth"];
     }}
     
     $secret1 =$googleAuth1;
     echo $secret1;

     echo "<br>";
     echo "Scan QR code using google authenticator <br>";
       echo '<img src="'.Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $email , $secret1,'TP AMC SHOP').'"><br>';
       echo '
       <form  class="loginform" method="post"> 
       <label >Code:</label><input type="text" id="code" name="code1"><br>
       <input type="submit" class="loginbtn" name="submit2"><br>
       </form>
       ';
     //check if code is true 
       if (isset($_POST['submit2'])){
       $code= $_POST['code1'];
       if ($g->checkCode($secret1, $code1)) {
            header("Location:http://localhost/SWAPproject/webpage/logged_in.php");
          exit;
         } 
       else {
            echo '<script>alert("You have typed in the wrong OTP")</script>';
        }
      
      
  }

  }
  else{

    $secret2= $googleAuth;
    echo "<br>";  
   
      echo '
      <form  class="loginform" method="post"> 
      <label>Code:</label><input type="text" name="code2"><br>
      <input type="submit" class="loginbtn" name="submit3"><br>
      </form>
      ';
      //check if code is true
      if (isset($_POST['submit3'])){
        $code2= $_POST['code2'];

        if ($g->checkCode($secret2, $code2)) {
            header("Location:http://localhost/SWAPproject/webpage/logged_in.php");
            exit;
        } 
        else {
          echo '<script>alert("You have typed in the wrong OTP")</script>';
        } 
  }
}
 include "footer.php";
?>



