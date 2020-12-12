<?php 
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	if (isset($_POST['enviar'])) {
		
	$con = conexion();

	$usuario = $con->real_escape_string($_POST['usuario']);
	$nombre = $con->real_escape_string($_POST['nombre']);
	$apellido = $con->real_escape_string($_POST['apellido']);
	$contra = $con->real_escape_string($_POST['contra']);
	$contravali = $con->real_escape_string($_POST['contravali']);

	$message = '';
	if ($contra != $contravali) {
		$message = 'Las contraseñas no coinciden';
	} else {
		$resultado = $con->query("SELECT * FROM USUARIO WHERE USUARIO = '$usuario'"); 
		$row_count = $resultado->num_rows;
		if ($row_count != 0) {
			$message = 'El usuario que intenta ingresar ya esta registrado';
			$con->close();
		} else {
			$sql = "INSERT INTO usuario (USUARIO, NOMBRE, APELLIDO, CLAVE) VALUES('$usuario','$nombre','$apellido','$contra')";
			$res = $con->query($sql);
			$con->close();
			header('Location:user.php');
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
				<div class="error"><?php if (isset($message)): ?><?php echo $message; ?><?php endif ?></div>
					
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