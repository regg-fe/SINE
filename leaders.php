<?php  
	session_start();
	include_once 'includes/database.php';
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$lideres = lideres();
	$brigadistas = brigadistas();
	
	if (isset($_POST['message'])) {
		$message = $_POST['message'];
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Lideres y Brigadistas</title>
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" type="text/css" href="css/styleshome.css">
		<link rel="stylesheet" href="css/styleTable.css">
	</head>
	<body>
	<?php include("includes/navbar.php");?>
	<div class="welcome">
		<h1>Lideres y Brigadistas de la Comunidad</h1>
	</div>
	<div class="container">
	<a class="center" href="home.php">Volver</a>
		<?php if (isset($lideres)): ?>
			<h2 class="center">Lideres</h2>
			<div class="container-table100">
				<div class="wrap-table100">	
					<div class="table100 ver1">
						<div class="wrap-table100 js-pscroll">
							<div class="table100-nextcols">
								<table>
									<thead>
										<tr class="row100 head">
											<th class="cell100 column2">Nombres</th>
											<th class="cell100 column4">Apellidos</th>
											<th class="cell100 column3">CI</th>
											<th class="cell100 column3">Telefono</th>
											<th class="cell100 column3">Bloque</th>
											<th class="cell100 column3">Editar</th>
											<th class="cell100 column3">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<tr class="row100 body">
											<?php for($i = 0; $i < count($lideres); $i++): ?>
											<td class="cell100 column2"><?php echo $lideres[$i]['NOMBRES']?></td>
											<td class="cell100 column4"><?php echo $lideres[$i]['APELLIDOS']?></td>
											<td class="cell100 column3"><?php echo $lideres[$i]['DNI']?></td>
											<td class="cell100 column3"><?php echo $lideres[$i]['TELEFONO']?></td>
											<td class="cell100 column3"><?php echo $lideres[$i]['NRO_BLOQUE']?></td>
											<td class="cell100 column3"><a class="icon" href="#" title="Editar"><i class="fas fa-pen-alt"></i></a></td>
											<td class="cell100 column3"><a class="icon" href="delete.php?op=1&id=<?php echo $lideres[$i]['ID'] ?>" title="Eliminar"><i class="fas fa-eraser"></i></a></td>	
										</tr>
									</tbody>
										<?php endfor?>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
		
	<?php endif ?>
	<a class="center" href="addleader.php?op=1"><button>Agregar Lider</button></a>
		<?php if (isset($brigadistas)): ?>
			<h2 class="center">Brigadistas</h2>
			<div class="container-table100">
				<div class="wrap-table100">	
					<div class="table100 ver1">
						<div class="wrap-table100 js-pscroll">
							<div class="table100-nextcols">
								<table>
									<thead>
										<tr class="row100 head">
											<th class="cell100 column2">Nombres</th>
											<th class="cell100 column4">Apellidos</th>
											<th class="cell100 column3">CI</th>
											<th class="cell100 column3">Telefono</th>
											<th class="cell100 column3">Bloque</th>
											<th class="cell100 column3">Editar</th>
											<th class="cell100 column3">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										<tr class="row100 body">
											<?php for($i = 0; $i < count($brigadistas); $i++): ?>
											<td class="cell100 column2"><?php echo $brigadistas[$i]['NOMBRES']?></td>
											<td class="cell100 column4"><?php echo $brigadistas[$i]['APELLIDOS']?></td>
											<td class="cell100 column3"><?php echo $brigadistas[$i]['DNI']?></td>
											<td class="cell100 column3"><?php echo $brigadistas[$i]['TELEFONO']?></td>
											<td class="cell100 column3"><?php echo $brigadistas[$i]['NRO_BLOQUE']?></td>
											<td class="cell100 column3"><a class="icon" href="#" title="Editar"><i class="fas fa-pen-alt"></i></a></td>
											<td class="cell100 column3"><a class="icon" href="delete.php?op=2&id=<?php echo $brigadistas[$i]['ID'] ?>" title="Eliminar"><i class="fas fa-eraser"></i></a></td>
										</tr>
									</tbody>
									<?php endfor?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
	
	<?php endif ?>
	<a class="center" href="addleader.php?op=2"><button>Agregar brigadista</button></a>
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
	</body>
</html>