<?php 
	session_start();
	include_once 'includes/database.php';
	include_once 'includes/functions.php';

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
		<title>SINE: Agregar Usuario</title>
		<link rel="stylesheet" href="css/insertForms.css">
	</head>
	<body>
		<?php include("includes/navbar.php");?>
		<div class="container">
			<div class="box-form">
				<form action="adduser.php" method="POST">
				<h1>Registrar nuevo usuario</h1>
					<?php if (isset($message)): ?><p><?php echo $message; ?></p><?php endif ?>
					
					<label for="usuario">Usuario</label>
					<input type="text" name="usuario">
					<label for="nombre">Nombre </label>
					<input type="text" name="nombre">
					<label for="apelido">Apellido </label>
					<input type="text" name="apellido"> 
					<label for="contra">Contraseña</label>
					<input type="password" name="contra">
					<label for="contravali">Validar Contraseña </label>
					<input type="password" name="contravali">
					<input type="submit" value="Enviar" name="enviar">
				</form>
			</div>
		</div>
		<?php include("includes/footer.php")?>
	</body>
</html>