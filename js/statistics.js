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
	$('#id').hide();
	$('#ie').hide();
	$('#if').hide();
	$('#ga').hide();
	$('#gb').hide();
	$('#gc').hide();
	$('#gd').hide();
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
		ope = 5;
		value = $("input:radio[name=condiciones]:checked").val();
		recibirDatos(value,ope);
	});

	$("#g").click(function (ev) {
		$("#ga").show();
		$("#gb").show();
		$("#gc").show();
		$("#gd").show();
		$("#ia").hide();
		$("#ib").hide();
		$("#ic").hide();
		$("#id").hide();
		$("#ie").hide();
		$("#if").hide();
		ope = 6;
		$("#ga").click(function (ev) {
			$("#serial").show();
			$("#codigo").show();
			$("#pension").hide();
			value = $("input:radio[name=select]:checked").val();
			recibirDatos(value,ope);
		});

		$("#gb").click(function (ev) {
			$("#serial").hide();
			$("#codigo").hide();
			$("#pension").hide();
			value = $("input:radio[name=select]:checked").val();
			recibirDatos(value,ope);
		});
	});

	$("#i").click(function (ev) {
		$("#ga").hide();
		$("#gb").hide();
		$("#gc").hide();
		$("#gd").hide();
		$("#ia").show();
		$("#ib").show();
		$("#ic").show();
		$("#id").show();
		$("#ie").show();
		$("#if").show();
		ope = 7;
		$("#ia").click(function (ev) {
			$('#pension').show();
			$("#serial").hide();
			$("#codigo").hide();
			value = $("input:radio[name=select]:checked").val();
			recibirDatos(value,ope);
		});

		$("#ib").click(function (ev) {
			$('#pension').show();
			$("#serial").hide();
			$("#codigo").hide();
			value = $("input:radio[name=select]:checked").val();
			recibirDatos(value,ope);
		});

		$("#ic").click(function (ev) {
			$('#pension').show();
			$("#serial").hide();
			$("#codigo").hide();
			value = $("input:radio[name=select]:checked").val();
			recibirDatos(value,ope);
		});
	});
	
	$("#j").click(function (ev) {
		$('#dni').hide();
		$('#genero').show();
		$('#fc').show();
		$('#apa').hide();
		ope = 8;
		value = $("input:radio[name=vulvenables]:checked").val();
		recibirDatos(value,ope);
	});

	$("#k").click(function (ev) {
		$('#dni').show();
		$('#genero').show();
		$('#fc').show();
		$('#apa').hide();
		ope = 9;
		value = $("input:radio[name=vulvenables]:checked").val();
		recibirDatos(value,ope);
	});

	$("#s").click(function (ev) {
		$('#dni').show();
		$('#apa').show();
		$('#genero').hide();
		$('#fc').hide();
		ope = 10;
		value = $("input:radio[name=vulvenables]:checked").val();
		recibirDatos(value,ope);
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