function openUrl(url,contenedor) {
	$.get(url,{},function(data) {
		$("#"+contenedor).html(data);
	});
}

$(document).ready(function() {
	$('#result').hide();
	$('#text').hide();
	$('#text1').hide();
	$('#ia').hide();
	$('#ib').hide();
	$('#ic').hide();
	$('#ga').hide();
	$('#gb').hide();
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

	$("#c").click(function (ev) {
		$("#h").show();
		ope = 2;
		value = $("input:radio[name=condiciones]:checked").val();
		recibirDatos(value,ope);
	});
	$("#d").click(function (ev) {
		$("#h").show();
		ope = 3;
		value = $("input:radio[name=condiciones]:checked").val();
		recibirDatos(value,ope);
	});
	$("#e").click(function (ev) {
		$("#h").hide();
		ope = 4;
		value = $("input:radio[name=condiciones]:checked").val();
		recibirDatos(value,ope);
	});
	$("#f").click(function (ev) {
		$("#h").hide();
		$("#h").hide();
		ope = 5;
		value = $("input:radio[name=condiciones]:checked").val();
		recibirDatos(value,ope);
	});

	$("#g").click(function (ev) {
		$("#ga").show();
		$("#gb").show();
		ope = 6;
		$("#ga").click(function (ev) {
			$("#serial").show();
			$("#codigo").show();		
			value = $("input:radio[name=carnets]:checked").val();
			recibirDatos(value,ope);
		});
	});

		$("#gb").click(function (ev) {
			$("#serial").hide();
			$("#codigo").hide();
			value = $("input:radio[name=carnets]:checked").val();
			recibirDatos(value,ope);
		});

		$("#i").click(function (ev) {
		$("#ia").show();
		$("#ib").show();
		$("#ic").show();
		ope = 7;
		$("#ia").click(function (ev) {		
			value = $("input:radio[name=carnets]:checked").val();
			recibirDatos(value,ope);
		});

		$("#gb").click(function (ev) {
			$("#serial").hide();
			$("#codigo").hide();
			value = $("input:radio[name=carnets]:checked").val();
			recibirDatos(value,ope);
		});
	});
});


function recibirDatos(value,ope) {
	var v = value;
	$.post('test.php',{val: v, o: ope}, function(data) {
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
		$('#text1').html('Total de personas: '+total[1]);
		$('#text2').show();
		$('#text2').html('Porcentaje: '+porcentaje+"%");
	});
}