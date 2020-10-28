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
    <title>Christina's Creations | Edit Creations</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Edit Creation</h1>  
        <div class="edit_item_div">
            <div>
                <h2>Item's Current Information</h2>
                <?php
                // list info for item being edited
                $stmt = $db->prepare('SELECT * FROM inventory WHERE invid = :invid');
                $stmt->bindValue(':invid', $_POST['invid'], PDO::PARAM_INT);
                $stmt->execute();
                $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<h3>Image:</h3>";
                echo "<img src='".$itemInfo[0]['invimg']."' alt='".$itemInfo[0]['invname']."'>";
                echo "<h3>Name:</h3>";
                echo "<p>".$itemInfo[0]['invname']."</p>";
                echo "<h3>Description:</h3>";
                echo "<p>".$itemInfo[0]['invdesc']."</p>";
                ?>
            </div>
            <div>
                <!--Update item info form -->
                <form class="update_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <label for="invname">Item Name</label>
                    <input type="text" name="invname" value="<?php echo $itemInfo[0]['invname'];?>">

                    <label for="invdesc">Item Description</label>
                    <textarea name="invdesc"><?php echo $itemInfo[0]['invdesc'];?></textarea>

                    <label for="imgfile">Item Image</label>
                    <input type="file" name="imgfile" value="<?php echo $itemInfo[0]['invimg'];?>">

                    <input type="submit" class="proceed_btn" value="Update">
                    <input type="hidden" name="update" value="true">
                    <input type="hidden" name="invid" value="<?php echo $_POST['invid'];?>">
                </form>
                <?php
                //update the item and redirect to account w/message
                if (array_key_exists('update', $_POST)) {
                    try {
                            $invId = filter_input(INPUT_POST, 'invid', FILTER_VALIDATE_INT);
                            $invName = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
                            $invDesc = filter_input(INPUT_POST, 'invdesc', FILTER_SANITIZE_STRING);
                            
                            //upload the img file and save filepath to db
                            print_r($_POST);
                            print_r($_FILES);

                            if(!empty($_FILES['imgfile'])){
                                echo "Files not empty";
                                uploadFile('imgfile');
                                $invImg = "images/".$_FILES['imgfile']['name'];

                                //update item info with image on database
                                $stmt = $db->prepare('UPDATE inventory SET invname=:invname, invdesc=:invdesc, invimg=:invimg WHERE invid=:invid');
                                $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
                                $stmt->bindValue(':invname', $invName, PDO::PARAM_STR);
                                $stmt->bindValue(':invdesc', $invDesc, PDO::PARAM_STR);
                                $stmt->bindValue(':invimg', $invImg, PDO::PARAM_STR);
                                $stmt->execute();
                            }
                            else {
                                echo "Empty files";
                                //update item info without image on database
                                $stmt = $db->prepare('UPDATE inventory SET invname=:invname, invdesc=:invdesc WHERE invid=:invid');
                                $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
                                $stmt->bindValue(':invname', $invName, PDO::PARAM_STR);
                                $stmt->bindValue(':invdesc', $invDesc, PDO::PARAM_STR);
                                $stmt->execute();
                            }
                            
                            $_SESSION['message'] = "Update was successful.";
                            //header('Location: account.php');
                    }
                    catch(Exception $e) {
                        $_SESSION['message'] = "Something went wrong. Please try again.";
                        header('Location: account.php');
                    }
                }
                ?>

                <br>
                <!--Delete item form -->
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                    <p class="general_notice">Once you delete an item, it cannot be retreived.</p>
                    <input type="submit" class="delete_btn" value="Delete">
                    <input type="hidden" name="delete" value="true">
                    <input type="hidden" name="invid" value="<?php echo $_POST['invid'];?>">
                </form>

                <?php
                //delete the item and redirect to account w/message
                if (array_key_exists('delete', $_POST)) {
                    try {
                            $invId = filter_input(INPUT_POST, 'invid', FILTER_VALIDATE_INT);

                            //delete item info on database
                            $stmt = $db->prepare('DELETE FROM inventory WHERE invid = :invid');
                            $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
                            $stmt->execute();
                            $_SESSION['message'] = "Deletion was successful.";
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