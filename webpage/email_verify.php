<?php 

include "db_connection.php";

if (isset($_POST["verify_email"])) {

    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];

    $stmt = $con->prepare("UPDATE user SET Verified_date=NOW() WHERE Email=? AND Otp=?");
    $stmt->bind_param('ss', $email, $verification_code);
    $result = $stmt->execute();
    $result = $stmt->store_result();

    if($result->num_rows == 0) {
        echo "Verification code failed.";
    }
    header("Location: Loginpage.php");
    exit();

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
        <?php include "navbar.php"?> 

        <form method="post">
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <div>
                <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" required>
                <input type="text" placeholder="Enter verification code" name="verification_code" required>
                </div>
                
                <hr>
                <button type="submit" name="verify_email">Verify Email</button>
            </div>

        </form>

    </body>

</html>