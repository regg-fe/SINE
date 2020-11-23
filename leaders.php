<?php  
	session_start();
	include_once 'database.php';
	include_once 'functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$lideres = lideres();
	$brigadistas = brigadistas();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Panel Central</title>
	</head>
	<body>
		<a href="home.php">Inicio</a>
		<a href="statistics.php">Estadisticas</a>
		<a href="#">Buscar</a>
		<a href="#">Nuevo Usuario</a>
		<a href="leaders.php">Lideres y Brigadistas</a>
		<a href="exit.php">Cerrar Sesión</a>
		
		<h1>Lideres y Brigadistas de la Comunidad</h1>
		<?php if (isset($lideres)): ?>
		<table cellspacing="3" cellpadding="3" border="1">
			<h2>Lideres</h2
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
					<td><?php echo $lideres[$i]['CEDULA']?></td>
					<td><?php echo $lideres[$i]['TELEFONO']?></td>
					<td><?php echo $lideres[$i]['NRO_BLOQUE']?></td>
					<td><a href="#"><button>...</button></a></td>
					<td><a href="#"><button>...</button></a></td>
					<?php endfor?>
				</tr>
			</tbody>
		</table>
		
	<?php endif ?>
	<td><a href="add_lider.php"><button>Agregar Lider</button></a></td>
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
					<td><?php echo $brigadistas[$i]['CEDULA']?></td>
					<td><?php echo $brigadistas[$i]['TELEFONO']?></td>
					<td><?php echo $brigadistas[$i]['NRO_BLOQUE']?></td>
					<td><a href="#"><button>...</button></a></td>
					<td><a href="#"><button>...</button></a></td>
					<?php endfor?>
				</tr>
			</tbody>
		</table>
		
	<?php endif ?>
	<td><a href="add_brigadista.php"><button>Agregar brigadista</button></a></td>

		<br><a href="home.php">Volver</a>
		<p>Ingeniera de Sistemas &copy;2020</p>
		<p>Version 0.1</p>
	</body>
</html>