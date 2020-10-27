<?php 
// start session
session_start();

// connect to the database
include 'common/connection.php'; 

// get upload function
require 'common/upload.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christina's Creations | Add Item</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php 
    // display the header
    include 'common/header.php';
    ?>

    <main>
        <h1>Add New Item</h1>
        <form class="add_form" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <label for="invname">Item Name</label>
            <input type="text" name="invname">

            <label for="invdesc">Item Description</label>
            <textarea name="invdesc"></textarea>

            <label for="imgfile">Item Image</label>
            <input type="file" name="imgfile">

            <input type="submit" class="proceed_btn" name="add" value="Add">
        </form>
        <?php
        if (array_key_exists('add', $_POST)) {
            try {
                $invName = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
                $invDesc = filter_input(INPUT_POST, 'invdesc', FILTER_SANITIZE_STRING);

                //upload the img file and save filepath to db
                uploadFile('imgfile');
                $invImg = "images/".$_FILES['imgfile']['name'];

                $creatorId = $_SESSION['user_info']['userid'];
    
                //insert item into db
                $stmt = $db->prepare('INSERT INTO inventory (invname, invdesc, invimg, creatorid) VALUES (:invname, :invdesc, :invimg, :creatorid)');
                $stmt->bindValue(':invname', $invName, PDO::PARAM_STR);
                $stmt->bindValue(':invdesc', $invDesc, PDO::PARAM_STR);
                $stmt->bindValue(':invimg', $invImg, PDO::PARAM_STR);
                $stmt->bindValue(':creatorid', $creatorId, PDO::PARAM_INT);
                $stmt->execute();
                $_SESSION['message'] = "New item successfully added.";
                header('Location: account.php');
            }
            catch(Exception $e) {
                $_SESSION['message'] = "Something went wrong. Please try again.";
                header('Location: account.php');
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