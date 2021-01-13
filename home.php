<?php  
	session_start();
	include_once 'includes/info.php';
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	
	$name = $_SESSION['name'];
	$surname = $_SESSION['surname'];
	$tablaBloques = bloques();
	$btns = count($tablaBloques);

	include("includes/navbar.php");
?>
		
		<div class="welcome">
			<?php if ((isset($name)) && (isset($surname))):?> <h1>Bienvenid@, <?php echo $name." ".$surname ?> al panel de control</h1> <?php endif;?>
		</div>
		<div class="container">
			<div class="info">
				<p><span class="negrita">CLAP:</span> <?php echo $clap ?></p>
				<p><span class="negrita">Consejo Comunal:</span> <?php echo $cc ?></p>
				<p><span class="negrita">UBCH:</span> <?php echo $ubch ?></p>
				<p><span class="negrita">Comunidad:</span> <?php echo $comunidad ?></p>
			</div>
			
			<div class="card-container">
			<?php for ($i = 0; $i < $btns; $i++): ?>
				<a href="apartments.php?id=<?php echo $tablaBloques[$i]['ID']; ?>">
					<div class="card">
						<p>Bloque</p>
						<p class="numero"><?php echo $tablaBloques[$i]['NRO_BLOQUE']; ?><p>
					</div>	
				</a>	
			<?php endfor; ?>
			</div>	
		</div>
	<?php include("includes/footer.php")?>