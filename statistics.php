<?php 
	session_start();
	include_once 'includes/functions.php';
	$tablaBloques = bloques();
	$btns = count($tablaBloques);
	$personas = count(personas());
	$familias = count(familias());
	$bombonas = count(bombonas());
	$discapacitados = count(discapacitados());
	$enfermos = count(enfermos());
	$estudiantes = count(escolarizaciones());
	$pensionados = count(pensionados('ALL'));
	$lactantes = count(lactantes());
	$adultos = count(adultosMayores());
	$embarazadas = count(embarazadas());
	$encamados = count(encamados());
	$solos = count(apartamentosConUnaPersona());
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SINE: Estadisticas</title>
		<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
		<script type="text/javascript" src="js/js.js"></script>
		<script type="text/javascript" src="js/statistics.js"></script>
		<link rel="stylesheet" type="text/css" href="css/inputsTypeRadio.css">
		<link rel="stylesheet" href="css/person.css">
		<link rel="stylesheet" href="css/styleTable.css">
	<?php if (!isset($_SESSION['usuario'])): ?>
		<link rel="stylesheet" href="css/styleTable.css">
	</head>
	<body style= "background-image:url(img/imagen8.jpg) ">
		<div class="transparencia">
			<header>
				<ul class="menu">  
					<li class="logo"><a href="#" alt="SINE"><img src="img/logoFinal.png"></a> </li>
					<li class="items"><a href="statistics.php">Estadisticas</a></li>
					<li class="items"><a href="login.php">Iniciar Sesión</a></li>
				</ul>
			</header>
		</div>
	<?php else: ?>
		<?php include("includes/navbar.php") ?>
	<?php endif ?>
		<div class="welcome">
			<h1>Estadisticas</h1>
		</div>
	<div class="container">
		<dsiv class="container2">
			<div class="tabla">
		 		<h2>Bloques: </h2>
		 		<div class="info2">
					<table>
					<tr>
				 		<td>Personas registradas: </td>
				 		<td><?php echo $personas ?></td>
				 	</tr>
				 	<tr>
				 		<td>Familias registradas:</td>
				 		<td> <?php echo $familias ?></td>
				 	</tr>
				 	<tr>
				 		<td>Total de Bombonas: 
				 		<td> <?php echo $bombonas ?></td>
				 	</tr>
				 	<tr>
				 		<td>Personas discapacitadas: </td>
				 		<td><?php echo $discapacitados ?></td>
				 	</tr>
				 	<tr>
				 		<td>Personas enfermas: </td>
				 		<td><?php echo $enfermos ?></td>
				 	</tr>
				 	<tr>
						<td>Estudiantes:</td>
						<td> <?php echo $estudiantes ?></td>
					</tr>
					<tr>
				 		<td>Pensionados: </td>
				 		<td><?php echo $pensionados ?></td>
				 	</tr>
				 	<tr>
				 		<td>Lactantes: </td>
				 		<td><?php echo $lactantes ?></td>
				 	</tr>
				 	<tr>
				 		<td>Adultos Mayores: </td>
				 		<td><?php echo $adultos ?></td>
				 	</tr>
				 	<tr>
				 		<td>Embarazadas: </td>
				 		<td><?php echo $embarazadas ?></td>
				 	</tr>
				 	<tr>
				 		<td>Encamados: </td>
				 		<td><?php echo $encamados ?></td>
				 	</tr>
				 	<tr>
				 		<td>Apartamentos con una sola persona:</td>
				 		<td> <?php echo $solos ?></td>
				 	</tr>
				 </table>
		 	</div>
		 </div>	
		</div>

		<div class="card-container">
			<?php for ($i=0; $i < $btns; $i++): ?>
				<a onclick="openUrl('includes/apartamentos.php?id=<?php echo $tablaBloques[$i]['ID'] ?>','visualizar')">
					<div class="card">
						<p class="negrita">Bloque <?php echo $tablaBloques[$i]['NRO_BLOQUE'] ?></p>
					</div>
				</a>
			<?php endfor ?>
		</div>
		<div id="visualizar"></div>
		<h2 class="parrafo">Otras opciones</h2>
		<div class="division"></div>
		<div class="card-container">
			<?php if (isset($_SESSION['usuario'])): ?>
			<a onclick="openUrl('includes/nutricion.php','mostrar')">
				<div class="card">
					<p class="negrita">Nutricion</p>
				</div>
			</a>
			<a onclick="openUrl('includes/condiciones.php','mostrar')">
				<div class="card">
					<p class="negrita">Condiciones</p>
				</div>
			</a>
			<a onclick="openUrl('includes/proteccion.php','mostrar')">
				<div class="card">
					<p class="negrita">Proteccion Social</p>
				</div>
			</a>
			<a onclick="openUrl('includes/vulnerables.php','mostrar')">
				<div class="card">
					<p class="negrita">Personas<br>Vulnerables</p>
				</div>
			</a>
		</div>
			<div id="mostrar"></div>
	
	<?php endif ?>
	<?php include("includes/footer.php") ?>
	
