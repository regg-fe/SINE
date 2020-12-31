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
				<input type="radio" id="j" name="vulvenables" value="13">
				<label for="j">Lactantes</label> 
				<input type="radio" id="k" name="vulvenables" value="14">
				<label for="k"> Adultos mayores</label>
				<input type="radio" id="s" name="vulvenables" value="15">
				<label for="s">Apartamentos con una sola persona</label> 
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
												<th class="cell100 column3" id="dni">Cedula</th>
												<th class="cell100 column9" id="genero">Genero</th>
												<th class="cell100 column9" id="fc">Fecha de Nacimiento</th>
												<th class="cell100 column9" id="apa">Apartamento</th>
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