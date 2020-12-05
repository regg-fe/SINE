<?php 

session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}

	$op = $_GET['op'];
	if (!isset($op)) {
		header("Location:leaders.php");
	}
	if (empty($op)) {
		header("Location:leaders.php");
	}

	if ($op == 1) {
		$result = "Lideres";
	}else if ($op == 2){
		$result = "Brigadistas";
	} else{
		header("Location:leaders.php");
	}
	$bloques = bloques();
	$con = conexion();

	$message = "";
	if (isset($_POST['btn'])) {
		switch ($op) {
			case 1:

				$nombre = $con->real_escape_string($_POST['nombre']);
				$apellido = $con->real_escape_string($_POST['apellido']);
				$dni = $con->real_escape_string($_POST['dni']);
				$telefono = $con->real_escape_string($_POST['telefono']);
				$id_bloque = $con->real_escape_string($_POST['id_bloque']);

				$r = repeatDNI($dni,$con,'lider');
				if ($r != 1) {
					$sql = "INSERT INTO lider (NOMBRES,APELLIDOS,DNI,TELEFONO,ID_BLOQUE) VALUES ('$nombre','$apellido','$dni','$telefono','$id_bloque')";
					$resultado = $con->query($sql);
					$con->close();
					header('Location:leaders.php');
				} else {
					$message = "El portador de esta cedula, ya esta registrado como lider";
				}
			break;
			
			case 2:
				$nombre = $con->real_escape_string($_POST['nombre']);
				$apellido = $con->real_escape_string($_POST['apellido']);
				$dni = $con->real_escape_string($_POST['dni']);
				$telefono = $con->real_escape_string($_POST['telefono']);
				$id_bloque = $con->real_escape_string($_POST['id_bloque']);

				$r = repeatDNI($dni,$con,'brigadista');
				if ($r == 0) {
					$sql = "INSERT INTO brigadista (NOMBRES,APELLIDOS,DNI,TELEFONO,ID_BLOQUE) VALUES ('$nombre','$apellido','$dni','$telefono','$id_bloque')";
					$resultado = $con->query($sql);
					$con->close();
					header('Location:leaders.php');
				} else {
					$message = "El portador de esta cedula, ya esta registrado como brigadista";
				}
			break;
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>SINE: <?php echo $result ?></title>
	<link rel="stylesheet" href="css/insertForms.css">
</head>
<body>
<?php require ('includes/navbar.php') ?>
	<div class="container">
		<div class="box-form">
			<form action="addleader.php?op=<?php echo $op ?>" method="POST">
				<h1>Registro de <?php echo $result ?></h1>
				<?php if (isset($message)): ?>
					<div class="error"><?php echo $message ?></div>
				<?php endif ?>
					
					<label for="nombre">Nombre:</label>
					<input type="text" name="nombre"> 
					<label for="apellido">Apellido:</label>
					<input type="text" name="apellido">
					<label for="dni">DNI:</label>
					<input type="text" name="dni" >
					<label for="telefono">Telefono:</label>
					<input type="text" name="telefono"> <br>
					<label for="id_bloque">Bloque al que pertenece:</label>
					<select class="select-css" name="id_bloque">
						<?php for ($i=0; $i <count($bloques) ; $i++): ?>
							<option value="<?php echo $bloques[$i]['ID']?>"><?php echo $bloques[$i]['NRO_BLOQUE']?></option>
						?<?php endfor; ?>	
					</select>
					<input type="submit" name="btn" value="Agregar">
			</form>
		</div>
		<a class="center" href="leaders.php" title="Volver">Volver</a>
	</div>
	<?php require ('includes/footer.php') ?>
</body>
</html>