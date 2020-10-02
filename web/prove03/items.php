<?php
session_start();
$items = array();
$i = 0;

/*if (isset($_POST['delete'])) {
	unset($_SESSION[$_POST['delete']]);
	header('Location: cart.php');
}*/

if (isset($_SESSION['items'])) {
	$i = count($_SESSION['items']);
}
	foreach ($_POST as $key => $value) {
		$items[$i] = $key;
		$i++;
	

	$_SESSION['items'] = $items;
	header('Location: index.php');
}
?>