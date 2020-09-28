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

       foreach ($_POST as $key => $value) {
              $_SESSION[$key] = $value;
       }

       if (empty($_SESSION)) {
              echo "Cart is currently empty.";
       }

       else {
       echo "<form method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'>"
              foreach ($_SESSION as $key => $value) {
                    echo $key;
                    echo 
              }
       echo"</form>"
       }

        //session_unset();
        /*if (empty($_POST)) {
            echo "Cart is currently empty. <a href='index.php'>Browse Items</a>";
        }
        else {
            foreach ($_POST as $key => $value) {
                $_SESSION[$key] = $value;
                echo $key;
                echo "<a href='cart.php' id='$key' onclick='delete.php'>Delete</a><br>"; //need to delete variable from session
            }
        }*/
        ?>
        <a href="index.php">Continue Browsing</a>
        <a class="submit" href="checkout.php">Proceed to Checkout</a>
    </main>
</body>
</html>