<?php 
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
			header("Location:index.php");
			die();
	}

	$tablaBloques = bloques();
	$btns = count($tablaBloques);
	$personas = count(personas());
	$familias = count(familias());
	$bombonas = count(bombonas());
	$discapacitados = count(discapacitados());
	$enfermos = count(enfermos());
	$estudiantes = count(escolarizaciones());
	$pensionados = count(pensionados('ALL'));
	$lactantes = count(lactantes());
	$adultos = count(adultosMayores());
	$embarazadas = count(embarazadas());
	$encamados = count(encamados());
	$solos = count(apartamentosConUnaPersona());
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SINE: Estadisticas</title>
		<script type="text/javascript" src="js/js.js"></script>
		<script type="text/javascript" src="js/statistics.js"></script>
	</head>
	<?php include("includes/navbar.php") ?>
 		<h1>Bloques: </h1>
 		<p>Personas registradas: <?php echo $personas ?></p>
 		<p>Familias registradas: <?php echo $familias ?></p>
 		<p>Total de Bombonas: <?php echo $bombonas ?></p>
 		<p>Personas discapacitadas: <?php echo $discapacitados ?></p>
 		<p>Personas enfermas: <?php echo $enfermos ?></p>
		<p>Estudiantes: <?php echo $estudiantes ?></p>
 		<p>Pensionados: <?php echo $pensionados ?></p>
 		<p>Lactantes: <?php echo $lactantes ?></p>
 		<p>Adultos Mayores: <?php echo $adultos ?></p>
 		<p>Embarazadas: <?php echo $embarazadas ?></p>
 		<p>Encamados: <?php echo $encamados ?></p>
 		<p>Apartamentos con una sola persona: <?php echo $solos ?></p>

		<?php for ($i=0; $i < $btns; $i++): ?>
			<a id="prevent" onclick="openUrl('includes/apartamentos.php?id=<?php echo $tablaBloques[$i]['ID'] ?>','visualizar')"><button>Bloque <?php echo $tablaBloques[$i]['NRO_BLOQUE'] ?></button></a>
		<?php endfor ?>
		<div id="visualizar"></div>
		<br><br>
		<a onclick="openUrl('includes/nutricion.php','mostrar')"><button>Nutricion</button></a>
		<a onclick="openUrl('includes/condiciones.php','mostrar')"><button>Condiciones</button></a>
		<a onclick="openUrl('includes/proteccion.php','mostrar')"><button>Proteccion Social</button></a>
		<a onclick="openUrl('includes/vulnerables.php','mostrar')"><button>Personas Vulnerables</button></a>

		<div id="mostrar"></div>
	<?php include("includes/footer.php") ?>
