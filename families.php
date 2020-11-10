<?php  
	session_start();
	include_once 'database.php';
	include_once 'functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$id = $_GET['id'];
	if (empty($id)) {
		header("Location:home.php");
	}
	$nro_ap = apartamento($id)['NRO_APARTAMENTO'];
	$id_ap = $id;
	$id_bl = apartamento($id)['ID_BLOQUE'];
	$apartamento = apartamento($id);
	$familias = familiasPorApartamento($apartamento['ID']);
	if ($apartamento == NULL) {
		header("Location:home.php");
	}
	$personas;
	if (isset($familias)) {
		for ($i=0; $i < count($familias); $i++) {
			$p = personasPorFamilia($familias[$i]['ID']);
			if (isset($p[$i])) {
				for ($j=0; $j < count($p); $j++) { 
					$personas[$i][$j] = $p[$j];
				}
			}	
		}
	}
?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Grupo Familiar</title>
	</head>
	<body>
		<a href="home.php">Inicio</a>
		<a href="statistics.php">Estadisticas</a>
		<a href="#">Buscar</a>
		<a href="exit.php">Cerrar Sesión</a>
		<h1>Apartamento <?php echo $nro_ap ?></h1>
			<?php if ($familias != null && isset($personas)): ?>
				<?php for ($i = 0; $i < count($familias); $i++):  ?>
					<?php if (isset($personas[$i])): ?> 
						<a href="afamily.php?id=<?php echo $familias[$i]['ID']?>" target="_blank"><h2>Familia <?php echo $personas[$i][0]['FAMILIA'] ?></h2></a>
						<table cellspacing="3" cellpadding="3" border="1">
							<thead>
								<tr>
									<th>Nombres</th>
									<th>Apellidos</th>
									<th>Genero</th>
									<th>DNI</th>
									<th>Jefe de familia</th>
									<th>Telefono</th>
									<th>Fecha de nacimiento</th>
									<th>Serial del Carnet de la Patria</th>
									<th>Codigo del Carnet de la Patria</th>
									<th>Editar</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							
							<?php for ($j = 0; $j < count($personas[$i]); $j++): ?>
								<tbody>
									<tr>
										<td><a target="_blank" href="aperson.php?id=<?php echo $personas[$i][$j]['ID'] ?>"><?php echo $personas[$i][$j]['NOMBRES'] ?></a></td>
										<td><?php echo $personas[$i][$j]['APELLIDOS'] ?></td>
										<td><?php echo $personas[$i][$j]['GENERO'] ?></td>
										<td><?php echo $personas[$i][$j]['DNI'] ?></td>
										<td><?php echo $personas[$i][$j]['POSICION'] ?></td>
										<td><?php echo $personas[$i][$j]['TELEFONO'] ?></td>
										<td><?php echo $personas[$i][$j]['FECHA_NAC'] ?></td>
										<td><?php echo $personas[$i][$j]['SERIAL_CARNET'] ?></td>
										<td><?php echo $personas[$i][$j]['CODIGO_CARNET'] ?></td>
										<td><a href="#"><button>...</button></a></td>
										<td><a href="#"><button>...</button></a></td>
									</tr>
								</tbody>
							<?php endfor ?>
						</table>
					<?php endif ?>
				<?php endfor ?>
			<?php else: echo "No hay familias asignadas a este apartamento"; ?>
			<?php endif?>
		<a href="#"><button>Agregar Familia</button></a>
		<a href="apartments.php?id=<?php echo $id_bl ?>">Volver</a>
		<p>Ingeniera de Sistemas &copy;2020</p>
		<p><?php echo $version; ?></p>
	</body>
</html>