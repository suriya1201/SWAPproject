<?php


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
        <?php include "retrieveprofile.php" ?>

        <form action="updateprofile.php" method="post">
            <div class="container">
                <h1>Profile</h1>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" value="<?php echo $username; ?>" name="username" id="username" required>

                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" value="<?php echo $email; ?>" name="email" id="email" required>

                <label for="address"><b>Address</b></label>
                <input type="text" placeholder="Enter Address" value="<?php echo $address; ?>" name="address" id="address" required>

                <label for="phone-num"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" value="<?php echo $contact; ?>" name="phone-num" id="phone-num" required>
                <hr>

                <button type="submit" class="registerbtn">Update</button>
            </div>
        </form>

    </body>
    <footer>
    Copyright &copy; Temasek Polytechnic
    </footer>
</html>