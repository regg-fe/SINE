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
		<p id="gc">&nbsp;&nbsp;<input type="radio" id="ga" name="select" value="8">Carnetizados</p>
		<p id="gd">&nbsp;&nbsp;<input type="radio" id="gb" name="select" value="9">No carnetizados</p>

		<input type="radio" id="i" name="proteccion">Pensionados<br>
		<p id="id">&nbsp;&nbsp;<input type="radio" id="ia" name="select" value="10">Amor Mayor</p>
		<p id="ie">&nbsp;&nbsp;<input type="radio" id="ib" name="select" value="11">Seguro Social</p>
		<p id="if">&nbsp;&nbsp;<input type="radio" id="ic" name="select" value="12">No pensionados</p>

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
						<th id="pension">Tipo de pension</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
	</body>
</html>