<?php  
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$id = $_GET['id'];
	if (!isset($id)) {
		header("Location:home.php");
	}
	if (empty($id)) {
		header("Location:home.php");
	}
	$tablaApartamento = apartamentosPorBloque($id);
	if ($tablaApartamento == NULL) {
		header("Location:home.php");
	}	
	$nrobloque = $tablaApartamento[0]['NRO_BLOQUE'];
	$lider = lider($id);
	$brigadista = brigadista($id);
	$btns = count($tablaApartamento);
?> 

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SINE: Apartamentos</title>
		<link rel="stylesheet" type="text/css" href="css/styleshome.css">
	</head>
	<body>
		<?php include("includes/navbar.php");?>
		<div class="welcome">
			<h1>Bloque <?php echo "$nrobloque"?></h1>
			<?php if (isset($lider)): ?>
				<p><span class="negrita">Lider:</span> <?php echo $lider['NOMBRES']." ".$lider['APELLIDOS']." ".$lider['DNI']." ".$lider['TELEFONO']  ?></p>
				<p><?php else: echo "No hay lider asignado."?></p>
			<?php endif ?>
			<?php if (isset($brigadista)): ?>
				<p><span class="negrita">Brigadista:</span> <?php echo $brigadista['NOMBRES']." ".$brigadista['APELLIDOS']." ".$brigadista['DNI']." ".$brigadista['TELEFONO']  ?></p>
				<p><?php else: echo "No hay brigadista asignado."?></p>
			<?php endif ?>
		</div>
		<div class="container">
			<div class="center apartmentBtn">
				<a href="#" id="addA"><button>Agregar Anexo</button></a><a href="#" id="delA"><button>Elminar Anexo</button></a>
				<a href="home.php">Volver</a>
			</div>
			<div class="card-container">
				<?php for ($i = 0; $i < $btns; $i++): ?>
					<?php if ($tablaApartamento[$i]['ANEXO'] == 'N' || $tablaApartamento[$i]['ANEXO'] == 'n'): ?>
						<a href="families.php?id=<?php echo $tablaApartamento[$i]['ID'] ?>">
							<div class="card card-aparment">
								<p>Apartamento</p> 
								<p class="numero"><?php echo $tablaApartamento[$i]['NRO_APARTAMENTO'] ?></p>
							</div>
						</a>
					<?php endif ?>
					<?php if ($tablaApartamento[$i]['ANEXO'] == 'S' || $tablaApartamento[$i]['ANEXO'] == 's'): ?>
						<a href="families.php?id=<?php echo $tablaApartamento[$i]['ID'] ?>">
							<div class="card card-aparment">
								<p>Anexo</p>
								<p class="numero"><?php echo $tablaApartamento[$i]['NRO_APARTAMENTO'] ?></p>
							</div>
						</a>
					<?php endif ?>
				<?php endfor ?>
			</div>
		</div>
		<?php include("includes/modal.php") ?>
		<?php include("includes/footer.php") ?>
</html>