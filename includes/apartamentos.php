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
		<div class="container">
			<div class="container2">
				<div class="tabla">
					<h2>Bloque: <?php echo $bloque['NRO_BLOQUE'] ?></h2>
					<div class="info2">
						<table>
						<tr>
						<td>Personas: </td>
						<td><?php echo $totalper ?></td>
						</tr>
						<tr>
						<td>Familias: </td>
						<td><?php echo $totalfam ?></td>
						</tr>
						<tr>
						<td>Apartamentos: </td>
						<td><?php echo $total ?></td>
						</tr>
						<tr>
						<td>Bombonas:</td>
						<td> <?php echo $totalbom ?></td>
						</tr>
						<tr>
						<td>Beneficios:</td>
						<td> <?php echo $totalben ?></td>
						</tr>
						<tr>
						<td>Anexos: </td>
						<td><?php echo $anexos ?></td>
						</tr>
						<tr>
						<td>Estudiantes: </td>
						<td><?php echo $escolarizacion ?></td>
						</tr>
						<tr>
						<td>Trabajadores: </td>
						<td><?php echo $trabajadores ?></td>
						</tr>
						<tr>
						<td>Embarazadas: </td>
						<td><?php echo $embarazadas ?></td>
						</tr>
						<tr>
						<td>Emcamados:</td>
						<td> <?php echo $emcamados ?></td>
						</tr>
						<tr>
						<td>Pensionados: </td>
						<td><?php echo $pensionados ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
						
		
		<div id="visualizartwo"></div>
	</body>
</html>