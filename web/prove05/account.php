<?php 
// start session
session_start();

// check if attempted login
if(isset($_POST['email'])) {
    
    // connect to the database
    include 'common/connection.php'; 
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    /*** TODO: filter email ***/
    $stmt = $db->prepare('SELECT * FROM public.user WHERE useremail=:email');
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //send user back to login if passwords don't match
    if($password != $userInfo[0]['userpassword']) {
        $_SESSION['login_message'] = "Incorrect password. Please try again.";
        header('Location: login.php');
    }
    else {
        // log the user in
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['userid'] = $userInfo[0]['userid'];
    }
    
}

// redirect to login page if user is not logged in
if(!$_SESSION['loggedin']) {
    header('Location: login.php');
}
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
        // try to get creatorid with matching userid, if it can't find it user is not a creator
        /*try {
            $stmt = $db->prepare('SELECT creatorid FROM creator WHERE userid=:userid');
            $stmt->bindValue(':userid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $creatorId = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $creator = true;
        }
        catch(Exception $e) {
            $creator = false;
        }*/

        //if user is a creator display creator information
        if($userInfo[0]['creator']) {
            //display list of creations
            $stmt = $db->prepare('SELECT * FROM inventory WHERE creatorid=:creatorid');
            $stmt->bindValue(':creatorid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Your Creations</h2>";
            foreach ($rows as $row) {
                echo "<div class='account_items_row'>";
                echo "<img src='".$row['invimg']."' alt='".$row['invname']."'>";
                echo "<h2>".$row['invname']."</h2>";
                if (isset($row['userid'])){
                    echo "<p>Sold</p>";
                }
                else {
                    echo "<form action='edit.php' method='post'>";
                    echo "<input type='hidden' name='invid' value='".$row['invid']."'>";
                    echo "<input type='submit' value='Edit'></form>";
                }
                echo "</div>";
            }

            //display list of commissions
            $stmt = $db->prepare('SELECT c.commDesc, c.accepted, u.firstname, u.lastname, u.useremail FROM commission AS c JOIN public.user AS u ON c.userid = u.userid WHERE c.creatorid = :creatorid');
            $stmt->bindValue(':creatorid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Your Commissions</h2>";
            foreach ($rows as $row){
                echo "<div class='account_comm_row'>";
                echo "<p>".$row['commdesc']."</p>";
                echo "<p>Requested by: ".$row['firstname']." ".$row['lastname']." <a href='mailto:'>".$row['useremail']."</a></p>";
                if ($row['accepted']) {
                    echo "<p class='comm_accepted-p'>Commission Accepted</p>";
                }
                echo "</div>";
            }

            //display link for editing creations
            echo "<a title='edit creations' href='edit.php'>Edit Your Creations</a>";
        }
        
        //display user info if they are not a creator
        else {
            //display list of purchases
            $stmt = $db->prepare('SELECT invname, invimg FROM inventory WHERE userid=:userid');
            $stmt->bindValue(':userid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo "<h2>Your Purchases</h2>";
            foreach($rows as $row){
                echo "<div class='account_items_row'</div>";
                echo "<img src='".$row['invimg']."' alt='".$row['invname']."'>";
                echo "<h2>".$row['invname']."</h2>";
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

            echo "<h2>Your Requested Commissions</h2>";
            foreach($rows as $row) {
                echo "<div class='account_comm_row'>";
                echo "<p>".$row['commdesc']."</p>";
                echo "<p>Requested sent to: ".$row['firstname']." ".$row['lastname']."</p>";
                if ($row['accepted']) {
                    echo "<p class='comm_accepted-p'>Commission Accepted</p>";
                }
                else {
                    echo "<p>Pending</p>";
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