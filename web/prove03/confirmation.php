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
    <header>
        <h1>Confirmation</h1>
    </header>
    <main>
        <?php
            echo "<h2>Items Purchased:</h2>";
            foreach ($_SESSION as $key => $value) {
                    $key2 = str_replace("_", " ", $key);
                    echo "<p>$key2</p>";
	        }
            echo "<h2>Shipping Address:</h2>";

            //filter
            $address = trim($_POST['address']);
            $address = filter_var($address, FILTER_SANITIZE_STRING);

            echo $address;
        ?>
    </main>
</body>
</html>