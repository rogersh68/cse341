<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Your Cart</h1>
    </header>
    <main>
       <?php 

       print_r($_SESSION);
       if (empty($_SESSION)) {
              echo "Cart is currently empty.";
       }

       else {
               foreach ($_SESSION as $key => $value) {
                    echo $key;
                    echo "<form action='items.php' method='post'>";
                    echo "<input type='submit' value='Delete'>";
                    echo "<input type='hidden' name='delete' value='$key'>"
                    echo "</form>";
                }
       }

        ?>
        <a href="index.php">Continue Browsing</a>
        <a class="submit" href="checkout.php">Proceed to Checkout</a>
    </main>
</body>
</html>