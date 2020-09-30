<?php
session_start();

if (isset($_POST['delete'])) {
	unset($_SESSION[$_POST['delete']]);
	header('Location: cart.php');
}
else {
	foreach ($_POST as $key => $value) {
		
		$_SESSION[$key] = $value;
	}
	header('Location: index.php');
}
?>