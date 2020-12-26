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
		<input type="radio" id="j" name="vulvenables" value="13">Lactantes<br>
		<input type="radio" id="k" name="vulvenables" value="14">Adultos mayores<br>
		<input type="radio" id="s" name="vulvenables" value="15">Apartamentos con una sola persona

		<p id="text"></p>
		<p id="text1">Porcentaje: </p>
		<p id="text2"> </p>
		<div id="result"><br>
			<table cellspacing="3" cellpadding="3" border="1">
				<thead id="head">
					<tr>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th id="dni">Cedula</th>
						<th id="genero">Genero</th>
						<th id="fc">Fecha de Nacimiento</th>
						<th id="apa">Apartamento</th>
					</tr>
				</thead>
				<tbody id="body"></tbody>
			</table>
		</div>
	</body>
</html>