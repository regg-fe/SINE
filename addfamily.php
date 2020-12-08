<!DOCTYPE html>
<?php
	include_once 'includes/functions.php';
?>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="js/jquery.js"></script>
	<title>Agregar persona</title>
</head>
<style type="text/css">
	form, form div{
		display: flex;
		flex-direction: column;
		width: 200px;
	}
	th{
		border: solid 2px black;
	}
	td{
		border: solid 1px black;
	}
</style>
<body>

	<form id="formulario">
		<input type="text" name="Nombres" placeholder="Nombres">
		<input type="text" name="Apellidos" placeholder="Apellidos">

		<hr>

		<div>
			Genero
			<label>Masculino<input type="radio" name="Genero" value="M"></label>
			<label>Femenino<input type="radio" name="Genero" value="F"></label>
		</div>

		<hr>

		<input type="number" name="DNI" placeholder="Cedula de identidad">
		<input type="text" name="Telefono" placeholder="Nro. Telefono">

		<hr>

		<select name="Posicion">
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

		<hr>

		<div>
			¿Embarazo?
			<label>Si<input type="radio" name="Embarazo" value="S"></label>
			<label>No<input type="radio" name="Embarazo" value="N"></label>
		</div>

		<hr>

		<div>
			¿Encamado?
			<label>Si<input type="radio" name="Encamado" value="S"></label>
			<label>No<input type="radio" name="Encamado" value="N"></label>
		</div>

		<hr>

		<div>
			Pension
			<label>Adulto mayor<input type="radio" name="Pension" value="AM"></label>
			<label>Seguro social<input type="radio" name="Pension" value="SS"></label>
			<label>No tiene<input type="radio" name="Pension" value="NT"></label>
		</div>

		<hr>

		<div>
			Voto
			<label>Duro<input type="radio" name="Voto" value="D"></label>
			<label>Blando<input type="radio" name="Voto" value="B"></label>
			<label>Oposicion<input type="radio" name="Voto" value="O"></label>
		</div>

		<hr>

		<input type="date" name="FechaNac">
		<input type="number" name="Peso" placeholder="Peso">
		<input type="number" name="Estatura" placeholder="Estatura">

		<hr>

		<button id="add">Agregar</button>
	</form>

	<table id="tabla">
		<thead>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>Genero</th>
			<th>DNI</th>
			<th>Nro Telefono</th>
			<th>Posicion</th>
			<th>Embarazo</th>
			<th>Encamado</th>
			<th>Pension</th>
			<th>Voto</th>
			<th>Fecha de Nacimiento</th>
			<th>Peso</th>
			<th>Estatura</th>
		</thead>
		<tbody>
			
		</tbody>
	</table>
	<?php
		if (isset($_GET['apartamento'])):
			$ap_id = $_GET['apartamento'];
			$apdata = apartamento($ap_id);
			echo "Apartamento: ".$apdata['NRO_APARTAMENTO']."<br>Bloque: ".$apdata['NRO_BLOQUE']."<br>";
		?>
		<input id="Apartamento" type="hidden" name="Apartamento" value="<?php echo $ap_id ?>">
	<?php
		else:
	?>
	<label>
		Bloque:
		<select name="Bloque">
			<?php 
				$bloques = bloques();
				for($i = 0; $i < count($bloques) ; $i++):
			?>
				 <option value="<?php echo $bloques[$i]['ID'] ?>"> <?php echo $bloques[$i]['NRO_BLOQUE'] ?> </option>

			<?php endfor; ?>
		</select>
	</label>
	<label>
		Apartamento:
		<select id="Apartamento" name="Apartamento">
			<?php
				$aparts = apartamentosPorBloque(1);
				for($i = 0; $i < count($aparts) ; $i++):
			?>
				 <option value="<?php echo $aparts[$i]['ID'] ?>"> <?php echo $aparts[$i]['NRO_APARTAMENTO'] ?> </option>

			<?php endfor; ?>
		</select>
	</label>
	<?php endif ?>
	<label>
		Estado de la vivienda:
		<select name="Vivienda">
			<option value="1">Propia</option>
			<option value="2">Alquilada</option>
			<option value="3">Asediada</option>
		</select>
	</label>

	<br>

	<button id="create">Crear familia</button>

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
				str += "<tr>";
				str += "<td>"+nombres+"</td>";
				str += "<td>"+apellidos+"</td>";
				str += "<td>"+genero+"</td>";
				str += "<td>"+dni+"</td>";
				str += "<td>"+telefono+"</td>";
				str += "<td>"+posicion+"</td>";
				str += "<td>"+embarazo+"</td>";
				str += "<td>"+encamado+"</td>";
				str += "<td>"+pension+"</td>";
				str += "<td>"+voto+"</td>";
				str += "<td>"+nacimiento+"</td>";
				str += "<td>"+peso+"</td>";
				str += "<td>"+estatura+"</td>";
				str += "<td><button onclick='$(this).parent().parent().remove()'>Eliminar</button></td>"
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
</body>
</html>