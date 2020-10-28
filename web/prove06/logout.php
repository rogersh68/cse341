<?php
//start session
session_start();

//unset and destroy the session
session_unset();
session_destroy();

//return to home page
header('Location: index.php');
?>