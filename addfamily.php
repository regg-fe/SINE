<!DOCTYPE html>
<?php
	include_once 'includes/functions.php';
?>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/insertForms.css">
	<link rel="stylesheet" href="css/styleTable.css">
	<title>Agregar persona</title>
<body>
	<?php include("includes/navbar.php")?>

	<div class="container-form-table">
		<div class="agrupar-pagina">
			<div class="box-form">
				<h1>Agregar miembro de familia</h1>
				<div id="mensajeError" class="error"></div>
				<div id="mensajeExito" class="exito"></div>
				<form id="formulario">
					<div class="agrupar">
						<input class="separador" type="text" name="Nombres" placeholder="Nombres">
						<input class="separador" type="text" name="Apellidos" placeholder="Apellidos">

					</div>

							
					<div class="agrupar">
						<input type="text" name="DNI" placeholder="Cedula de identidad">
						<input type="text" name="Telefono" placeholder="Nro. Telefono">
					</div>


					<select class="select-css" name="Posicion" required>
						<option selected>--POSICION--</option>
						<option value="1">Jefe</option>
						<option value="2">Pareja</option>
						<option value="3">Hermano</option>
						<option value="4">Hijo</option>
						<option value="5">Padre</option>
						<option value="6">Tío</option>
						<option value="7">Sobrino</option>
						<option value="8">Nieto</option>
						<option value="9">Abuelo</option>
						<option value="10">Bisabuelo</option>
						<option value="11">Bisnieto</option>
						<option value="12">Otro</option>
					</select>

					<div class="agrupar">
						<div class="radio radio-chico">
							<p>Genero</p>
							<span>
								<input type="radio" name="Genero" value="M" id="masculino">
								<label for="masculino">Masculino</label>
							</span>
							<span>
								<input type="radio" name="Genero" value="F" id="femenino">
								<label for="femenino">Femenino</label>
							</span>
							<div class="checkbox" id="genero"></div>
						</div>
						<div class="radio radio-chico">
							<p>¿Embarazo?</p>
							<span>
								<input type="radio" name="Embarazo" value="S" id="siEmbarazo">
								<label for="siEmbarazo">Si</label>
							</span>
							<span>
								<input type="radio" name="Embarazo" value="N" id="noEmbarazo">
								<label for="noEmbarazo">No</label>
							</span>
							<span class="checkbox" id="embarazo"></span>
						</div>
						<div class="radio radio-chico">
							<p>¿Encamado?</p>
							<span>
								<input type="radio" name="Encamado" value="S" id="siEncamado">
								<label for="siEncamado">Si</label>
							</span>
							<span>
								<input type="radio" name="Encamado" value="N" id="noEncamado">
								<label for="noEncamado">No</label>
							</span>
							 <span class="checkbox" id="encamado"></span>
						</div>
					</div>

				
					<div class="agrupar">
						<p>Fecha de nacimiento</p>
						<input class="chico" type="date" name="FechaNac">
						<input class="chico" type="number" name="Peso" placeholder="Peso" min="0">
						<input class="chico" type="number" name="Estatura" placeholder="Estatura" min="0">
					</div>

					<div class="agrupar">
						<div class="radio">
							<p>Pension <span class="checkbox" id="pension"></span></p>
							<span>
								<input type="radio" name="Pension" value="AM" id="adultoMayor">
								<label for="adultoMayor">Adulto mayor</label>
							</span>
							<span>
								<input type="radio" name="Pension" value="SS" id="seguroSocial">
								<label for="seguroSocial">Seguro social</label>
							</span>
							<span>
								<input type="radio" name="Pension" value="NT" id="noTiene">
								<label for="noTiene">No tiene</label>
							</span>
						</div>

						<div class="radio">
							<p>Voto <span class="checkbox" id="voto"></span></p>
								<span>
								<input type="radio" name="Voto" value="D" id="duro">
								<label for="duro">Duro</label>
							</span>
							<span>
								<input type="radio" name="Voto" value="B" id="blando">
								<label for="blando">Blando</label>
							</span>
							<span>
								<input type="radio" name="Voto" value="O" id="oposicion">
								<label for="oposicion">Oposicion</label>
							</span>
						</div>	
					</div>

					<button id="add">Agregar</button>
				</form>
			</div>
		</div>
		
		
		<div class="agrupar-pagina">
			<div class="little-table">
				<div class="wrap-table100">	
					<div class="table100 ver1">
						<div class="wrap-table100 js-pscroll">
							<div class="table100-nextcols">
								<table id="tabla">
									<thead>
										<tr class="row100 head">
											<th class="cell100 column1">Nombres</th>
											<th class="cell100 column2">Apellidos</th>
											<th class="cell100 column0">Genero</th>
											<th class="cell100 column4">DNI</th>
											<th class="cell100 column5">Nro Telefono</th>
											<th class="cell100 column6">Posicion</th>
											<th class="cell100 column9">Embarazo</th>
											<th class="cell100 column9">Encamado</th>
											<th class="cell100 column0">Pension</th>
											<th class="cell100 column0">Voto</th>
											<th class="cell100 column8">Fecha de Nacimiento</th>
											<th class="cell100 column0">Peso</th>
											<th class="cell100 column0">Estatura</th>
											<th class="cell100 column9">Eliminar</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>	
			<div class="crear center">
				<div class="inputs-crear">
				<?php
					if (isset($_GET['apartamento'])):
						$ap_id = $_GET['apartamento'];
						$apdata = apartamento($ap_id);
						echo "<div class='datos'><label>Apartamento:</label> ".$apdata['NRO_APARTAMENTO']."</div>
						<div class='datos'><label>Bloque:</label> ".$apdata['NRO_BLOQUE']."</div>";
					?>
					<input id="Apartamento" type="hidden" name="Apartamento" value="<?php echo $ap_id ?>">
				<?php
					else:
				?>
				<div class="agrupar-crear">
					<label>Bloque:</label>
					<select class="select-css" name="Bloque">
						<?php 
							$bloques = bloques();
							for($i = 0; $i < count($bloques) ; $i++):
						?>
							<option value="<?php echo $bloques[$i]['ID'] ?>"> <?php echo $bloques[$i]['NRO_BLOQUE'] ?> </option>
						<?php endfor; ?>
					</select>
				</div>
				<div class="agrupar-crear">
					<label>Apartamento:</label>
					<select class="select-css" id="Apartamento" name="Apartamento">
						<?php
							$aparts = apartamentosPorBloque(1);
							for($i = 0; $i < count($aparts) ; $i++):
						?>
							<option value="<?php echo $aparts[$i]['ID'] ?>"> <?php echo $aparts[$i]['NRO_APARTAMENTO'] ?> </option>
						<?php endfor; ?>
					</select>
				</div>
				<?php endif ?>
				<div class="agrupar-crear">
					<label>Estado de la vivienda:</label>
					<select  class="select-css" name="Vivienda">
						<option value="1">Propia</option>
						<option value="2">Alquilada</option>
						<option value="3">Asediada</option>
					</select>
				</div>
			</div>
				<button id="create">Crear familia</button>
			</div>
		</div>
	</div>
		
	<!-- Inicio de scripts -->
	<script type="text/javascript">
		$(document).ready(function () {
			$("input[name='Genero']").click(function () {
				switch ($("input[name='Genero']:checked").val()) {
					case 'M':
						$("#formulario input[name='Embarazo'][value='S']").attr("checked",null);
						$("#formulario input[name='Embarazo'][value='N']").attr("checked",'checked');
						$("#formulario input[name='Embarazo'][value='S']").attr("disabled","disabled");
						$("#formulario input[name='Embarazo'][value='N']").attr("disabled","disabled");

						break;
					case 'F':
						$("#formulario input[name='Embarazo'][value='N']").attr("checked",null);
						$("#formulario input[name='Embarazo'][value='S']").attr("checked",null);
						$("#formulario input[name='Embarazo'][value='S']").attr("disabled",null);
						$("#formulario input[name='Embarazo'][value='N']").attr("disabled",null);
						break;
				}
			});

			$("select[name='Bloque']").change(function () {
				var id = $("select[name='Bloque']").val();
				$.post("addfam.php", {idBLOQUE: id, }, function (data) {
					$("select[name='Apartamento']").html(data);
					
				})
			});

			$("#add").click(function (ev) {
				ev.preventDefault();
				var nombres = $("#formulario input[name='Nombres']");
				var apellidos = $("#formulario input[name='Apellidos']");
				var genero = $("#formulario input[name='Genero']:checked");
				var dni = $("#formulario input[name='DNI']");
				var telefono = $("#formulario input[name='Telefono']");
				var posicion = $("#formulario select[name='Posicion']");
				var embarazo = $("#formulario input[name='Embarazo']:checked");
				var encamado = $("#formulario input[name='Encamado']:checked");
				var pension = $("#formulario input[name='Pension']:checked");
				var voto = $("#formulario input[name='Voto']:checked");
				var nacimiento = $("#formulario input[name='FechaNac']");
				var peso = $("#formulario input[name='Peso']");
				var estatura = $("#formulario input[name='Estatura']");
				
				$("#mensajeError").html("");
				//validacion
				var campoVacio = "";
				var radioVacio = "";
				var mensajeError ="";
				var validateInputs = function (name){
					if (name.val() == "" || name.val() == "--POSICION--") {
						name.css("border-color","#D32F2F");
						campoVacio = "campo vacios";
					}
					else{
						name.css("border-color","#61b4b3");
						if (name == dni) {
							if ($.isNumeric(dni.val()) == false) {
								mensajeError += "DNI invalido</br>";
								dni.css("border-color","#D32F2F");
							} 
						}
						else if (name == telefono) {
							if ($.isNumeric(telefono.val()) == false) {
								mensajeError += "Numero de telefono invalido</br>";
								telefono.css("border-color","#D32F2F");
							} 
						}
					}
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
				
				validateInputs(nombres);
				validateInputs(apellidos);
				validateRadio($("#formulario input[name='Genero']:radio"), $("#genero"));
				validateInputs(dni);
				validateInputs(telefono);
				validateInputs(posicion);
				validateRadio($("#formulario input[name='Embarazo']:radio"), $("#embarazo"));
				validateRadio($("#formulario input[name='Encamado']:radio"), $("#encamado"));
				validateRadio($("#formulario input[name='Pension']:radio"), $("#pension"));
				validateRadio($("#formulario input[name='Voto']:radio"), $("#voto"));
				validateInputs(nacimiento);
				validateInputs(peso);
				validateInputs(estatura);
				if (campoVacio != "") {
					mensajeError = "Hay campos vacios</br>" + mensajeError;
				}
				if (campoRadio != "") {
					mensajeError += campoRadio;
				}
				if (mensajeError != "") {
					$("#mensajeError").html(mensajeError);
					ev.preventDefault();
				} //fin validacion
				else{
					$("#mensajeExito").html("¡Persona agrgada con éxito!");
					var str;
					str += "<tr class='row100 body'>";
					str += "<td  class='cell100 column1'>"+nombres.val()+"</td>";
					str += "<td  class='cell100 column2'>"+apellidos.val()+"</td>";
					str += "<td  class='cell100 column0'>"+genero.val()+"</td>";
					str += "<td  class='cell100 column4'>"+dni.val()+"</td>";
					str += "<td  class='cell100 column5'>"+telefono.val()+"</td>";
					str += "<td  class='cell100 column6'>"+posicion.val()+"</td>";
					str += "<td  class='cell100 column9'>"+embarazo.val()+"</td>";
					str += "<td  class='cell100 column9'>"+encamado.val()+"</td>";
					str += "<td  class='cell100 column0'>"+pension.val()+"</td>";
					str += "<td  class='cell100 column0'>"+voto.val()+"</td>";
					str += "<td  class='cell100 column8'>"+nacimiento.val()+"</td>";
					str += "<td  class='cell100 column0'>"+peso.val()+"</td>";
					str += "<td  class='cell100 column0'>"+estatura.val()+"</td>";
					str += "<td  class='cell100 column9'><button class='icon' onclick='$(this).parent().parent().remove()'><i class='fas fa-eraser'></i></button></td>"
					str += "</tr>";

					$("#tabla tbody").append(str);

					//emptyform();
					//alert(nombres+" "+apellidos+" "+genero+"\n"+dni+"\n"+telefono+"\n"+posicion+"\n"+embarazo+" "+encamado+" "+pension+" "+voto+"\n"+nacimiento+"\n"+peso+" "+estatura);
				}
			});
			//Variables
			var nombres = $("#formulario input[name='Nombres']");
			var apellidos = $("#formulario input[name='Apellidos']");
			var genero = $("#formulario input[name='Genero']:checked");
			var dni = $("#formulario input[name='DNI']");
			var telefono = $("#formulario input[name='Telefono']");
			var posicion = $("#formulario select[name='Posicion']");
			var embarazo = $("#formulario input[name='Embarazo']:checked");
			var encamado = $("#formulario input[name='Encamado']:checked");
			var pension = $("#formulario input[name='Pension']:checked");
			var voto = $("#formulario input[name='Voto']:checked");
			var nacimiento = $("#formulario input[name='FechaNac']");
			var peso = $("#formulario input[name='Peso']");
			var estatura = $("#formulario input[name='Estatura']");
			//detencio de cambios en el input
			var change = function (name){
				name.change(function(){
					if (name.val() != "") {
						name.css("border-color","#61b4b3");
					}
					if (name == dni) {
						if ($.isNumeric(dni.val()) == false) {
							name.css("border-color","#D32F2F");
						} 
					}
					else if (name == telefono) {
						if ($.isNumeric(telefono.val()) == false) {
							name.css("border-color","#D32F2F");
						} 
					}
				});
			}

			change(nombres);
			change(apellidos);
			change(dni);
			change(telefono);
			change(posicion);
			change(nacimiento);
			change(peso);
			change(estatura);
			$("#create").click(function (ev) {
				ev.preventDefault();
				if ($("#tabla tbody tr").length) {
					var data = family2JSON();
					$.post("addfam.php",{
						data: data,
						apart: $("#Apartamento").val(),
						vivienda: $("select[name='Vivienda']").val(),
					}, function (dat) {
						//alert("Llendo a: "+dat);
						window.location.href=""+dat;
					});
				}
				
			});
			});
			function family2JSON() {
			var personas = $("#tabla tbody tr");
			var tabla = new Array();
			for (var i = 0 ; i < personas.length ; i++){
				var persona = $(personas[i]).children();
				tabla.push({
					NOMBRES: $(persona[0]).text(),
					APELLIDOS: $(persona[1]).text(),
					GENERO: $(persona[2]).text(),
					DNI: $(persona[3]).text(),
					TELEFONO: $(persona[4]).text(),
					POSICION: $(persona[5]).text(),
					EMBARAZO: $(persona[6]).text(),
					ENCAMADO: $(persona[7]).text(),
					PENSION: $(persona[8]).text(),
					VOTO: $(persona[9]).text(),
					NACIMIENTO: $(persona[10]).text(),
					PESO: $(persona[11]).text(),
					ESTATURA: $(persona[12]).text()
				});
			}
			return tabla;
			}
		function emptyform() {
			$("#formulario input[name='Nombres']").attr("value",null);
			$("#formulario input[name='Apellidos']").attr("value",null);
			$("#formulario input[name='Genero']:checked").attr("checked",null);
			$("#formulario input[name='DNI']").attr("value",null);
			$("#formulario input[name='Telefono']").attr("value",null);
			$("#formulario select[name='Posicion']").attr("value",null);
			$("#formulario input[name='Embarazo']:checked").attr("checked",null);
			$("#formulario input[name='Encamado']:checked").attr("checked",null);
			$("#formulario input[name='Pension']:checked").attr("checked",null);
			$("#formulario input[name='Voto']:checked").attr("checked",null);
			$("#formulario input[name='FechaNac']").attr("value",null);
			$("#formulario input[name='Peso']").attr("value",null);
			$("#formulario input[name='Estatura']").attr("value",null);
		}
	</script>
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})

		});
		
	</script>
	<?php include("includes/footer.php")?>