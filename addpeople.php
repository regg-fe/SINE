<?php 
	include_once'includes/functions.php';
	session_start();
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	if (empty($_GET['id'])) {
		header("Location:home.php");
		die();
	}
	$efe = $_GET['id'];
	if (isset($_POST['enviar'])) { 
		$con = conexion();

		$nombre =  $con->real_escape_string($_POST['nombres']);
		$apellido =  $con->real_escape_string($_POST['apellidos']);
		$genero =  $con->real_escape_string($_POST['genero']);
		$dni =  $con->real_escape_string($_POST['dni']);
		$telefono =  $con->real_escape_string($_POST['tlf']);
		$posicion =  $con->real_escape_string($_POST['pos']);
		if (isset($_POST['emb']))
			$embarazo =  $con->real_escape_string($_POST['emb']);
		else
			$embarazo = 'M';
		$encamado =  $con->real_escape_string($_POST['encamado']);
		$pension =  $con->real_escape_string($_POST['pension']);
		$voto =  $con->real_escape_string($_POST['voto']);
		$f_nac =  $con->real_escape_string($_POST['f_nac']);
		$peso =  $con->real_escape_string($_POST['peso']);
		$estatura =  $con->real_escape_string($_POST['est']);
		$familia =  $con->real_escape_string($_POST['id']);

		if ($genero == 'M') {
			$embarazo = 'N';
		}
		$validar = repeatDNI($dni,$con,'PERSONA');
		if ($validar != 1) {
			$sql = "INSERT INTO PERSONA (NOMBRES, APELLIDOS, GENERO, DNI, TELEFONO, POSICION, EMBARAZO, ENCAMADO, PENSION, VOTO, FECHA_NAC, PESO, ESTATURA, ID_FAMILIA) VALUES ('$nombre', '$apellido', '$genero', '$dni', '$telefono', '$posicion', '$embarazo', '$encamado', '$pension', '$voto', '$f_nac', '$peso', '$estatura', '$familia')";
			
			$result = $con->query($sql);
			if (!$result) {
				die("Insert error".mysql_error($con));
			} else {			
				header('Location:afamily.php?id='.$efe);
			}
		} else {
			$message = "Cedula registrada";
		}
		
		$con->close();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SINE: Añadir Persona</title>
		<link rel="stylesheet" href="css/insertForms.css">
	</head>
		<?php include("includes/navbar.php")?>
	<body>
		<div class="container">
		<div class="center">
			<a href="afamily.php?id= <?php echo $efe ?>" title="Volver"><i class="fas fa-arrow-left"></i></a>	
		</div>
		
		<div class="box-form">
		<h1>Agregar Persona</h1>
		<form action="addpeople.php?id=<?php echo $efe ?>" method="POST" id="formulario">
			<?php if (isset($message)): ?> <p><?php echo $message ?></p> <?php endif ?>
			

			<div class="agrupar">
				<input type="text" name="nombres" required placeholder="Nombres"> 
				<input type="text" name="apellidos" required placeholder="Apellidos"> 
			</div>
			<div class="agrupar">	
				<input type="text" name="dni" placeholder="Cedula de identidad">
				<input type="text" name="tlf" required placeholder="Nro. Telefono">
			</div>

			<select class="select-css" name="pos" required>
				<option selected disabled>--POSICION--</option>
				<option value="HIJO">HIJO</option>
				<option value="NIETO">NIETO</option>
				<option value="PADRE">PADRE</option>
				<option value="ABUELO">ABUELO</option>
				<option value="HERMANO">HERMANO</option>
				<option value="TIO">TIO</option>
				<option value="SOBRINO">SOBRINO</option>
				<option value="BISABUELO">BISABUELO</option>
				<option value="BISNIETO">BISNIETO</option>
				<option value="OTROS">OTRO</option>
			</select>

			<div class="agrupar">
				<div class="radio radio-chico">
					<p>Genero</p>
					<span>
						<input type="radio" name="genero" id="gen" value="M">
						<label for="gen">Masculino</label>
					</span>
					<span>
						<input type="radio" name="genero" id="femenino" value="F">
						<label for="femenino">Femenino</label>
					</span>
				</div>
				

				<div class="radio radio-chico">
					<p>¿Embarazo?</p>
					<span>
						<input type="radio" name="emb" id="emb" value="S">
						<label for="emb">Si</label>
					</span>
					<span>
						<input type="radio" name="emb" id="emb-no" value="N">
						<label for="emb-no">No</label>
					</span>
				</div>

				<div class="radio radio-chico">
					<p>¿Encamado?</p>
					<span>
						<input type="radio" name="encamado" id="encamado" value="S">
						<label for="encamado">Si</label>
					</span>
					<span>
						<input type="radio" name="encamado" id="no-encamado" value="N">
						<label for="no-encamado">No</label>
					</span>
				</div>
			</div>
			<div class="agrupar">
				<p>Fecha de nacimiento</p>
				<input class="chico" type="date" name="f_nac" required> 
				<input class="chico" type="number" name="peso" placeholder="Peso" required min="0"> 
				<input class="chico" type="number" name="est" min="0" placeholder="Estatura" required>
			</div>
			<div class="agrupar">
				<div class="radio">
					<p>Pension</p>
					<span>
						<input type="radio" name="pension" id="adultoMayor" value="AM">
						<label for="adultoMayor">Adulto mayor</label>
					</span>
					<span>
						<input type="radio" name="pension" id="seguroSocial" value="SS">
						<label for="seguroSocial">Seguro social</label>
					</span>
					<span>
						<input type="radio" name="pension" id="noTiene" value="NT">
						<label for="noTiene">No tiene</label>
					</span>
				</div>
			
				<div class="radio">
					<p>Voto</p>
						<span>
						<input type="radio" name="voto" id="duro" value="D">
						<label for="duro">Duro</label>
					</span>
					<span>
						<input type="radio" name="voto" id="blando" value="B">
					<label for="blando">Blando</label>
					</span>
					<span>
						<input type="radio" name="voto" id="oposicion" value="O">
						<label for="oposicion">Oposicion</label>
					</span>
				</div>	
			</div>
			
		

			<input type="hidden" name="id" value="<?php echo $efe ?>">
			<input type="submit" name="enviar" value="Enviar">
		</form>
	</div>
	</div>
		<?php include("includes/footer.php")?>
	</body>
	<!-- script -->
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("input[name='genero']").click(function () {
				switch ($("input[name='genero']:checked").val()) {
					case 'M':
						$("#formulario input[name='emb'][value='S']").prop("checked",false);
						$("#formulario input[name='emb'][value='N']").prop("checked",true);
						$("#formulario input[name='emb'][value='S']").attr("disabled","disabled");
						$("#formulario input[name='emb'][value='N']").attr("disabled","disabled");

						break;
					case 'F':
						$("#formulario input[name='emb'][value='N']").prop("checked",false);
						$("#formulario input[name='emb'][value='S']").prop("checked",false);
						$("#formulario input[name='emb'][value='S']").attr("disabled",null);
						$("#formulario input[name='emb'][value='N']").attr("disabled",null);
						break;
				}
			});
		});
	</script>
</html>