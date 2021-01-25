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

		$validar = repeatDNI($dni,$con,'PERSONA');
		if ($validar != 1) {
			$sql = "INSERT INTO PERSONA (NOMBRES, APELLIDOS, GENERO, DNI, TELEFONO, POSICION, EMBARAZO, ENCAMADO, PENSION, VOTO, FECHA_NAC, PESO, ESTATURA, ID_FAMILIA) VALUES ('$nombre', '$apellido', '$genero', '$dni', '$telefono', '$posicion', '$embarazo', '$encamado', '$pension', '$voto', '$f_nac', '$peso', '$estatura', '$familia')";
			
			$result = $con->query($sql);
			if (!$result) {
				$message = "Cedula registrada";
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
			<div class="error"><?php if (isset($message)): ?><?php echo $message; ?><?php endif ?></div>
			<div class="agrupar">
				<input type="text" name="nombres"  id="nombre" placeholder="Nombres"> 
				<input type="text" name="apellidos"  id="apellidos" placeholder="Apellidos"> 
			</div>
			<div class="agrupar">	
				<input type="text" name="dni" id="dni" placeholder="Cedula de identidad">
				<input type="text" name="tlf"  id="tlf" placeholder="Nro. Telefono">
			</div>

			<select class="select-css" name="pos" id="s">
				<option value="--POSICION--" selected disabled>--POSICION--</option>
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
						<input type="radio" name="genero" id="masculino" value="M">
						<label for="masculino">Masculino</label>
					</span>
					<span>
						<input type="radio" name="genero" id="femenino" value="F">
						<label for="femenino">Femenino</label>
					</span>
					<span class="checkbox" id="genero"></span>
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
					<span class="checkbox" id="embarazo"></span>
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
					<span class="checkbox" id="encamados"></span>
				</div>
			</div>
			<div class="agrupar">
				<p>Fecha de nacimiento</p>
				<input class="chico" type="date" name="f_nac" id="f_nac"> 
				<input class="chico" type="number" name="peso" id="peso" placeholder="Peso" min="0" max="300"> 
				<input class="chico" type="number" name="est" id="est" min="0" max="300" placeholder="Estatura">
			</div>
			<div class="agrupar">
				<div class="radio">
					<p>Pension <span class="checkbox" id="pension"></p>
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
					<p>Voto <span class="checkbox" id="voto"></span></p>
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
			<input type="submit" name="enviar" id="btnEnviarPerson" value="Agregar">
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
		
			$("#btnEnviarPerson").click(function(e) {
				var campoVacio = "";
				var campoRadio = "";
				var mensajeError ="";
				//Verificacion de campos vacios
				if ($("#nombre").val() == "") {
					$("#nombre").css("border-color","#D32F2F");
					$("#nombre").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					$("#nombre").css("border-color","#61b4b3");
				}

				if ($("#apellidos").val() == "") {
					$("#apellidos").css("border-color","#D32F2F");
					$("#apellidos").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					$("#apellidos").css("border-color","#61b4b3");
				}

				if ($("#dni").val() == "") {
					$("#dni").css("border-color","#D32F2F");
					$("#dni").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					if ($.isNumeric($("#dni").val()) == false) {
						mensajeError += "DNI invalido</br>";
						e.preventDefault();
					} else {
						$("#dni").css("border-color","#61b4b3");
					}
				}
				
				if ($("#s").val() == "--POSICION--") {
					$("#s").css("border-color","#D32F2F");
					$("#s").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					$("#s").css("border-color","#61b4b3");
				}

				if ($("#tlf").val() == "") {
					$("#tlf").css("border-color","#D32F2F");
					$("#tlf").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					if ($.isNumeric($("#tlf").val()) == false) {
						mensajeError += "Numero de telefono invalido</br>";
						e.preventDefault();
					} else {
						$("#tlf").css("border-color","#61b4b3");
					}
				}
				
				if ($("#peso").val() == "") {
					$("#peso").css("border-color","#D32F2F");
					$("#peso").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					if ($.isNumeric($("#peso").val()) == false) {
						mensajeError += "Ingrese un valor numerico</br>";
						e.preventDefault();
					if ($("#peso").val() < 0 || $("#peso") > 700 ) {
						mensajeError += "Debe ser un valor mayor que 0 y menor que 700</br>";
						e.preventDefault();
					}
					} else {
						$("#peso").css("border-color","#61b4b3");
					}
				}

				if ($("#est").val() == "") {
					$("#est").css("border-color","#D32F2F");
					$("#est").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					if ($.isNumeric($("#est").val()) == false) {
						mensajeError += "Ingrese un valor numerico</br>";
						e.preventDefault();
					if ($("#est").val() < 0 || $("#est") > 3 ) {
						mensajeError += "Debe ser un valor mayor que 0 y menor que 3</br>";
					}
					} else {
						$("#est").css("border-color","#61b4b3");
					}
				}
					if ($("#s".val() == "--POSICION--")) {
							name.css("border-color","#D32F2F");
							campoVacio = "campo vacios";
				} else {
					$("#s").css("border-color","#61b4b3");
				} 

					if ($("#f_nac").val() == "") {
					$("#f_nac").css("border-color","#D32F2F");
					$("#f_nac").attr("placeholder","Este campo es obligatorio");
					e.preventDefault();
					campoVacio = "campo vacios";
				} else {
					$("#f_nac").css("border-color","#61b4b3");
				}

				var validateRadio = function (name,id) {
						if (!name.is(':checked')) {
							campoRadio = "Hay opciones no marcadas";
							id.html("<p class='mensaje'>Elige una opción</p>");
						}
						else{
							campoRadio = "";
							id.html("");
						}
					}

				validateRadio($("#formulario input[name='emb']:radio"), $("#embarazo"));
				validateRadio($("#formulario input[name='genero']:radio"), $("#genero"));
				validateRadio($("#formulario input[name='voto']:radio"), $("#voto"));
				validateRadio($("#formulario input[name='encamado']:radio"), $("#encamados"));
				validateRadio($("#formulario input[name='pension']:radio"), $("#pension"));


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

		});
	</script>
</html>