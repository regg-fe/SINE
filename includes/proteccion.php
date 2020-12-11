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
		<input type="radio" id="g" name="proteccion">Carnets<br>
		<p id="ga">&nbsp;&nbsp;<input type="radio" id="ga" name="carnets" value="8">Carnetizados</p>
		<p id="gb">&nbsp;&nbsp;<input type="radio" id="ga" name="carnets" value="9">No carnetizados</p>

		<input type="radio" id="i" name="proteccion">Pensionados<br>
		<p id="ia">>&nbsp;&nbsp;<input type="radio" id="ia" name="pension" value="9">Amor Mayor</p>
		<p id="ib">>&nbsp;&nbsp;<input type="radio" id="ib" name="pension" value="9">Seguro Social</p>
		<p id="ic">>&nbsp;&nbsp;<input type="radio" id="ic" name="pension" value="9">No pensionados</p>

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
						<th id="serial">Serial del Carnet</th>
						<th id="codigo">Codigo del Carnet</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
	</body>
</html>