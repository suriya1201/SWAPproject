<?php
session_start();

if (!isset($_SESSION["Username"])){
    header("Location: Homepage.php");
}

?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="/w3css/3/w3.css">
    </head>
    <body>
        <?php include "navbar.php" ?>
        <?php include "retriveprofile.php" ?>

        <form>
            <div class="container">
                <h1>Profile</h1>

                <label for="username"><b>Username</b></label>
                <?php echo $username; ?>

                <label for="psw"><b>Password</b></label>
                <?php echo $password; ?>

                <label for="email"><b>Email</b></label>
                <?php echo $email; ?>

                <label for="address"><b>Address</b></label>
                <?php echo $address; ?>

                <label for="phone-num"><b>Phone Number</b></label>
                <?php echo $contact; ?>

                <hr>

            </div>
        </form>

    </body>
    <footer>
    Copyright &copy; Temasek Polytechnic
    </footer>
</html>