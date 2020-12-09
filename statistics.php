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

		<a href="#" onclick="openUrl('includes/statistics1.php','nutricion')">Nutricion</a>

		<div id="nutricion"></div>

	<?php include("includes/footer.php") ?>
	</body>
</html>