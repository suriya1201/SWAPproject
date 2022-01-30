<?php
include "session_regen.php";
require 'vendor/autoload.php';
include "db_connection.php";

$userid = $_SESSION['ID'];
$g =new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
include "navbar2.php";


//sql prepared statement 

$query = $con->prepare("SELECT google_auth FROM user WHERE ID = ?");
$query->bind_param('i', $_SESSION['ID']);
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $googleAuth = $row["google_auth"];
}}

if(!isset($googleAuth) || $googleAuth == ""){
    
     
     $secret = $g->generateSecret();
  
    
     echo "<br>";
     echo "Scan QR code using google authenticator <br>";
       echo '<img src="'.Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $userid , $secret,'TP AMC SHOP').'"><br>';
       echo '
       <form  class="loginform" method="post"> 
       <label >Code:</label><input type="text" id="code" name="code1"><br>
       <input type="submit" class="loginbtn" name="submit2"><br>
       </form>
       ';
     //check if code is true 
     if (isset($_POST['submit2'])){
      $code= $_POST['code1'];
      if ($g->checkCode($secret, $code)) {
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
    echo '<img src="'.Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $userid , $secret2,'TP AMC SHOP').'"><br>';
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



