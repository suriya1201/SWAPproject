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
        <form action="registration.php" method="post">
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <div>
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" id="username" required>
                </div>

                <div>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
                </div>

                <div>
                <label for="psw-confirm"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="psw-confirm" id="psw-confirm" required>
                </div>

                <div>
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" id="email" required>
                </div>

                <div>
                <label for="address"><b>Address</b></label>
                <input type="text" placeholder="Enter Address" name="address" id="address" required>
                </div>

                <div>
                <label for="phone-num"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phone-num" id="phone-num" required>
                </div>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Policy</a>.</p>

                <button type="submit" class="registerbtn">Register</button>
            </div>
            
            <div class="container signin">
                <p>Already have an account? <a href="#">Sign in</a>.</p>
            </div>
        </form>

    </body>


    <?php include 'footer.php' ?>

</html>