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
        <a href="index.php">Continue Browsing</a>
    </header>
    <main>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <?php 
        
        if (empty($_POST)) {
	        echo "Cart is currently empty. <a href='index.php'>Browse Items</a>";
        }
        else {
	        foreach ($_POST as $key => $value) {
                $_SESSION[$key] = $value;
                echo $key;
                echo "<input type='submit' name='$key' value='Delete'><br>"; //need to delete variable from session
	        }
        }
        ?>
        </form>
        <a href="checkout.php">Proceed to Checkout</a>
        <?php
        print_r($_POST);
        ?>
    </main>
</body>
</html>