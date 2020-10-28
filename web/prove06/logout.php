<?php
session_unset();
session_destroy();
$_SESSION['logged_in'] = FALSE;
echo $_SESSION['logged_in'];
//header('Location: index.php');
?>