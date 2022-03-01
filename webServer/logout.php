<?php
	session_start();
	session_unset();
	session_destroy();
	//TODO Can insert some sort of log out message that goes up to indicate they have been logged out
	die(header("Location: login.php"));
?>
