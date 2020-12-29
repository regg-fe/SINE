<?php 
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}

	$op = $_GET['op'];
	$id = $_GET['id'];
	if (!isset($op)) {
		header("Location:leaders.php");
	}
	if (empty($op)) {
		header("Location:leaders.php");
	}

	if (!isset($id)) {
			header("Location:leaders.php");
		}
	if (empty($id)) {
			header("Location:leaders.php");
		}

	$bloques = bloques();
	$con = conexion();
	$message = "";
	switch ($op) {
		case 1:
			$r = "Lider";
			$con = conexion();
			$sql = "SELECT * FROM LIDER WHERE ID = '$id'";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
				$a = 0;
				while ($row = $result->fetch_assoc()) {
					$muestra[$a]['ID'] = $row['ID'];
					$muestra[$a]['NOMBRES'] = $row['NOMBRES'];
					$muestra[$a]['APELLIDOS'] = $row['APELLIDOS'];
					$muestra[$a]['DNI'] = $row['DNI'];
					$muestra[$a]['TELEFONO'] = $row['TELEFONO'];
					$muestra[$a]['ID_BLOQUE'] = $row['ID_BLOQUE'];
					$a++;
				}
			} else {
				header("Location:leaders.php");
			}
			$con->close();
		break;

			case 2:
				$r = "Brigadistas";
				$con = conexion();
				$sql = "SELECT * FROM BRIGADISTA WHERE ID = '$id'";
				$result = $con->query($sql);

				if ($result->num_rows > 0) {
					$a = 0;
					while ($row = $result->fetch_assoc()) {
						$muestra[$a]['ID'] = $row['ID'];
						$muestra[$a]['NOMBRES'] = $row['NOMBRES'];
						$muestra[$a]['APELLIDOS'] = $row['APELLIDOS'];
						$muestra[$a]['DNI'] = $row['DNI'];
						$muestra[$a]['TELEFONO'] = $row['TELEFONO'];
						$muestra[$a]['ID_BLOQUE'] = $row['ID_BLOQUE'];
						$a++;
					}
				} else {
				header("Location:leaders.php");
			}
			$con->close();
		break;

		default:
			header("Location:leaders.php");
		break;
	}

	if (isset($_POST['btn'])) {
		$con = conexion();
		switch ($op) {
			case 1:
				$id = $con->real_escape_string($_POST['id']);
				$nombre = $con->real_escape_string($_POST['nombre']);
				$apellido = $con->real_escape_string($_POST['apellido']);
				$dni = $con->real_escape_string($_POST['dni']);
				$telefono = $con->real_escape_string($_POST['telefono']);
				$id_bloque = $con->real_escape_string($_POST['id_bloque']);

				$sql = "UPDATE LIDER SET NOMBRES = '$nombre', APELLIDOS = '$apellido', DNI = '$dni', TELEFONO = '$telefono', ID_BLOQUE = '$id_bloque' WHERE ID = '$id'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				header('Location:leaders.php');
			break;
			
			case 2:
				$id = $con->real_escape_string($_POST['id']);
				$nombre = $con->real_escape_string($_POST['nombre']);
				$apellido = $con->real_escape_string($_POST['apellido']);
				$dni = $con->real_escape_string($_POST['dni']);
				$telefono = $con->real_escape_string($_POST['telefono']);
				$id_bloque = $con->real_escape_string($_POST['id_bloque']);

				$sql = "UPDATE BRIGADISTA SET NOMBRES = '$nombre', APELLIDOS = '$apellido', DNI = '$dni', TELEFONO = '$telefono', ID_BLOQUE = '$id_bloque' WHERE ID = '$id'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));
				}
				$con->close();
				header('Location:leaders.php');
			break;

		default:
			$con->close();
			header("Location:leaders.php");
		break;
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>SINE: <?php echo $r ?></title>
	<link rel="stylesheet" href="css/insertForms.css">
</head>
<body>
<?php require ('includes/navbar.php') ?>
	<div class="container">
		<a class="center" href="leaders.php" title="Volver"><i class="fas fa-arrow-left"></i></a>
		<div class="box-form">
			<form  action="editleader.php?op=<?php echo $op ?>&id=<?php echo $id ?>" method="POST">
				<h1>Actualizar datos de <?php echo $r ?></h1>
				<?php if (isset($message)): ?>
					<div class="error"><?php echo $message ?></div>
				<?php endif ?>
					
					<label for="nombre">Nombre:</label>
					<input type="hidden" name="id" value="<?php echo $muestra[0]['ID'] ?>"> 
					<input type="text" name="nombre" value="<?php echo $muestra[0]['NOMBRES'] ?>"> 
					<label for="apellido">Apellido:</label>
					<input type="text" name="apellido" value="<?php echo $muestra[0]['APELLIDOS'] ?>">
					<label for="dni">Cedula:</label>
					<input type="text" name="dni" value="<?php echo $muestra[0]['DNI'] ?>">
					<label for="telefono">Telefono:</label>
					<input type="text" name="telefono" value="<?php echo $muestra[0]['TELEFONO'] ?>"> <br>
					<label for="id_bloque">Bloque al que pertenece:</label>
					<select class="select-css" name="id_bloque">
						<?php for ($i=0; $i <count($bloques); $i++): ?>
							<option value="<?php echo $bloques[$i]['ID']?>"><?php echo $bloques[$i]['NRO_BLOQUE']?></option>
						<?php endfor; ?>
					</select>
					<input type="submit" name="btn" value="Actualizar">
			</form>
		</div>
	</div>
	<?php require ('includes/footer.php') ?>
</body>
</html>