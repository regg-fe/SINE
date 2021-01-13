<?php  
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$id = $_GET['id'];
	if (empty($id)) {
		header("Location:home.php");
	}
	$nro_ap = apartamento($id)['NRO_APARTAMENTO'];
	$id_ap = $id;
	$id_bl = apartamento($id)['ID_BLOQUE'];
	$a = apartamento($id)['ANEXO'];
	$apartamento = apartamento($id);
	$familias = familiasPorApartamento($apartamento['ID']);
	if ($apartamento == NULL) {
		header("Location:home.php");
	}
	$personas;
	if (isset($familias)) {
		for ($i=0; $i < count($familias); $i++) {
			$p = personasPorFamilia($familias[$i]['ID']);
			if (isset($p[0])) {
				for ($j=0; $j < count($p); $j++) { 
					$personas[$i][$j] = $p[$j];
				}
			}	
		}
	}
?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Grupo Familiar</title>
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" type="text/css" href="css/styleshome.css">
		<link rel="stylesheet" href="css/styleTable.css">
	</head>
	<body>
		<?php include("includes/navbar.php");?>
			<div class="welcome">
				<?php if ($a == 'S'): ?>
				<h1>Anexo <?php echo $nro_ap ?></h1>
				<?php else: ?>
				<h1>Apartamento <?php echo $nro_ap ?></h1>
				<?php endif ?>
				</div> 
				<div class="container">
					<div class="center Btn-menu">
					<a class="left" href="apartments.php?id=<?php echo $id_bl ?>" title="Volever"><i class="fas fa-arrow-left"></i></a>
					<a href="addfamily.php?apartamento=<?php echo $id_ap ?>"><button>Agregar Familia</button></a>
					</div>	

					<?php if ($familias != null && isset($personas)): ?>
						<?php for ($i = 0; $i < count($familias); $i++):  ?>
							<?php if (isset($personas[$i])): ?>
			
								<div class="center">
									<h2>Familia <?php echo $personas[$i][0]['FAMILIA'] ?></h2>
									<a class="btn-families" href="afamily.php?id=<?php echo $familias[$i]['ID']?>" title="Ver detalles de la familia"><i class="fas fa-info-circle"></i></a>
									<a class="btn-families" href="#" title="Eliminar Familia" onclick="Confirmar(4, <?php echo $familias[$i]['ID'] ?>, <?php echo $id_ap ?>)"><i class="fas fa-eraser"></i></a>
								</div>
								
								<div class="container-table100">
									<div class="wrap-table100">	
										<div class="table100 ver1">
											<div class="wrap-table100 js-pscroll">
												<div class="table100-nextcols">
													<table>
														<thead>
															<tr class="row100 head">
																<th class="cell100 column1">Nombres</th>
																<th class="cell100 column2">Apellidos</th>
																<th class="cell100 column3">Genero</th>
																<th class="cell100 column4">DNI</th>
																<th class="cell100 column5">Jefe de familia</th>
																<th class="cell100 column6">Telefono</th>
																<th class="cell100 column7">Fecha de nacimiento</th>
																<th class="cell100 column8">Serial del Carnet de la Patria</th>
																<th class="cell100 column8">Codigo del Carnet de la Patria</th>
															</tr>
														</thead>

														<?php for ($j = 0; $j < count($personas[$i]); $j++): ?>
															<tbody>
																<tr class="row100 body">
																	<td class="cell100 column1"><?php echo $personas[$i][$j]['NOMBRES'] ?></td>
																	<td class="cell100 column2"><?php echo $personas[$i][$j]['APELLIDOS'] ?></td>
																	<td class="cell100 column3"><?php echo $personas[$i][$j]['GENERO'] ?></td>
																	<td class="cell100 column4"><?php echo $personas[$i][$j]['DNI'] ?></td>
																	<td class="cell100 column5"><?php echo $personas[$i][$j]['POSICION'] ?></td>
																	<td class="cell100 column6"><?php echo $personas[$i][$j]['TELEFONO'] ?></td>
																	<td class="cell100 column7"><?php echo $personas[$i][$j]['FECHA_NAC'] ?></td>
																	<td class="cell100 column8"><?php echo $personas[$i][$j]['SERIAL_CARNET'] ?></td>
																	<td class="cell100 column8"><?php echo $personas[$i][$j]['CODIGO_CARNET'] ?></td>
																</tr>
															</tbody>
														<?php endfor ?>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
					<?php endif ?>
				<?php endfor ?>
					<?php else: echo "<h3 class='center'>No hay familias asignadas a este apartamento</h3>" ?>			
				<?php endif ?>
		</div>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})

		});
		
	</script>
	<?php include("includes/modal.php")?>
	<?php include("includes/footer.php")?>