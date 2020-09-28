<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php print_r($_SESSION); ?>
    <?php
        echo "<h2>Items Purchased:</h2>";
        foreach ($_SESSION as $key => $value) {
                echo $key;
	    }
        echo "<h2>Shipping Address:</h2>";
        echo $_POST['address'];
    ?>
</body>
</html>