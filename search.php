<?php  
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Buscar</title>
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<link rel="stylesheet" href="css/styleTable.css">
	</head>
		<?php include("includes/navbar.php");?>
		<div class="welcome">
			<div class="search">
				<input type="text" id="search" placeholder="Buscar" autofocus>
				<button id="btn"><i class="fas fa-search"></i></button>
			</div>
		</div>
			
		<div class="container">
			<a class="center" href="home.php" title="Volver"><i class="fas fa-arrow-left"></i></a>
			<div id="wait">
				<p>¡Esperando busqueda!</p>
				<img src="img/undraw_people_search_wctu.svg" alt="busqueda">
			</div>
			<div id="mensaje" class="center"></div>
			<div id="result">
				<div class="container-table100">
					<div class="wrap-table100">	
						<div class="table100 ver1">
							<div class="wrap-table100 js-pscroll">
								<div class="table100-nextcols">
									<table>
										<thead id="head"></thead>
										<tbody id="body"></tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	


	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
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

