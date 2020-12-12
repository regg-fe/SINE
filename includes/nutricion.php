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
		<input type="radio" id="a" name="nutricion" value="1">Desnutricion<br>
		<input type="radio" id="b" name="nutricion" value="4">Obesidad

		<p id="text"></p>
		<p id="text1">Porcentaje: </p>
		<p id="text2"> </p>
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
						<th>IMC</th>
						<th>Familia</th>
						<th>Apartamento</th>
						<th>Bloque</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
	</body>
</html>