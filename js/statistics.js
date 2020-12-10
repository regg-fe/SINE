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
	var ope;
	$("#a").click(function (ev) {
		ope = 1;
		value = $("input:radio[name=nutricion]:checked").val();
		recibirDatos(value,ope);
	});
	$("#b").click(function (ev) {
		ope = 1;
		value = $("input:radio[name=nutricion]:checked").val();
		recibirDatos(value,ope);
	});
});

function recibirDatos(value,ope) {
	var v = value;
	$.post('test.php',{val: v}, function(data) {
		$('#result').show();
		$('#body').html(data);
	});
	recibirTotales(v,ope);
}

function recibirTotales(value,n) {
	var v = value;
	$.post('test.php', {e: v,o: n}, function(data) {
		let total = JSON.parse(data);
		let porcentaje = Math.round((total[1]/total[0])*100);
		$('#text').show();
		$('#text').html('Total de personas registradas en el sistema: '+total[0]);
		$('#text1').show();
		$('#text1').html('Total de personas con problemas de nutricion: '+total[1]);
		$('#text2').show();
		$('#text2').html('Porcentaje: '+porcentaje+"%");
	});
}