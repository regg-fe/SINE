<?php  
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$con = conexion();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/styleTable.css">
	<link rel="stylesheet" type="text/css" href="css/insertForms.css">
	<title>Opciones</title>
</head>
<body>
	<?php include("includes/navbar.php");?>
	<!-- Ayudas Tecnicas -->
	<div class="welcome">
		<h1>Opciones</h1>
	</div>
	<div class="card-container">
		<div class="card-table">
			<h2 class="centrar">Ayudas tecnicas registradas</h2>
			<?php
				$at = ayudasTec();
				if (count($at) != 0):
			?>
			<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column1">#</th>
										<th class="cell100 column3">Nombre</th>
										<th class="cell100 column9">Opciones</th>
									</tr>
								</thead>
								<tbody>
									
								<?php for ($i=0; $i < count($at); $i++): ?>
										<tr class="row100 body">
											<td class="cell100 column1"><?php echo $i+1 ?></td>
											<td class="cell100 column3"><?php echo $at[$i]['NOMBRE'] ?></td>
											<td class="cell100 column9">
												<button class="icon"><i class="fas fa-pen-alt"></i></button>
												<button class="icon" onclick="erase('AT',<?php echo $at[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
											</td>
										</tr>
								<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>	
			
			<?php else: ?>
				<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
			<?php endif; ?>
			<div class="agregar">
				<form class="centrar">
					<input type="text" name="AyudaTec" id="at" placeholder="Agrega una nueva opcion" autocomplete="off">
					<button id="AddAyudaTec">Agregar</button>
				</form>
			</div>
		</div>

		<!-- Bonos -->
		<div class="card-table">
			<h2 class="centrar">Bonos registrados</h2>
			<?php
				$bn = bonos();
				if (count($bn) != 0):
			?>
			<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column1">#</th>
										<th class="cell100 column3">Nombre</th>
										<th class="cell100 column9">Opciones</th>
									</tr>
								</thead>
								<tbody>
									
								<?php for ($i=0; $i < count($bn); $i++): ?>
									<tr class="row100 body">
										<td class="cell100 column1"><?php echo $i+1 ?></td>
										<td class="cell100 column3"><?php echo $bn[$i]['NOMBRE'] ?></td>
										<td class="cell100 column9">
											<button class="icon"><i class="fas fa-pen-alt"></i></button>
											<button class="icon" onclick="erase('BN',<?php echo $bn[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
										</td>
									</tr>
								<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<?php else: ?>
				<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
			<?php endif; ?>
			<div class="agregar">
				<form class="centrar">
					<input type="text" name="Bono" id="bn" placeholder="Agrega una nueva opcion" autocomplete="off">
					<button id="AddBono">Agregar</button>
				</form>
			</div>
		</div>	

		<!-- Programas Sociales -->
		<div class="card-table">
			<h2 class="centrar">Programas sociales registrados</h2>
			<?php
				$ps = programasSociales();
				if (count($ps) != 0):
			?>
			<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>

								<thead>
									<tr  class="row100 head">
										<th class="cell100 column1">#</th>
										<th class="cell100 column3">Nombre</th>
										<th class="cell100 column9">Opciones</th>
									</tr>
								</thead>
								<tbody>
									
								<?php for ($i=0; $i < count($ps); $i++): ?>
									<tr class="row100 body">
										<td class="cell100 column1"><?php echo $i+1 ?></td>
										<td class="cell100 column3"><?php echo $ps[$i]['NOMBRE'] ?></td>
										<td class="cell100 column9">
											<button class="icon"><i class="fas fa-pen-alt"></i></button>
											<button class="icon" onclick="erase('PS',<?php echo $ps[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
										</td>
									</tr>
								<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<?php else: ?>
				<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
			<?php endif; ?>
			<div class="agregar">
				<form class="centrar">
					<input type="text" name="ProgramaSocial" id="ps" placeholder="Agrega una nueva opcion" autocomplete="off">
					<button id="AddProgramaSocial">Agregar</button>
				</form>
			</div>
		</div>
		<!-- Discapacidades -->
		<div class="card-table">
			<h2 class="centrar">Discapacidades registradas</h2>
			<?php
				$dc = discapacidades();
				if (count($dc) != 0):
			?>
			<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column1">#</th>
										<th class="cell100 column3">Nombre</th>
										<th class="cell100 column9">Opciones</th>
									</tr>
								</thead>
								<tbody>
									
								<?php for ($i=0; $i < count($dc); $i++): ?>
										<tr class="row100 body">
											<td class="cell100 column1"><?php echo $i+1 ?></td>
											<td class="cell100 column3"><?php echo $dc[$i]['TIPO'] ?></td>
											<td class="cell100 column9">
												<button class="icon"><i class="fas fa-pen-alt"></i></button>
												<button class="icon" onclick="erase('DC',<?php echo $dc[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
											</td>
										</tr>
								<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<?php else: ?>
				<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
			<?php endif; ?>
			<div class="agregar">
				<form class="centrar">
					<input type="text" name="Discapacidad" id="dc" placeholder="Agrega una nueva opcion" autocomplete="off">
					<button id="AddDiscapacidad">Agregar</button>
				</form>
			</div>
		</div>

		<!-- Enfermedades -->
		<div class="card-table">
			<h2 class="centrar">Enfermedades registradas</h2>
			<?php
				$ef = enfermedades();
				if (count($ef) != 0):
			?>
			<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								
								<thead>
									<tr  class="row100 head">
										<th class="cell100 column1">#</th>
										<th class="cell100 column3">Nombre</th>
										<th class="cell100 column9">Opciones</th>
									</tr>
								</thead>
								<tbody>
									
								<?php for ($i=0; $i < count($ef); $i++): ?>
										<tr  class="row100 body">
											<td class="cell100 column1"><?php echo $i+1 ?></td>
											<td class="cell100 column3"><?php echo $ef[$i]['NOMBRE'] ?></td>
											<td class="cell100 column9">
												<button class="icon"><i class="fas fa-pen-alt"></i></button>
												<button class="icon" onclick="erase('EF',<?php echo $ef[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
											</td>
										</tr>
								<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<?php else: ?>
				<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
			<?php endif; ?>
			<div class="agregar">
				<form class="centrar">
					<input type="text" name="Enfermedad" id="ef" placeholder="Agrega una nueva opcion" autocomplete="off">
					<button id="AddEnfermedad">Agregar</button>
				</form>
			</div>
		</div>

		<!-- Medicamentos -->
		<div class="card-table">
			<h2 class="centrar">Medicamentos registrados</h2>
			
				<?php
					$md = medicamentos();
					if (count($md) != 0):
				?>
			<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr class="row100 head">
										<th class="cell100 column1">#</th>
										<th class="cell100 column3">Nombre</th>
										<th class="cell100 column4">Tipo</th>
										<th class="cell100 column9">Opciones</th>
									</tr>
								</thead>
								<tbody>
								<?php for ($i=0; $i < count($md); $i++): ?>
										<tr class="row100 body">
											<td class="cell100 column1"><?php echo $i+1 ?></td>
											<td class="cell100 column3"><?php echo $md[$i]['NOMBRE'] ?></td>
											<td class="cell100 column4"><?php echo $md[$i]['TIPO'] ?></td>
											<td class="cell100 column9">
												<button class="icon"><i class="fas fa-pen-alt"></i></button>
												<button class="icon" onclick="erase('MD',<?php echo $md[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
											</td>
										</tr>
									<?php endfor; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
				<?php else: ?>
					<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
				<?php endif; ?>
			<div class="agregar">
				<form class="centrar">
					<input type="text" name="Medicamento" id="md" placeholder="Agrega una nueva opcion" autocomplete="off">
					<select class="select-css" name="TipoMedicamento" required>
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
			</div>
		</div>

			<!-- Marcas de bombona -->
			<div class="card-table">
				<h2 class="centrar">Marcas de bombona registradas</h2>
				<?php
					$mb = marcaBombona();
					if (count($mb) != 0):
				?>
				<div class="wrap-table100">	
					<div class="table100 ver1">
						<div class="wrap-table100 js-pscroll">
							<div class="table100-nextcols">
								<table>
									<thead>
										<tr class="row100 head">
											<th class="cell100 column1">#</th>
											<th class="cell100 column3">Nombre</th>
											<th class="cell100 column9">Opciones</th>
										</tr>
										</thead>
										<tbody>
											
										<?php for ($i=0; $i < count($mb); $i++): ?>
												<tr class="row100 body">
													<td class="cell100 column1"><?php echo $i+1 ?></td>
													<td class="cell100 column3"><?php echo $mb[$i]['MARCA'] ?></td>
													<td class="cell100 column9">
														<button class="icon"><i class="fas fa-pen-alt"></i></button>
														<button class="icon" onclick="erase('MB',<?php echo $mb[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
													</td>
												</tr>
										<?php endfor; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				<?php else: ?>
					<h4>Aún no se ha registrado nada aquí</h4>
				<?php endif; ?>
				<div class="agregar">
					<form class="centrar">
						<input type="text" name="MarcaBombona" id="mb" placeholder="Agrega una nueva opcion" autocomplete="off">
						<button id="AddMarcaBombona">Agregar</button>
					</form>
				</div>
			</div>

			<!-- Tipos de bombona -->
			<div class="card-table">
				<h2 class="centrar">Tipos de bombona registradas</h2>
				<?php
					$tb = tipoBombona();
					if (count($tb) != 0):
				?>
				<div class="wrap-table100">	
					<div class="table100 ver1">
						<div class="wrap-table100 js-pscroll">
							<div class="table100-nextcols">
								<table>
									<thead>
										<tr class="row100 head">
											<th class="cell100 column1">#</th>
											<th class="cell100 column3">Nombre</th>
											<th class="cell100 column9">Opciones</th>
										</tr>
									</thead>
									<tbody>
										
									<?php for ($i=0; $i < count($tb); $i++): ?>
											<tr class="row100 body">
												<td class="cell100 column1"><?php echo $i+1 ?></td>
												<td class="cell100 column3"><?php echo $tb[$i]['TIPO'] ?></td>
												<td class="cell100 column9">
													<button class="icon"><i class="fas fa-pen-alt"></i></button>
													<button class="icon" onclick="erase('TB',<?php echo $tb[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
												</td>
											</tr>
									<?php endfor; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php else: ?>
					<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
				<?php endif; ?>
				<div class="agregar">
					<form class="centrar">
						<input type="text" name="TipoBombona" id="tb" placeholder="Agrega una nueva opcion" autocomplete="off">
						<button id="AddTipoBombona">Agregar</button>
					</form>
				</div>
			</div>

			<!-- Lugares / Instituciones -->
			<div class="card-table">
				<h2 class="centrar">Lugares o instituciones registradas</h2>
				<?php
					$lg = lugares();
					if (count($lg) != 0):
				?>
				<div class="wrap-table100">	
				<div class="table100 ver1">
					<div class="wrap-table100 js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr class="row100 head">
										<th class="cell100 column1">#</th>
										<th class="cell100 column3">Nombre</th>
										<th class="cell100 column3">Privacidad</th>
										<th class="cell100 column5">Tipo de institucion</th>
										<th class="cell100 column3">RIF</th>
										<th class="cell100 column9">Opciones</th>
									</tr>
									</thead>
									<tbody>
										
									<?php for ($i=0; $i < count($lg); $i++): ?>
											<tr class="row100 body">
												<td class="cell100 column1"><?php echo $i+1 ?></td>
												<td class="cell100 column3"><?php echo $lg[$i]['NOMBRE'] ?></td>
												<td class="cell100 column3"><?php echo $lg[$i]['TIPO'] ?></td>
												<td class="cell100 column5"><?php echo $lg[$i]['TIPO_INSTITUCION'] ?></td>
												<td class="cell100 column3"><?php echo $lg[$i]['RIF'] ?></td>
												<td class="cell100 column9">
													<button class="icon"><i class="fas fa-pen-alt"></i></button>
													<button class="icon" onclick="erase('LG',<?php echo $lg[$i]['ID'] ?>);"><i class="fas fa-eraser"></i></button>
												</td>
											</tr>
									<?php endfor; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<?php else: ?>
					<h4 class="centrar">Aún no se ha registrado nada aquí</h4>
				<?php endif; ?>
				<div class="agregar">
					<form class="centrar">
						<input type="text" name="Lugar" placeholder="Agrega una nueva opcion" autocomplete="off">
						<select class="select-css" name="PrivacidadLugar" required>
							<option>-- PRIVACIDAD --</option>
							<option value="1">Publico</option>
							<option value="2">Privado</option>
						</select>
						<select class="select-css" name="TipoInstitucion" required>
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
				</div>
			</div>
		</div>
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
				location.reload();
			});
		}

		$(document).ready(function () {
			$("#AddAyudaTec").click(function (ev) {
				if ($("#at").val() == ""){
					$("#at").css("border-color","#D32F2F");
					$("#at").attr("placeholder","Agregue una opción");
				}
				else{
					add('AT',{ NOMBRE: $("input[name='AyudaTec']").val()});
				}
				ev.preventDefault();
			});
			$("#AddBono").click(function (ev) {
				if ($("#bn").val() == ""){
					$("#bn").css("border-color","#D32F2F");
					$("#bn").attr("placeholder","Agregue una opción");
				}
				else{
					add('BN',{ NOMBRE: $("input[name='Bono']").val()});
				}
				ev.preventDefault();
			});
			$("#AddProgramaSocial").click(function (ev) {
				if ($("#ps").val() == ""){
					$("#ps").css("border-color","#D32F2F");
					$("#ps").attr("placeholder","Agregue una opción");
				}
				else{
				add('PS',{ NOMBRE: $("input[name='ProgramaSocial']").val()});
				}
				ev.preventDefault();
			});
			$("#AddDiscapacidad").click(function (ev) {
				if ($("#dc").val() == ""){
					$("#dc").css("border-color","#D32F2F");
					$("#dc").attr("placeholder","Agregue una opción");
				}
				else{
					add('DC',{ NOMBRE: $("input[name='Discapacidad']").val()});
				}
				ev.preventDefault();
			});
			$("#AddMedicamento").click(function (ev) {
				if ($("#md").val() == ""){
					$("#md").css("border-color","#D32F2F");
					$("#md").attr("placeholder","Agregue una opción");
				}
				else{
					add('MD',{ NOMBRE: $("input[name='Medicamento']").val(), TIPO: $("select[name='TipoMedicamento']").val()});
				}
				ev.preventDefault();
			});
			$("#AddEnfermedad").click(function (ev) {
				if ($("#ef").val() == ""){
					$("#ef").css("border-color","#D32F2F");
					$("#ef").attr("placeholder","Agregue una opción");
				}
				else{
					add('EF',{ NOMBRE: $("input[name='Enfermedad']").val()});
				}
				ev.preventDefault();
			});
			$("#AddMarcaBombona").click(function (ev) {
				if ($("#mb").val() == ""){
					$("#mb").css("border-color","#D32F2F");
					$("#mb").attr("placeholder","Agregue una opción");
				}
				else{
					add('MB',{ NOMBRE: $("input[name='MarcaBombona']").val()});
				}
				ev.preventDefault();
			});
			$("#AddTipoBombona").click(function (ev) {
				if ($("#tb").val() == ""){
					$("#tb").css("border-color","#D32F2F");
					$("#tb").attr("placeholder","Agregue una opción");
				}
				else{
					add('TB',{ NOMBRE: $("input[name='TipoBombona']").val()});
				}
				ev.preventDefault();
			});
			$("#AddLugar").click(function (ev) {
				if ($("input[name='Lugar']").val() == ""){
					$("input[name='Lugar']").css("border-color","#D32F2F");
					$("input[name='Lugar']").attr("placeholder","Agregue una opción");
				}
				if ($("select[name='PrivacidadLugar']").val() == "-- PRIVACIDAD --") {
					$("#select[name='PrivacidadLugar']").css("border-color","#D32F2F");
				}
				if ($("select[name='TipoInstitucion']").val() == "-- TIPO DE INSTITUCION --") {
					$("select[name='TipoInstitucion']").css("border-color","#D32F2F");
				}
				if ($("input[name='RIF']").val() == "") {
					$("input[name='RIF']").css("border-color","#D32F2F");
					$("input[name='RIF']").attr("placeholder","Agregue una opción");
				}
				else{
					add('LG',{ NOMBRE: $("input[name='Lugar']").val(), PRIVACIDAD: $("select[name='PrivacidadLugar']").val(), TIPO_INSTITUCION: $("select[name='TipoInstitucion']").val(), RIF: $("input[name='RIF']").val()});
				}
				ev.preventDefault();
			});
		});
	</script>
	<!--Tabla===============================================================================================-->	
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