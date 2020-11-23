<!DOCTYPE html>
<html>
<head>
	<title>Sine: Agregar Brigadista</title>
</head>


<body>


<?php

		include_once 'database.php';
		require('functions.php');
		session_start();

	if (isset($_POST['enviar_briga'])) {
		
	
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	


		$nombre = $_POST['name_briga'];
		$apellido = $_POST['ape_briga'];
		$cedula = $_POST['cedu_briga'];
		$telefono = $_POST['tlf_briga'];
		$id = $_POST['numero_briga'];


		$resultado = $conexion->query("SELECT NOMBRES FROM brigadista WHERE CEDULA = '$cedula'"); 

				$row_count = $resultado->num_rows;

				if ($row_count >= 1) {
				
					echo "Error: La misma persona no puede ser brigadista de diferentes bloques o la persona ya se encuentra siendo brigadista." . "<br>";

						echo "<a href='leaders.php'> Volver </a>";

						exit();



				} else{

	
		$seql = "INSERT INTO brigadista(NOMBRES, APELLIDOS, TELEFONO, CEDULA, ID_BLOQUE) VALUES('$nombre', '$apellido', '$telefono', '$cedula', '$id')";

		$res = $conexion->query($seql);

		echo "brigadista agregado con éxito.";

		echo "<br>";
	}

}



		?>

<center>
<h2>Porfavor introduzca los datos requeridos a continuación</h2>
<form action="add_brigadista.php" method="post">
	
	Nombres <input type="text" name="name_briga"> <br>
	Apellidos <input type="text" name="ape_briga"> <br>
	Cedula <input type="text" name="cedu_briga"> <br>
	Número de Teléfono<input type="text" name="tlf_briga"> <br>
	Seleccione el bloque<select name="numero_briga">
		
		<option value="1">14</option>
			<option value="2">15</option>
				<option value="3">16</option>
					<option value="4">17</option>
						<option value="5">18</option>
							<option value="6">19</option>
								<option value="7">20</option>
									<option value="8">23</option>


	</select>
	<input type="submit" name="enviar_briga" value="Enviar">

</form>

</center>



</body>
</html>