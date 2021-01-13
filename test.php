<?php 
	include_once 'includes/functions.php';
	
	// BUSCADOR
	if (isset($_POST['search'])) {
		$con = conexion();
		$search = $_POST['search'];
	if(!empty($search)) {
		$sql = "SELECT * FROM persona WHERE DNI LIKE '%$search%' OR NOMBRES LIKE '%$search%' OR APELLIDOS LIKE '$search'";
		$result = $con->query($sql);	
		if(!$result) 
			die("Query Error".mysqli_error($con));
		}
		$json = array();
		while($row = $result->fetch_assoc()) {
			$json[] = array(
				'id' => $row['ID'],
				'nombre' => $row['NOMBRES'],
				'apellido' => $row['APELLIDOS'],
				'genero' => $row['GENERO'],
				'dni' => $row['DNI'],
				'telefono' => $row['TELEFONO'],
				'fecha' => $row['FECHA_NAC'],
				'familia' => $row['ID_FAMILIA']
			);
		}
		$jsonstring = json_encode($json); 
		echo $jsonstring;
		$con->close();
	}

	
	// CAMBIO DE BLOQUE
	if (isset($_POST['idfam']) && isset($_POST['bloque']) && isset($_POST['apart'])) {
		$con = conexion();
		$bloque = $con->real_escape_string($_POST['bloque']);
		$apart = $con->real_escape_string($_POST['apart']);
		$id = $con->real_escape_string($_POST['idfam']);
	
		$sql="UPDATE FAMILIA SET ID_APARTAMENTO = $apart WHERE ID = $id";
		$r = $con->query($sql);
		if (!$r) {
			die("Update error".mysql_error($con));
		}
		$con->close();
	}

	// MOSTRAR APARTAMENTOS
	if (isset($_POST['idbl'])){
		$apartamentos = apartamentosPorBloque($_POST['idbl']);
		
		for ($i=0; $i < count($apartamentos); $i++) {
			echo "<option value='".$apartamentos[$i]['ID']."'>".$apartamentos[$i]['NRO_APARTAMENTO']."</option>";
		}
	}
	
	// SUGERIDOS
	if (isset($_POST['idfamE']) && isset($_POST['month']) && isset($_POST['total'])) {
		$con = conexion();
		$id = $con->real_escape_string($_POST['idfamE']);
		$time = $con->real_escape_string($_POST['month']);
		$total = $con->real_escape_string($_POST['total']);
		
		$sql = "INSERT INTO BENEFICIO (FECHA_ENTREGA,CANTIDAD,ID_FAMILIA) VALUES ('$time','$total','$id')";
		$r = $con->query($sql);
		if (!$r) {
			die("Insert Error".mysqli_error($con));
		}
		$con->close();
	}

	//BOMBONAS
	if (isset($_POST['idfamB']) && isset($_POST['marca']) && isset($_POST['tipo'])) {
		$con = conexion();
		$id = $con->real_escape_string($_POST['idfamB']);
		$marca = $con->real_escape_string($_POST['marca']);
		$total = $con->real_escape_string($_POST['tipo']);

		$sql = "INSERT INTO BOMBONA (ID_FAMILIA,ID_MARCA,ID_TIPO) VALUES ('$id','$marca','$total')";
		$r = $con->query($sql);
		if (!$r) {
			die("Insert Error".mysqli_error($con));
		}
		$con->close();
	}

	// INSERTAR ANEXOS
	if (isset($_POST['idBlo']) && isset($_POST['numA'])) {
		$con = conexion();
		$id = $con->real_escape_string($_POST['idBlo']);
		$a = "S";
		$n = $con->real_escape_string($_POST['numA']);
		$existeAnexo = existeAnexo($n,$id);
		if ($existeAnexo == NULL) {
			$sql = "INSERT INTO APARTAMENTO (NUMERO_APARTAMENTO, ANEXO, ID_BLOQUE) VALUES ('$n','$a','$id')";
			$r = $con->query($sql);
			if (!$r) {
				die("Insert Error".mysqli_error($con));
			}
			$con->close();
		} else {
			echo "Este anexo ya fue creado";
		}
	}

	// ELIMINAR ANEXO
	if (isset($_POST['numD'])) {
		$con = conexion();
		$id = $con->real_escape_string($_POST['numD']);
		$sql = "DELETE FROM APARTAMENTO WHERE ID = '$id'";
		$r = $con->query($sql);
		if (!$r) {
			die("Delete Error".mysqli_error($con));
		}
		$con->close();
	}

	
	if (isset($_POST['val']) && isset($_POST['o'])) {
		switch ($_POST['o']) {
			case 1:
			// ESTADISTICAS NUTRICION
				$v = $_POST['val'];
				$salida = "";
				$muestra = estadoDeNutricion($v);
				if ($muestra != NULL) {
						$salida .="<table>
											<thead>
												<tr class='row100 head'>
													<th class='cell100 column1'>Nombres</th>
													<th class='cell100 column2'>Apellidos</th>
													<th class='cell100 column3'>Genero</th>
													<th class='cell100 column4'>Fecha de nacimiento</th>
													<th class='cell100 column5'>Cedula</th>
													<th class='cell100 column6'>Telefono</th>
													<th class='cell100 column6'>Peso</th>
													<th class='cell100 column6'>Estatura</th>
													<th class='cell100 column6'>IMC</th>
													<th class='cell100 column7'>Familia</th>
													<th class='cell100 column8'>Apartamento</th>
													<th class='cell100 column9'>Bloque</th>
												</tr>
											</thead><tbody>";
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr class='row100 body descentrar'>
									    	<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
									    	<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
									    	<td class='cell100 column3'>".$muestra[$i]['GENERO']."</td>
									    	<td class='cell100 column4'>".$muestra[$i]['FECHA_NAC']."</td>
									    	<td class='cell100 column5'>".$muestra[$i]['DNI']."</td>
									    	<td class='cell100 column6>".$muestra[$i]['TELEFONO']."</td>
									    	<td class='cell100 column6'>".$muestra[$i]['PESO']."</td>
									    	<td class='cell100 column6'>".$muestra[$i]['ESTATURA']."</td>
									    	<td class='cell100 column6'>".$muestra[$i]['IMC']."</td>
									    	<td class='cell100 column7'>".$muestra[$i]['FAMILIA']."</td>
									    	<td class='cell100 column8'>".$muestra[$i]['NRO_APARTAMENTO']."</td>
									    	<td class='cell100 column9'>".$muestra[$i]['NRO_BLOQUE']."</td>
									    </tr>";
					}
						$salida.="</tbody>
								</table>";
				} else {
					$salida = "No hay personas con problemas de nutricion";
				}
				echo $salida;
			break;

			case 2:
			// PERSONAS ENFERMAS
				$v = $_POST['val'];
				$salida = "";
				$muestra = enfermos();
				if ($muestra != NULL) {
						$salida .="<table>
										<thead>
											<tr class='row100 head'>
												<th class='cell100 column1'>Nombres</th>
												<th class='cell100 column2'>Apellidos</th>
												<th class='cell100 column3'>Cedula</th>
												<th class='cell100 column9'>Enfermedad</th>
											</tr>
										</thead><tbody>";
					for ($i=0; $i <count($muestra) ; $i++) {
						$salida.="<tr class='row100 body descentrar'>
			    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID_PERSONA']."' target='_blank'>".$muestra[$i]['NOMBRE_PERSONA']."</a></td>
			    					<td class='cell100 column2'>".$muestra[$i]['APELLIDO_PERSONA']."</td>
			    					<td class='cell100 column3'>".$muestra[$i]['DNI_PERSONA']."</td>
			    					<td class='cell100 column9'>".$muestra[$i]['NOMBRE_ENFERMEDAD']."</td>
			    			    </tr>";
					}
						$salida.="</tbody>
								</table>";
				} else {
					$salida = "No hay personas con problemas de salud";
				}
				echo $salida;
			break;

			case 3:
			// PERSONAS DISCAPACITADAS
				$v = $_POST['val'];
				$salida = "";
				$muestra = discapacitados();
				if ($muestra != NULL) {
					$salida .="<table>
									<thead>
										<tr class='row100 head'>
											<th class='cell100 column1'>Nombres</th>
											<th class='cell100 column2'>Apellidos</th>
											<th class='cell100 column3'>Cedula</th>
											<th class='cell100 column9'>Discapacidad</th>
										</tr>
									</thead><tbody>";
					for ($i=0; $i <count($muestra) ; $i++) {
						$salida.="<tr class='row100 body descentrar'>
			    					<td class='cell100 column21'><a href='aperson.php?id=".$muestra[$i]['ID_PERSONA']."' target='_blank'>".$muestra[$i]['NOMBRE_PERSONA']."</a></td>
			    					<td class='cell100 column2'>".$muestra[$i]['APELLIDO_PERSONA']."</td>
			    					<td class='cell100 column3'>".$muestra[$i]['DNI_PERSONA']."</td>
			    					<td class='cell100 column9'>".$muestra[$i]['TIPO_DISCAPACIDAD']."</td>
			    			    </tr>";
					}
					$salida.="</tbody>
							</table>";
				} else {
					$salida = "No hay personas con discapacidades";
				}
				echo $salida;
			break;

			case 4:
			// PERSONAS EMBARAZADAS
				$v = $_POST['val'];
				$salida = "";
				$muestra = embarazadas();
				if ($muestra != NULL) {
						$salida .="<table>
										<thead>
											<tr class='row100 head'>
												<th class='cell100 column1'>Nombres</th>
												<th class='cell100 column2'>Apellidos</th>
												<th class='cell100 column9'>Cedula</th>
											</tr>
										</thead><tbody>";
					for ($i=0; $i <count($muestra) ; $i++) {
						$salida.="<tr class='row100 body descentrar'>
			    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
			    					<td class='cell100 column9'>".$muestra[$i]['DNI']."</td>
			    					    </tr>";
					}
						$salida.="</tbody>
							</table>";
				} else {
					$salida = "No hay personas embarazadas";
				}
				echo $salida;
			break;
			
			case 5:
			// PERSONAS EMCAMADAS
				$v = $_POST['val'];
				$salida = "";
				$muestra = encamados(true);
				if ($muestra != NULL) {
						$salida .="<table>
										<thead>
											<tr class='row100 head'>
												<th class='cell100 column1'>Nombres</th>
												<th class='cell100 column2'>Apellidos</th>
												<th class='cell100 column9'>Cedula</th>
											</tr>
										</thead><tbody>";
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr class='row100 body descentrar'>
			    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
			    					<td class='cell100 column9'>".$muestra[$i]['DNI']."</td>
			    					    </tr>";
					}
						$salida.="</tbody>
								</table>";
				} else {
					$salida = "No hay personas ecamadas";
				}
				echo $salida;
			break;

			case 6:
			// CARNETS
				$v = $_POST['val'];
				$salida = "";
				$muestra = NULL;
				if ($v == 8) {
					$bolean = true;
					$muestra = tienenCarnet($bolean);
				} else if ($v == 9) {
					$bolean = false;
					$muestra = tienenCarnet($bolean);
				} else {
					$muestra = NULL;
				}
				if ($muestra != NULL) {
					if ($bolean == true) {
						$salida .="<table>
										<thead>
											<tr class='row100 head'>
												<th class='cell100 column1'>Nombres</th>
												<th class='cell100 column2'>Apellidos</th>
												<th class='cell100 column3'>Cedula</th>
												<th class='cell100 column4'>Serial del Carnet</th>
												<th class='cell100 column9'>Codgio del Carnet</th>
											</tr>
										</thead><tbody>";
					} else {
						$salida .="<table>
										<thead>
											<tr class='row100 head'>
												<th class='cell100 column1'>Nombres</th>
												<th class='cell100 column2'>Apellidos</th>
												<th class='cell100 column9'>Cedula</th>
											</tr>
										</thead><tbody>";
					}
					for ($i=0; $i < count($muestra) ; $i++) {
						if ($bolean == true) {
										$salida.="<tr class='row100 body descentrar'>
						    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
						    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
						    					<td class='cell100 column3'>".$muestra[$i]['DNI']."</td>
						    					<td class='cell100 column4'>".$muestra[$i]['SERIAL_CARNET']."</td>
						    					<td class='cell100 column9'>".$muestra[$i]['CODIGO_CARNET']."</td>
						    				</tr>";
						} else {
							$salida.="<tr class='row100 body descentrar'>
			    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
			    					<td class='cell100 column9'>".$muestra[$i]['DNI']."</td>
			    				</tr>";
						}
					}
					$salida.="</tbody>
								</table>";
				} else {
					$salida = "No hay personas carnetizadas";
				}
				echo $salida;
			break;

			case 7:
			// PENSIONADOS
				$v = $_POST['val'];
				$salida = "";
				$muestra = NULL;
				if ($v == 10) {
					$muestra = pensionados('AM');
				} else if ($v == 11) {
					$muestra = pensionados('SS');
				} else if ($v == 12) {
					$muestra = pensionados('NT');
				} else {
					$muestra = NULL;
				}
				if ($muestra != NULL) {
					$salida .="<table>
									<thead>
										<tr class='row100 head'>
											<th class='cell100 column1'>Nombres</th>
											<th class='cell100 column2'>Apellidos</th>
											<th class='cell100 column3'>Cedula</th>
											<th class='cell100 column9'>Pension</th>
										</tr>
									</thead><tbody>";
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr class='row100 body descentrar'>
		    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
		    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
		    					<td class='cell100 column3'>".$muestra[$i]['DNI']."</td>
		    					<td class='cell100 column9'>".$muestra[$i]['PENSION']."</td>
		    				</tr>";
					}
					$salida.="</tbody>
								</table>";
				} else {
					$salida = "No hay personas pensionadas";
				}
				echo $salida;
			break;

			case 8:
			// LACTANTES
				$v = $_POST['val'];
				$salida = "";
				$muestra = lactantes();
				if ($muestra != NULL) {
					$salida .="<table>
									<thead>
										<tr class='row100 head'>
											<th class='cell100 column1'>Nombres</th>
											<th class='cell100 column2'>Apellidos</th>
											<th class='cell100 column3'>Genero</th>
											<th class='cell100 column9'>Fecha de Nacimiento</th>
										</tr>
									</thead>";
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="
								<tbody>
									<tr class='row100 body descentrar'>
				    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
				    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
				    					<td class='cell100 column3'>".$muestra[$i]['GENERO']."</td>
				    					<td class='cell100 column9'>".$muestra[$i]['FECHA_NAC']."</td>
			    					</tr>
	    						";
					}
						$salida.="	</tbody>
								</table>";
				} else {
					$salida = "No hay lactantes registrados";
				}
				echo $salida;
			break;

			case 9:
			//ADULTOS MAYORES
				$v = $_POST['val'];
				$salida = "";
				$muestra = adultosMayores();
				if ($muestra != NULL) {
						$salida .="<table>
										<thead>
											<tr class='row100 head'>
												<th class='cell100 column1'>Nombres</th>
												<th class='cell100 column2'>Apellidos</th>
												<th class='cell100 column3'>Cedula</th>
												<th class='cell100 column4'>Genero</th>
												<th class='cell100 column9'>Fecha de Nacimiento</th>
											</tr>
										</thead>";
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="
									<tbody>
										<tr class='row100 body descentrar'>
				    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
				    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
				    					<td class='cell100 column3'>".$muestra[$i]['DNI']."</td>
				    					<td class='cell100 column4'>".$muestra[$i]['GENERO']."</td>
				    					<td class='cell100 column9'>".$muestra[$i]['FECHA_NAC']."</td>
				    				</tr>";
					}
					$salida.="		</tbody>
								</table>";
				} else {
					$salida = "No hay Adultos Mayores registrados";
				}
				echo $salida;
			break;

			case 10:
			//APARTAMENTOS CON UNA SOLA PERSONA
				$v = $_POST['val'];
				$salida = "";
				$muestra = apartamentosConUnaPersona();
				if ($muestra != NULL) {
						$salida .="<table>
										<thead>
											<tr class='row100 head'>
												<th class='cell100 column1'>Nombres</th>
												<th class='cell100 column2'>Apellidos</th>
												<th class='cell100 column3'>Cedula</th>
												<th class='cell100 column9'>Numnero de Apartamento</th>
											</tr>
										</thead>";
					for ($i=0; $i < count($muestra); $i++) {
						$salida.="
								<tbody>
									<tr class='row100 body descentrar'>
				    					<td class='cell100 column1'><a href='aperson.php?id=".$muestra[$i]['ID_PERSONA']."' target='_blank'>".$muestra[$i]['NOMRBES']."</a></td>
				    					<td class='cell100 column2'>".$muestra[$i]['APELLIDOS']."</td>
				    					<td class='cell100 column3'>".$muestra[$i]['DNI']."</td>
				    					<td class='cell100 column9'>".$muestra[$i]['NRO_APARTAMENTO']."</td>
				    				</tr>";
					}
						$salida.="	</tbody>
								</table>";
				} else {
					$salida = "No existen apartamentos con una sola persona registrados";
				}
				echo $salida;
			break;

			default:
				echo $salida = "Esta opcion no esta implementada";
			break;
		}
	}

	// TOTALES ESTADISTICOS
	if (isset($_POST['e']) && isset($_POST['o'])) {
		$v = $_POST['e'];
		$o = $_POST['o'];
		switch ($o) {
			case 1:
			//NUTRICION
				$muestra = estadoDeNutricion($v);
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;

			case 2:
			//ENFERMOS
				$muestra = enfermos();
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;
		
			case 3:
			//DISCAPACITADOS
				$muestra = discapacitados();
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;

			case 4:
			//EMBARAZADAS
				$muestra = embarazadas();
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;
		
			case 5:
			//ENCAMADOS
				$muestra = encamados(true);
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;

			case 6:
			//CARTENIZADOS
			if ($v == 8) {
				$muestra = tienenCarnet(true);
			} else if ($v == 9) {
				$muestra = tienenCarnet(false);
			}
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;
			
			case 7:
			//PENSIONADOS
			if ($v == 10) {
				$bolean = 'AM';
				$muestra = pensionados($bolean);
			} else if ($v == 11) {
				$bolean = 'SS';
				$muestra = pensionados($bolean);
			} else if ($v == 12) {
				$bolean = 'NT';
				$muestra = pensionados($bolean);
			}
			$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;

			case 8:
			//LACTANTES
				$muestra = lactantes();
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;

			case 9:
			//ADULTOS MAYORES
				$muestra = adultosMayores();
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;

			case 10:
			//APARTAMENTOS CON UNA SOLA PERSONA
				$muestra = apartamentosConUnaPersona();
				$personas = personas();
				if ($muestra != NULL && $personas != NULL) {
					$total = array(0 => count($personas), 1 => count($muestra));
				} else if ($muestra == NULL){
					$total = array(0 => count($personas), 1 => 0);
				} else if ($personas == NULL) {
					$total = array(0 => 0, 1 => count($muestra));
				}
				$jsonstring = json_encode($total);
				echo $jsonstring;
			break;

			default:
				$jsonstring = json_encode('NANN');
				echo $jsonstring;
			break;
		}
	}

	// OBTENER DATOS 
	if (isset($_POST['o']) && isset($_POST['i'])) {
		$id = $_POST['i'];
		switch ($_POST['o']) {
			case 0:
				$r = obtenerInfo('TIPOAYUDATECNICA',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 1:
				$r = obtenerInfo('BONO',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 2:
				$r = obtenerInfo('PROGRAMASOCIAL',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 3:
				$r = obtenerInfo('TIPODISCAPACIDAD',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 4:
				$r = obtenerInfo('TIPOENFERMEDAD',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 5:
				$r = obtenerInfo('MARCABOMBONA',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 6:
				$r = obtenerInfo('TIPOBOMBONA',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 7:
				$r = obtenerInfo('MEDICAMENTO',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;

			case 8:
				$r = obtenerInfo('LUGAR',$id);
				if ($r != NULL) {
					$json = json_encode($r);
					echo $json;
				} else {
					echo 'error';
				}
			break;
		}
	}
	// EDITAR DATOS
	if (isset($_POST['op']) && isset($_POST['e'])) {
		$info = $_POST['e'];
		switch ($_POST['op']) {
			case 0:
				$con = conexion();
				$sql = "UPDATE TIPOAYUDATECNICA SET NOMBRE = '$info[0]' WHERE ID = '$info[1]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;

			case 1:
				$con = conexion();
				$sql = "UPDATE BONO SET NOMBRE = '$info[0]' WHERE ID = '$info[1]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;

			case 2:
				$con = conexion();
				$sql = "UPDATE PROGRAMASOCIAL SET NOMBRE = '$info[0]' WHERE ID = '$info[1]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;

			case 3:
				$con = conexion();
				$sql = "UPDATE TIPODISCAPACIDAD SET TIPO = '$info[0]' WHERE ID = '$info[1]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;

			case 4:
				$con = conexion();
				$sql = "UPDATE TIPOENFERMEDAD SET NOMBRE = '$info[0]' WHERE ID = '$info[1]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;
			
			case 5:
				$con = conexion();
				$sql = "UPDATE MARCABOMBONA SET MARCA = '$info[0]' WHERE ID = '$info[1]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;

			case 6:
				$con = conexion();
				$sql = "UPDATE TIPOBOMBONA SET TIPO = '$info[0]' WHERE ID = '$info[1]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;

			case 7:
				$con = conexion();
				$sql = "UPDATE MEDICAMENTO SET NOMBRE = '$info[0]', TIPO = '$info[1]' WHERE ID = '$info[2]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;

			case 8:
				$con = conexion();
				$sql = "UPDATE LUGAR SET NOMBRE = '$info[0]', RIF = '$info[1]', TIPO = '$info[2]', TIPO_INSTITUCION = '$info[3]' WHERE ID = '$info[4]'";
				$result = $con->query($sql);
				if (!$result) {
					die("Query Error".mysqli_error($con));	
				}
				$con->close();
				echo "Actualizado";
			break;
		}
	}


?>



