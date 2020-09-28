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
        <form action="cart.php" method="post">
            <input type='checkbox' name="item_1" <?php if (isset($_SESSION['item_1'])) echo "checked" ?>>Item 1<br>
            <input type='checkbox' name="item_2" <?php if (isset($_SESSION['item_2'])) echo "checked" ?>>Item 2<br>
            <input type='checkbox' name="item_3" <?php if (isset($_SESSION['item_3'])) echo "checked" ?>>Item 3<br>
            <input type='checkbox' name="item_4" <?php if (isset($_SESSION['item_4'])) echo "checked" ?>>Item 4<br>
            <input type='submit' class="submit" value="View Cart">
        </form>
    </main>
</body>
</html>