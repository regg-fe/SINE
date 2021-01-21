$(function() {
	let edit = false;
	$('#result').hide();
	fecthResult();
	function fecthResult() {
	 	$('#btn').click(function() {
			if ($("#search").val() == "") {
				$("#search").css("border-color","#D32F2F");
				$("#search").attr("placeholder","Debe indicar un nombre");
			}
			
			if ($('#search').val()) {
				$("#wait").hide("slow");//escoder imagen
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
							$('#mensaje').html("<p>No hay registros</p> <img src='img/undraw_No_data_re_kwbl.svg' alt='no-data'>");
							$('#head').html("");
							$('#body').html(template);
							$('#result').show();
						} else {
							$("#mensaje").hide("slow");
							$('#result').show();
							$('#head').html(`<tr class="row100 head">
												<th  class="cell100 column2">Nombres</th>
												<th  class="cell100 column3">Apellidos</th>
												<th  class="cell100 column4">Genero</th>
												<th  class="cell100 column5">Cedula</th>
												<th  class="cell100 column6">Telefono</th>
												<th  class="cell100 column7">Fecha de Nacimiento</th>
												<th  class="cell100 column8">Familia</th>
											</tr>`)
							$('#body').html(template);
						}
					}
				})
			}
		});

		$('#search').keypress(function(e){
           if(e.which == 13){//Enter key pressed
               $('#btn').click();//Trigger search button click event
           }
       });
		
	}
});