<?php  
	session_start();
	include_once 'database.php';
	include_once 'functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Panel Central</title>
		<script type="text/javascript" src="js/js.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</head>
	
	<body>
		<a href="home.php">Inicio</a>
		<a href="statistics.php">Estadisticas</a>
		<a href="search.php">Buscar</a>
		<a href="adduser.php">Nuevo Usuario</a>
		<a href="leaders.php">Lideres y Brigadistas</a>
		<a href="exit.php">Cerrar Sesión</a>

		<br><br><input type="text" id="search" placeholder="Buscar"><input type="submit" id="btn" value="Buscar">
		
		<div id="result"><br>
			<table cellspacing="3" cellpadding="3" border="1">
				<thead id="head">
					<tr>
						<th>ID</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Genero</th>
						<th>Cedula</th>
						<th>Telefono</th>
						<th>Fecha de Nacimiento</th>
						<th>Familia</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
		<p>Ingeniera de Sistemas &copy;2020</p>
		<p><?php echo $version; ?></p>
	</body>
</html>