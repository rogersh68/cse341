<?php 
session_start();

// connect to the database
include 'common/connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Edit Creations</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Edit Creation</h1>  
        <div class="edit_item_div">
            <?php
            // list info for item being edited
            $stmt = $db->prepare('SELECT * FROM inventory WHERE invid = :invid');
            $stmt->bindValue(':invid', $_POST['invid'], PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Image:</h2>";
            echo "<img src='".$itemInfo[0]['invimg']."' alt='".$itemInfo[0]['invname']."'>";
            echo "<h2>Name:</h2>";
            echo "<h3>".$itemInfo[0]['invname']."</h3>";
            echo "<h2>Description:</h2>";
            echo "<p>".$itemInfo[0]['invdesc']."</p>";
            ?> 
        </div>
        
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>