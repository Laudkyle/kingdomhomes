<?php
session_start();
	if(isset($_SESSION['user_id'])){
		unset($_SESSION['user_id']);
	}
	if(isset($_SESSION['user_level'])){
		unset($_SESSION['user_level']);
	
	}
header("Location: account.php")
?>
