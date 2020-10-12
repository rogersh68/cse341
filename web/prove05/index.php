<?php 
// connect to the database
//include $_SERVER['DOCUMENT_ROOT'].'common/connection.php'; 
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
    //include $_SERVER['DOCUMENT_ROOT'].'common/header.php'; 
    include 'common/header.php';
    ?>

    <main>
        <h1>Welcome</h1>

        <?php
        // display each inventory item
        /*foreach ($db->query('SELECT inventoryname, inventorydesc, inventoryimg FROM inventory') as $row)
        {
            echo "<div class='item_overview'>";
            echo "<img src='".$row['inventoryimg']."' alt='".$row['inventoryname']."'>";
            echo "<div><h2>".$row['inventoryname']."</h2>";
            echo "<p>".$row['inventorydesc']."</p>";
            echo "<a title='purchase' href='purchase.php' class='purchase_link'>Purchase</a></div></div>";
        }*/
        ?>

    <!-- Inventory Placeholder
        <div class="item_overview">
            <img src="images/placeholder.svg" alt="item name">
            <div>
                <h2>Item Name</h2>
                <p>Item description will go here.</p>
                <a title="purchase" href="purchase.php" class="purchase_link">Purchase</a>
            </div>
        </div>
    -->
   
    </main>

    <?php 
    // display the footer
    include $_SERVER['DOCUMENT_ROOT'].'common/footer.php'; 
    ?>
</body>
</html>