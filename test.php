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

	// ESTADISTICAS NUTRICION
	if (isset($_POST['val'])) {
		$v = $_POST['val'];
		$salida = "";
		$nutricion = estadoDeNutricion($v);
		if ($nutricion != NULL) {
			for ($i=0; $i <count($nutricion) ; $i++) { 
				$salida.="<tr>
	    					<td><a href='aperson.php?id=".$nutricion[$i]['ID']."' target='_blank'>".$nutricion[$i]['NOMBRES']."</a></td>
	    					<td>".$nutricion[$i]['APELLIDOS']."</td>
	    					<td>".$nutricion[$i]['GENERO']."</td>
	    					<td>".$nutricion[$i]['FECHA_NAC']."</td>
	    					<td>".$nutricion[$i]['DNI']."</td>
	    					<td>".$nutricion[$i]['TELEFONO']."</td>
	    					<td>".$nutricion[$i]['PESO']."</td>
	    					<td>".$nutricion[$i]['ESTATURA']."</td>
	    					<td>".$nutricion[$i]['IMC']."</td>
	    					<td>".$nutricion[$i]['FAMILIA']."</td>
	    					<td>".$nutricion[$i]['NRO_APARTAMENTO']."</td>
	    					<td>".$nutricion[$i]['NRO_BLOQUE']."</td>
	    				</tr>";
			}
			echo $salida;
		} else {
			$salida = "No hay personas con problemas de nutricion";
		}
	}

	// TOTALES NUTRICION
	if (isset($_POST['e']) && isset($_POST['o'])) {
		$v = $_POST['e'];
		$o = $_POST['o'];
		switch ($o) {
			case 1:
				$nutricion = estadoDeNutricion($v);
				$personas = personas();
				$total = array(0 => count($personas), 1 => count($nutricion));
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
