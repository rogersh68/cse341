<?php
//start session
session_start();

// connect to the database
include './prove06/common/connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <h1>Sign In</h1>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <input type="submit" value="Sign In">
    </form>
    <a href="sign-up.php">Create an Account</a>

    <?php
    if (!empty($_POST)) {
        $username = filter_input(INPUT_POST, $_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, $_POST['password'], FILTER_SANITIZE_STRING);

        $stmt = $db->prepare('SELECT password FROM team_user WHERE username=:username');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (password_verify($password, $result['password'])) {
            $_SESSION['user'] = $username;
            header('Location: index.php');
            die();
        }
        else {
            
        }
    }
    ?>
</body>
</html>