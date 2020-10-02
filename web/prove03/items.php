<?php
session_start();

$items = array();
foreach ($_POST as $key => $value) {
	$_SESSION[$key] = $value;
}
if (isset($_SESSION['delete'])) {
	unset($_SESSION[$_SESSION['delete']]);
	unset($_SESSION['delete']);
	header('Location: cart.php');
}
else {
	header('Location: index.php');
}
?>