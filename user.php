<?php  
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$usuarios = usuarios();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Usuarios</title>
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" type="text/css" href="css/styleshome.css">
		<link rel="stylesheet" href="css/styleTable.css">
	</head>
	<body>
	<?php include("includes/navbar.php") ?>
	<div class="welcome">
		<h1>Usuarios del Sistema</h1>
	</div>
	<div class="container">
		<a class="center" href="home.php" title="Volver"><i class="fas fa-arrow-left"></i></a>
				<h2 class="center">Usuarios</h2>
				<div class="container-table100">
					<div class="wrap-table100">	
						<div class="table100 ver1">
							<div class="wrap-table100 js-pscroll">
								<div class="table100-nextcols">
									<table>
										<thead>
											<tr class="row100 head">
												<th class="cell100 column2">Usuario</th>
												<th class="cell100 column4">Nombre</th>
												<th class="cell100 column3">Apelldio</th>
												<th class="cell100 column3">Editar</th>
												<th class="cell100 column3">Eliminar</th>
											</tr>
										</thead>
										<tbody>
											<tr class="row100 body">
												<?php for($i = 0; $i < count($usuarios); $i++): ?>
												<td class="cell100 column2"><?php echo $usuarios[$i]['USUARIO']?></td>
												<td class="cell100 column4"><?php echo $usuarios[$i]['NOMBRE']?></td>
												<td class="cell100 column3"><?php echo $usuarios[$i]['APELLIDO']?></td>
												<td class="cell100 column3"><a class="icon" href="#" title="Editar"><i class="fas fa-pen-alt"></i></a></td>
												<td class="cell100 column3"><a class="icon" href="delete.php?op=7&id=<?php echo $usuarios[$i]['ID'] ?>" title="Eliminar"><i class="fas fa-eraser"></i></a></td>	
											</tr>
										</tbody>
											<?php endfor?>
									</table>
									</div>
								</div>
							</div>
						</div>
					</div>
		<a class="center" href="adduser.php"><button>Agregar Usuario</button></a>
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