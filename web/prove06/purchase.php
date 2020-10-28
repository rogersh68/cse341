<?php 
//start session
session_start();

// redirect to login page if user is not logged in
if(!$_SESSION['logged_in'] or empty($_SESSION['logged_in'])) {
    $_SESSION['page'] = "purchase";
    $_SESSION['item'] = $_POST['item'];
    header('Location: login.php');
}

// connect to the database
include 'common/connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Purchase</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Purchase</h1>  

        <?php
        //get and display item being purchased
        try {
            // get item id from form or session
            if(isset($_SESSION['item'])) {
                $invId = $_SESSION['item'];
            }
            else {
                $invId = $_POST['item'];
            }
            
            // query database for the item
            $stmt = $db->prepare('SELECT * FROM inventory WHERE invid=:invid');
            $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //display the item
            echo "<div class='item_overview'>";
            echo "<img src='".$itemInfo[0]['invimg']."' alt='".$itemInfo[0]['invname']."'>";
            echo "<div><h2>".$itemInfo[0]['invname']."</h2>";
            echo "<p>".$itemInfo[0]['invdesc']."</p></div></div>";

            // check if item is under a userid already
            if (isset($itemInfo[0]['userid'])) {
                echo "Sorry, this item is currently unavailable.";
                echo "<a href='./'>Continue Browsing</a>";
            }
            else {
                //display confirmation form
                echo "<h2 class='subtitle'>Please fill out your information</h2>";
                echo "<form class='confirmation_form' action = 'confirmation.php' method='post'";
                echo "<label>Address</label>";
                echo "<input type='text' name='address'>";
                echo "<input class='proceed_btn' type='submit' value='Complete Purchase'>";
                echo "<input type='hidden' name='item' value='".$invId."'></form>";
            }
        }
        catch (Exception $e){
            echo "Something went wrong. Please try again.";
            echo "<br><a href='./'>Home</a>";
        }
        ?> 
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>