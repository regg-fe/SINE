<?php  
	include_once 'functions.php';
	$id = $_GET['id'];
	if (empty($id)) {
		echo "<script>location.reload();</script>";
		die();
	}
	$bloque = bloque($id);
	$apartamentos = apartamentosPorBloque($id);
	$total = count($apartamentos);
	$totalbom = count(bombonasPorBloque($id));
	$totalper = count(personasPorBloque($id));
	$totalfam = count(familiasPorBloque($id));
	$totalben = count(registroBeneficiosPorBloque($id));
	$anexos = count(anexosPorBloque($id));
	$escolarizacion = count(escolarizacionesPorBloque($id));
	$trabajadores = count(trabajadoresPorBloque($id));
	$embarazadas = count(embarazadasPorBloque($id));
	$emcamados = count(encamadosPorBloque($id));
	$pensionados = count(pensionadosPorBloque($id));
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<h2>Bloque: <?php echo $bloque['NRO_BLOQUE'] ?></h2>
		<p>Personas: <?php echo $totalper ?></p>
		<p>Familias: <?php echo $totalfam ?></p>
		<p>Apartamentos: <?php echo $total ?></p>
		<p>Bombonas: <?php echo $totalbom ?></p>
		<p>Beneficios: <?php echo $totalben ?></p>
		<p>Anexos: <?php echo $anexos ?></p>
		<p>Estudiantes: <?php echo $escolarizacion ?></p>
		<p>Trabajadores: <?php echo $trabajadores ?></p>
		<p>Embarazadas: <?php echo $embarazadas ?></p>
		<p>Emcamados: <?php echo $emcamados ?></p>
		<p>Pensionados: <?php echo $pensionados ?></p>
		
		<div id="visualizartwo"></div>
	</body>
</html>