<?php
// connect to the database
include './prove06/common/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Sign Up">
    </form>

    <?php
    print_r($_POST);
    if (!empty($_POST)) {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $db->prepare('INSERT INTO team_user (username, userpassword) VALUES (:username, :userpassword)');
            $stmt->bindValue(':username', $username, PDO::PARAM_STR);
            $stmt->bindValue(':userpassword', $hashedPassword, PDO::PARAM_STR);
            $stmt->execute();

            header('Location: sign-in.php');
            die();
        }
        catch(Exception $e) {
            echo "Error: ".$e;
        }
    }
    ?>
</body>
</html>