<?php  
	include_once 'functions.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="js/js.js"></script>
		<script type="text/javascript" src="js/statistics.js"></script>
	</head>
	
	<body>
		<div class="centrar">
			<div class="radio-statistic">
				<input type="radio" id="a" name="nutricion" value="1">
				<label for="a">Desnutricion</label>
				<input type="radio" id="b" name="nutricion" value="4">
				<label for="b">Obesidad</label>
			</div>
			<div class="info">
				<p id="text"></p>
				<p id="text1">Porcentaje: </p>
				<p id="text2"> </p>
			</div>
			<div id="result"><br>
				<div class='container-table100'>
					<div class='wrap-table100'>	
						<div class='table100 ver1'>
							<div class='wrap-table100 js-pscroll'>
								<div class='table100-nextcols'>
									<table>
										<thead id="head">
											<tr class='row100 head'>	
											
												<th class="cell100 column1">Nombres</th>
												<th class="cell100 column2">Apellidos</th>
												<th class="cell100 column3">Genero</th>
												<th class="cell100 column4">Fecha de nacimiento</th>
												<th class="cell100 column5">Cedula</th>
												<th class="cell100 column6">Telefono</th>
												<th class="cell100 column6">Peso</th>
												<th class="cell100 column6">Estatura</th>
												<th class="cell100 column6">IMC</th>
												<th class="cell100 column7">Familia</th>
												<th class="cell100 column8">Apartamento</th>
												<th class="cell100 column9">Bloque</th>
											</tr>
										</thead>
										<tbody id="body"></tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
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
	</body>
</html>