<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <h1>Checkout</h1>
    </header>
    <?php print_r($_POST); ?>
    <form action="confirmation.php" method="post">
        Address:
        <input type=text name="address" required>
        <a href="cart.php">Return to cart</a>
        <input type=submit  value="Complete Purchase">
    </form>
</body>
</html>