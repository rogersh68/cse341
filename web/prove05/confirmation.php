<?php 
// connect to the database
include 'common/connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Confirmation</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Confirmation</h1> 
        <?php 
        //get and display purchase summary for item
        try {
            // get item id from form
            $inventoryId = $_POST['item'];

            // query database for item
            $stmt = $db->prepare('SELECT inventoryname FROM inventory WHERE inventoryid=:id');
            $stmt->bindValue(':id', $inventoryId, PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // add userId to row in database

            // display item summary
            echo "<h2>Summary</h2>";
            echo "<p>".$itemInfo[0]['inventoryname']."will be shipped to:</p>";
            echo "<p>".$_POST['address']."</p>";
        }
        catch (Exception $e) {
            echo "Something went wrong. Please try again.";
        }
        ?>  
        <a title="browse" href="./">Continue Browsing</a>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>