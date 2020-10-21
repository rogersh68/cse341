<?php 
session_start();

// connect to the database
include 'common/connection.php'; 
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
                <h2>Current</h2>
                <?php
                // list info for item being edited
                $stmt = $db->prepare('SELECT * FROM inventory WHERE invid = :invid');
                $stmt->bindValue(':invid', $_POST['invid'], PDO::PARAM_INT);
                $stmt->execute();
                $itemInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo "<h2>Image:</h2>";
                echo "<img src='".$itemInfo[0]['invimg']."' alt='".$itemInfo[0]['invname']."'>";
                echo "<h2>Name:</h2>";
                echo "<h3>".$itemInfo[0]['invname']."</h3>";
                echo "<h2>Description:</h2>";
                echo "<p>".$itemInfo[0]['invdesc']."</p>";
                ?>
            </div>
            <div>
                <!--Update item info form -->
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                    <label for="invname">Item Name</label>
                    <input type="text" name="invname" value="<?php echo $itemInfo[0]['invname'];?>">

                    <label for="invdesc">Item Description</label>
                    <textarea name="invdesc"><?php echo $itemInfo[0]['invdesc'];?></textarea>

                    <label for="invimg">Item Image</label>
                    <input type="text" name="invimg" value="<?php echo $itemInfo[0]['invimg'];?>">

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
                            $invImg = "images/inv_placeholder.svg";

                            //update item info on database
                            $stmt = $db->prepare('UPDATE inventory SET invname = :invname, invdesc = :invdesc, invimg = :invimg WHERE invid = :invid');
                            $stmt->bindValue(':invid', $invId, PDO::PARAM_INT);
                            $stmt->bindValue(':invname', $invName, PDO::PARAM_STR);
                            $stmt->bindValue(':invdesc', $invDesc, PDO::PARAM_STR);
                            $stmt->bindValue(':invImg', $invImg, PDO::PARAM_STR);
                            $stmt->execute();
                            $_SESSION['message'] = "Update was successful.";
                            header('Location: account.php');
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