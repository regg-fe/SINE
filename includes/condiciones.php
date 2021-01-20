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
			<center><div id="send" style="display: none;">Cargando...</div></center>
				<div class='container-table100'>
					<div class='wrap-table100'>
						<div class='table100 ver1'>
							<div class='wrap-table100 js-pscroll'>
								<div class='table100-nextcols'>
									
									<div id="result"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


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
	</body>
</html>