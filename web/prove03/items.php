<?php
session_start();
$items = array();
$i = 0;

/*if (isset($_POST['delete'])) {
	unset($_SESSION[$_POST['delete']]);
	header('Location: cart.php');
}*/
if (isset($_POST['delete'])) {

}

if (isset($_SESSION['items'])) {
	foreach ($_SESSION['items'] as $x) {
		$items[$i] = $x;
		$i++;
	}
}
	foreach ($_POST as $key => $value) {
		$items[$i] = $key;
		$i++;
	

	$_SESSION['items'] = $items;
	header('Location: index.php');
}
?>