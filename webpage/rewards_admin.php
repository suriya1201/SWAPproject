<?php
include "db_connection.php";
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:500&display=swap" rel="stylesheet">
        <style>
	    .center {
	        text-align: center;
	    }
	</style>
    </head>
    <body>
        <?php include "navbar.php" ?>
        <div class="row">

        <?php
        $query=$con->prepare("SELECT ID, reward_item, reward_points FROM `reward_types`");
        $query->execute();
        $query->bind_result($id, $reward_item, $reward_points);
        echo "<table align='center' border='1'><tr>";
        echo "<th>Id</th><th>Rewards</th><th>Points</th>";
        while($query->fetch())
        {
            echo "<tr><td>".$id."</td>";
            echo "<td>".$reward_item."</td>";
            echo "<td>".$reward_points."</td>";
            echo "<td><a href='editrewards.php?id=".$id."'>edit</a></td>";
            echo "<td><a href='deleterewards.php?id=".$id."'>delete</a></td></tr>";
        }
        echo "</table>";
        ?>
        <div class="column"><div padding=10px><a class="r1" href="http://localhost/SWAPproject/webpage/createrewards_form.php">Create Rewards</a></div>
    </body>

    <?php include 'footer.php' ?>

</html>