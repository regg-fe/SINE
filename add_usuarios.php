<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Usuario</title>
</head>

<body>

	<?php 

	session_start();
	include_once 'database.php';
	include_once 'functions.php';

	if (isset($_POST['enviar'])) {
		
	
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

		//SELECT COUNT(*) FROM USUARIO WHERE USUARIO = 'zoka'


			$resultado = $conexion->query("SELECT USUARIO FROM USUARIO WHERE USUARIO = '$nombre'"); 

				$row_count = $resultado->num_rows;

				if ($row_count >= 1) {
				
					echo "El nombre de usuario está en uso por favor utiliza otro." . "<br>";


				}				

		else{
		

		$seql = "INSERT INTO usuario(USUARIO, CLAVE) VALUES('$nombre', '$contra')";

		$res = $conexion->query($seql);

		echo "usuario agregado con éxito.";

		echo "<br>";

		//header("refresh:5; url=home.php");
		


	}

	}

}

?>

Por favor, rellena los campos descritos a continuacion

<center>
<form action="add_usuarios.php" method="post">

	Nombre de usuario <input type="text" name="nombre"> <br>
	Contraseña <input type="password" name="contra"> <br>
	Validar Contraseña <input type="password" name="contravali"> <br>
	<input type="submit" value="Enviar" name="enviar">
	
</form>
</center>

<a href="home.php">Volver</a> 

</body>
</html>
