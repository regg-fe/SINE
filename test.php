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
			echo "<option value='".$apartamentos[$i]['ID']."'> ".$apartamentos[$i]['NRO_APARTAMENTO']." </option>";
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
					for ($i=0; $i <count($muestra) ; $i++) {
						$salida.="<tr>
			    					<td><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td>".$muestra[$i]['APELLIDOS']."</td>
			    					<td>".$muestra[$i]['GENERO']."</td>
			    					<td>".$muestra[$i]['FECHA_NAC']."</td>
			    					<td>".$muestra[$i]['DNI']."</td>
			    					<td>".$muestra[$i]['TELEFONO']."</td>
			    					<td>".$muestra[$i]['PESO']."</td>
			    					<td>".$muestra[$i]['ESTATURA']."</td>
			    					<td>".$muestra[$i]['IMC']."</td>
			    					<td>".$muestra[$i]['FAMILIA']."</td>
			    					<td>".$muestra[$i]['NRO_APARTAMENTO']."</td>
			    					<td>".$muestra[$i]['NRO_BLOQUE']."</td>
			    				</tr>";
					}
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
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr>
			    					<td><a href='aperson.php?id=".$muestra[$i]['ID_PERSONA']."' target='_blank'>".$muestra[$i]['NOMBRE_PERSONA']."</a></td>
			    					<td>".$muestra[$i]['APELLIDO_PERSONA']."</td>
			    					<td>".$muestra[$i]['DNI_PERSONA']."</td>
			    					<td>".$muestra[$i]['NOMBRE_ENFERMEDAD']."</td>
			    				</tr>";
					}
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
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr>
			    					<td><a href='aperson.php?id=".$muestra[$i]['ID_PERSONA']."' target='_blank'>".$muestra[$i]['NOMBRE_PERSONA']."</a></td>
			    					<td>".$muestra[$i]['APELLIDO_PERSONA']."</td>
			    					<td>".$muestra[$i]['DNI_PERSONA']."</td>
			    					<td>".$muestra[$i]['TIPO_DISCAPACIDAD']."</td>
			    				</tr>";
					}
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
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr>
			    					<td><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td>".$muestra[$i]['APELLIDOS']."</td>
			    					<td>".$muestra[$i]['DNI']."</td>
			    				</tr>";
					}
				} else {
					$salida = "No hay personas con discapacidades";
				}
				echo $salida;
			break;
			
			case 5:
			// PERSONAS EMBARAZADAS
				$v = $_POST['val'];
				$salida = "";
				$muestra = encamados(true);
				if ($muestra != NULL) {
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr>
			    					<td><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td>".$muestra[$i]['APELLIDOS']."</td>
			    					<td>".$muestra[$i]['DNI']."</td>
			    				</tr>";
					}
				} else {
					$salida = "No hay personas con discapacidades";
				}
				echo $salida;
			break;

			case 6:
			// CARNETS
				$v = $_POST['val'];
				$salida = "";
				if ($v == 8) {
					$bolean = true;
					$muestra = tienenCarnet($bolean);
				} else if ($v == 9) {
					$bolean = false;
					$muestra = tienenCarnet($bolean);
				}
				
				if ($muestra != NULL) {
					for ($i=0; $i <count($muestra) ; $i++) { 
						if ($bolean == true) {
							$salida.="<tr>
			    					<td><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td>".$muestra[$i]['APELLIDOS']."</td>
			    					<td>".$muestra[$i]['DNI']."</td>
			    					<td>".$muestra[$i]['SERIAL_CARNET']."</td>
			    					<td>".$muestra[$i]['CODIGO_CARNET']."</td>
			    				</tr>";
						} else {
							$salida.="<tr>
			    					<td><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
			    					<td>".$muestra[$i]['APELLIDOS']."</td>
			    					<td>".$muestra[$i]['DNI']."</td>
			    				</tr>";
						}
					}
				} else {
					$salida = "No hay personas carnetizadas";
				}
				echo $salida;
			break;
			
			case 7:
			// PENSIONADOS
				$v = $_POST['val'];
				$salida = "";
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
				
				if ($muestra != NULL) {
					for ($i=0; $i <count($muestra) ; $i++) { 
						$salida.="<tr>
		    					<td><a href='aperson.php?id=".$muestra[$i]['ID']."' target='_blank'>".$muestra[$i]['NOMBRES']."</a></td>
		    					<td>".$muestra[$i]['APELLIDOS']."</td>
		    					<td>".$muestra[$i]['DNI']."</td>
		    					<td>".$muestra[$i]['PENSION']."</td>
		    				</tr>";
					}
				} else {
					$salida = "No hay personas con este tipo de pension";
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
			//CARNETS
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

			default:
				$jsonstring = json_encode(null);
				echo $jsonstring;
			break;
		}
	}
?>