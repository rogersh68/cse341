<?php
session_start();
$key = $_POST['delete'];
unset($_SESSION[$key]);
header('Location: cart.php');
?>