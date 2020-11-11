<?php 
	session_start();
	include_once 'database.php';
	include_once 'functions.php';

	if (isset($_POST['enviar'])) {
		
		if (!isset($_SESSION['usuario'])) {
			header("Location:index.php");
			die();
		}
		$usuario = $_POST['usuario'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$contra = $_POST['contra'];
		$contravali = $_POST['contravali'];
		$message = '';
		if ($contra != $contravali) {
			$message = 'Las contraseñas no coinciden';
		} else {
			$resultado = $conexion->query("SELECT USUARIO FROM USUARIO WHERE USUARIO = '$nombre'"); 
			$row_count = $resultado->num_rows;
				
			if ($row_count >= 1) {
				$message = 'El usuario que intenta ingresar ya esta registrado';
			} else {
				$seql = "INSERT INTO usuario (USUARIO, NOMBRE, APELLIDO, CLAVE) VALUES('$usuario','$nombre','$apellido','$contra')";
				$res = $conexion->query($seql);	
				$message = 'Usuario agregado satisfactoriamente';
					}
				}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Panel Central</title>
	</head>
	<body>
		<a href="home.php">Inicio</a>
		<a href="statistics.php">Estadisticas</a>
		<a href="search.php">Buscar</a>
		<a href="adduser.php">Nuevo Usuario</a>
		<a href="leaders.php">Lideres y Brigadistas</a>
		<a href="exit.php">Cerrar Sesión</a>
		<form action="adduser.php" method="POST">
			<?php if (isset($message)): ?><p><?php echo $message; ?></p><?php endif ?>
			Usuario <input type="text" name="usuario">
			Nombre <input type="text" name="nombre">
			Apellido <input type="text" name="apellido"> 
			Contraseña <input type="password" name="contra">
			Validar Contraseña <input type="password" name="contravali">
			<input type="submit" value="Enviar" name="enviar">
		</form>
		<p>Ingeniera de Sistemas &copy;2020</p>
		<p><?php echo $version; ?></p>
	</body>
</html>