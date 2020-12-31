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
				<input type="radio" id="c" name="condiciones" value="2">
				<label for="c">Enfermos</label> 
				<input type="radio" id="d" name="condiciones" value="3">
				<label for="d"> Discapacitados</label>
				<input type="radio" id="e" name="condiciones" value="4">
				<label for="e"> Embarazadas</label>
				<input type="radio" id="f" name="condiciones" value="5">
				<label for="f"> Encamados</label>
			</div>

			<div class="info">
				<p id="text"></p>
				<p id="text1">Porcentaje: </p>
				<p id="text2"> </p>
			</div>
		<div id="result"><br>
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
												<th class="cell100 column3">Cedula</th>
												<th class="cell100 column9" id="h">Enfermedad/Discapacidad</th>
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