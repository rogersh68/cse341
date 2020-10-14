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
            $invId = $_POST['item'];
          
            // query database for item
            $stmt = $db->prepare('SELECT invname FROM inventory WHERE invid=:invid');
            $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            /*** TODO: add userid to row in database ***/ 

            // display item summary
            echo "<h2 class='subtitle'>Summary</h2>";
            echo "<div class='confirmation_div'><p>Your <b>".$itemInfo[0]['invname']."</b> will be shipped to:</p>";
            echo "<p><b>".$_POST['address']."</b></p>";
            echo "<p>Thank you for your purchase.</p>";
        }
        catch (Exception $e) {
            echo "<div class='confirmation_div'>Something went wrong. Please try again.";
        }
        ?>  
        <a title="browse" href="./">Continue Browsing</a></div>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>