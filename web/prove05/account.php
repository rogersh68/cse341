<?php 
// start session
session_start();

// check if attempted login
if(isset($_POST['email'])) {
    
    // connect to the database
    include 'common/connection.php'; 
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT userid, password FROM public.user WHERE email=:email');
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //send user back to login if passwords don't match
    if($password != $userInfo[0]['password']) {
        $_SESSION['login_message'] = "Incorrect password";
        header('Location: login.php');
    }
    else {
        // log the user in
        $_SESSION['loggedin'] = TRUE;
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
        echo "Logged in --> ".$_SESSION['loggedin'];
        echo "User info -->";
        print_r($userInfo);
        try {
            $stmt = $db->prepare('SELECT creatorid FROM creator WHERE userid=:userid');
            $stmt->bindValue(':userid', $userInfo[0]['userid'], PDO::PARAM_INT);
            $stmt->execute();
            $creatorId = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $creator = true;
            print_r($creatorId);
            echo "Creator (try) --> ".$creator;
        }
        catch(Exception $e) {
            $creator = false;
            echo $e;
            echo "Creator (catch) --> ".$creator;
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