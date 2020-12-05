<?php 
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$id = $_GET['id'];
	if (!isset($id)) {
		header("Location:families.php");
	}
	if (empty($id)) {
		header("Location:home.php");
	}
	$familia = familia($id);
	if ($familia == NULL) {
		header('Location:home.php');
	}
	$integrantes = personasPorFamilia($id);
	$bombonas = bombonasPorFamilia($id);
	if ($bombonas == NULL) {
		$message1 = "Esta familia no posee bombonas asignadas";
	}
	$beneficios = registroBeneficiosPorFamilia($id);
	
	if ($beneficios == NULL) {
		$message = "Esta familia no ha recibido ningun sugerido";
	}
	$persona = persona($familia['ID_JEFE']);
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SINE | Familia: <?php echo $persona['APELLIDOS']?></title>
	</head>
	<body>
		<?php include("includes/navbar.php")?>
		<p>Familia: <?php echo $persona['APELLIDOS']?></p>
		<p>Bloque: <?php echo $familia['NRO_BLOQUE']?></p>
		<p>Apartamento: <?php echo $familia['NRO_APARTAMENTO']?> </p>
		<a href="#" id="changedir"><button>Editar direccion</button></a>
		<h1>Integrantes: </h1><a href="#"><button>Agregar Persona</button></a>
		
		<!-- PERSONAS -->
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
			<?php for ($i = 0; $i < count($integrantes); $i++): ?>
			<tbody>
				<tr>
					<td><a target="_blank" href="aperson.php?id=<?php echo $integrantes[$i]['ID'] ?>"><?php echo $integrantes[$i]['NOMBRES'] ?></a></td>
					<td><?php echo $integrantes[$i]['APELLIDOS'] ?></td>
					<td><?php echo $integrantes[$i]['GENERO'] ?></td>
					<td><?php echo $integrantes[$i]['DNI'] ?></td>
					<td><?php echo $integrantes[$i]['POSICION'] ?></td>
					<td><?php echo $integrantes[$i]['TELEFONO'] ?></td>
					<td><?php echo $integrantes[$i]['FECHA_NAC'] ?></td>
					<td><?php echo $integrantes[$i]['SERIAL_CARNET'] ?></td>
					<td><?php echo $integrantes[$i]['CODIGO_CARNET'] ?></td>
					<td><a href="#" title="Editar">...</a></td>
					<td><a href="delete.php?op=3&id=<?php echo $integrantes[$i]['ID'] ?>&f=<?php echo $id ?>" title="Eliminar">...</a></td>
				</tr>
			</tbody>
			<?php endfor ?>
		</table>
		<!-- PERSONAS -->
		
		<!-- BOMBONAS -->
		<h1>Bombonas: </h1><a href="#" id="changeB"><button>Agregar Bombona</button></a>
		<?php if ($bombonas != NULL ): ?>
			<table cellspacing="3" cellpadding="3" border="1">
				<thead>
					<tr>
						<th>Tipo</th>
						<th>Marca</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<?php for ($i = 0; $i < count($bombonas); $i++): ?>
				<tbody>
					<tr>
						<td><?php echo $bombonas[$i]['MARCA'] ?></td>
						<td><?php echo $bombonas[$i]['TIPO'] ?></td>
						<td><a href="delete.php?op=6&id=<?php echo $bombonas[$i]['ID'] ?>&f=<?php echo $id ?>" title="Eliminar">...</a></td>
					</tr>
				</tbody>
				<?php endfor ?>
			</table>
		<?php else: ?>
			<p><?php echo $message1 ?></p>
		<?php endif ?>
		<!-- BOMBONAS -->

		<!-- ENTREGAS -->
		<h1>Entrega de sugeridos: </h1><a href="#" id="changeE"><button>Asignar Entrega</button></a>
		<?php if ($beneficios != NULL ): ?>
			<table cellspacing="3" cellpadding="3" border="1">
				<thead>
					<tr>
						<th>Cantidad de Sugeridos</th>
						<th>Fecha de entrega</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<?php for ($i = 0; $i < count($beneficios); $i++): ?>
					<tbody>
					<tr>
						<td><?php echo $beneficios[$i]['CANTIDAD'] ?></td>
						<td><?php echo $beneficios[$i]['FECHA_ENTREGA'] ?></td>
						<td><a href="delete.php?op=5&id=<?php echo $beneficios[$i]['ID'] ?>&f=<?php echo $id ?>" title="Eliminar">...</a></td>
					</tr>
				</tbody>
				<?php endfor ?>
			</table>
		<?php else: ?>
			<p><?php echo $message ?></p>
		<?php endif ?>	
		<!-- ENTREGAS -->
		<a href="families.php?id=<?php echo $familia['ID_APARTAMENTO']?>">Volver</a>
		<!-- MODALES -->
		<?php include("includes/modal.php") ?>
		<?php include("includes/footer.php")?>
	</body>
</html>