<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Browse Our Selection</h1>
    </header>
    <main>
        <form action="items.php" method="post">
            <label for="Item 1">Item 1</label>
            <input type='submit' class='action-browse' name='Item 1' value="Add to Cart">            
        </form>
        <form action="items.php" method="post">
            <label for="Item 2">Item 2</label>
            <input type='submit' class='action-browse' name='Item 2' id="item_2" value="Add to Cart">            
        </form>
        <form action="items.php" method="post">
            <label for="Item 3">Item 3</label>
            <input type='submit' class='action-browse' name='Item 3' id="item_3" value="Add to Cart">            
        </form>
        <form action="items.php" method="post">
            <label for="Item 4">Item 4</label>
            <input type='submit' class='action-browse' name='Item 4' id="item_4" value="Add to Cart">            
        </form>

        <a class='proceed' href="cart.php">View Cart</a>
    </main>
</body>
</html>