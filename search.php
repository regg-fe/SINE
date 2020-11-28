<?php  
	session_start();
	include_once 'includes/database.php';
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Buscar</title>
		<script type="text/javascript" src="js/js.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</head>
	
	<body>
		<?php include("includes/navbar.php");?>

		<input type="text" id="search" placeholder="Buscar"><input type="submit" id="btn" value="Buscar">
		
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
		
		<?php include("includes/footer.php")?>
	</body>
</html>