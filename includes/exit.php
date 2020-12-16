<?php  
	session_start();
	if (!isset($_SESSION['usuario'])) {
	header("Location:../index.php");
	} 
		session_destroy();
		header("location:../index.php");
?>