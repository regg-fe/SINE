<?php 

	session_start();
	include_once 'database.php';
	include_once 'functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	
	$nombre = $_POST['nombre'];
	$contra = $_POST['contra'];
	$contravali = $_POST['contravali'];

	if ($contra != $contravali) {
		echo "las contraseñas no coinciden.";

	}

	else{

		$seql = "INSERT INTO usuario(USUARIO, CLAVE) VALUES('$nombre', '$contra')";

		$res = $conexion->query($seql);

		echo "usuario agregado";

		


	}





?>