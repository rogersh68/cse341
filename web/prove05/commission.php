<?php 
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
        <h1>Commission</h1>
        <form action="account.php" method="post">
            <label for="creator">Who would you like to commission?</label>
            <?php 
            //populate select list with creators
            echo "<select name='creator' id='creatorList'>";
            echo "<option>Select</option>";
            foreach ($db->query('SELECT userid, firstname, lastname FROM public.user WHERE creator = TRUE') as $row) {
                echo "<option value='".$row['userid']."'>".$row['firstname']." ".$row['lastname']."</option>";
            }
            echo "</select>"
            ?>

            <label for="commDesc">What would you like to commission?</label>
            <textarea name="commDesc"></textarea>

            <p>Please note that whoever you choose must accept the commission.</p>
            <input type="submit" value="Send Request">
        </form>

        <h2>Get to know our creators</h2>

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

    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>