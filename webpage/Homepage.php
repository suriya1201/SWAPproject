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
    <?php include 'navbar.php' ?>
    <?php include 'db_connection.php' ?>
    <?php
        $con = mysqli_connect("localhost","root","","tp_amc");

        $sql = "SELECT * from products";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result)>0){
            while($fetch = mysqli_fetch_assoc($result))
            {
                ?>

        <div class="column">
                    <div class="row">
                        <img src ="images/<?php echo $fetch['Image']; ?>" width=350 height=350>
                    </div>
                    <div class="row">
                        <h4><?php echo $fetch['Product_Name'] ?></h4>
                        <button onclick="window.location.href='create_purchase.php'">Add to cart</button>
                        
                    </div>
        </div>
                
                <?php
            }
        }
     ?>
</body>

</html>