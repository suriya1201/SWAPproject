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
    </head>
    <body>
        <?php include "navbar.php" ?>
   <div class="column"><div padding=10px>item 1</div>
       
       <img src="images/tplogo.jpg" alt="Snow" style="width:60%">
    </div>
    <div class="column"> <div padding=10px>item 2</div>
        <img src="images/tplogo.jpg" alt="Forest" style="width:60%">
   </div>
       <div class="column"><div padding=10px>item 3</div>
      <img src="images/tplogo.jpg" alt="Mountains" style="width:60%">
     </div>
     </div>
    </body>


    <footerss>
    Copyright &copy; Temasek Polytechnic
    </footer>
</html>