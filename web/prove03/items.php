<?php
session_start();

if (array_key_exists($_POST['delete'])) {
	unset($_SESSION['items'][$_POST['delete']);
	header('Location: cart.php');
}

else {
	$items = array();
	$i = 0;

	if (isset($_SESSION['items'])) {
		foreach ($_SESSION['items'] as $x) {
			$items[$i] = $x;
			$i++;
		}
	}

	foreach ($_POST as $key => $value) {
		$items[$i] = $key;
		$i++;
	}

	$_SESSION['items'] = $items;
	header('Location: index.php');
}

?>