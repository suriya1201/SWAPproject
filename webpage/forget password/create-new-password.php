<?php include "navbar.php" ?>

<?php
  $selector = $_GET["selector"]; //get the selector variable
  $validator = $_GET["validator"]; //get the validator variable 

  if(empty($selector) || empty($validator)) { //if empty
      echo"We could not validate your request";
  } else {
      if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) { //checks whether the selector and validator are hexadecimals
        ?>

        <form action="reset-password.inc.php" method="POST">
            <input type="hidden" name="selector" value="<?php echo $selector?>">
            <input type="hidden" name="validator" value="<?php echo $validator?>">
            <input type="password" name="pwd" placeholder="Enter new password">
            <input type="password" name="pwd-repeat" placeholder="Repeat new password">
            <button type="submit" name="reset-password-submit">Reset password</button> 


        </form> 


        <?php
      }
  }
?>
