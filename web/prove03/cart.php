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
       if (isset($_SESSION)){
              foreach ($_SESSION as $key => $value) {
                    $key = str_replace("_", " ", $key);
                    echo "<form action='items.php' method='post'>";
                    echo "<label for='$key'>$key</label>";
                    echo "<input type='submit' class='action-delete' value='Delete'>";
                    echo "<input type='hidden' name='delete' value='$key'>";
                    echo"</form>";
              }
       }
       else {
              echo "<p>Your Cart is currently empty.</p>";
       }
       
        ?>
        <a class="return" href="index.php">Continue Browsing</a>
        <a class="proceed" href="checkout.php">Proceed to Checkout</a>
    </main>
</body>
</html>