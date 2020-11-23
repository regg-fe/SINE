<!DOCTYPE html>
<html>
<head>
	<title>Sine: Agregar Lider</title>
</head>


<body>


<?php

		include_once 'database.php';
		require('functions.php');
		session_start();

	if (isset($_POST['enviar_lider'])) {
		
	
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	


		$nombre = $_POST['name_lider'];
		$apellido = $_POST['ape_lider'];
		$cedula = $_POST['cedu_lider'];
		$telefono = $_POST['tlf_lider'];
		$id = $_POST['numero_bloque'];


		$resultado = $conexion->query("SELECT NOMBRES FROM lider WHERE CEDULA = '$cedula'"); 

				$row_count = $resultado->num_rows;

				if ($row_count >= 1) {
				
					echo "Error: La misma persona no puede ser lider en diferentes bloques, o la persona que se agregó ya es lider." . "<br>";

						echo "<a href='leaders.php'> Volver </a>";

						exit();

					}

				else{

	
		$seql = "INSERT INTO lider(NOMBRES, APELLIDOS, CEDULA, TELEFONO, ID_BLOQUE) VALUES('$nombre', '$apellido', '$cedula', '$telefono', '$id')";

		$res = $conexion->query($seql);

		echo "lider agregado con éxito.";

		echo "<br>";
	}

}



		?>

<center>
<h2>Porfavor introduzca los datos requeridos a continuación</h2>
<form action="add_lider.php" method="post">
	
	Nombres <input type="text" name="name_lider"> <br>
	Apellidos <input type="text" name="ape_lider"> <br>
	Cedula <input type="text" name="cedu_lider"> <br>
	Número de Teléfono<input type="text" name="tlf_lider"> <br>
	Seleccione el bloque<select name="numero_bloque">
		
		<option value="1">14</option>
			<option value="2">15</option>
				<option value="3">16</option>
					<option value="4">17</option>
						<option value="5">18</option>
							<option value="6">19</option>
								<option value="7">20</option>
									<option value="8">23</option>


	</select>
	<input type="submit" name="enviar_lider" value="Enviar">

</form>

</center>



</body>
</html>