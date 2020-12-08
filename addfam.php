<?php
	include_once 'includes/functions.php';
	if (isset($_POST['idBLOQUE'])) {
		$id = $_POST['idBLOQUE'];
		$aps = apartamentosPorBloque($id);
		for ($i=0; $i < count($aps); $i++) { 
			echo "<option value=".$aps[$i]['ID']." >".$aps[$i]['NRO_APARTAMENTO']."</option>";
		}
	}
	else if (isset($_POST['data'])) {
		$datos = $_POST['data'];
		$apartamento = $_POST['apart'];
		$vivienda = $_POST['vivienda'];
		$aux = false;
		$i = 1;
		$con = conexion();
		while (!$aux) {
			$sql = "SELECT ID FROM FAMILIA WHERE ID = $i";
			$result = $con->query($sql);
			if ($result->num_rows != 0)
				$i++;
			else
				$aux = true;
		}
		//echo "No hay familia con ID $i";
		
		$sql = "INSERT INTO FAMILIA (ID, ID_APARTAMENTO, ESTADO_VIVIENDA) VALUES ($i, $apartamento, $vivienda)";
		$con->query($sql);
		//echo $con->error;
		
		for ($j=0; $j < count($datos); $j++) { 
			$sql = "INSERT INTO PERSONA (NOMBRES, APELLIDOS, GENERO, DNI, TELEFONO, POSICION, EMBARAZO, ENCAMADO, PENSION, VOTO, FECHA_NAC, PESO, ESTATURA, ID_FAMILIA) VALUES ('".$datos[$j]['NOMBRES']."','".$datos[$j]['APELLIDOS']."','".$datos[$j]['GENERO']."',".$datos[$j]['DNI'].",'".$datos[$j]['TELEFONO']."',".$datos[$j]['POSICION'].",'".$datos[$j]['EMBARAZO']."','".$datos[$j]['ENCAMADO']."','".$datos[$j]['PENSION']."','".$datos[$j]['VOTO']."','".$datos[$j]['NACIMIENTO']."',".$datos[$j]['PESO'].",".$datos[$j]['ESTATURA'].",".$i.")";
			$con->query($sql);
			//echo $con->error;
		}
		
		echo "afamily.php?id=$i";
	}
?>