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
       if (isset($_SESSION['items'])){
              //print_r($_SESSION['items']);
              foreach ($_SESSION['items'] as $item) {
                    echo "<form action='items.php' method='post'>";
                    echo "<p>$item</p>";
                    echo "<input type='hidden' name='delete' value='".$item."'>"
                    echo "<input type='submit' value='Delete'>";
                    //
                    echo"</form>";
              }
              /*foreach ($_SESSION['items'] as $item) {
                    echo $item;
                    echo "<form action='items.php' method='post'>";
                    echo "<input type='submit' value='Delete'>";
                    echo "<input type='hidden' name='delete' value='$item'>"
                    echo "</form>";
              }*/
       }
       else {
              echo "<p>Your Cart is currently empty.</p>";
       }
       
        ?>
        <a href="index.php">Continue Browsing</a>
        <a class="submit" href="checkout.php">Proceed to Checkout</a>
    </main>
</body>
</html>