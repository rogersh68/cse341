<?php 
// start session
session_start();

// redirect to login page if user is not logged in
if(!$_SESSION['logged_in'] or empty($_SESSION['logged_in'])) {
    $_SESSION['page'] = "account";
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
    <title>Christina's Creations | Account</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>My Account</h1>
        <?php 
        //insert any new commissions into database
        if(isset($_POST['creator']) and isset($_POST['commDesc'])) {
            $stmt = $db->prepare('INSERT INTO commission (commdesc, accepted, creatorid, userid) 
                                    VALUES (:commdesc, :accepted, :creatorid, :userid)');
            $stmt->bindValue(':commdesc', $_POST['commDesc'], PDO::PARAM_STR);
            $stmt->bindValue(':accepted', false);
            $stmt->bindValue(':creatorid', $_POST['creator'], PDO::PARAM_INT);
            $stmt->bindValue(':userid', $_SESSION['user_info']['userid'], PDO::PARAM_INT);
            $stmt->execute();
        }

        // get user's info
        $stmt = $db->prepare('SELECT * FROM public.user WHERE userid=:userid');
        $stmt->bindValue(':userid', $_SESSION['user_info']['userid'], PDO::PARAM_INT);
        $stmt->execute();
        $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //if user is a creator display creator information
        if($userInfo[0]['creator']) {
            //display list of creations
            $stmt = $db->prepare('SELECT * FROM inventory WHERE creatorid=:creatorid');
            $stmt->bindValue(':creatorid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2 class='subtitle'>Your Creations</h2>";
            foreach ($rows as $row) {
                echo "<div class='account_items_row'>";
                echo "<img src='".$row['invimg']."' alt='".$row['invname']."'>";
                echo "<div><h3>".$row['invname']."</h3>";
                echo "<p>".$row['invdesc']."</p></div>";
                if (isset($row['userid'])){
                    echo "<p class='green_notice'>Sold</p>";
                }
                else {
                    echo "<form action='edit.php' method='post'>";
                    echo "<input type='hidden' name='invid' value='".$row['invid']."'>";
                    echo "<input class='proceed_btn' type='submit' value='Edit'></form>";
                }
                echo "</div>";
            }

            //display list of commissions
            $stmt = $db->prepare('SELECT c.commDesc, c.accepted, u.firstname, u.lastname, u.useremail FROM commission AS c JOIN public.user AS u ON c.userid = u.userid WHERE c.creatorid = :creatorid');
            $stmt->bindValue(':creatorid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<hr><h2 class='subtitle'>Your Commissions</h2>";
            foreach ($rows as $row){
                echo "<div class='account_comm_row'>";
                echo "<p>".$row['commdesc']."</p>";
                echo "<p>Requested by: ".$row['firstname']." ".$row['lastname']." <a href='mailto:'>".$row['useremail']."</a></p>";
                if ($row['accepted']) {
                    echo "<p class='yellow_notice'>Accepted</p>";
                }
                else {
                    echo "<form>";
                    echo "<input class='proceed_btn' type='submit' value='Accept'>";
                    echo "</form>";
                }
                echo "</div>";
            }
        }
        
        //display user info if they are not a creator
        else {
            //display list of purchases
            $stmt = $db->prepare('SELECT invname, invimg, invdesc FROM inventory WHERE userid=:userid');
            $stmt->bindValue(':userid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2 class='subtitle'>Your Purchases</h2>";
            foreach($rows as $row){
                echo "<div class='account_items_row'</div>";
                echo "<img src='".$row['invimg']."' alt='".$row['invname']."'>";
                echo "<div><h3>".$row['invname']."</h3>";
                echo "<p>".$row['invdesc']."</p></div>";
                echo "<p></p></div>";
            }
            
            //display list of commissions
            $stmt = $db->prepare('SELECT c.commDesc, c.accepted, u.firstname, u.lastname 
                FROM commission AS c 
                JOIN public.user AS u ON c.creatorid=u.userid 
                WHERE c.userid = :userid');
            $stmt->bindValue(':userid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<hr><h2 class='subtitle'>Your Requested Commissions</h2>";
            foreach($rows as $row) {
                echo "<div class='account_comm_row'>";
                echo "<p>".$row['commdesc']."</p>";
                echo "<p>Request sent to: ".$row['firstname']." ".$row['lastname']."</p>";
                if ($row['accepted']) {
                    echo "<p class='green_notice'>Accepted</p>";
                }
                else {
                    echo "<p class='yellow_notice'>Pending</p>";
                }
                echo "</div>";
            }
        }

        
        ?>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>