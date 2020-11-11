<?php 
	session_start();
	include_once 'database.php';
	include_once 'functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}

	echo "NO ESTA IMPLEMENTADO";
	echo "<a href='home.php'>Volver</a>"

?>