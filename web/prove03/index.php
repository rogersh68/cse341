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
    <?php print_r($_SESSION)?>
        <form action="items.php" method="post">
            <label for="item_1">Item 1</label>
            <input type='submit' name='item_1' id="item_1" value="Add to Cart">            
        </form>
        <form action="items.php" method="post">
            <label for="item_2">Item 2</label>
            <input type='submit' name='item_2' id="item_2" value="Add to Cart">            
        </form>

        <a href="cart.php">View Cart</a>
        <a class="submit" href="checkout.php">Proceed to Checkout</a>
    </main>
</body>
</html>