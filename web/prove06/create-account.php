<?php 
//start session
session_start();

// connect to the database
include 'common/connection.php'; 

// add new creator to database
function addCreator($db, $firstName, $lastName, $userImg, 
$userEmail, $userPassword, $creatorDesc) {
    $stmt = $db->prepare('INSERT INTO public.user (firstname, lastname, userimg, useremail, userpassword, creator, creatordesc)
    VALUES (:firstname, :lastname, :userimg, :useremail, :userpassword, :creator, :creatordesc)');
    $stmt->bindValue(':firstname', $firstName, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastName, PDO::PARAM_STR);
    $stmt->bindValue(':userimg', $userImg, PDO::PARAM_STR);
    $stmt->bindValue(':useremail', $userEmail, PDO::PARAM_STR);
    $stmt->bindValue(':userpassword', $userPassword, PDO::PARAM_STR);
    $stmt->bindValue(':creator', TRUE, PDO::PARAM_BOOL);
    $stmt->bindValue(':creatordesc', $creatorDesc, PDO::PARAM_STR);
    $stmt->execute();

    //redirect to login page
    $_SESSION['login_message'] = "Your account was created, please sign in.";
    header('Location: login.php');
}

// add new user to database
function addUser($db, $firstName, $lastName, $userImg, 
$userEmail, $userPassword){
    $stmt = $db->prepare('INSERT INTO public.user (firstname, lastname, userimg, useremail, userpassword, creator)
    VALUES (:firstname, :lastname, :userimg, :useremail, :userpassword, :creator)');
    $stmt->bindValue(':firstname', $firstName, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastName, PDO::PARAM_STR);
    $stmt->bindValue(':userimg', $userImg, PDO::PARAM_STR);
    $stmt->bindValue(':useremail', $userEmail, PDO::PARAM_STR);
    $stmt->bindValue(':userpassword', $userPassword, PDO::PARAM_STR);
    $stmt->bindValue(':creator', FALSE, PDO::PARAM_BOOL);
    $stmt->execute();
    
    //redirect to login page
    $_SESSION['login_message'] = "Your account was created, please sign in.";
    header('Location: login.php');
}

// if post is set, call appropriate functions to add user to db
if(!empty($_POST)) {
    print_r($_POST);

    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $userImg = $_POST['img'];
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];
    
    // check if creator option was selected
    if($_POST['creator'] == "t") {
        $creatorDesc = $_POST['desc'];
        addCreator($db, $firstName, $lastName, $userImg, 
            $userEmail, $userPassword, $creatorDesc);
    }
    else {
        addUser($db, $firstName, $lastName, $userImg, 
        $userEmail, $userPassword);
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Create Account</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="scripts/create-account.js"></script>
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Create Account</h1>
        <form class="create_account_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname">

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname">

            <label for="email">Email</label>
            <input type="email" name="email">

            <label for="password">Password</label>
            <input type="password" name="password">

            <label for="creator">Are you signing up as a Creator?</label>
            <input type="radio" id="yes" name="creator" value="t" onchange="toggleDesc()">
            <label class="sbs" for="yes">Yes</label>
            <br>
            <input type="radio" id="no" name="creator" value="f">
            <label class ="sbs" for="no">No</label>

            <div id="desc_div">
            <label class="new_creator_desc" for="desc">Tell us about yourself and what you create</label>
            <textarea class="new_creator_desc" name="desc"></textarea>
            </div>

            <label for="img">Profile Picture</label>
            <input type="text" name="img">

            <input class="proceed_btn" type="submit" value="Create Account">
        </form>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>