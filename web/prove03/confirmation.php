<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
        echo "<h2>Items Purchased:</h2";
        foreach ($_POST as $item) {
		        if (isset($item)) {
			        echo $_POST[$item];
		        }
	    }
        echo "<h2>Shipping Address:</h2>";
        echo $_POST['address'];
    ?>
</body>
</html>