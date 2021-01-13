<?php
	include_once'includes/functions.php';
	session_start();
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	if(!isset($_GET['id'])){
		header("Location:home.php");
		die();
	}
	if (empty($_GET['id'])) {
		header("Location:home.php");
		die();
	}
	$id_persona = $_GET['id'];

	$persona = persona($id_persona);
	$enfermedades = enfermedadesPorPersona($id_persona);
	$discapacidades = discapacidadesPorPersona($id_persona);
	$recetas = recetasPorPersona($id_persona);
	$ayudasTec = ayudasTecPorPersona($id_persona);
	if ($persona['ID_CARNET'] != null){
		$bonos = bonosPorCarnet($persona['ID_CARNET']);
	}
	$programas = programasSocialesPorPersona($id_persona);
	$trabajos = trabajosPorPersona($id_persona);
	$escolarizacion = escolarizacionPorPersona($id_persona);
?>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" href="css/insertForms.css">
	<link rel="stylesheet" href="css/styleTable.css">
	<title>Editar persona</title>
	<style type="text/css">
		table, th, tr, td{
			border: solid 1px black;
		}
	</style>
<body>
	<?php include("includes/navbar.php")?>

	<div class="container">
		<div class="box-form">
		<h2>Editar informacion de: <?php echo $persona['NOMBRES']." ".$persona['APELLIDOS']?></h2>

	<!-- DATOS GENERALES -->
		<div class="agrupar">
			
			<input type="hidden" name="id-persona" value="<?php echo $id_persona; ?>">
			<div class="agrupar-input">
				<p>Nombre(s):</p> 
				<input  class="mediano" type="text" name="nombre" value="<?php echo $persona['NOMBRES']; ?>">
			</div>
			<div class="agrupar-input">
				<p>Apellido(s):</p> 
				<input  class="mediano" type="text" name="apellido" value="<?php echo $persona['APELLIDOS']; ?>">
			</div>
			
		</div>
		<div class="agrupar">
			
				<div class="agrupar-input">
				<p>Cedula de identidad</p>
				<input class="mediano" type="number" name="dni" value="<?php echo $persona['DNI']; ?>">
				</div>
				<div class="agrupar-input">
			
				<p>Numero de telefono</p>
				<input class="mediano" type="number" name="telefono" value="<?php echo $persona['TELEFONO']; ?>">
			</div>
			
		</div>
		
		<div class="agrupar">
			<div class="agrupar-input">
				<p>Genero:</p> 
				<input class="mediano" type="hidden" name="genero" value="<?php echo $persona['GENERO']; ?>">
			<?php if($persona['GENERO'] == 'M') echo "<div class='mediano'> Masculino</div>"; else echo "<div class='mediano info-edit'>Femenino</div>"; ?>
			</div>
			<div class="agrupar-input">
				<p>Posicion familiar:</p>
				<?php echo "<div class='mediano info-edit'> " . $persona['POSICION'] . "</div>"?>
			</div>
		</div>
		
		<div class="agrupar">

		<div class="agrupar-input">
		<p>Fecha de nacimiento:</p>	
		<input class="chico" type="date" name="fecha_nacimiento" value="<?php echo $persona['FECHA_NAC']; ?>">
		</div>
		<div class="agrupar-input">
		<p>Peso: </p>
		<input class="chico" type="number" name="peso" value="<?php echo $persona['PESO']; ?>">
		</div>
		<div class="agrupar-input">
		<p>Estatura:</p>
		<input class="chico" type="number" name="estatura" value="<?php echo $persona['ESTATURA']; ?>">
		</div>
	</div>

	<div class="agrupar">
		<div class="radio radio-chico">
			<div class="separador">
		<div class="agrupar-input">
		<?php 
		if($persona['GENERO'] == 'F'):
			echo "<p>Embarazo: </p>";
		?>
		<span>
			<input type="radio" id="embsi" name="embarazo" value="S">
			<label for="embsi">Sí</label>
		</span>
		<span>
			<input type="radio" id="embno" name="embarazo" value="N">
			<label for="embno">No</label>
		</span>
		<p>(Condicion actual: <?php if($persona['EMBARAZO'] == 'M') echo "Si"; else echo "No"; ?>)</p>
		<?php else:?>
			<input type="radio" name="embarazo" value="N" checked style="display: none">
		<?php endif;?>
	</div>
		<div class="agrupar-input">
			<p>¿Encamado?</p>
		
			<span>
				<input type="radio" id="encsi" name="encamado" value="S">
				<label for="encsi">Sí</label>
			</span>
			<span>
				<input type="radio" id="encno" name="encamado" value="N">
				<label for="encno">No</label>
				</span>
				<p>(Condicion actual: <?php if($persona['ENCAMADO'] == 'M') echo "Si"; else echo "No"; ?>)</p>
		</div>
	</div>
	<div class="separador">
		<div class="agrupar-input">
			<p>Pension </p>
			<span>
				<input type="radio" name="pension" id="ad" value="AM">
				<label for="ad">Adulto mayor</label>
			</span>
			<span>
			<input type="radio" id="se" name="pension" value="SS"><label for="se">Seguro social</label>
			</span>
			<span>
			<input type="radio" id="nt" name="pension" value="NT"><label for="nt">No tiene</label>
			</span>
			<p>(Condicion actual: <?php if($persona['PENSION'] == 'AM') echo "Adulto mayor"; else if($persona['PENSION'] == 'SS') echo "Seguro social"; else echo "No tiene";?>)</p>
		</div>

		<div class="agrupar-input">
		<p>Voto:</p>

			<span>
				<input type="radio" id="du" name="voto" value="D">
				<label for="du">Duro</label>
			</span>
			<span>
				<input type="radio" id="bl" name="voto" value="B">
				<label for="bl">Blando</label>
			</span>
			<span>
				<input type="radio" id="vo" name="voto" value="B">
				<label for="vo">Opositor</label>
			</span>
		<p>(Condicion actual: <?php if($persona['VOTO'] == 'D') echo "Duro"; else if($persona['VOTO'] == 'B') echo "Blando"; else echo "Opositor";?>)</p>
		</div>
		</div>
	</div>
		<button id="generalinfo-update">Actualizar informacion</button>
		
	</div>


</div>


<!-- INFORMACION DEL CARNET -->
<strong>Carnet de la patria</strong>
<?php if ($persona['ID_CARNET'] === null) {
	echo "(Aun no se ha registrado un carnet para esta persona)";
} ?>
<br>
Codigo del carnet:		<input type="text" name="codigo_carnet" <?php if($persona['CODIGO_CARNET'] != null):?> value="<?php echo $persona['CODIGO_CARNET'] ?>" <?php endif;?>><br>
Serial del carnet:		<input type="text" name="serial_carnet" <?php if($persona['SERIAL_CARNET'] != null):?> value="<?php echo $persona['SERIAL_CARNET'] ?>" <?php endif;?>><br>
<button id="carnet-update">Actualizar informacion</button>
<br><br>
<br><br>
<?php if ($persona['ID_CARNET'] != null): ?>
<strong>Bonos recibidos</strong>
<table>
	<thead>
		<tr>
			<th>Nombre del bono</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i = 0 ; $i < count($bonos) ; $i++):?>
		<tr>
			<td><?php echo $bonos[$i]['NOMBRE_BONO'];?></td>
			<td><button onclick="updateInfo({ID: <?php echo $bonos[$i]['ID']?>}, 11);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td>
				<button onclick="reload('new_bono',0)">Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_bono_id" id="new_bono">
					<?php
						$bn_opt = bonos();
						for ($i = 0 ; $i < count($bn_opt) ; $i++):
					?>
					<option value="<?php echo $bn_opt[$i]['ID']?>"><?php echo $bn_opt[$i]['NOMBRE']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td><button id="bono-update">Agregar bono</button></td>
		</tr>
	</tbody>
</table>
<input type="hidden" name="id_carnet" value="<?php echo $persona['ID_CARNET']; ?>">
<?php endif;?>
<br>
<strong>Programas sociales asignados a la persona</strong>
<table>
	<thead>
		<tr>
			<th>Nombre del programa</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i = 0 ; $i < count($programas) ; $i++):?>
		<tr>
			<td><?php echo $programas[$i]['NOMBRE'];?></td>
			<td><button onclick="updateInfo({ID: <?php echo $programas[$i]['ID']?>}, 12);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td>
				<button onclick="reload('new_program',1)">Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_program_id" id="new_program">
					<?php
						$ps_opt = programasSociales();
						for ($i = 0 ; $i < count($ps_opt) ; $i++):
					?>
					<option value="<?php echo $ps_opt[$i]['ID']?>"><?php echo $ps_opt[$i]['NOMBRE']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td><button id="program-update">Agregar programa social</button></td>
		</tr>
	</tbody>
</table>
<br><br>

<!-- INFORMACION DE SALUD -->
<strong>Enfermedades que presenta la persona</strong><br>
<table>
	<thead>
		<tr>
			<th>Nombre de la enfermedad</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i = 0 ; $i < count($enfermedades) ; $i++):?>
		<tr>
			<td><?php echo $enfermedades[$i]['NOMBRE_ENFERMEDAD'];?></td>
			<td><button onclick="updateInfo({ID: <?php echo $enfermedades[$i]['ID']?>}, 13);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td>
				<button onclick="reload('new_sick',2)">Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_sick_id" id="new_sick">
					<?php
						$enf_opt = enfermedades();
						for ($i = 0 ; $i < count($enf_opt) ; $i++):
					?>
					<option value="<?php echo $enf_opt[$i]['ID']?>"><?php echo $enf_opt[$i]['NOMBRE']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td><button id="sickness-update">Agregar enfermedad</button></td>
		</tr>
	</tbody>
</table>

<br>

<strong>Medicamentos recetados a la persona</strong><br>
<table>
	<thead>
		<tr>
			<th>Nombre del medicamento</th>
			<th>Tipo de medicamento</th>
			<th>Descripcion de la receta</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i = 0 ; $i < count($recetas) ; $i++):?>
		<tr>
			<td><?php echo $recetas[$i]['NOMBRE_MEDICAMENTO'];?></td>
			<td><?php echo $recetas[$i]['TIPO_MEDICAMENTO'];?></td>
			<td><?php echo $recetas[$i]['DESCRIPCION'];?></td>
			<td><button onclick="updateInfo({ID: <?php echo $recetas[$i]['ID']?>}, 14);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td colspan="2">
				<button onclick="reload('new_medicine',3)" >Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_medicine_id" id="new_medicine">
					<?php
						$med_opt = medicamentos();
						for ($i = 0 ; $i < count($med_opt) ; $i++):
					?>
					<option value="<?php echo $med_opt[$i]['ID']?>"><?php echo $med_opt[$i]['NOMBRE']?> (<?php echo $med_opt[$i]['TIPO']?>)</option>
					<?php endfor;?>
				</select>
			</td>
			<td><input type="text" name="new_medicine_description"></td>
			<td><button id="medicine-update">Agregar receta</button></td>
		</tr>
	</tbody>
</table>

<br>

<strong>Discapacidades que presenta la persona</strong><br>
<table>
	<thead>
		<tr>
			<th>Nombre de la discapacidad</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i = 0 ; $i < count($discapacidades) ; $i++):?>
		<tr>
			<td><?php echo $discapacidades[$i]['TIPO_DISCAPACIDAD'];?></td>
			<td><button onclick="updateInfo({ID: <?php echo $discapacidades[$i]['ID']?>}, 15);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td>
				<button onclick="reload('new_disc',4)">Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_disc_id" id="new_disc">
					<?php
						$disc_opt = discapacidades();
						for ($i = 0 ; $i < count($disc_opt) ; $i++):
					?>
					<option value="<?php echo $disc_opt[$i]['ID']?>"><?php echo $disc_opt[$i]['TIPO']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td><button id="disc-update">Agregar discapacidad</button></td>
		</tr>
	</tbody>
</table>

<br>

<strong>Ayudas e instrumentos asignados a la persona</strong><br>
<table>
	<thead>
		<tr>
			<th>Tipo de ayuda o instrumento</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i = 0 ; $i < count($ayudasTec) ; $i++):?>
		<tr>
			<td><?php echo $ayudasTec[$i]['TIPO_AYUDA'];?></td>
			<td><button onclick="updateInfo({ID: <?php echo $ayudasTec[$i]['ID']?>}, 16);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td>
				<button onclick="reload('new_help',5)">Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_help_id" id="new_help">
					<?php
						$hlp_opt = ayudasTec();
						for ($i = 0 ; $i < count($hlp_opt) ; $i++):
					?>
					<option value="<?php echo $hlp_opt[$i]['ID']?>"><?php echo $hlp_opt[$i]['NOMBRE']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td><button id="help-update">Agregar ayuda</button></td>
		</tr>
	</tbody>
</table>

<br><br>


<!-- OTROS -->

<strong>Trabajos actuales de la persona</strong><br>
<table>
	<thead>
		<tr>
			<th>Lugar de trabajo</th>
			<th>Descripcion del trabajo</th>
		</tr>
	</thead>
	<tbody>
		<?php for($i = 0 ; $i < count($trabajos) ; $i++):?>
		<tr>
			<td><?php echo lugar($trabajos[$i]['ID_LUGAR'])['NOMBRE'];?></td>
			<td><?php echo $trabajos[$i]['DESCRIPCION']; ?></td>
			<td><button onclick="updateInfo({ID: <?php echo $trabajos[$i]['ID']?>}, 17);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td>
				<button onclick="reload('new_job',6)">Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_job_place" id="new_job">
					<?php
						$lg_opt = lugares();
						for ($i = 0 ; $i < count($lg_opt) ; $i++):
					?>
					<option value="<?php echo $lg_opt[$i]['ID']?>"><?php echo $lg_opt[$i]['NOMBRE']." (".$lg_opt[$i]['TIPO'].") (".$lg_opt[$i]['TIPO_INSTITUCION'].") RIF:".$lg_opt[$i]['RIF']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td><input type="text" name="new_job_description" placeholder="Descripcion del trabajo"></td>
			<td><button id="job-update">Agregar trabajo</button></td>
		</tr>
	</tbody>
</table>

<br>

<strong>Escolarizaciones de la persona</strong><br>
<table>
	<thead>
		<tr>
			<th>Lugar de escolarizacion</th>
			<th>Nivel educacional</th>
			<th>Descripcion</th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($escolarizacion)) for($i = 0 ; $i < 1/*count($escolarizacion)*/ ; $i++):?>
		<tr>
			<td><?php echo lugar($escolarizacion['ID_INSTITUCION'])['NOMBRE'];?></td>
			<td><?php echo $escolarizacion['NIVEL_EDUCACIONAL']; ?></td>
			<td><?php echo $escolarizacion['DESCRIPCION']; ?></td>
			<td><button onclick="updateInfo({ID: <?php echo $escolarizacion['ID']?>}, 18);">Eliminar</button></td>
		</tr>
		<?php endfor; ?>
		<tr>
			<td>
				<button onclick="reload('new_sch',7)">Recargar</button>&nbsp;&nbsp;<a href="options.php" title="Agregar mas opciones" target="__blank"><button>Agregar</button></a>
				<select name="new_sch_place" id="new_sch">
					<?php
						$lg_opt = lugares();
						for ($i = 0 ; $i < count($lg_opt) ; $i++):
							if ($lg_opt[$i]['TIPO_INSTITUCION'] != "EDUCATIVA")
								continue;
					?>
					<option value="<?php echo $lg_opt[$i]['ID']?>"><?php echo $lg_opt[$i]['NOMBRE']." (".$lg_opt[$i]['TIPO'].") (".$lg_opt[$i]['TIPO_INSTITUCION'].") RIF:".$lg_opt[$i]['RIF']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td>
				<select name="new_sch_lvl">
					<option value="1">MATERNAL</option>
					<option value="2">PREESCOLAR</option>
					<option value="3">PRIMARIA</option>
					<option value="4">SECUNDARIA</option>
					<option value="5">UNIVERSIDAD</option>
				</select>
			</td>
			<td><input type="text" name="new_sch_description" placeholder="Descripcion"></td>
			<td><button id="sch-update">Agregar escolarizacion</button></td>
		</tr>
	</tbody>
</table>

</div>
<!-- So crazy scripting... -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

		$("#generalinfo-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				NOMBRES: $("input[name='nombre']").val(),
				APELLIDOS: $("input[name='apellido']").val(),
				DNI: $("input[name='dni']").val(),
				TELEFONO: $("input[name='telefono']").val(),
				EMBARAZO: $("input[name='embarazo']:checked").val(),
				ENCAMADO: $("input[name='encamado']:checked").val(),
				PENSION: $("input[name='pension']:checked").val(),
				VOTO: $("input[name='voto']:checked").val(),
				FECHA_NAC: $("input[name='fecha_nacimiento']").val(),
				PESO: $("input[name='peso']").val(),
				ESTATURA: $("input[name='estatura']").val()
			};
			if(data['NOMBRES'] == "" || data['APELLIDOS'] == "" || data['DNI'] == "" || data['EMBARAZO'] == undefined || data['ENCAMADO'] == undefined || data['PENSION'] == undefined || data['VOTO'] == undefined)
				alert("Algún campo no es correcto");
			else
			//alert(data['ID']+"\n"+data['NOMBRES']+"\n"+data['APELLIDOS']+"\n"+data['DNI']+"\n"+data['TELEFONO']+"\n"+data['EMBARAZO']+"\n"+data['ENCAMADO']+"\n"+data['PENSION']+"\n"+data['VOTO']+"\n"+data['FECHA_NAC']+"\n"+data['PESO']+"\n"+data['ESTATURA']+"\n");
				updateInfo(data, 1);

		});
		
		$("#carnet-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				CODIGO_CARNET: $("input[name='codigo_carnet']").val(),
				SERIAL_CARNET: $("input[name='serial_carnet']").val()
			};
			
			if(data['CODIGO_CARNET'] == "" || data['SERIAL_CARNET'] == "")
				alert("Completa todos los campos");
			else
				//alert(data['ID']+"\n"+data['CODIGO_CARNET']+"\n"+data['SERIAL_CARNET']);
				updateInfo(data, 2);
		});
		
		$("#bono-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_BONO: $("select[name='new_bono_id']").val(),
				ID_CARNET: $("input[name='id_carnet']").val(),
			};
			updateInfo(data, 3);
		});
		
		$("#program-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_PROGRAMA: $("select[name='new_program_id']").val()
			};
			updateInfo(data, 4);
		});
		
		$("#sickness-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_ENFERMEDAD: $("select[name='new_sick_id']").val()
			};
			updateInfo(data, 5);
		});
		
		$("#medicine-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_MEDICAMENTO: $("select[name='new_medicine_id']").val(),
				DESCRIPCION: $("input[name='new_medicine_description']").val()
			};
			if (data['DESCRIPCION'] == "")
				alert("Completa todos los campos");
			else
				updateInfo(data, 6);
		});
		
		$("#disc-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_TIPODISCAPACIDAD: $("select[name='new_disc_id']").val(),
			};
			updateInfo(data, 7);
		});
		
		$("#help-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_TIPOAYUDA: $("select[name='new_help_id']").val(),
			};
			updateInfo(data, 8);
		});
		
		$("#job-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_LUGAR: $("select[name='new_job_place']").val(),
				DESCRIPCION: $("input[name='new_job_description']").val()
			};
			if (data['DESCRIPCION'] == "")
				alert("Completa todos los campos");
			else
				updateInfo(data, 9);
		});
		
		$("#sch-update").click(function (ev) {
			ev.preventDefault();
			var data = {
				ID: $("input[name='id-persona']").val(),
				ID_LUGAR: $("select[name='new_sch_place']").val(),
				NIVEL_EDUCACIONAL: $("select[name='new_sch_lvl']").val(),
				DESCRIPCION: $("input[name='new_sch_description']").val()
			};
			if (data['DESCRIPCION'] == "")
				alert("Completa todos los campos");
			else
				updateInfo(data, 10);
		});
		
		
	});
	function updateInfo(data, operation) {
		$.post("updateperson.php", {
			data: data,
			operation: operation,
		}, function (data) {
			location.reload();
		});
	}

	function reload(id,ope) {
		$.post('updateperson.php', {o: ope}, function(data) {
			$('#'+id).html(data);
		});
	}
</script>
<?php include("includes/footer.php")?>