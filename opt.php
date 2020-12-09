<?php
	include_once 'includes/functions.php';
	if (isset($_POST['met'])) {
		$met = $_POST['met'];
		$con = conexion();
		switch ($met) {
			case 'erase':
				$id = $_POST['id'];
				$name = $_POST['name'];
				switch ($name) {
					case 'AT':
						$sql = "DELETE FROM TIPOAYUDATECNICA WHERE TIPOAYUDATECNICA.ID = $id";
						break;
					case 'BN':
						$sql = "DELETE FROM BONO WHERE BONO.ID = $id";
						break;
					case 'PS':
						$sql = "DELETE FROM PROGRAMASOCIAL WHERE PROGRAMASOCIAL.ID = $id";
						break;
					case 'DC':
						$sql = "DELETE FROM TIPODISCAPACIDAD WHERE TIPODISCAPACIDAD.ID = $id";
						break;
					case 'EF':
						$sql = "DELETE FROM TIPOENFERMEDAD WHERE TIPOENFERMEDAD.ID = $id";
						break;
					case 'MD':
						$sql = "DELETE FROM MEDICAMENTO WHERE MEDICAMENTO.ID = $id";
						break;
					case 'MB':
						$sql = "DELETE FROM MARCABOMBONA WHERE MARCABOMBONA.ID = $id";
						break;
					case 'TB':
						$sql = "DELETE FROM TIPOBOMBONA WHERE TIPOBOMBONA.ID = $id";
						break;
					case 'LG':
						$sql = "DELETE FROM LUGAR WHERE LUGAR.ID = $id";
						break;
				}
				$con->query($sql);
				break;
			
			case 'add':
				$data = $_POST['data'];
				$name = $_POST['name'];
				switch ($name) {
					case 'AT':
						$sql = "INSERT INTO TIPOAYUDATECNICA (NOMBRE) VALUES ('". $data['NOMBRE'] ."')";
						break;
					case 'BN':
						$sql = "INSERT INTO BONO (NOMBRE) VALUES ('". $data['NOMBRE'] ."')";
						break;
					case 'PS':
						$sql = "INSERT INTO PROGRAMASOCIAL (NOMBRE) VALUES ('". $data['NOMBRE'] ."')";
						break;
					case 'DC':
						$sql = "INSERT INTO TIPODISCAPACIDAD (TIPO) VALUES ('". $data['NOMBRE'] ."')";
						break;
					case 'EF':
						$sql = "INSERT INTO TIPOENFERMEDAD (NOMBRE) VALUES ('". $data['NOMBRE'] ."')";
						break;
					case 'MD':
						$sql = "INSERT INTO MEDICAMENTO (NOMBRE, TIPO) VALUES ('". $data['NOMBRE'] ."', '". $data['TIPO'] ."')";
						break;
					case 'MB':
						$sql = "INSERT INTO MARCABOMBONA (MARCA) VALUES ('". $data['NOMBRE'] ."')";
						break;
					case 'TB':
						$sql = "INSERT INTO TIPOBOMBONA (TIPO) VALUES ('". $data['NOMBRE'] ."')";
						break;
					case 'LG':
						$sql = "INSERT INTO LUGAR (NOMBRE, TIPO, TIPO_INSTITUCION, RIF) VALUES ('". $data['NOMBRE'] ."', '". $data['PRIVACIDAD'] ."', '". $data['TIPO_INSTITUCION'] ."', '". $data['RIF'] ."')";
						break;
						
				}
				$con->query($sql);
				echo $con->error;
				break;
		}
	}
?>