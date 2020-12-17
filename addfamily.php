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
				<form id="formulario">
					<div class="agrupar">
						<input type="text" name="Nombres" placeholder="Nombres">
						<input type="text" name="Apellidos" placeholder="Apellidos">

					</div>

							
					<div class="agrupar">
						<input type="text" name="DNI" placeholder="Cedula de identidad">
						<input type="text" name="Telefono" placeholder="Nro. Telefono">
					</div>


					<select class="select-css" name="Posicion">
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
								<input type="radio" name="Genero" value="M">
								<label for="masculino">Masculino</label>
							</span>
							<span>
								<input type="radio" name="Genero" value="F">
								<label for="femenino">Femenino</label>
							</span>
						</div>
						<div class="radio radio-chico">
							<p>¿Embarazo?</p>
							<span>
								<input type="radio" name="Embarazo" value="S">
								<label for="si">Si</label>
							</span>
							<span>
								<input type="radio" name="Embarazo" value="N">
								<label for="no">No</label>
							</span>
						</div>
						<div class="radio radio-chico">
							<p>¿Encamado?</p>
							<span>
								<input type="radio" name="Encamado" value="S">
								<label for="si">Si</label>
							</span>
							<span>
								<input type="radio" name="Encamado" value="N">
								<label for="no">No</label>
							</span>
						</div>
					</div>

				
					<div class="agrupar">
						<p>Fecha de nacimiento</p>
						<input class="chico" type="date" name="FechaNac">
						<input class="chico" type="number" name="Peso" placeholder="Peso">
						<input class="chico" type="number" name="Estatura" placeholder="Estatura">
					</div>

					<div class="agrupar">
						<div class="radio">
							<p>Pension</p>
							<span>
								<input type="radio" name="Pension" value="AM">
								<label for="adultoMayor">Adulto mayor</label>
							</span>
							<span>
								<input type="radio" name="Pension" value="SS">
								<label for="seguroSocial">Seguro social</label>
							</span>
							<span>
								<input type="radio" name="Pension" value="NT">
								<label for="noTiene">No tiene</label>
							</span>
						</div>

						<div class="radio">
							<p>Voto</p>
								<span>
								<input type="radio" name="Voto" value="D">
								<label for="duro">Duro</label>
							</span>
							<span>
								<input type="radio" name="Voto" value="B">
							<label for="blando">Blando</label>
							</span>
							<span>
								<input type="radio" name="Voto" value="O">
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
				<?php
					if (isset($_GET['apartamento'])):
						$ap_id = $_GET['apartamento'];
						$apdata = apartamento($ap_id);
						echo "<div class='datos'><label>Apartamento:</label> ".$apdata['NRO_APARTAMENTO']."</div><br><label>Bloque:</label> ".$apdata['NRO_BLOQUE']."<br>";
					?>
					<input id="Apartamento" type="hidden" name="Apartamento" value="<?php echo $ap_id ?>">
				<?php
					else:
				?>
			
				<label>Bloque:</label>
					<select name="Bloque">
						<?php 
							$bloques = bloques();
							for($i = 0; $i < count($bloques) ; $i++):
						?>
							<option value="<?php echo $bloques[$i]['ID'] ?>"> <?php echo $bloques[$i]['NRO_BLOQUE'] ?> </option>
						<?php endfor; ?>
					</select>
				
				<label>Apartamento:</label>
					<select id="Apartamento" name="Apartamento">
						<?php
							$aparts = apartamentosPorBloque(1);
							for($i = 0; $i < count($aparts) ; $i++):
						?>
							<option value="<?php echo $aparts[$i]['ID'] ?>"> <?php echo $aparts[$i]['NRO_APARTAMENTO'] ?> </option>
						<?php endfor; ?>
					</select>
				
				<?php endif ?>
				<label>Estado de la vivienda:</label>
					<select  class="select-css" name="Vivienda">
						<option value="1">Propia</option>
						<option value="2">Alquilada</option>
						<option value="3">Asediada</option>
					</select>
				
				<br>
				<button id="create">Crear familia</button>
			</div>
		</div>
	</div>
		
	
	<?php include("includes/footer.php")?>
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
				var nombres = $("#formulario input[name='Nombres']").val();
				var apellidos = $("#formulario input[name='Apellidos']").val();
				var genero = $("#formulario input[name='Genero']:checked").val();
				var dni = $("#formulario input[name='DNI']").val();
				var telefono = $("#formulario input[name='Telefono']").val();
				var posicion = $("#formulario select[name='Posicion']").val();
				var embarazo = $("#formulario input[name='Embarazo']:checked").val();
				var encamado = $("#formulario input[name='Encamado']:checked").val();
				var pension = $("#formulario input[name='Pension']:checked").val();
				var voto = $("#formulario input[name='Voto']:checked").val();
				var nacimiento = $("#formulario input[name='FechaNac']").val();
				var peso = $("#formulario input[name='Peso']").val();
				var estatura = $("#formulario input[name='Estatura']").val();

				var str;
				str += "<tr class='row100 body'>";
				str += "<td  class='cell100 column1'>"+nombres+"</td>";
				str += "<td  class='cell100 column2'>"+apellidos+"</td>";
				str += "<td  class='cell100 column0'>"+genero+"</td>";
				str += "<td  class='cell100 column4'>"+dni+"</td>";
				str += "<td  class='cell100 column5'>"+telefono+"</td>";
				str += "<td  class='cell100 column6'>"+posicion+"</td>";
				str += "<td  class='cell100 column9'>"+embarazo+"</td>";
				str += "<td  class='cell100 column9'>"+encamado+"</td>";
				str += "<td  class='cell100 column0'>"+pension+"</td>";
				str += "<td  class='cell100 column0'>"+voto+"</td>";
				str += "<td  class='cell100 column8'>"+nacimiento+"</td>";
				str += "<td  class='cell100 column0'>"+peso+"</td>";
				str += "<td  class='cell100 column0'>"+estatura+"</td>";
				str += "<td  class='cell100 column9'><button class='icon' onclick='$(this).parent().parent().remove()'><i class='fas fa-eraser'></i></button></td>"
				str += "</tr>";

				$("#tabla tbody").append(str);

				//emptyform();
				//alert(nombres+" "+apellidos+" "+genero+"\n"+dni+"\n"+telefono+"\n"+posicion+"\n"+embarazo+" "+encamado+" "+pension+" "+voto+"\n"+nacimiento+"\n"+peso+" "+estatura);
			});

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
</body>
</html>