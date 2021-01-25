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
	<script src="js/jquery.min.js"></script>
</head>
<body>
<?php require ('includes/navbar.php') ?>
	<div class="container">
		<a class="center" href="leaders.php" title="Volver"><i class="fas fa-arrow-left"></i></a>
		<div class="box-form">
			<form  action="addleader.php?op=<?php echo $op ?>" method="POST">
				<h1>Registro de <?php echo $result ?></h1>
				<?php if (isset($message)): ?>
					<div class="error"><?php echo $message ?></div>
				<?php endif ?>
				<div class="error" id="mensajeError"></div>	
					<label for="nombre">Nombre:</label>
					<input type="text" id="nombre" name="nombre"> 

					<label for="apellido">Apellido:</label>
					<input type="text" id="apellido" name="apellido">

					<label for="dni">DNI:</label>
					<input type="text" id="dni" name="dni" >

					<label for="telefono">Telefono:</label>
					<input type="text" id="telefono" name="telefono"> <br>

					<label for="id_bloque">Bloque al que pertenece:</label>
					<select class="select-css" name="id_bloque">
						<?php for ($i=0; $i <count($bloques) ; $i++): ?>
							<option value="<?php echo $bloques[$i]['ID']?>"><?php echo $bloques[$i]['NRO_BLOQUE']?></option>
						?<?php endfor; ?>	
					</select>
					<input type="submit" name="btn" id="btnEnviarLider" value="Agregar">
			</form>
		</div>
	</div>
	<script>
			$("#btnEnviarLider").click(function(e) {
				var campoVacio = "";
				var mensajeError ="";
				//Verificacion de campos vacios
				if ($("#nombre").val() == "") {
					$("#nombre").css("border-color","#D32F2F");
					$("#nombre").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				else{
					$("#nombre").css("border-color","#61b4b3");
				}
				if ($("#apellido").val() == "") {
					$("#apellido").css("border-color","#D32F2F");
					$("#apellido").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				else{
					$("#apellido").css("border-color","#61b4b3");
				}
				if ($("#dni").val() == "") {
					$("#dni").css("border-color","#D32F2F");
					$("#dni").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}
				else{
					if ($.isNumeric($("#dni").val()) == false) {
						mensajeError += "DNI invalido</br>";
						e.preventDefault();
					} 
					else{
						$("#dni").css("border-color","#61b4b3");
					}
				}
				if ($("#telefono").val() == "") {
					$("#telefono").css("border-color","#D32F2F");
					$("#telefono").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				}else{
					if ($.isNumeric($("#telefono").val()) == false) {
						mensajeError += "Numero de telefono invalido</br>";
						e.preventDefault();
					} 
					else{
						$("#telefono").css("border-color","#61b4b3");
					}
				}
				if (campoVacio != "") {
					mensajeError = "Hay campos vacios </br>" +  mensajeError;
					e.preventDefault();
				}
				
				if (mensajeError != "") {
					$("#mensajeError").html(mensajeError);
					e.preventDefault();
				}
			});	

			var change = function (name){
				name.change(function(){
					if (name.val() != "") {
						name.css("border-color","#61b4b3");
					}
				});
			}

			change(name = $("#nombre"));
			change(name = $("#apellido"));
			change(name = $("#dni"));
			change(name = $("#telefono"));

		</script>
	<?php require ('includes/footer.php') ?>
</body>
</html>