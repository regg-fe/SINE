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
				<div class="radio-container">
					<input type="radio" id="g" name="proteccion">
					<label for="g"> Carnets</label>
					<p id="ga">
						<input type="radio" id="Ga" name="select" value="8">
						<label for="Ga"> Carnetizados</label>
					</p>
					<p id="gb">
						<input type="radio" id="Gb" name="select" value="9">
						<label for="Gb"> No carnetizados</label>
					</p>
				</div>
				<div class="radio-container">
					<input type="radio" id="i" name="proteccion">
					<label for="i">Pensionados</label> 
					<p id="ia">
						<input type="radio" id="Ia" name="select" value="10">
						<label for="Ia"> Amor Mayor</label>
					</p>
					<p id="ib">
						<input type="radio" id="Ib" name="select" value="11">
						<label for="Ib"> Seguro Social</label>
					</p>
					<p id="ic"><input type="radio" id="Ic" name="select" value="12">
					<label for="Ic"> No pensionados</label></p>
				</div>
			</div>

			<div class="info">
				<p id="text"></p>
				<p id="text1">Porcentaje: </p>
				<p id="text2"></p>
			</div>
			<br><center><div id="send" style="display: none;">Cargando...</div></center>
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