<?php 
//start session
session_start();

// connect to the database
include 'common/connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Home</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Welcome</h1>

        <?php
        // display each inventory item
        foreach ($db->query('SELECT invid, invname, invdesc, invimg, inventory.userid, firstname, lastname FROM inventory JOIN public.user AS u ON inventory.creatorid = u.userid') as $row)
        {
            echo "<div class='item_overview'>";
            echo "<img src='".$row['invimg']."' alt='".$row['invname']."'>";
            echo "<div><h2>".$row['invname']."</h2>";
            echo "<p>".$row['invdesc']."</p>";
            echo "<p>Created by: ".$row['firstname']." ".$row['lastname']."</p>";
            if (isset($row['userid'])) {
                echo "<p>SOLD</p>";
            }
            else {
                echo "<form action='purchase.php' method='post'>";
                echo "<input type='submit' class='purchase_btn' value='Purchase'>";
                echo "<input type='hidden' name='item' value='".$row['invid']."'></form></div></div>";
            }
            
        }
        ?>
   
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>