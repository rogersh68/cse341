<?php 
// connect to the database
include 'common/connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Create Account</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Create Account</h1>
        <form class="create_account_form" action="login.php" method="post">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname">

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname">

            <label for="email">Email</label>
            <input type="email" name="email">

            <label for="password">Password</label>
            <input type="password" name="password">

            <label for="creator">Are you signing up as a Creator?</label>
            <input type="radio" id="yes" name="creator" value="true">
            <label class="sbs" for="yes">Yes</label>
            <input type="radio" id="no" name="creator" value="false">
            <label class ="sbs" for="no">No</label>

            <label class="new_creator_desc" for="desc">Tell us about yourself and what you create</label>
            <textarea class="new_creator_desc" name="desc"></textarea>

            <label for="img">Profile Picture</label>
            <input type="image" name="img">

            <input class="proceed_btn" type="submit" value="Create Account">
        </form>   
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>