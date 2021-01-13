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
	<title>SINE: Opciones</title>
</head>
<body>
	<?php include("includes/navbar.php");?>
	<!-- Ayudas Tecnicas -->
	<div class="welcome">
		<h1>Opciones</h1>
	</div>
	<div class="card-container">
		<div class="card-table">
			<a class="center" href="home.php" title="Volver"><i class="fas fa-arrow-left"></i></a>
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
												<button class="icon" onclick="update(<?php echo $at[$i]['ID']?>,0,'Ayuda Tecnica',0)"><i class="fas fa-pen-alt"></i></button>
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
					<input type="text" name="AyudaTec" placeholder="Agrega una nueva opcion" autocomplete="off">
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
											<button class="icon" onclick="update(<?php echo $bn[$i]['ID']?>,1,'Bono',0)"><i class="fas fa-pen-alt"></i></button>
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
					<input type="text" name="Bono" placeholder="Agrega una nueva opcion" autocomplete="off">
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
											<button class="icon" onclick="update(<?php echo $ps[$i]['ID']?>,2,'Programa Social',0)"><i class="fas fa-pen-alt"></i></button>
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
					<input type="text" name="ProgramaSocial" placeholder="Agrega una nueva opcion" autocomplete="off">
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
												<button class="icon" onclick="update(<?php echo $dc[$i]['ID']?>,3,'Discapacidad',0)"><i class="fas fa-pen-alt"></i></button>
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
					<input type="text" name="Discapacidad" placeholder="Agrega una nueva opcion" autocomplete="off">
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
												<button class="icon" onclick="update(<?php echo $dc[$i]['ID']?>,4,'Enfermedad',0)"><i class="fas fa-pen-alt"></i></button>
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
					<input type="text" name="Enfermedad" placeholder="Agrega una nueva opcion" autocomplete="off">
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
												<button class="icon" onclick="update(<?php echo $md[$i]['ID']?>,7,'Medicamento',1)"><i class="fas fa-pen-alt"></i></button>
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
					<input type="text" name="Medicamento" placeholder="Agrega una nueva opcion" autocomplete="off">
					<select class="select-css" name="TipoMedicamento">
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
														<button class="icon" onclick="update(<?php echo $mb[$i]['ID']?>,5,'Marca',0)"><i class="fas fa-pen-alt"></i></button>
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
						<input type="text" name="MarcaBombona" placeholder="Agrega una nueva opcion" autocomplete="off">
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
													<button class="icon" onclick="update(<?php echo $mb[$i]['ID']?>,6,'Tipo',0)"><i class="fas fa-pen-alt"></i></button>
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
						<input type="text" name="TipoBombona" placeholder="Agrega una nueva opcion" autocomplete="off">
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
													<button class="icon" onclick="update(<?php echo $lg[$i]['ID']?>,8,'Institucion',2)"><i class="fas fa-pen-alt"></i></button>
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
						<select class="select-css" name="PrivacidadLugar">
							<option>-- PRIVACIDAD --</option>
							<option value="1">Publico</option>
							<option value="2">Privado</option>
						</select>
						<select class="select-css" name="TipoInstitucion">
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
			$("#delete").css("display","flex");
			$("#delete").css("position","fixed");
			$("#message").show();
		
			$("#deleteS").click(function (ev) {
				ev.preventDefault();
				$.post("opt.php", {
					met: "erase",
					name: name,
					id: id,
				}, function (data) {
					location.reload();
				});
			});
			
			$("#deleteN").click(function (ev) {
				ev.preventDefault();
				$("#delete").css("display","none");
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
	<!--Tabla===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
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
	<?php include("includes/modal.php") ?>
	<?php include("includes/footer.php")?>