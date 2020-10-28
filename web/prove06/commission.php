<?php 
//start session
session_start();

// redirect to login page if user is not logged in
if(!$_SESSION['logged_in'] or empty($_SESSION['logged_in'])) {
    $_SESSION['page'] = "commission";
    header('Location: login.php');
}

// connect to the database
include 'common/connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Commission</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Commissions</h1>
        <div class="commissions_div">
            <form action="account.php" method="post">
                <label for="creator">Who would you like to commission?</label>
                <?php 
                //populate select list with creators
                echo "<select name='creator' id='creatorList'>";
                echo "<option disabled selected>Select</option>";
                foreach ($db->query('SELECT userid, firstname, lastname FROM public.user WHERE creator = TRUE') as $row) {
                    echo "<option value='".$row['userid']."'>".$row['firstname']." ".$row['lastname']."</option>";
                }
                echo "</select>"
                ?>

                <label for="commDesc">Describe what you want commissioned</label>
                <textarea name="commDesc"></textarea>

                <p class="general_notice">Please note your request <br>must be accepted.</p>
                <input class="proceed_btn" type="submit" value="Send Request">
            </form>

            <div class="comm_creators_container">
                <h2 class="subtitle">Get to Know Our Creators</h2>

                <div class="creators_div">
                    <?php
                    foreach ($db->query('SELECT firstname, lastname, userimg, creatordesc FROM public.user WHERE creator = TRUE') as $row) {
                        echo "<div class='creator_desc'>";
                        echo "<img src='".$row['userimg']."' alt='creator'>";
                        echo "<h3>".$row['firstname']." ".$row['lastname']."</h3>";
                        echo "<p>".$row['creatordesc']."</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>

    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>