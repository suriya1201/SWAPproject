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
        <header>
            <a class="logo" href="https://www.tp.edu.sg/home.html"><img src="images/tplogo.png" alt="logo" width="60px" height="60px"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="Homepage.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <?php

                    if (isset($_SESSION["Username"]) && isset($_SESSION["Role"]) && $_SESSION["Role"] == "p_admin") {
                        echo("<li><a href=create_product_form.php>Go back to adding page</a></li>");
                    }
                    else if (isset($_SESSION["Username"]) && isset($_SESSION['Role'])){
                        echo("<li><a href=rewardspage.php>Rewards</a></li>");
                        echo("<li><a href=Profile_page.php>Profile</a></li>");
                        echo("<li><a href=cartpage.php>Shopping Cart</a></li>");
                        echo("<li><a class=cta href=logout.php>Logout</a><li>");
                    } else {
                        echo("<li><a class=cta href=Loginpage.php>Login</a></li>");
                    }
                    ?>
                </ul>
            </nav>
        </header>
    <div class="row">
   
</body>
</html>