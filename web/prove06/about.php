<?php 
//start session
session_start();

// connect to the database
include 'common/connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | About</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>About Christina's Creations</h1>
        <div class="about_div">
            <p>Christina's Creations gives you the opportunity to donate or purchase crafts and other creations.<br> 
            The proceeds for any item purchased will be donated to charity.</p>
            <a class="proceed_link" href="./">Browse Items</a>
            <p class="center_p">or</p>
            <a class="proceed_link" href="account.php">Sign Up</a>   
        </div>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>