<?php 
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$id = $_GET['id'];
	if (!isset($id)) {
		header("Location:families.php");
	}
	if (empty($id)) {
		header("Location:home.php");
	}
	$persona = persona($id);
	if ($persona == NULL) {
		header("Location:home.php");
	}
	$escolarizado = escolarizacionPorPersona($persona['ID']);
	$trabajador = trabajosPorPersona($persona['ID']);
	if (isset($trabajador)) {
		for ($i=0; $i < count($trabajador); $i++) {
			$lugar[$i] = lugar($trabajador[$i]['ID_LUGAR']);
		}
	}
	
	$proteccion = programasSocialesPorPersona($persona['ID']);
	$salud = enfermedadesPorPersona($persona['ID']);
	$discapacitado = discapacidadesPorPersona($persona['ID']);
	$receta = recetasPorPersona($persona['ID']);
	$carnet = carnet($persona['ID']);	 
	$bono = bonosPorCarnet($persona['ID']);
	$ayuda = ayudasTecPorPersona($persona['ID']);

	if(isset($_POST['btn'])) {
       echo "<script>window.close();</script>";
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>SINE: <?php echo $persona['NOMBRES']." ".$persona['APELLIDOS']?></title>
		<link rel="stylesheet" href="css/person.css">
	</head>
	<body>
		<?php include("includes/navbar.php")?>
		<div class="container">
			<div class="tabla">
				<h1>Datos personales:</h1>
				<div class="info2">
					<table>
					<tr>
						<td class="column1">Nombres:</td>
						<td><?php echo $persona['NOMBRES'] ?></td>
					</tr>
					<tr>
						<td>Apellidos:</td>
						<td> <?php echo $persona['APELLIDOS'] ?></td>
					</tr>
					<tr>
					<td>Genero:</td>
					<td> <?php echo $persona['GENERO'] ?></td>
					</tr>
					<tr>
					<td>CI:</td>
					<td> <?php echo $persona['DNI'] ?></td>
					</tr>
					<tr>
					<td>Telefono:</td>
					<td> <?php echo $persona['TELEFONO'] ?></td>
					</tr>
					<tr>
					<td>Posicion:</td>
					<td> <?php echo $persona['POSICION'] ?></td>
					</tr>
					<tr>
					<td>Embarazo:</td>
					<td> <?php echo $persona['EMBARAZO'] ?></td>
					</tr>
					<tr>
					<td>Encamado:</td>
					<td> <?php echo $persona['ENCAMADO'] ?></td>
					</tr>
					<tr>
					<td>Pension:</td>
					<td> <?php echo $persona['PENSION'] ?></td>
					</tr>
					<tr>
					<td>Voto:</td>
					<td> <?php echo $persona['VOTO'] ?></td>
					</tr>
					<tr>
					<td>Peso:</td>
					<td> <?php echo $persona['PESO'] ?></td>
					</tr>
					<tr>
					<td>Estatura:</td>
					<td> <?php echo $persona['ESTATURA'] ?></td>
					</tr>
					<tr>
					<td>Codigo de Carnet:</td>
					<td> <?php echo $persona['CODIGO_CARNET'] ?></td>
					</tr>
					<tr>
					<td>Serial de Carnet:</td>
					<td> <?php echo $persona['SERIAL_CARNET'] ?></td>
					</tr>
					<tr>
					<td>Familia:</td>
					<td> <?php echo $persona['FAMILIA'] ?></td>
					</tr>
					<tr>
					<td>Bloque:</td>
					<td> <?php echo $persona['NRO_BLOQUE'] ?></td>
					</tr>
					<tr>
					<td>Apartamento:</td>
					<td> <?php echo $persona['NRO_APARTAMENTO'] ?></td>
					</tr>	
				</div>
				
</table>
				<?php if ($escolarizado != NULL): ?>
					<h1>Preparacion Academicos:</h1>
					<p>Nivel de instruccion: <?php echo $escolarizado['NIVEL_EDUCACIONAL'] ?></p>
					<p>Descricion: <?php echo $escolarizado['DESCRIPCION'] ?></p>
					<p>Nombre de Institucion: <?php echo $escolarizado['NOMBRE_INSTITUCION'] ?></p>
					<p>Rif de Institucion: <?php echo $escolarizado['RIF_INSTITUCION'] ?></p>
				<?php endif ?>

				<?php if ($trabajador != NULL && $lugar != NULL): ?>
					<h1>Datos Laborales:</h1>
					<p>Nombre: <?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['NOMBRE'] ?> <?php endfor ?> </p>
					<p>Tipo: <?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['TIPO'] ?> <?php endfor ?> </p>
					<p>Tipo de Institucion: <?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['TIPO_INSTITUCION'] ?> <?php endfor ?> </p>
					<p>RIF: <?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['RIF'] ?> <?php endfor ?> </p>
					<p>Descripcion: <?php for ($i=0; $i < count($trabajador); $i++): ?> <?php echo " | ".$trabajador[$i]['DESCRIPCION'] ?> <?php endfor ?> </p>
				<?php endif ?>

				<?php if ($proteccion != NULL || $bono != NULL ): ?>
					<h1>Proteccion Social: </h1>
					<?php if ($proteccion != NULL): ?>
						<p>Programa Social:<?php for ($i=0; $i < count($proteccion); $i++): ?> <?php echo " | ".$proteccion[$i]['NOMBRE'] ?> <?php endfor ?></p>
					<?php endif ?>
					<?php if ($bono != NULL): ?> 
						<p> Bono: <?php for ($i=0; $i < count($bono); $i++): ?> <?php echo " | ".$bono[$i]['NOMBRE_BONO'] ?><?php endfor?> </p> 
					<?php endif ?>	
				<?php endif ?>	

				
				<?php if ($salud != NULL || $discapacitado != NULL): ?>
					<h1>Salud: </h1>
					<?php if ($salud != NULL): ?>
						<p>Enfermedad: <?php for ($i=0; $i < count($salud); $i++): ?> <?php echo " | ".$salud[$i]['NOMBRE_ENFERMEDAD'] ?> <?php endfor ?>
					<?php endif ?></p> 
					<?php if ($discapacitado != NULL): ?>
						<p>Discapacidad: <?php for ($i=0; $i < count($discapacitado); $i++): ?><?php echo " | ".$discapacitado[$i]['TIPO_DISCAPACIDAD'] ?><?php endfor ?> </p> 
					<?php endif ?>
					
					<?php if ($receta != NULL && $salud != NULL): ?>
						<p>Medicamento: <?php for ($i=0; $i < count($receta); $i++): ?> <?php echo  " | ".$receta[$i]['NOMBRE_MEDICAMENTO'] ?><?php endfor ?> </p>
						<p>Tipo de Medicamento: <?php for ($i=0; $i < count($receta); $i++): ?> <?php echo " | ".$receta[$i]['TIPO_MEDICAMENTO'] ?><?php endfor ?> </p>
						<p>Descripcion: <?php for ($i=0; $i < count($receta); $i++): ?> <?php echo  " | ".$receta[$i]['DESCRIPCION'] ?><?php endfor ?> </p>
						<?php if ($ayuda != NULL): ?>
							<p>Ayuda tecnica: <?php for ($i=0; $i < count($ayuda); $i++): ?> <?php echo  " | ".$ayuda[$i]['TIPO_AYUDA'] ?><?php endfor ?> </p>
						<?php endif ?>
					<?php endif ?>	
				<?php endif ?>

				<form method="POST">
					<input type="submit" value="Cerrar" name="btn">
				</form>
			</div>
		</div>	

		<?php include("includes/footer.php")?>
	</body>
</html>
