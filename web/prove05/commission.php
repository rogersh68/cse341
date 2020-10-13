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
            <?php 
            //get creators and their user info from db


            //populate select list with creators
            echo "<select name='creator' id='creatorList'>";
            echo "<option>Select</option>";
            foreach ($db->query('SELECT c.creatorid, u.name FROM creator AS c JOIN public.user AS u ON c.userid = u.userid') as $row) {
                echo "<option value='".$row['creatorId']."'>".$row['name']."</option>";
            }
            echo "</select>"
            ?>
        </form>

    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>