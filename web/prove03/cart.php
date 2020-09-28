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
        <?php 
        if (empty($_POST)) {
	        echo "Cart is currently empty. <a href='index.php'>Browse Items</a>";
        }
        else {
	        foreach ($_POST as $key => $value) {
                echo $key;
                echo "<a href='cart.php'>Delete</a><br>";
	        }
        }
        ?>
        <a href="checkout.php">Proceed to Checkout</a>
    </main>
</body>
</html>