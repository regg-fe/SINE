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
		<input type="radio" id="c" name="condiciones" value="2">Enfermos<br>
		<input type="radio" id="d" name="condiciones" value="3">Discapacitados<br>
		<input type="radio" id="e" name="condiciones" value="4">Embarazadas<br>
		<input type="radio" id="f" name="condiciones" value="5">Encamados

		<p id="text"></p>
		<p id="text1">Porcentaje: </p>
		<p id="text2"> </p>
		<div id="result"><br>
			<table cellspacing="3" cellpadding="3" border="1">
				<thead id="head">
					<tr>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Cedula</th>
						<th id="h">Enfermedad/Discapacidad</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
	</body>
</html>