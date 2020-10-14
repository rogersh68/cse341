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
    <title>Christina's Creations | Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Login</h1> 
        <form action="account.php" method="post">
            <label for="email">Email</label>
            <input type="email" required name="email">
            
            <label for="password">Password</label>
            <input type="password" required name="password">

            <?php
            if(isset($_SESSION['login_message'])){
                echo "<p class='warning'>".$_SESSION['login_message']."</p>";
            }
            ?>

            <input type="submit" value="Login">
        </form> 
        <a title="create account" href="create-account.php">Create Account</a>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>