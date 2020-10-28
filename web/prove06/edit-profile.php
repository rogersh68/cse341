<?php 
session_start();

// connect to the database
require 'common/connection.php'; 

// get upload function
require 'common/upload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Edit Profile</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Edit Profile</h1>  
        <div class="edit_item_div">
            <div>
                <h2>Your Current Information</h2>
                <?php
                // list info for user being edited
                $stmt = $db->prepare('SELECT * FROM public.user WHERE userid = :userid');
                $stmt->bindValue(':userid', $SESSION['user_info']['userid'], PDO::PARAM_INT);
                $stmt->execute();
                $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                echo "<h3>Image:</h3>";
                echo "<img src='".$userInfo['userimg']."' alt='".$userInfo['firstname']." ".$userInfo['lastname']."'>";
                echo "<h3>Name:</h3>";
                echo "<p>".$userInfo['firstname']." ".$userInfo['lastname']."</p>";
                echo "<h3>Email:</h3>";
                echo "<p>".$userInfo['useremail']."</p>";

                if($userInfo['creator']) {
                    echo "<h3>Description:</h3>";
                    echo "<p>".$userInfo['creatordesc']."</p>";
                }
                ?>
            </div>
            <div>
                <!--Update item info form -->
                <form class="update_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <label for="firstname">First Name</label>
                    <input type="text" name="firstname" value="<?php echo $userInfo['firstname'];?>">

                    <label for="lastname">Last Name</label>
                    <input type="text" name="lastname" value="<?php echo $userInfo['lastname'];?>">

                    <label for="useremail">Email</label>
                    <input type="email" name="useremail" value="<?php echo $userInfo['useremail'];?>">

                    <label for="imgfile">Profile Picture</label>
                    <input type="file" name="imgfile" value="<?php echo $userInfo['userimg'];?>">

                    <?php
                    if($userInfo['creator']) {
                        echo "<label for='creatordesc'>Your Description</label>";
                        echo "<textarea name='creatordesc'>".$userInfo['creatordesc']."</textarea>";
                    }
                    ?>

                    <input type="submit" class="proceed_btn" value="Update">
                    <input type="hidden" name="update" value="true">
                    <input type="hidden" name="userid" value="<?php echo $_SESSION['user_info']['userid'];?>">
                </form>
                <?php
                //update the user and redirect to account w/message
                if (array_key_exists('update', $_POST)) {
                    try {
                            $userId = filter_input(INPUT_POST, 'userid', FILTER_VALIDATE_INT);
                            $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
                            $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
                            $userEmail = filter_input(INPUT_POST, 'useremail', FILTER_SANITIZE_EMAIL);

                            //upload the img file and save filepath to db
                            uploadFile('imgfile');
                            $userImg = "images/".$_FILES['imgfile']['name'];

                            if($userInfo['creator']) {
                                $creatorDesc = filter_input(INPUT_POST, 'creatordesc', FILTER_SANITIZE_STRING);
                                //update creator info on database
                                $stmt = $db->prepare('UPDATE public.user 
                                SET firstname=:firstname, lastname=:lastname, userimg=:userimg, useremail=:useremail, creatordesc=:creatordesc 
                                WHERE userid=:userid');
                                $stmt->bindValue(':userid', $userId, PDO::PARAM_INT);
                                $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
                                $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
                                $stmt->bindValue(':useremail', $userEmail, PDO::PARAM_STR);
                                $stmt->bindValue(':creatordesc', $creatorDesc, PDO::PARAM_STR);
                                $stmt->bindValue(':userimg', $userImg, PDO::PARAM_STR);
                                $stmt->execute();
                            }
                            else {
                                //update user info on database
                                $stmt = $db->prepare('UPDATE public.user 
                                SET firstname=:firstname, lastname=:lastname, userimg=:userimg, useremail=:useremail 
                                WHERE userid=:userid');
                                $stmt->bindValue(':userid', $userId, PDO::PARAM_INT);
                                $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
                                $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
                                $stmt->bindValue(':useremail', $userEmail, PDO::PARAM_STR);
                                $stmt->bindValue(':userimg', $userImg, PDO::PARAM_STR);
                                $stmt->execute();
                            }
                            
                            $_SESSION['message'] = "Update was successful.";
                            header('Location: account.php');
                    }
                    catch(Exception $e) {
                        $_SESSION['message'] = "Something went wrong. Please try again.";
                        header('Location: account.php');
                    }
                }
                ?>
            </div>
            
            
        </div>
        
    </main>

    <?php 
    // display the footer
    include 'common/footer.php'; 
    ?>
</body>
</html>