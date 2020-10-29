<?php  
	session_start();
	if (isset($_SESSION['usuario'])) {
		header("Location:home.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Pagina de Inicio</title>
	</head>
	<body>
		<a href="index.php">Inicio</a>
		<a href="login.php">Iniciar sesión</a>
		<a href="">¿Que es SINE?</a>
		<h1> Bienvenidos a SINE </h1>
		<p>Para consultar, editar o actualizar debe <a href="login.php">Iniciar sesión</a></p>
		<p>Ingeniera de Sistemas &copy;2020</p>
		<p>Version 0.1</p>
	</body>
</html>