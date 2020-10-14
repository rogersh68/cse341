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
        <div class="edit_item">
            <?php
            // list info for item being edited
            $stmt = $db->prepare('SELECT * FROM inventory WHERE invid = :invid');
            $stmt->bindValue(':invid', $_POST['invid'], PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<img src='".$itemInfo['invimg']."' alt='".$itemInfo['invname']."'>";
            echo "<h2>".$itemInfo['invname']."</h2>";
            echo "<p>".$itemInfo['invdesc']."</p>";
            ?> 
        </div>
        
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>