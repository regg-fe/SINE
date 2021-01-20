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
			<div class="container2">
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
						<td>Fecha de nacimiento:</td>
						<td> <?php echo $persona['FECHA_NAC'] ?></td>
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
						</table>	
					</div>
				</div>
					<!--Academico-->
					<?php if ($escolarizado != NULL): ?>
						<div class="tabla">
							<h1>Preparacion Academicos:</h1>
							<div class="info2">
								<table>
									<tr>
										<td class="column1" >Nivel de instruccion:</td>
										<td><?php echo $escolarizado['NIVEL_EDUCACIONAL'] ?></td>
									</tr>
									<tr>
										<td>Descricion:</td>
										<td><?php echo $escolarizado['DESCRIPCION'] ?></td>
									</tr>
									<tr>
										<td>Nombre de Institucion:</td> 
										<td><?php echo $escolarizado['NOMBRE_INSTITUCION'] ?></td>
									</tr>
									<tr>

									</tr>
										<td>Rif de Institucion:</td>
										<td><?php echo $escolarizado['RIF_INSTITUCION'] ?></td>
									</tr>
								</table>
							</div>	
						</div>
					<?php endif ?>
						<!--Laborales-->
						<?php if ($trabajador != NULL && $lugar != NULL): ?>
							<div class="tabla">	
								<h1>Datos Laborales:</h1>
								<div class="info2">
									<table>
										<tr>
											<td class="column1">Nombre:</td> 
											<td><?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['NOMBRE'] ?> <?php endfor ?> </td>
										</tr>
										<tr>
											<td>Tipo:</td>
											<td><?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['TIPO'] ?> <?php endfor ?> </td>
										</tr>	
										<tr>
											<td>Tipo de Institucion:</td> 
											<td><?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['TIPO_INSTITUCION'] ?> <?php endfor ?> </td>
										</tr>
										<tr>
											<td>RIF:</td> <?php for ($i=0; $i < count($lugar); $i++): ?> <?php echo " | ".$lugar[$i]['RIF'] ?> <?php endfor ?> </td>
											<td>Descripcion: <?php for ($i=0; $i < count($trabajador); $i++): ?> <?php echo " | ".$trabajador[$i]['DESCRIPCION'] ?> <?php endfor ?> </td>
										</tr>
									</table>
								</div>	
							</div>				
						<?php endif ?>
						
						<!--Proteccion social-->
						
						<?php if ($proteccion != NULL || $bono != NULL ): ?>
							<div class="tabla">	
								<h1>Proteccion Social: </h1>
								<div class="info2">
									<table>
											<?php if ($proteccion != NULL): ?>
												<tr>
													<td class="column1">Programa Social:</td>
													<td><?php for ($i=0; $i < count($proteccion); $i++): ?> <?php echo " | ".$proteccion[$i]['NOMBRE'] ?> <?php endfor ?></td>
												</tr>
											<?php endif ?>
											<?php if ($bono != NULL): ?> 
												<tr>
												<td> Bono:</td> 
												<td><?php for ($i=0; $i < count($bono); $i++): ?> <?php echo " | ".$bono[$i]['NOMBRE_BONO'] ?><?php endfor?> </td> 
											<?php endif ?>	
									</table>
								</div>
							</div>
						<?php endif ?>	
						
					<!--Salud-->
					<?php if ($salud != NULL || $discapacitado != NULL): ?>
						<div class="tabla">
							<h1>Salud: </h1>
							<div class="info2">
								<table>
										<?php if ($salud != NULL): ?>
											<tr>
												<td class="column1">Enfermedad:</td> 
												<td><?php for ($i=0; $i < count($salud); $i++): ?> <?php echo " | ".$salud[$i]['NOMBRE_ENFERMEDAD'] ?> <?php endfor ?></td>
											</tr>
										<?php endif ?>
										<?php if ($discapacitado != NULL): ?>
											<tr>
												<td>Discapacidad:</td> 
												<td><?php for ($i=0; $i < count($discapacitado); $i++): ?><?php echo " | ".$discapacitado[$i]['TIPO_DISCAPACIDAD'] ?><?php endfor ?> </td> 
											</tr>
											<?php endif ?>
										
										<?php if ($receta != NULL && $salud != NULL): ?>
											<tr>
												<td>Medicamento:</td>
												<td><?php for ($i=0; $i < count($receta); $i++): ?> <?php echo  " | ".$receta[$i]['NOMBRE_MEDICAMENTO'] ?><?php endfor ?> </td>
											</tr>
											<tr>
												<td>Tipo de Medicamento:</td>
												<td><?php for ($i=0; $i < count($receta); $i++): ?> <?php echo " | ".$receta[$i]['TIPO_MEDICAMENTO'] ?><?php endfor ?> </td>
											</tr>
											<tr>
												<td>Descripcion:</td> 
												<td><?php for ($i=0; $i < count($receta); $i++): ?> <?php echo  " | ".$receta[$i]['DESCRIPCION'] ?><?php endfor ?> </td>
											</tr>

											<?php if ($ayuda != NULL): ?>
												<tr>
													<td>Ayuda tecnica:</td> 
													<td><?php for ($i=0; $i < count($ayuda); $i++): ?> <?php echo  " | ".$ayuda[$i]['TIPO_AYUDA'] ?><?php endfor ?> </td>
												</tr>
											<?php endif ?>
										<?php endif ?>
									</tr>
								</table>
							</div>	
						</div>
					<?php endif ?>
				</div>
			</div>
			<div class="centrar">
				<form style="display: inline" method="POST">
					<input type="submit" value="Cerrar" name="btn">
				</form>
				<a class="agregar" href="editperson.php?id= <?php echo $id ?>">
					<button type="submit" style="padding: 14px 19px">Editar</button>
				</a>
			</div>
				
		</div>	

		<?php include("includes/footer.php")?>
	</body>
</html>
