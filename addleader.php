<?php 

session_start();
	include_once 'database.php';
	include_once 'functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}

	if(isset($_GET['op'])){

 $op = $_GET['op'];
	
}	else{

	$op = $_POST['op'];
}

$result;



	if ($op == 1) {
		$result = "Lideres";
	}else if ($op == 2){
		$result = "Brigadistas";
	}
	else{
			header("leaders.php");

	}

	?>

<?php
	if (isset($_POST['envia_datos'])) {

		switch ($op) {

		case 1:
			
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$dni = $_POST['dni'];
			$telefono = $_POST['telefono'];
			$id_bloque = $_POST['id_bloque'];

			$conexion = conexion();

			$sql = "INSERT INTO lider (NOMBRES, APELLIDOS, DNI, TELEFONO, ID_BLOQUE) VALUES ('$nombre', '$apellido', '$dni', '$telefono', '$id_bloque')";

			$resultado = $conexion->query($sql);


			echo "Lider agregado con exito";


			break;
		
		case 2:
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$dni = $_POST['dni'];
			$telefono = $_POST['telefono'];
			$id_bloque = $_POST['id_bloque'];

				$sql = "INSERT INTO brigadista (NOMBRES, APELLIDOS, DNI, TELEFONO, ID_BLOQUE) VALUES ('$nombre', '$apellido', '$dni', '$telefono', '$id_bloque')";

			$resultado = $conexion->query($sql);


			echo "Brigadista agregado con exito";
			
			break;
	}

	
	}
?>


<!DOCTYPE html>
<html>
<head>
	<?php if (isset($result)):?>
	<title>SINE: <?php echo $result ?></title>
	<?php endif;?>
</head>
<body>


	<center>
	<form action="addleader.php" method="post">
		<p><?php echo $result ?><p>

			Nombre: &nbsp; <input type="text" name="nombre" required> <br>
			Apellido: &nbsp;<input type="text" name="apellido" required> <br>
			DNI: &nbsp;<input type="text" name="dni" required> <br>
			Telefono: &nbsp;<input type="text" name="telefono"> <br>
			
			Bloque al que pertenece: &nbsp;<select name="id_bloque">
				
				<option value="1">14</option>
					<option value="2">15</option>
						<option value="3">16</option>
							<option value="4">17</option>
								<option value="5">18</option>
									<option value="6">19</option>
										<option value="7">20</option>
											<option value="8">23</option>
				</option>
			</select>

		
			<input type= "hidden" name="op" value="<?php echo $op ?>">

			<input type="submit" name="envia_datos" value="Enviar">



	</form>
		</center>

</body>
</html>