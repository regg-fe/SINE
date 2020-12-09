<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery.js"></script>
	<style type="text/css">
		table, th, tr, td{
			border: solid 1px black;
		}
	</style>
<?php
	include_once 'includes/functions.php';
	$con = conexion();
?>
	<title>Opciones</title>
</head>
<body>
	<!-- Ayudas Tecnicas -->
	<h2>Ayudas tecnicas registradas</h2>
	<?php
		$at = ayudasTec();
		if (count($at) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($at); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $at[$i]['NOMBRE'] ?></td>
					<td><button>Editar</button><button onclick="erase('AT',<?php echo $at[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="AyudaTec" placeholder="Agrega una nueva opcion" autocomplete="off">
		<button id="AddAyudaTec">Agregar</button>
	</form>

	<!-- Bonos -->
	<h2>Bonos registrados</h2>
	<?php
		$bn = bonos();
		if (count($bn) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($bn); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $bn[$i]['NOMBRE'] ?></td>
					<td><button>Editar</button><button onclick="erase('BN',<?php echo $bn[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="Bono" placeholder="Agrega una nueva opcion" autocomplete="off">
		<button id="AddBono">Agregar</button>
	</form>

	<!-- Programas Sociales -->
	<h2>Programas sociales registrados</h2>
	<?php
		$ps = programasSociales();
		if (count($ps) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($ps); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $ps[$i]['NOMBRE'] ?></td>
					<td><button>Editar</button><button onclick="erase('PS',<?php echo $ps[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="ProgramaSocial" placeholder="Agrega una nueva opcion" autocomplete="off">
		<button id="AddProgramaSocial">Agregar</button>
	</form>

	<!-- Discapacidades -->
	<h2>Discapacidades registradas</h2>
	<?php
		$dc = discapacidades();
		if (count($dc) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($dc); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $dc[$i]['NOMBRE'] ?></td>
					<td><button>Editar</button><button onclick="erase('DC',<?php echo $dc[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="Discapacidad" placeholder="Agrega una nueva opcion" autocomplete="off">
		<button id="AddDiscapacidad">Agregar</button>
	</form>


	<!-- Enfermedades -->
	<h2>Enfermedades registradas</h2>
	<?php
		$ef = enfermedades();
		if (count($ef) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($ef); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $ef[$i]['NOMBRE'] ?></td>
					<td><button>Editar</button><button onclick="erase('EF',<?php echo $ef[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="Enfermedad" placeholder="Agrega una nueva opcion" autocomplete="off">
		<button id="AddEnfermedad">Agregar</button>
	</form>

	<!-- Medicamentos -->
	<h2>Medicamentos registrados</h2>
	<?php
		$md = medicamentos();
		if (count($md) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Tipo</th>
			<th>Opciones</th>
		</thead>
		<tbody>
		<?php for ($i=0; $i < count($md); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $md[$i]['NOMBRE'] ?></td>
					<td><?php echo $md[$i]['TIPO'] ?></td>
					<td><button>Editar</button><button onclick="erase('MD',<?php echo $md[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="Medicamento" placeholder="Agrega una nueva opcion" autocomplete="off">
		<select name="TipoMedicamento">
			<option>-- TIPO --</option>
			<option value="1">Oral</option>
			<option value="2">Rectal/Vaginal</option>
			<option value="3">Intramuscular</option>
			<option value="4">Intravenosa</option>
			<option value="5">Topico</option>
			<option value="6">Intradermica</option>
			<option value="7">Optica</option>
			<option value="8">Oftalmica/Nasal</option>
		</select>
		<button id="AddMedicamento">Agregar</button>
	</form>

	<!-- Marcas de bombona -->
	<h2>Marcas de bombona registradas</h2>
	<?php
		$mb = marcaBombona();
		if (count($mb) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($mb); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $mb[$i]['MARCA'] ?></td>
					<td><button>Editar</button><button onclick="erase('MB',<?php echo $mb[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="MarcaBombona" placeholder="Agrega una nueva opcion" autocomplete="off">
		<button id="AddMarcaBombona">Agregar</button>
	</form>

	<!-- Tipos de bombona -->
	<h2>Tipos de bombona registradas</h2>
	<?php
		$tb = tipoBombona();
		if (count($tb) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($tb); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $tb[$i]['TIPO'] ?></td>
					<td><button>Editar</button><button onclick="erase('TB',<?php echo $tb[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="TipoBombona" placeholder="Agrega una nueva opcion" autocomplete="off">
		<button id="AddTipoBombona">Agregar</button>
	</form>

	<!-- Lugares / Instituciones -->
	<h2>Lugares o instituciones registradas</h2>
	<?php
		$lg = lugares();
		if (count($lg) != 0):
	?>
	<table>
		
		<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Privacidad</th>
			<th>Tipo de institucion</th>
			<th>RIF</th>
			<th>Opciones</th>
		</thead>
		<tbody>
			
		<?php for ($i=0; $i < count($lg); $i++): ?>
				<tr>
					<td><?php echo $i+1 ?></td>
					<td><?php echo $lg[$i]['NOMBRE'] ?></td>
					<td><?php echo $lg[$i]['TIPO'] ?></td>
					<td><?php echo $lg[$i]['TIPO_INSTITUCION'] ?></td>
					<td><?php echo $lg[$i]['RIF'] ?></td>
					<td><button>Editar</button><button onclick="erase('LG',<?php echo $lg[$i]['ID'] ?>);">Eliminar</button></td>
				</tr>
		<?php endfor; ?>
		</tbody>
	</table>
	<?php else: ?>
		<h4>Aún no se ha registrado nada aquí</h4>
	<?php endif; ?>
	<form>
		<input type="text" name="Lugar" placeholder="Agrega una nueva opcion" autocomplete="off">
		<select name="PrivacidadLugar">
			<option>-- PRIVACIDAD --</option>
			<option value="1">Publico</option>
			<option value="2">Privado</option>
		</select>
		<select name="TipoInstitucion">
			<option>-- TIPO DE INSTITUCION --</option>
			<option value="1">Política</option>
			<option value="2">Economica</option>
			<option value="3">Jurídica</option>
			<option value="4">Laboral</option>
			<option value="5">Científica</option>
			<option value="6">De salud</option>
			<option value="7">Educatíva</option>
			<option value="8">Artística</option>
			<option value="9">Ninguna</option>
		</select>
		<input type="text" name="RIF" placeholder="RIF" autocomplete="off">
		<button id="AddLugar">Agregar</button>
	</form>


	<!-- Scripting -->
	<script type="text/javascript">
		function erase(name, id) {
			$.post("opt.php", {
				met: "erase",
				name: name,
				id: id,
			}, function (ev) {
				location.reload();
			});
		}
		function add(name, data) {
			$.post("opt.php", {
				met: "add",
				name: name,
				data: data,
			}, function (ev) {
				alert(ev);
				location.reload();
			});
		}
		$(document).ready(function () {
			$("#AddAyudaTec").click(function (ev) {
				ev.preventDefault();
				add('AT',{ NOMBRE: $("input[name='AyudaTec']").val()});
			});
			$("#AddBono").click(function (ev) {
				ev.preventDefault();
				add('BN',{ NOMBRE: $("input[name='Bono']").val()});
			});
			$("#AddProgramaSocial").click(function (ev) {
				ev.preventDefault();
				add('PS',{ NOMBRE: $("input[name='ProgramaSocial']").val()});
			});
			$("#AddDiscapacidad").click(function (ev) {
				ev.preventDefault();
				add('DC',{ NOMBRE: $("input[name='Discapacidad']").val()});
			});
			$("#AddMedicamento").click(function (ev) {
				ev.preventDefault();
				add('MD',{ NOMBRE: $("input[name='Medicamento']").val(), TIPO: $("select[name='TipoMedicamento']").val()});
			});
			$("#AddEnfermedad").click(function (ev) {
				ev.preventDefault();
				add('EF',{ NOMBRE: $("input[name='Enfermedad']").val()});
			});
			$("#AddMarcaBombona").click(function (ev) {
				ev.preventDefault();
				add('MB',{ NOMBRE: $("input[name='MarcaBombona']").val()});
			});
			$("#AddTipoBombona").click(function (ev) {
				ev.preventDefault();
				add('TB',{ NOMBRE: $("input[name='TipoBombona']").val()});
			});
			$("#AddLugar").click(function (ev) {
				ev.preventDefault();
				add('LG',{ NOMBRE: $("input[name='Lugar']").val(), PRIVACIDAD: $("select[name='PrivacidadLugar']").val(), TIPO_INSTITUCION: $("select[name='TipoInstitucion']").val(), RIF: $("input[name='RIF']").val()});
			});
		});
	</script>
</body>
</html>