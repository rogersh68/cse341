<?php
session_start();

/*if (array_key_exists($_POST['delete'])) {
	unset($_SESSION['items'][$_POST['delete']);
	header('Location: cart.php');
}

else {
	$items = array();
	$i = 0;

	if (isset($_SESSION['items'])) {
		foreach ($_SESSION['items'] as $key => $value) {
			$items[$i] = $key => $value;
			$i++;
		}
	}

	foreach ($_POST as $key => $value) {
		$items[$i] = $key => $value;
		$i++;
	}

	$_SESSION['items'] = $items;
	header('Location: index.php');
//}*/
$items = array();
foreach ($_POST as $key => $value) {
	$_SESSION[$key] = $value;
}
//array_merge($_SESSION['items'], $items);
header('Location: index.php');

?>