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
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Agregar Usuario</title>
		<link rel="stylesheet" href="css/insertForms.css">
		<script src="js/jquery.min.js"></script>

	</head>
	<body>
		<?php include("includes/navbar.php");?>
		<div class="container">
			<div class="center Btn-menu">
				<a href="user.php" title="Volver"><i class="fas fa-arrow-left"></i></a>
			</div>
			<div class="box-form">
				<form action="adduser.php" method="POST">
				<h1>Registrar nuevo usuario</h1>
				<div class="error"><?php if (isset($message)): ?><?php echo $message; ?><?php endif ?></div>
				<div class="error" id="mensajeError"></div>
					<!--Usuario-->
					<label for="usuario">Usuario</label>
					<input type="text" name="usuario" id="usuario">
					<!--Nombre-->
					<label for="nombre">Nombre </label>
					<input type="text" name="nombre" id="nombre">
					<!--Apellidoo-->
					<label for="apelido">Apellido </label>
					<input type="text" name="apellido" id="apellido"> 
					<!--Password-->
					<label for="contra">Contraseña</label>
					<input type="password" name="contra" id="contra">
					<!--Validar Password-->
					<label for="contravali">Validar Contraseña</label>
					<input type="password" name="contravali" id="contravali">
					<input type="submit"  id="btnEnviar" value="Enviar" name="enviar">
				</form>
			</div>
		</div>
		<script>
			$("#btnEnviar").click(function(e) {
				var campoVacio = "";
				var mensajeError ="";
				//Verificacion de campos vacios
				if ($("#usuario").val() == "") {
					$("#usuario").css("border-color","#D32F2F");
					$("#usuario").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				if ($("#nombre").val() == "") {
					$("#nombre").css("border-color","#D32F2F");
					$("#nombre").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				if ($("#apellido").val() == "") {
					$("#apellido").css("border-color","#D32F2F");
					$("#apellido").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				if ($("#contra").val() == "") {
					$("#contra").css("border-color","#D32F2F");
					$("#contra").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				if ($("#contravali").val() == "") {
					$("#contravali").css("border-color","#D32F2F");
					$("#contravali").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				if (campoVacio != "") {
					mensajeError = "<p>Hay campos vacios</p>" +  mensajeError;
					e.preventDefault();
				}
				if ($("#contra").val() != $("#contravali").val()) {
					mensajeError  += "<p>Las contraseñas no coinciden</p>";
					e.preventDefault();
				} 
				if (mensajeError != "") {
					$("#mensajeError").html(mensajeError);
					e.preventDefault();
				} 
			});	
		</script>
		<?php include("includes/footer.php")?>
	</body>
</html>