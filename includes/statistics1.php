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
		<input type="radio" id="a" name="nutricion" value="1">Desnutridos<br>
		<input type="radio" id="b" name="nutricion" value="4">Obesos

		<p id="text">Total de personas: </p><p id="total"></p>
		<p id="text1">Porcentaje: </p><p id="porcentaje"></p>
		<div id="result"><br>
			<table cellspacing="3" cellpadding="3" border="1">
				<thead id="head">
					<tr>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Genero</th>
						<th>Fecha de nacimiento</th>
						<th>Cedula</th>
						<th>Telefono</th>
						<th>Peso</th>
						<th>Estatura</th>
						<th>Familia</th>
						<th>Apartamento</th>
						<th>Bloque</th>
						<th>IMC</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
	</body>
</html>