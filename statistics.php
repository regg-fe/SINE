<?php 
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
			header("Location:index.php");
			die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SINE: Estadisticas</title>
		<script type="text/javascript" src="js/js.js"></script>
		<script type="text/javascript" src="js/statistics.js"></script>
	</head>
	<?php include("includes/navbar.php") ?>
	<body>

		<a href="#" onclick="openUrl('includes/nutricion.php','mostrar')">Nutricion</a>
		<a href="#" onclick="openUrl('includes/enfermos.php','mostrar')">Enfermedades</a>

		<div id="mostrar"></div>

	<?php include("includes/footer.php") ?>
	</body>
</html>