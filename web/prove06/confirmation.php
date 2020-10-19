<?php 
//start session
session_start();

// redirect to login page if user is not logged in
if(!$_SESSION['logged_in'] or empty($_SESSION['logged_in'])) {
    $_SESSION['page'] = "purchase";
    $_SESSION['item'] = $_POST['item'];
    header('Location: confirmation.php');
}

// connect to the database
include 'common/connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Confirmation</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Confirmation</h1> 
        <?php 
        //get and display purchase summary for item
        try {
            // get item id from form or session
            if(isset($_SESSION['item'])) {
                $invId = $_SESSION['item'];
            }
            else {
                $invId = $_POST['item'];
            }

            // add userid to row in database
            $stmt2 = $db->prepare('UPDATE inventory SET userid = :userid WHERE invid = :invid');
            $stmt2->bindValue(':userid', $_SESSION['user_info']['userid'], PDO::PARAM_INT);
            $stmt2->bindValue(':invid', $invId, PDO::PARAM_INT);
            //$stmt2->execute();
          
            // query database for item info
            $stmt = $db->prepare('SELECT invname FROM inventory WHERE invid=:invid');
            $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
            $stmt->execute();
            $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // display item summary
            echo "<h2 class='subtitle'>Summary</h2>";
            echo "<div class='confirmation_div'><p>Your <b>".$itemInfo[0]['invname']."</b> will be shipped to:</p>";
            echo "<p><b>".$_POST['address']."</b></p>";
            echo "<p>Thank you for your purchase.</p>";

            //clear session item variable
            unset($_SESSION['item']);
        }
        catch (Exception $e) {
            echo "<div class='confirmation_div'>Something went wrong. Please try again.";
        }
        ?>  
        <a class="proceed_link" title="browse" href="./">Continue Browsing</a></div>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>