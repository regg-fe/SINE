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
	$familia = familia($id);
	if ($familia == NULL) {
		header('Location:home.php');
	}
	$integrantes = personasPorFamilia($id);
	$bombonas = bombonasPorFamilia($id);
	if ($bombonas == NULL) {
		$message1 = "Esta familia no posee bombonas asignadas";
	}
	$beneficios = registroBeneficiosPorFamilia($id);
	
	if ($beneficios == NULL) {
		$message = "Esta familia no ha recibido ningun sugerido";
	}
	$persona = persona($familia['ID_JEFE']);
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SINE | Familia: <?php echo $persona['APELLIDOS']?></title>
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" href="css/styleTable.css">
	</head>
	<body>
		<?php include("includes/navbar.php")?>
		<div class="welcome afamily-justify">
			<h1>Familia: <?php echo $persona['APELLIDOS']?></h1>
			<h3>Bloque: <?php echo $familia['NRO_BLOQUE']?>
			Apartamento: <?php echo $familia['NRO_APARTAMENTO']?> </h3>
			<a class="btn-welcome" href="#" id="changedir">Editar direccion</a>
		</div>
		<div class="container">
			<a class="center" href="families.php?id=<?php echo $familia['ID_APARTAMENTO']?>" title="Volver"><i class="fas fa-arrow-left"></i></a>
			<h1 class="center">Integrantes: </h1>
			
			<!-- PERSONAS -->
			<div class="container-table100">
					<div class="wrap-table100">	
						<div class="table100 ver1">

							<div class="wrap-table100-nextcols js-pscroll">
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
										<?php for ($i = 0; $i < count($integrantes); $i++): ?>
										<tbody>
											<tr class="row100 body">
												<td class="cell100 column1"><a target="_blank" href="aperson.php?id=<?php echo $integrantes[$i]['ID'] ?>"><?php echo $integrantes[$i]['NOMBRES'] ?></a></td>
												<td class="cell100 column2"><?php echo $integrantes[$i]['APELLIDOS'] ?></td>
												<td class="cell100 column3"><?php echo $integrantes[$i]['GENERO'] ?></td>
												<td class="cell100 column4"><?php echo $integrantes[$i]['DNI'] ?></td>
												<td class="cell100 column5"><?php echo $integrantes[$i]['POSICION'] ?></td>
												<td class="cell100 column6"><?php echo $integrantes[$i]['TELEFONO'] ?></td>
												<td class="cell100 column7"><?php echo $integrantes[$i]['FECHA_NAC'] ?></td>
												<td class="cell100 column8"><?php echo $integrantes[$i]['SERIAL_CARNET'] ?></td>
												<td class="cell100 column8"><?php echo $integrantes[$i]['CODIGO_CARNET'] ?></td>
											</tr>
										</tbody>
										<?php endfor ?>
									</table>
								</div>
							</div>
							<div class="table100-firstcol">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column9">Editar</th>
									<th class="cell100 column9">Eliminar</th>
								</tr>
							</thead>
							<?php for ($i = 0; $i < count($integrantes); $i++): ?>
							<tbody>
								<td class="cell100 column9"><a  class="icon" href="editperson.php?id=<?php echo $integrantes[$i]['ID']?>" title="Editar"><i class="fas fa-pen-alt"></i></a></td>
								<td class="cell100 column9"><a  class="icon" href="#" title="Eliminar" onclick="Confirmar(3, <?php echo $integrantes[$i]['ID'] ?>, <?php echo $id ?>)"><i class="fas fa-eraser"></i></a></td>
							</tbody>
							<?php endfor ?>
						</table>
					</div>
						</div>
						
					</div>
				</div>
				<a class="center" href="addpeople.php?id=<?php echo $familia['ID']?>"><button>Agregar Persona</button></a>

			<!-- PERSONAS -->
			
			<!-- BOMBONAS -->
			<h1 class="center">Bombonas: </h1>
			<?php if ($bombonas != NULL ): ?>
				<div class="container-table100">
					<div class="wrap-table100">	
						<div class="table100 ver1">
							<div class="wrap-table100 js-pscroll">
								<div class="table100-nextcols">
									<table>
										<thead>
											<tr class="row100 head">	
												<th class="cell100 column1">Tipo</th>
												<th class="cell100 column2">Marca</th>
												<th class="cell100 column9">Eliminar</th>
											</tr>
										</thead>
										<?php for ($i = 0; $i < count($bombonas); $i++): ?>
										<tbody>
											<tr class="row100 body"> 
												<td class="cell100 column1"><?php echo $bombonas[$i]['MARCA'] ?></td>
												<td class="cell100 column2"><?php echo $bombonas[$i]['TIPO'] ?></td>
												<td class="cell100 column9"><a class="icon" href="#" title="Eliminar" onclick="Confirmar(6, <?php echo $bombonas[$i]['ID'] ?>,0)"><i class="fas fa-eraser"></i></a></td>
											</tr>
										</tbody>
										<?php endfor ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<p class="center"><?php echo $message1 ?></p>
			<?php endif ?>
			<a class="center" href="#" id="changeB"><button>Agregar Bombona</button></a>
			<!-- BOMBONAS -->

			<!-- ENTREGAS -->
			<h1 class="center">Entrega de sugeridos: </h1>
			<?php if ($beneficios != NULL ): ?>
				<div class="container-table100">
					<div class="wrap-table100">	
						<div class="table100 ver1">
							<div class="wrap-table100 js-pscroll">
								<div class="table100-nextcols">
									<table>
										<thead>
											<tr class="row100 head">
												<th class="cell100 column1">Cantidad de Sugeridos</th>
												<th class="cell100 column2">Fecha de entrega</th>
												<th class="cell100 column9">Eliminar</th>
											</tr>
										</thead>
										<?php for ($i = 0; $i < count($beneficios); $i++): ?>
											<tbody>
											<tr>
												<td class="cell100 column1"><?php echo $beneficios[$i]['CANTIDAD'] ?></td>
												<td class="cell100 column2"><?php echo $beneficios[$i]['FECHA_ENTREGA'] ?></td>
												<td class="cell100 column9"><a class="icon" title="Eliminar" onclick="Confirmar(5, <?php echo $beneficios[$i]['ID'] ?>,0)"><i class="fas fa-eraser"></i></a></td>
											</tr>
										</tbody>
										<?php endfor ?>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<p class="center"><?php echo $message ?></p>
			<?php endif ?>	
			<a class="center" href="#" id="changeE"><button>Asignar Entrega</button></a>
			<!-- ENTREGAS -->
			
			<!-- MODALES -->
			<?php include("includes/modal.php") ?>
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
	<?php include("includes/footer.php")?>
