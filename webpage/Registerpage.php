<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Navbar</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <header>
            <a class="logo" href="/"><img src="images/tplogo.png" alt="logo" width="60px" height="60px"></a>
            <nav>
                <ul class="nav__links">
                    <li><a href="http://localhost/SWAPproject/Homepage.php">Home</a></li>
                </ul>
            </nav>
            <a class="cta" href="#">Login</a>
        </header>
        <form action="/registration.php" method="post">
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" id="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

                <label for="psw-confirm"><b>Confirm Password</b></label>
                <input type="password" placeholder="Confirm Password" name="psw-confirm" id="psw-confirm" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" id="email" required>

                <label for="address"><b>Address</b></label>
                <input type="text" placeholder="Enter Address" name="address" id="address" required>

                <label for="phone-num"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phone-num" id="phone-num" required>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <button type="submit" class="registerbtn">Register</button>
            </div>
            
            <div class="container signin">
                <p>Already have an account? <a href="#">Sign in</a>.</p>
            </div>
        </form>

    </body>


    <footer>
    Copyright &copy; Temasek Polytechnic
    </footer>
</html>