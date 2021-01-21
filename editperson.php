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
	<link rel="stylesheet" href="css/scrollbar-vertical.css">
	<title>Editar persona</title>
	<style>
		.box-form p{
			color: #2d2d2d;
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
			<?php if($persona['GENERO'] == 'M') echo "<div class='mediano info-edit'>Masculino</div>"; else echo "<div class='mediano info-edit'>Femenino</div>"; ?>
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
		<?php 
			if($persona['EMBARAZO'] == 'M'){?>
				<script>
					document.querySelector('#embsi').checked = true;
				</script>					
			<?php } else{?>
				<script>
					document.querySelector('#embno').checked = true;
				</script>
			<?php } 
		?>
		<?php else:?>
			<input type="radio" name="embarazo" value="N" checked style="display: none">
		<?php endif;?>
	</div>
		<div class="agrupar-input" >
			<p>¿Encamado?</p>
			<span>
				<input type="radio" id="encsi" name="encamado" value="S">
				<label for="encsi">Sí</label>
			</span>
			<span>
				<input type="radio" id="encno" name="encamado" value="N">
				<label for="encno">No</label>
			</span>
			<?php 
				if($persona['ENCAMADO'] == 'M') {?>
					<script>
						document.querySelector('#encsi').checked = true;
					</script>					
				<?php } else{?>
					<script>
						document.querySelector('#encno').checked = true;
					</script>
				<?php } 
			?>
				
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
			<?php 
			if($persona['PENSION'] == 'AM') {?>
				<script>
					document.querySelector('#ad').checked = true;
				</script>
			<?php } else if($persona['PENSION'] == 'SS') {?>
				<script>
					document.querySelector('#se').checked = true;
				</script>
				<?php } else {?>
				<script>
					document.querySelector('#nt').checked = true;
				</script>
				<?php } 
			?>
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
		<?php 
			if($persona['VOTO'] == 'D') {?>
				<script>
					document.querySelector('#du').checked = true;
				</script> 
			<?php } else if($persona['VOTO'] == 'B') {?>
				<script>
					document.querySelector('#bl').checked = true;
				</script>
			<?php } else {?>
				<script>
					document.querySelector('#vo').checked = true;
				</script>
			<?php } 
		?>
		</div>
		</div>
	</div>
		<button id="generalinfo-update">Actualizar informacion</button>
		
	</div>


	</div>


<!-- INFORMACION DEL CARNET -->
<div class="card-container">
	<div class="card-table">
		<h2 class="centrar">Carnet de la patria</h2>
		<div class="agregar centrar" style="box-shadow: 3px 3px 10px rgba(0,0,0,0.2);">
		<?php if ($persona['ID_CARNET'] === null) {
			echo "(Aun no se ha registrado un carnet para esta persona)";
		} ?>
		
		Codigo del carnet:		<input type="text" name="codigo_carnet" <?php if($persona['CODIGO_CARNET'] != null):?> value="<?php echo $persona['CODIGO_CARNET'] ?>" <?php endif;?>><br>
		Serial del carnet:		<input type="text" name="serial_carnet" <?php if($persona['SERIAL_CARNET'] != null):?> value="<?php echo $persona['SERIAL_CARNET'] ?>" <?php endif;?>><br>
		<button id="carnet-update" style="margin-top: 20px;">Actualizar informacion</button>
		</div>
	</div>
	<!--Bono-->
	<?php if ($persona['ID_CARNET'] != null): ?>
	<div class="card-table">
	<h2 class="centrar">Bonos recibidos</h2>
	<div class="wrap-table100">	
			<div class="table100 ver1">
				<div class="wrap-table100 js-pscroll">
					<div class="table100-nextcols">
						<div class="scroll_vertical">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Nombre del bono</th>
										<th class="cell100 column3">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i = 0 ; $i < count($bonos) ; $i++):?>
									<tr class="row100 body">
										<td class="cell100 column2"><?php echo $bonos[$i]['NOMBRE_BONO'];?></td>
										<td class="cell100 column0"><button onclick="updateInfo({ID: <?php echo $bonos[$i]['ID']?>}, 11);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

			<div class="agregar centrar">
				<button onclick="reload('new_bono',0)"><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
				<select class="select-css" name="new_bono_id" id="new_bono">
					<?php
						$bn_opt = bonos();
						for ($i = 0 ; $i < count($bn_opt) ; $i++):
					?>
					<option value="<?php echo $bn_opt[$i]['ID']?>"><?php echo $bn_opt[$i]['NOMBRE']?></option>
					<?php endfor;?>
				</select>
				<button id="bono-update">Agregar bono</button></td>
			</div>
								
		<input type="hidden" name="id_carnet" value="<?php echo $persona['ID_CARNET']; ?>">
		<?php endif;?>
	</div>

	<div class="card-table">
		<h2 class="centrar">Programas sociales asignados</h2>
		<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
						<div class="scroll_vertical">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Nombre del programa</th>
										<th class="cell100 column3">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i = 0 ; $i < count($programas) ; $i++):?>
									<tr>
										<td class="cell100 column2"><?php echo $programas[$i]['NOMBRE'];?></td>
										<td class="cell100 column3"><button onclick="updateInfo({ID: <?php echo $programas[$i]['ID']?>}, 12);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>

								</tbody>
							</table>
						</div>
						</div>
					</div>
				</div>
			</div>
			<div class="agregar centrar">
		
			<button onclick="reload('new_program',1)"><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
			<select class="select-css" name="new_program_id" id="new_program">
				<?php
					$ps_opt = programasSociales();
					for ($i = 0 ; $i < count($ps_opt) ; $i++):
													?>
				<option value="<?php echo $ps_opt[$i]['ID']?>"><?php echo $ps_opt[$i]['NOMBRE']?></option>
				<?php endfor;?>
			</select>
		<button id="program-update">Agregar programa</button>
	</div>
	</div>


	<!-- INFORMACION DE SALUD -->
	<div class="card-table">
		<h2 class="centrar">Enfermedades que presenta</h2>
		<div class="wrap-table100">	
			<div class="table100 ver1">
				<div class="wrap-table100 js-pscroll">
					<div class="table100-nextcols">
						<div class="scroll_vertical">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Nombre de la enfermedad</th>
										<th class="cell100 column3">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i = 0 ; $i < count($enfermedades) ; $i++):?>
									<tr>
										<td class="cell100 column2"><?php echo $enfermedades[$i]['NOMBRE_ENFERMEDAD'];?></td>
										<td class="cell100 column3"><button onclick="updateInfo({ID: <?php echo $enfermedades[$i]['ID']?>}, 13);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="agregar centrar">
				<button onclick="reload('new_sick',2)"><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
				<select class="select-css" name="new_sick_id" id="new_sick">
				<?php
					$enf_opt = enfermedades();
					for ($i = 0 ; $i < count($enf_opt) ; $i++):
				?>
				<option value="<?php echo $enf_opt[$i]['ID']?>"><?php echo $enf_opt[$i]['NOMBRE']?></option>
				<?php endfor;?>
				</select>
										
				<button id="sickness-update">Agregar enfermedad</button>
			</div class="agregar centrar">
	</div>

	<div class="card-table">
		<h2 class="centrar">Discapacidades que presenta</h2>
		<div class="wrap-table100">	
			<div class="table100 ver1">
				<div class="wrap-table100 js-pscroll">
					<div class="table100-nextcols">
						<div class="scroll_vertical">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Nombre de la discapacidad</th>
										<th class="cell100 column3">ELiminar</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i = 0 ; $i < count($discapacidades) ; $i++):?>
									<tr>
										<td class="cell100 column2"><?php echo $discapacidades[$i]['TIPO_DISCAPACIDAD'];?></td>
										<td class="cell100 column3"><button onclick="updateInfo({ID: <?php echo $discapacidades[$i]['ID']?>}, 15);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="agregar centrar">
			<td>
				<button onclick="reload('new_disc',4)"><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
				<select class="select-css" name="new_disc_id" id="new_disc">
					<?php
						$disc_opt = discapacidades();
						for ($i = 0 ; $i < count($disc_opt) ; $i++):
					?>
					<option value="<?php echo $disc_opt[$i]['ID']?>"><?php echo $disc_opt[$i]['TIPO']?></option>
					<?php endfor;?>
				</select>
			</td>
			<td><button id="disc-update">Agregar discapacidad</button></td>
		</div>
	</div>
	<div class="card-table">
		<h2 class="centrar">Ayudas e instrumentos asignados </h2>
		<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Tipo de ayuda o instrumento</th>
										<th class="cell100 column3">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i = 0 ; $i < count($ayudasTec) ; $i++):?>
									<tr>
										<td class="cell100 column2"><?php echo $ayudasTec[$i]['TIPO_AYUDA'];?></td>
										<td class="cell100 column3"><button onclick="updateInfo({ID: <?php echo $ayudasTec[$i]['ID']?>}, 16);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="agregar centrar">							
				<button onclick="reload('new_help',5)"><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
				<select class="select-css" name="new_help_id" id="new_help">
					<?php
						$hlp_opt = ayudasTec();
						for ($i = 0 ; $i < count($hlp_opt) ; $i++):
					?>
						<option value="<?php echo $hlp_opt[$i]['ID']?>"><?php echo $hlp_opt[$i]['NOMBRE']?></option>
						<?php endfor;?>
					</select>
									
				<button id="help-update">Agregar ayuda</button>
			</div>
	</div>

<div class="card-table tablas-grandes">
		<h2 class="centrar">Medicamentos recetados </h2>
		<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Nombre del medicamento</th>
										<th class="cell100 column8">Tipo de medicamento</th>
										<th class="cell100 column4">Descripcion de la receta</th>
										<th class="cell100 column3">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i = 0 ; $i < count($recetas) ; $i++):?>
									<tr>
										<td class="cell100 column2"><?php echo $recetas[$i]['NOMBRE_MEDICAMENTO'];?></td>
										<td class="cell100 column8"><?php echo $recetas[$i]['TIPO_MEDICAMENTO'];?></td>
										<td class="cell100 column4"><?php echo $recetas[$i]['DESCRIPCION'];?></td>
										<td class="cell100 column3"><button onclick="updateInfo({ID: <?php echo $recetas[$i]['ID']?>}, 14);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="agregar centrar">
			<td colspan="2">
				<button onclick="reload('new_medicine',3)" ><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
				<select class="select-css" name="new_medicine_id" id="new_medicine">
				<?php
					$med_opt = medicamentos();
						for ($i = 0 ; $i < count($med_opt) ; $i++):
						?>
						<option value="<?php echo $med_opt[$i]['ID']?>"><?php echo $med_opt[$i]['NOMBRE']?> (<?php echo $med_opt[$i]['TIPO']?>)</option>
						<?php endfor;?>
				</select>
				</td>
				<input type="text" name="new_medicine_description" placeholder="Descripcion de la receta">
				<button id="medicine-update">Agregar receta</button>
			</div>
	</div>

	<!-- OTROS -->
	<div class="card-table tablas-grandes">
		<h2 class="centrar">Trabajos actuales</h2>
		<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Lugar de trabajo</th>
										<th class="cell100 column8">Descripcion del trabajo</th>
										<th class="cell100 column3">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php for($i = 0 ; $i < count($trabajos) ; $i++):?>
									<tr>
										<td class="cell100 column2"><?php echo lugar($trabajos[$i]['ID_LUGAR'])['NOMBRE'];?></td>
										<td class="cell100 column8"><?php echo $trabajos[$i]['DESCRIPCION']; ?></td>
										<td class="cell100 column3"><button onclick="updateInfo({ID: <?php echo $trabajos[$i]['ID']?>}, 17);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="agregar centrar">			
					<button onclick="reload('new_job',6)"><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
					<select class="select-css" name="new_job_place" id="new_job">
						<?php
							$lg_opt = lugares();
							for ($i = 0 ; $i < count($lg_opt) ; $i++):
						?>
					<option value="<?php echo $lg_opt[$i]['ID']?>"><?php echo $lg_opt[$i]['NOMBRE']." (".$lg_opt[$i]['TIPO'].") (".$lg_opt[$i]['TIPO_INSTITUCION'].") RIF:".$lg_opt[$i]['RIF']?></option>
					<?php endfor;?>
				</select>
									
				<input type="text" name="new_job_description" placeholder="Descripcion del trabajo">
				<button id="job-update">Agregar trabajo</button>
			</div>
	</div>

	<div class="card-table">
		<h2 class="centrar">Escolarizaciones</h2>
		<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column2">Lugar de escolarizacion</th>
										<th class="cell100 column3">Nivel educacional</th>
										<th class="cell100 column9">Descripcion</th>
										<th class="cell100 column3">Eliminar</th>
									</tr>
								</thead>
								<tbody>
									<?php if(isset($escolarizacion)) for($i = 0 ; $i < 1/*count($escolarizacion)*/ ; $i++):?>
									<tr>
										<td class="cell100 column2"><?php echo lugar($escolarizacion['ID_INSTITUCION'])['NOMBRE'];?></td>
										<td class="cell100 column3"><?php echo $escolarizacion['NIVEL_EDUCACIONAL']; ?></td>
										<td class="cell100 column9"><?php echo $escolarizacion['DESCRIPCION']; ?></td>
										<td class="cell100 column3"><button onclick="updateInfo({ID: <?php echo $escolarizacion['ID']?>}, 18);"><i class="fas fa-eraser"></button></td>
									</tr>
									<?php endfor; ?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="agregar centrar">
			<td>
			<button onclick="reload('new_sch',7)"><i class="fas fa-redo-alt"></i></button><a href="options.php" title="Agregar mas opciones" target="__blank"><button><i class="fas fa-plus"></i></button></a>
			<select class="select-css" name="new_sch_place" id="new_sch">
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
			<select class="select-css" name="new_sch_lvl">
				<option value="1">MATERNAL</option>
				<option value="2">PREESCOLAR</option>
				<option value="3">PRIMARIA</option>
				<option value="4">SECUNDARIA</option>
				<option value="5">UNIVERSIDAD</option>
			</select>
		</td>
		<td><input type="text" name="new_sch_description" placeholder="Descripcion"></td>
		<td><button id="sch-update">Agregar escolarizacion</button></td>
	</div>
</div>
	</div>
	
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