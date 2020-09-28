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
	        foreach ($_POST as $item) {
		        if (isset($item)) {
			        echo $_POST[$item];
                    echo "<a href='cart.php'>Delete</a><br>";
		        }
	        }
        }
        ?>
        <button  type="button" onclick="checkout.php">Proceed to Checkout</button>
    </main>
</body>
</html>