<?php
session_start();
$items = array();
if (isset($_POST['delete'])) {
	unset($_SESSION[$_POST['delete']]);
	header('Location: cart.php');
}
else {
	foreach ($_POST as $key => $value) {
		$items.push($key);
		
	}
	$_SESSION['items'] = $items;
	header('Location: index.php');
}
?>