function openUrl(url,contenedor) {
	$.get(url,{},function(data) {
		$("#"+contenedor).html(data);
	});
}

$(document).ready(function() {
	$('#result').hide();
	$('#text').hide();
	$('#text1').hide();
	var value;
	$("#a").click(function (ev) {
		value = $("input:radio[name=nutricion]:checked").val();
		enviarDatos(value);
	});
	
	$("#b").click(function (ev) {
		value = $("input:radio[name=nutricion]:checked").val();
		enviarDatos(value);
	});
});


	function enviarDatos(value) {
		var v = value;
		var total;
		$.post('test.php',{val: v}, function(data) {
			let nutricion = JSON.parse(data);
			if (nutricion != null) {
				let template = '';				
				nutricion.forEach( nutricion => {
					template += `<tr>
									<td>${nutricion.NOMBRES}</td>
									<td>${nutricion.APELLIDOS}</td>
									<td>${nutricion.GENERO}</td>
									<td>${nutricion.FECHA_NAC}</td>
									<td>${nutricion.DNI}</td>
									<td>${nutricion.TELEFONO}</td>
									<td>${nutricion.PESO}</td>
									<td>${nutricion.ESTATURA}</td>
									<td>${nutricion.FAMILIA}</td>
									<td>${nutricion.NRO_APARTAMENTO}</td>
									<td>${nutricion.NRO_BLOQUE}</td>
									<td>${nutricion.IMC}</td>
								</tr>`
				});
				if (Object.entries(nutricion).length === 0) {
					template = "No hay registros";
					$('#body').html(template);
					$('#result').show();
				} else {
					$('#result').show();
					$('#body').html(template);
					$.post('test.php',{v: 1}, function(response){
						let personas = response;
						let nutridos = nutricion.length;
						var porcentaje = (nutridos/personas)*100;
						porcentaje = Math.round(porcentaje);
						$('#text').show();
						$('#text1').show();
						$('#total').html(nutridos);
						$('#porcentaje').html(porcentaje+"%");
					});	
				}
			} else {
				template = "No hay registros";
				$('#total').html(template);
			}	
		});
	}
