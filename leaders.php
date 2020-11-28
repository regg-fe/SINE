<?php  
	session_start();
	include_once 'includes/database.php';
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$lideres = lideres();
	$brigadistas = brigadistas();
	
	if (isset($_POST['message'])) {
		$message = $_POST['message'];
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Lideres y Brigadistas</title>
		<link rel="stylesheet" type="text/css" href="css/styleshome.css">
	</head>
	<body>
	<?php include("includes/navbar.php");?>
		
		<h1>Lideres y Brigadistas de la Comunidad</h1>
		<?php if (isset($lideres)): ?>
		<table cellspacing="3" cellpadding="3" border="1">
			<h2>Lideres</h2>
			<thead>
				<tr>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>CI</th>
					<th>Telefono</th>
					<th>Bloque</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php for($i = 0; $i < count($lideres); $i++): ?>
					<td><?php echo $lideres[$i]['NOMBRES']?></td>
					<td><?php echo $lideres[$i]['APELLIDOS']?></td>
					<td><?php echo $lideres[$i]['DNI']?></td>
					<td><?php echo $lideres[$i]['TELEFONO']?></td>
					<td><?php echo $lideres[$i]['NRO_BLOQUE']?></td>
					<td><a href="#"><button>...</button></a></td>
					<td><a href="delete.php?op=1&id=<?php echo $lideres[$i]['ID'] ?>"><button>...</button></a></td>	
				</tr>
			</tbody>
				<?php endfor?>
		</table>
		
	<?php endif ?>
	<td><a href="addleader.php?op=1"><button>Agregar Lider</button></a></td>
		<?php if (isset($brigadistas)): ?>
		<table cellspacing="3" cellpadding="3" border="1">
			<h2>Brigadistas</h2>
			<thead>
				<tr>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>CI</th>
					<th>Telefono</th>
					<th>Bloque</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php for($i = 0; $i < count($brigadistas); $i++): ?>
					<td><?php echo $brigadistas[$i]['NOMBRES']?></td>
					<td><?php echo $brigadistas[$i]['APELLIDOS']?></td>
					<td><?php echo $brigadistas[$i]['DNI']?></td>
					<td><?php echo $brigadistas[$i]['TELEFONO']?></td>
					<td><?php echo $brigadistas[$i]['NRO_BLOQUE']?></td>
					<td><a href="#"><button>...</button></a></td>
					<td><a href="delete.php?op=2&id=<?php echo $brigadistas[$i]['ID'] ?>"><button>...</button></a></td>
				</tr>
			</tbody>
			<?php endfor?>
		</table>
	
	<?php endif ?>
	<td><a href="addleader.php?op=2"><button>Agregar brigadista</button></a></td>

		<br><a href="home.php">Volver</a>
		<?php include("includes/footer.php")?>
	</body>
</html>