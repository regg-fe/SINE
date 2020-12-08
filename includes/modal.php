<!-- CAMBIO DE BLOQUE -->
	<div id="modal">
		<form id="fmodal" method="POST">
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
			<button id="sbm">Cambiar</button>
			<button id="cnl">Cancelar</button>
		</form>
	</div>
	<style type="text/css">
		#modal{
			display: none; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5);
			align-items: center; justify-content: center; top: 0; z-index: 99;
		}
		form#fmodal{
			display: flex; flex-direction: column; padding: 50px; background-color: white;
		}
		form#fmodal select{
			min-width: 200px;
		}
	</style>
<!-- CAMBIO DE BLOQUE -->

<!-- BOMBONAS -->
	<div id="modalB">
		<form id="fmodalB" method="POST">
			<p>Escoge la marca de bombona:</p>
			<select id="selectMB">
				<?php $marcas = marcaBombona();
				for($i = 0; $i < count($marcas) ; $i++): ?>
				 <option value="<?php echo $marcas[$i]['ID'] ?>"> <?php echo $marcas[$i]['MARCA'] ?> </option>
				<?php endfor; ?>
			</select>

			<p>Escoge el tipo de bombona</p>
			<select id="selectTB">
				<?php  $tipos = tipoBombona(); 
				for($i = 0; $i < count($tipos) ; $i++): ?>
				 <option value="<?php echo $tipos[$i]['ID'] ?>"> <?php echo $tipos[$i]['TIPO'] ?> </option>
				<?php endfor; ?>
			</select>

			<button id="sbmB">Agregar</button>
			<button id="cnlB">Cancelar</button>
		</form>
	</div>

	<style type="text/css">
		#modalB{
			display: none; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5);
			align-items: center; justify-content: center; top: 0; z-index: 99;
		}
		form#fmodalB{
			display: flex; flex-direction: column; padding: 50px; background-color: white;
		}
		form#fmodalB select{
			min-width: 200px;
		}
	</style>
<!-- BOMBONAS -->

<!-- SUGERIDOS -->
	<div id="modalE">
		<form id="fmodalE" method="POST">
			
			<p>Numero de sugeridos: </p><input type="number" id="number">
			<p>Fecha: </p><input type="date" id="month" placeholder="Fecha">
			
			<button id="sbmE">Agregar Entrega</button>
			<button id="cnlE">Cancelar</button>
		</form>
	</div>
	<style type="text/css">
		#modalE{
			display: none; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5);
			align-items: center; justify-content: center; top: 0; z-index: 99;
		}
		form#fmodalE{
			display: flex; flex-direction: column; padding: 50px; background-color: white;
		}
		form#fmodalE select{
			min-width: 200px;
		}
	</style>
<!-- SUGERIDOS -->

<!-- ANEXOS -->
	<div id="modalA">
		<form id="fmodalA" method="POST">
			<input id="idblo" type="hidden" value="<?php echo $id ?>">
			<p>Ingrese el numero del anexo: </p><input type="number" id="numA">
			<button id="sbmA">Agregar</button>
			<button id="cnlA">Cancelar</button>
		</form>
	</div>
	<style type="text/css">
		#modalA{
			display: none; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5);
			align-items: center; justify-content: center; top: 0; z-index: 99;
		}
		form#fmodalA{
			display: flex; flex-direction: column; padding: 50px; background-color: white;
		}
		form#fmodalA select{
			min-width: 200px;
		}
	</style>
<!-- ANEXOS -->

<!-- DELETE ANEXOS -->
	<div id="modalD">
		<form id="fmodalD" method="POST">
			<p>Escoge el anexo a elminar: </p>
			<select id="selectDA">
				<?php $anexos = apartamentosPorBloque($id) ?>
				<?php for($i = 0; $i < count($anexos) ; $i++): ?>
					<?php if ($anexos[$i]['ANEXO'] == 'S'): ?>
						<option value="<?php echo $anexos[$i]['ID'] ?>"> <?php echo $anexos[$i]['NRO_APARTAMENTO'] ?> </option>
					<?php endif ?>
				 <?php endfor ?>
			</select>
			<button id="sbmD">Eliminar</button>
			<button id="cnlD">Cancelar</button>
		</form>
	</div>

	<style type="text/css">
		#modalD{
			display: none; width: 100vw; height: 100vh; background-color: rgba(0,0,0,0.5);
			align-items: center; justify-content: center; top: 0; z-index: 99;
		}
		form#fmodalD{
			display: flex; flex-direction: column; padding: 50px; background-color: white;
		}
		form#fmodalD select{
			min-width: 200px;
		}
	</style>
<!-- DELETE ANEXOS -->

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