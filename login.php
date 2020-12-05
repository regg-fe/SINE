<?php
	include_once 'includes/functions.php';
	session_start();
	if (isset($_SESSION['usuario'])) {
		header("Location:home.php");
		die();
	}
	$con = conexion();
	if (isset($_POST['btn'])) {
		$user =  $con->real_escape_string($_POST['user']);
		$pass =  $con->real_escape_string($_POST['password']);
		$sql = "SELECT * FROM USUARIO WHERE USUARIO = '$user'";
		$res = $con->query($sql);
			if ($res->num_rows > 0) {
				while ($row = $res->fetch_assoc()) {
					$pass2 = $row['CLAVE'];
					$user2 = $row['USUARIO'];
					if ($pass == $pass2) {
						session_start();
						$_SESSION['usuario'] = $user;
						$_SESSION['id'] = $row['ID'];
						$_SESSION['name'] = $row['NOMBRE'];
						$_SESSION['surname'] = $row['APELLIDO'];
						header("location:home.php");
					} else {
						$message = "¡Contraseña incorrecta!";
					}
				}
			} else {
				$message = "¡Usuario no encontrado!";
			}
		}
?>
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
		<title>SINE: Login</title>
	</head>
	<body>
	<div class="login-box">
		<img class="avatar" src="img/undraw_profile_pic_ic5t.svg" alt="avatar-image">
		<h1>Iniciar sesión</h1>
		<?php if (isset($message)): ?> <div class="error"> <?php echo $message; ?> </div> <?php endif; ?>
		<form action="login.php" name="formulario" method="post">
			<!--Nombre de usuario-->
			<label for="username">Nombre de usuario</label>
			<input type="text" name="user" id="username" placeholder="Ingresar nombre de usuario">
			<!--Contraseña-->
			<label for="password">Contraseña</label>
			<input type="password" name="password" id="password" placeholder="Ingresar contraseña">
			<input type="submit" name = "btn" value="Iniciar sesión" id="submit">
			<a href="#">¿Olvidó su contraseña?</a>
		</form>
	</div>
	<script src="js/login.js"></script>
	</body>
</html>