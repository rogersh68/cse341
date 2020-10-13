<?php 
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
            
            // get id from form
            $inventoryId = $_POST['item'];
            
            // query database for the item
            $stmt = $db->prepare('SELECT * FROM inventory WHERE inventoryid=:id');
            $stmt->bindValue(':id', $inventoryId, PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            //display the item
            echo "<div class='item_overview'>";
            echo "<img src='".$itemInfo[0]['inventoryimg']."' alt='".$itemInfo[0]['inventoryname']."'>";
            echo "<div><h2>".$itemInfo[0]['inventoryname']."</h2>";
            echo "<p>".$itemInfo[0]['inventorydesc']."</p></div></div>";

            // check if item is under a userid already
            if (isset($itemInfo[0]['userid'])) {
                echo "Sorry, this item is currently unavailable.";
                echo "<a href='./'>Continue Browsing</a>";
            }
            else {
                //display confirmation form
                echo "<form action = 'confirmation.php' method='post'";
                echo "<label>Address</label>";
                echo "<input type='text' name='address'>";
                echo "<input type='submit' value='Complete Purchase'>";
                echo "<input type='hidden' name='item' value='".$inventoryId."'></form>";
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