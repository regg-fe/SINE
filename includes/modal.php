<!-- CAMBIO DE BLOQUE -->
	<div id="modal" class="modal">
		<div class="contenedor">
		<form id="fmodal" class="form" method="POST">
			<input id="idfam" type="hidden" value="<?php echo $id ?>">
			<p>Escoge un bloque:</p>
			<select id="selectBl">
				<?php 
				$bloques = bloques();
				for($i = 0; $i < count($bloques) ; $i++):
				 ?>
				 <option value="<?php echo $bloques[$i]['ID'] ?>"> <?php echo $bloques[$i]['NRO_BLOQUE'] ?> </option>

				<?php endfor; ?>
			</select>
			<p>Escoge un apartamento:</p>
			<select id="selectAp">
				<?php 
				$aparts = apartamentosPorBloque(1);
				for($i = 0; $i < count($aparts) ; $i++):
				 ?>
				 <option value="<?php echo $aparts[$i]['ID'] ?>"> <?php echo $aparts[$i]['NRO_APARTAMENTO'] ?> </option>

				<?php endfor; ?>
			</select>
			<div class="botones">
				<button id="sbm" class="boton">Cambiar</button>
				<button id="cnl" class="boton">Cancelar</button>
			</div>
		</form>
		</div>
	</div>
	
<!-- CAMBIO DE BLOQUE -->

<!-- BOMBONAS -->
	<div id="modalB" class="modal">
		<div class="contenedor">
		<form id="fmodalB" class="form" method="POST">
			<p>Escoge la marca de bombona:</p>
			<select id="selectMB" class="input">
				<?php $marcas = marcaBombona();
				for($i = 0; $i < count($marcas) ; $i++): ?>
				 <option value="<?php echo $marcas[$i]['ID'] ?>"> <?php echo $marcas[$i]['MARCA'] ?> </option>
				<?php endfor; ?>
			</select>

			<p>Escoge el tipo de bombona</p>
			<select id="selectTB" class="input">
				<?php  $tipos = tipoBombona(); 
				for($i = 0; $i < count($tipos) ; $i++): ?>
				 <option value="<?php echo $tipos[$i]['ID'] ?>"> <?php echo $tipos[$i]['TIPO'] ?> </option>
				<?php endfor; ?>
			</select>
			<div class="botones">
				<button id="sbmB" class="boton">Agregar</button>
				<button id="cnlB" class="boton">Cancelar</button>
			</div>
		</form>
		</div>
	</div>


<!-- BOMBONAS -->

<!-- SUGERIDOS -->
	<div id="modalE" class="modal">
		<div class="contenedor">
		<form id="fmodalE" class="form" method="POST">
			
			<p>Numero de sugeridos: </p><input type="number" class="input" id="number">
			<p>Fecha: </p><input type="date" id="month" placeholder="Fecha">
			<div class="botones">
				<button id="sbmE" class="boton">Agregar Entrega</button>
				<button id="cnlE" class="boton">Cancelar</button>
			</div>
		</form>
		</div>
	</div>
	
<!-- SUGERIDOS -->

<!-- ANEXOS -->
	<div id="modalA" class="modal">
		<div class="contenedor">
		<form id="fmodalA" class="form" method="POST">
			<input id="idblo" type="hidden" value="<?php echo $id ?>">
			<p>Ingrese el numero del anexo: </p><input type="number" class="input">
			<div class="botones">
				<button class="boton">Agregar</button>
				<button class="boton">Cancelar</button>
			</div>
		</form>
		</div>
	</div>
	
<!-- DELETE ANEXOS -->
	<div id="modalD" class="modal">
		<div class="contenedor">
		<form id="fmodalD" class="form" method="POST">
			<p>Escoge el anexo a eliminar: </p>
			<select class="input">
				<?php $anexos = apartamentosPorBloque($id) ?>
				<?php for($i = 0; $i < count($anexos) ; $i++): ?>
					<?php if ($anexos[$i]['ANEXO'] == 'S'): ?>
						<option value="<?php echo $anexos[$i]['ID'] ?>"> <?php echo $anexos[$i]['NRO_APARTAMENTO'] ?> </option>
					<?php endif ?>
				 <?php endfor ?>
			</select>
			<div class="botones">
				<button class="boton">Eliminar</button>
				<button class="boton">Cancelar</button>
			</div>
		</form>
		</div>
	</div>

	


<script type="text/javascript" src="js/js.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		//------------------------------//	
		// CAMBIO DE BLOQUE
		$("#selectBl").change(function () {
			var id = $("#selectBl").val();
			$.post("test.php", {idbl: id, }, function (data) {
				$("#selectAp").html(data);
				
			})
		});

		$("#sbm").click(function (ev) {
			ev.preventDefault();
			$.post("test.php", {
				bloque: $("#selectBl").val(), 
				apart: $("#selectAp").val(), 
				idfam: $("#idfam").val(),
			}, function (data) {
				location.reload();
			});
		});

		$("#cnl").click(function (ev) {
			ev.preventDefault();
			$("#modal").css("display","none");
		});

		$("#changedir").click(function (ev) {
			ev.preventDefault();
			$("#modal").css("display","flex");
			$("#modal").css("position","fixed");
		});
		//------------------------------//
		
		// BOMBONAS
		$("#changeB").click(function (ev) {
			ev.preventDefault();
			$("#modalB").css("display","flex");
			$("#modalB").css("position","fixed");
		});

		$("#sbmB").click(function (ev) {
			ev.preventDefault();
			$.post("test.php", {
				marca: $("#selectMB").val(), 
				tipo: $("#selectTB").val(), 
				idfamB: $("#idfam").val(),
			}, function (data) {
				location.reload();
			});
		});

		$("#cnlB").click(function (ev) {
			ev.preventDefault();
			$("#modalB").css("display","none");
		});
		//------------------------------//

		//------------------------------//	
		// SUGERIDOS
		$("#changeE").click(function (ev) {
			ev.preventDefault();
			$("#modalE").css("display","flex");
			$("#modalE").css("position","fixed");
		});

		$("#sbmE").click(function (ev) {
			ev.preventDefault();
			$.post("test.php", {
				total: $("#number").val(), 
				month: $("#month").val(), 
				idfamE: $("#idfam").val(),
			}, function (data) {
				location.reload();
			});
		});

		$("#cnlE").click(function (ev) {
			ev.preventDefault();
			$("#modalE").css("display","none");
		});
		//------------------------------//

		// ANEXOS
		$("#addA").click(function (ev) {
			ev.preventDefault();
			$("#modalA").css("display","flex");
			$("#modalA").css("position","fixed");
		});

		$("#sbmA").click(function (ev) {
			ev.preventDefault();
			$.post("test.php", {
				idBlo: $("#idblo").val(),
				numA: $("#numA").val(),
			}, function (data) {
				location.reload();
			});
		});

		$("#cnlA").click(function (ev) {
			ev.preventDefault();
			$("#modalA").css("display","none");
		});
		//------------------------------//

		// ELIMINAR ANEXOS
		$("#delA").click(function (ev) {
			ev.preventDefault();
			$("#modalD").css("display","flex");
			$("#modalD").css("position","fixed");
		});

		$("#sbmD").click(function (ev) {
			ev.preventDefault();
			$.post("test.php", {
				numD: $("#selectDA").val(),
			}, function (data) {
				location.reload();
			});
		});

		$("#cnlD").click(function (ev) {
			ev.preventDefault();
			$("#modalD").css("display","none");
		});
		//------------------------------//
	});
</script>