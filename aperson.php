<?php 
	session_start();
	include_once 'database.php';
	include_once 'functions.php';
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
	</head>
	<body>
		<?php include("includes/navbar.php")?>
		
		<h1>Datos personales:</h1>
		<p>Nombres: <?php echo $persona['NOMBRES'] ?></p>
		<p>Apellidos: <?php echo $persona['APELLIDOS'] ?></p>
		<p>Genero: <?php echo $persona['GENERO'] ?></p>
		<p>CI: <?php echo $persona['DNI'] ?></p>
		<p>Telefono: <?php echo $persona['TELEFONO'] ?></p>
		<p>Posicion: <?php echo $persona['POSICION'] ?></p>
		<p>Embarazo: <?php echo $persona['EMBARAZO'] ?></p>
		<p>Encamado: <?php echo $persona['ENCAMADO'] ?></p>
		<p>Pension: <?php echo $persona['PENSION'] ?></p>
		<p>Voto: <?php echo $persona['VOTO'] ?></p>
		<p>Peso: <?php echo $persona['PESO'] ?></p>
		<p>Estatura: <?php echo $persona['ESTATURA'] ?></p>
		<p>Codigo de Carnet: <?php echo $persona['CODIGO_CARNET'] ?></p>
		<p>Serial de Carnet: <?php echo $persona['SERIAL_CARNET'] ?></p>
		<p>Familia: <?php echo $persona['FAMILIA'] ?></p>
		<p>Bloque: <?php echo $persona['NRO_BLOQUE'] ?></p>
		<p>Apartamento: <?php echo $persona['NRO_APARTAMENTO'] ?></p>
		
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
		<?php include("includes/footer.php")?>
	</body>
</html>
