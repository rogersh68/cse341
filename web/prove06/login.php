<?php 
//start session
session_start();

// connect to the database
include 'common/connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Login</h1> 
        <?php 
            echo "PRE-FORM --->";
            echo "SESSION: ";
            print_r($_SESSION);
            echo "POST: ";
            print_r($_POST);
            echo "GET: ";
            print_r($_GET);
        ?>
        <div class="login_div">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <label for="email">Email</label>
                <input type="email" required name="email">
                
                <label for="password">Password</label>
                <input type="password" required name="password">

                <?php
                if(isset($_SESSION['login_message'])){
                    echo "<p class='general_notice'>".$_SESSION['login_message']."</p>";
                }
                ?>

                <input class="proceed_btn" type="submit" value="Login">
            </form> 

            <?php
            // log the user in
            if(isset($_POST['email'])) {
                // set destination variables
                $retry = "Location: login.php?page=".$_GET['page'];
                $redirect = "Location: ".$_GET['page'].".php";

                echo $retry;
                echo $redirect;

                // set login credential variables
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

                echo $email;
                echo $password;

                // get credentials from db
                try{
                    $stmt = $db->prepare('SELECT * FROM public.user WHERE useremail=:email');
                    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                    $stmt->execute();
                    $userInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                catch(Exception $e) {
                    $_SESSION['login_message'] = "No account with that email. Please try again.";
                    header($retry);
                }               

                //send user back to login if passwords don't match
                if($password != $userInfo[0]['userpassword']) {
                    $_SESSION['login_message'] = "Incorrect password. Please try again.";
                    header($retry);
                }
                else {
                    // log the user in
                    $_SESSION['logged_in'] = TRUE;
                    $_SESSION['user_info']['userid'] = $userInfo[0]['userid'];
                    $_SESSION['user_info']['useremail'] = $userInfo[0]['useremail'];
                    header($redirect);
                } 
            }
            else {
                $_SESSION['login_message'] = "Email is required.";
                header($retry);
            }

            echo "POST-FORM --->";
    echo "SESSION: ";
    print_r($_SESSION);
    echo "POST: ";
    print_r($_POST);
    echo "GET: ";
    print_r($_GET);

            ?>

            <p class="center_p">or</p>
            <a class="proceed_link" title="create account" href="create-account.php">Create Account</a>
        </div>
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>