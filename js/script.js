$(function() {
	let edit = false;
	$('#result').hide();
	fecthResult();
	function fecthResult() {
	 	$('#btn').click(function() {
			$("#wait").toggle("slow");
			if ($('#search').val()) {
				let search = $('#search').val();
				$.ajax({
					url: 'test.php',
					type: 'POST',
					data: {search},
					success: function(response) {
						let personas = JSON.parse(response);
						let template = '';			
						personas.forEach( personas => {
							template += `<tr class="row100 body">
											<td class="cell100 column2"><a target="__blank" href="aperson.php?id=${personas.id}">${personas.nombre}</a></td>
											<td class="cell100 column3">${personas.apellido}</td>
											<td class="cell100 column4">${personas.genero}</td>
											<td class="cell100 column5">${personas.dni}</td>
											<td class="cell100 column6">${personas.telefono}</td>
											<td class="cell100 column7">${personas.fecha}</td>
											<td class="cell100 column8"><a target="__blank" href="afamily.php?id=${personas.id}">${personas.familia}</a></td>
										</tr>`
						});
						if (Object.entries(personas).length === 0) {
							template = "No hay registros<br><br>";
							$('#body').html(template);
							$('#result').show();
						} else {
							$('#result').show();
							$('#body').html(template);
						}
					}
				})
			}
		});
	}
});