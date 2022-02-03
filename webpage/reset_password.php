<?php include "navbar.php" ?>

<h1>Reset your password here</h1>
<p>An email will be sent to you with instructions on how to reset your password</p>
<form action="reset-request.inc.php" method="POST">
    <input type="text" name="email" placeholder="Enter your email">
    <button type="submit" name="reset-request-submit">Receive new password by email</button>
</form>
<?php
if (isset($_GET["reset"])){ //if email is sent
    if ($_GET["reset"] == "success"){
        echo '<p class="signupsuccess">Check your email!</p>'; 
    }
}
?>