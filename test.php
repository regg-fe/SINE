<?php 
	include_once 'database.php';
	$search = $_POST['search']; 
	if(!empty($search)) {
		$sql = "SELECT * FROM persona WHERE DNI LIKE '%$search%' OR NOMBRES LIKE '%$search%' OR APELLIDOS LIKE '$search'";
		$result = $conexion->query($sql);	
		if(!$result) {
			die("Query Error".mysqli_error($conexion));
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
	}
?>
