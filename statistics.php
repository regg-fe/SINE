<?php 
	session_start();
	include_once 'includes/database.php';
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
			header("Location:index.php");
			die();
	}
	
	echo "NO ESTA IMPLEMENTADO";
	echo "<a href='home.php'>Volver</a>"

?>