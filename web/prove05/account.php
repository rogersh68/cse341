<?php 
// start session
session_start();

// check if attempted login
if(isset($_POST['email'])) {
    echo "Logging in";
}

// redirect to login page if user is not logged in
if(!$_SESSION['loggedin']) {
    echo "NOT LOGGED IN";
    //header('Location: login.php');
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
        try {
            $stmt = $db->prepare('SELECT creatorid FROM creator WHERE userid=:userid');
            $stmt->bindValue(':email', $userInfo['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $creatorId = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $creator = true;
        }
        catch(Exception $e) {
            $creator = false;
        }

        //if userid is also on creator table display creator info
        if($creator) {
            echo "You are a creator";
            //display list of creations

            //display list of commissions

            //display link for editing creations
        }
        //display user info if they are not a creator
        else {
            echo "You are NOT a creator";
            //display list of purchases

            //display list of commissions

        }

        
        ?>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>