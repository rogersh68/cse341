<?php
session_destroy();
$_SESSION['logged_in'] = FALSE;
header('Location: index.php');
?>