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
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#result').fadeIn(500);
		});
		
	});
	$("#b").click(function (ev) {
		ope = 1;
		value = $("input:radio[name=nutricion]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#result').fadeIn(500);
		});
	});

	$("#c").click(function (ev) {
		$("#h").show();
		ope = 2;
		value = $("input:radio[name=condiciones]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#result').fadeIn(500);
		});
	});
	$("#d").click(function (ev) {
		$("#h").show();
		ope = 3;
		value = $("input:radio[name=condiciones]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#result').fadeIn(500);
		});
	});
	$("#e").click(function (ev) {
		$("#h").hide();
		ope = 4;
		value = $("input:radio[name=condiciones]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#result').fadeIn(500);
		});
	});
	$("#f").click(function (ev) {
		$("#h").hide();
		ope = 5;
		value = $("input:radio[name=condiciones]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#result').fadeIn(500);
		});
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
			value = $("input:radio[name=select]:checked").val();
			$('#result').fadeOut(500, function () {
				recibirDatos(value,ope);
				$("#serial").show();
				$("#codigo").show();
				$("#pension").hide();
				$('#result').fadeIn(500);
			});
			
		});

		$("#gb").click(function (ev) {
			value = $("input:radio[name=select]:checked").val();
			$('#result').fadeOut(500, function () {
				recibirDatos(value,ope);
				$("#serial").hide();
				$("#codigo").hide();
				$("#pension").hide();
				$('#result').fadeIn(500);
			});
			
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
			value = $("input:radio[name=select]:checked").val();
			$('#result').fadeOut(500, function () {
				recibirDatos(value,ope);
				$('#pension').show();
				$("#serial").hide();
				$("#codigo").hide();
				$('#result').fadeIn(500);
			});
			
		});

		$("#ib").click(function (ev) {
			value = $("input:radio[name=select]:checked").val();
			$('#result').fadeOut(500, function () {
				recibirDatos(value,ope);
				$('#pension').show();
				$("#serial").hide();
				$("#codigo").hide();
				$('#result').fadeIn(500);
			});
			
		});

		$("#ic").click(function (ev) {
			value = $("input:radio[name=select]:checked").val();
			$('#result').fadeOut(500, function () {
				recibirDatos(value,ope);
				$('#pension').show();
				$("#serial").hide();
				$("#codigo").hide();
				$('#result').fadeIn(500);
			});
			
		});
	});
	
	$("#j").click(function (ev) {
		ope = 8;
		value = $("input:radio[name=vulvenables]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#dni').hide();
			$('#genero').show();
			$('#fc').show();
			$('#apa').hide();
			$('#result').fadeIn(500);
		});
		
	});

	$("#k").click(function (ev) {
		ope = 9;
		value = $("input:radio[name=vulvenables]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#dni').show();
			$('#genero').show();
			$('#fc').show();
			$('#apa').hide();
			$('#result').fadeIn(500);
		});

	});

	$("#s").click(function (ev) {
		ope = 10;
		value = $("input:radio[name=vulvenables]:checked").val();
		$('#result').fadeOut(500, function () {
			recibirDatos(value,ope);
			$('#dni').show();
			$('#apa').show();
			$('#genero').hide();
			$('#fc').hide();
			$('#result').fadeIn(500);
		});
		
	});
});


function recibirDatos(value,ope) {
	var v = value;
	$.post('test.php',{val: v, o: ope}, function(data) {
		
			$('#body').html(data);
			
			$('#result').show();

		
		
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