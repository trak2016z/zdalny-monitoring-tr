<?php
	
	session_start();
	session_destroy();
	unset($_SESSION['username']);
	$_SESSION['message'] = "Zostałeś wylogowany";
	header("location: logowanie.php");
?>