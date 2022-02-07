<?php
include "session_regen.php";
require 'vendor/autoload.php';
include "db_connection.php";

include "navbar2.php";

$userid = $_GET['ID'];
$email = $_GET['email'];
$g =new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
$secret = $g->generateSecret();



//sql prepared statement  to check if user has google_auth code alr 

$query = $con->prepare("SELECT google_auth FROM user WHERE ID = ?");
$query->bind_param('i', $userid);
$query->execute();
$result = $query->get_result();
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
    $googleAuth = $row["google_auth"];
}}

if( !isset($googleAuth) || $googleAuth == ""){
    
     
     

     $query = $con->prepare("UPDATE tp_amc.user SET google_auth = ? WHERE ID = ?");
     $query->bind_param('si', $secret , $userid);
     $query->execute();

     $Query= $con->prepare("SELECT Username,Email,Address,Phone_Number,User_type,google_auth FROM user WHERE ID = ?");
     $Query->bind_param('i', $userid);
     $Query->execute();
     $result = $Query->get_result();
    if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $googleAuth1 = $row["google_auth"];
     }}
     
     $secret1 =$googleAuth1;

     echo '<br><body class="loginbdy">';
     echo "Scan QR code using google authenticator (download from APP STORE or Playstore)<br></br><br></br>";
       echo '<img src="'.Sonata\GoogleAuthenticator\GoogleQrUrl::generate( $email , $secret1,'TP AMC SHOP').'"><br></br>';
       echo '
      
       <form  class="loginform" method="post"> 
       <div class="containerLogin">
       <label >Code:</label><input type="text" id="code" name="code1"><br>
       <input type="submit" class="loginbtn" name="submit2"><br>
       </form>
       </div>
       </body>
       ';
     //check if code is true 
    if (isset($_POST['submit2'])){
       $code1= $_POST['code1'];
       if ($g->checkCode($secret1, $code1)) {
        $_SESSION['Username'] = $row['Username'];
        $_SESSION['Role'] = $row['User_type'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['Email'] = $row['Email'];
        $_SESSION['timeout'] = time();

        $action = "login";
        $username =$_SESSION['Username'];
        
        $query = $con->prepare("INSERT INTO tp_amc.login_log (User_name,Action) VALUES (?,?)");
        $query->bind_param('ss', $username , $action );
        $query->execute();
            
        header("Location:https://localhost/SWAPproject/webpage/logged_in.php");
        exit;

      }
       else {
            echo '<script>alert("You have typed in the wrong OTP")</script>';
        }
       }
      
  }
  
  elseif(isset($googleAuth) || $googleAuth != ""){

    $secret2= $googleAuth;
    echo '<br><body class="loginbdy">';  
   
      echo '
      <form  class="loginform" method="post"> 
      <div class="containerLogin">
      <label>Input code from google authenticator app:</label><input type="text" name="code2"><br>
      <input type="submit" class="loginbtn" name="submit3"><br>
      </form>
      </div>
      </body>
      ';
      //check if code is true
      if (isset($_POST['submit3'])){
        $code2= $_POST['code2'];

        if ($g->checkCode($secret2, $code2)) {

          $Query= $con->prepare("SELECT Username,Email,Address,Phone_Number,User_type,google_auth FROM user WHERE ID = ?");
          $Query->bind_param('i', $userid);
          $Query->execute();
          $result = $Query->get_result();
          if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();

          $_SESSION['Username'] = $row['Username'];
          $_SESSION['Role'] = $row['User_type'];
          $_SESSION['ID'] = $row['ID'];
          $_SESSION['Email'] = $row['Email'];
          $_SESSION['timeout'] = time();

          $action = "login";
          $username =$_SESSION['Username'];
          
          $query = $con->prepare("INSERT INTO tp_amc.login_log (User_name,Action) VALUES (?,?)");
          $query->bind_param('ss', $username , $action );
          $query->execute();
              
          header("Location:https://localhost/SWAPproject/webpage/logged_in.php");
          
        }
        } 
        else {
          echo '<script>alert("You have typed in the wrong OTP")</script>';
        } 
      
  }
}

 include "footer.php";


?>



<script> //prevent form resubmission
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

</script>
