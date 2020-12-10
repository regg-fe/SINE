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
		<input type="radio" id="c" name="enfermos" value="2">Enfermos<br>
		<input type="radio" id="d" name="enfermos" value="3">Discapacitados

		<p id="text"></p>
		<p id="text1">Porcentaje: </p>
		<p id="text2"> </p>
		<div id="result"><br>
			<table cellspacing="3" cellpadding="3" border="1">
				<thead id="head">
					<tr>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Enfermedad/Discapacidad</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
	</body>
</html>