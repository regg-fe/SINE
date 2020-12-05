$(function() {
	let edit = false;
	$('#result').hide();
	fecthResult();
	function fecthResult() {
	 	$('#btn').click(function() {
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
							template += `<tr>
											<td>${personas.id}</td>
											<td><a target="__blank" href="aperson.php?id=${personas.id}">${personas.nombre}</a></td>
											<td>${personas.apellido}</td>
											<td>${personas.genero}</td>
											<td>${personas.dni}</td>
											<td>${personas.telefono}</td>
											<td>${personas.fecha}</td>
											<td><a target="__blank" href="afamily.php?id=${personas.id}">${personas.familia}</a></td>
										</tr>`
						});
						if (Object.entries(personas).length === 0) {
							template = "No hay registros";
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