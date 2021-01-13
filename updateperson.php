<?php
	include_once'includes/functions.php';
	if (isset($_POST['data']) && isset($_POST['operation'])) {
		$data = $_POST['data'];
		$op = $_POST['operation'];
		$id = $data['ID'];
		$conn = conexion();
		switch ($op) {
			case 1:
				$nm = $data['NOMBRES']; $ap = $data['APELLIDOS']; $dni = $data['DNI']; $tf = $data['TELEFONO']; $em = $data['EMBARAZO']; $en = $data['ENCAMADO']; $vt = $data['VOTO']; $pn = $data['PENSION']; $fn = $data['FECHA_NAC']; $ps = $data['PESO']; $es = $data['ESTATURA'];
				
				$sql = "UPDATE PERSONA SET NOMBRES = '$nm', APELLIDOS = '$ap', DNI = '$dni', TELEFONO = '$tf', EMBARAZO = '$em', ENCAMADO = '$en', PENSION = '$pn', VOTO = '$vt', FECHA_NAC = 'fn', PESO = '$ps', ESTATURA = '$es' WHERE PERSONA.ID = $id";
				$conn->query($sql);
				
				break;
			
			case 2:
				$serial = $data['SERIAL_CARNET']; $codigo = $data['CODIGO_CARNET'];

				$sql = "SELECT * FROM CARNET WHERE ID_PERSONA = $id";
				$result = $conn->query($sql);

				if ($result->num_rows > 0)
					$sql = "UPDATE CARNET SET SERIAL_CARNET = '$serial', CODIGO_CARNET = '$codigo' WHERE ID_PERSONA = $id ";
				else
					$sql = "INSERT INTO CARNET (SERIAL_CARNET, CODIGO_CARNET, ID_PERSONA) VALUES ('$serial', '$codigo', '$id')";
				
				$conn->query($sql);
				break;

			case 3:
				$bono = $data['ID_BONO'];
				$carnet = $data['ID_CARNET'];
				$sql = "INSERT INTO BONORECIBIDO (ID_BONO, ID_CARNET) VALUES ('$bono', '$carnet')";

				$conn->query($sql);
				break;
			case 4:
				$programa = $data['ID_PROGRAMA'];
				$sql = "INSERT INTO PROGRAMAASIGNADO (ID_PROGRAMA, ID_PERSONA) VALUES ('$programa', '$id')";

				$conn->query($sql);
				break;
			case 5:
				$enfermedad = $data['ID_ENFERMEDAD'];
				$sql = "INSERT INTO ENFERMEDAD (ID_TIPOENFERMEDAD, ID_PERSONA) VALUES ('$enfermedad', '$id')";

				$conn->query($sql);
				break;
			case 6:
				$medicina = $data['ID_MEDICAMENTO'];
				$descripcion = $data['DESCRIPCION'];
				$sql = "INSERT INTO RECETA (DESCRIPCION, ID_PERSONA, ID_MEDICAMENTO) VALUES ('$descripcion', '$id', '$medicina')";

				$conn->query($sql);
				break;
			case 7:
				$discapacidad = $data['ID_TIPODISCAPACIDAD'];
				$sql = "INSERT INTO DISCAPACIDAD (ID_TIPO, ID_PERSONA) VALUES ('$discapacidad', '$id')";

				$conn->query($sql);
				break;
			case 8:
				$ayudaTec = $data['ID_TIPOAYUDA'];
				$sql = "INSERT INTO AYUDATECNICA (ID_PERSONA, ID_TIPOAYUDATECNICA) VALUES ('$id', '$ayudaTec')";

				$conn->query($sql);
				break;
			case 9:
				$lugar = $data['ID_LUGAR'];
				$descripcion = $data['DESCRIPCION'];
				$sql = "INSERT INTO TRABAJO (ID_LUGAR, ID_PERSONA, DESCRIPCION) VALUES ('$lugar', '$id', '$descripcion')";

				$conn->query($sql);
				break;
			case 10:
				$lugar = $data['ID_LUGAR'];
				$descripcion = $data['DESCRIPCION'];
				$nivel = $data['NIVEL_EDUCACIONAL'];

				$sql = "SELECT * FROM ESCOLARIZACION WHERE ID_PERSONA = $id";
				$result = $conn->query($sql);
				if ($result->num_rows > 0)
					$sql = "UPDATE ESCOLARIZACION SET ID_INSTITUCION = '$lugar', NIVEL_EDUCACIONAL = '$nivel', DESCRIPCION = '$descripcion' WHERE ID_PERSONA = $id ";
				else
					$sql = "INSERT INTO ESCOLARIZACION (ID_INSTITUCION, NIVEL_EDUCACIONAL, DESCRIPCION, ID_PERSONA) VALUES ('$lugar', '$nivel', '$descripcion', '$id')";

				$conn->query($sql);
				break;
			case 11:
				$sql = "DELETE FROM BONORECIBIDO WHERE ID = $id";
				$conn->query($sql);
				break;
			case 12:
				$sql = "DELETE FROM PROGRAMAASIGNADO WHERE ID = $id";
				$conn->query($sql);
				break;
			case 13:
				$sql = "DELETE FROM ENFERMEDAD WHERE ID = $id";
				$conn->query($sql);
				break;
			case 14:
				$sql = "DELETE FROM RECETA WHERE ID = $id";
				$conn->query($sql);
				break;
			case 15:
				$sql = "DELETE FROM DISCAPACIDAD WHERE ID = $id";
				$conn->query($sql);
				break;
			case 16:
				$sql = "DELETE FROM AYUDATECNICA WHERE ID = $id";
				$conn->query($sql);
				break;
			case 17:
				$sql = "DELETE FROM TRABAJO WHERE ID = $id";
				$conn->query($sql);
				break;
			case 18:
				$sql = "DELETE FROM ESCOLARIZACION WHERE ID = $id";
				$conn->query($sql);
				break;
		}
		if ($conn->error)
			echo "Error: ".$conn->error;
		else
			echo "Operacion exitosa";
		$conn->close();
	}

	if (isset($_POST['o'])) {
		switch ($_POST['o']) {
			case 0:
			// BONOS
				$muestra = bonos();
				for ($i=0; $i < count($muestra); $i++) { 
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['NOMBRE']."</option>";
				}
			break;
			case 1:
			// PROGRAMAS SOCIALES
				$muestra = programasSociales();
				for ($i = 0 ; $i < count($muestra) ; $i++) {
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['NOMBRE']."</option>";
				}
			break;
			case 2:
			// ENFERMEDADES
				$muestra = enfermedades();
				for ($i = 0 ; $i < count($muestra) ; $i++) {
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['NOMBRE']."</option>";
				}
			break;

			case 3:
			// MEDICAMENTOS
				$muestra = medicamentos();
				for ($i = 0 ; $i < count($muestra) ; $i++) {
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['NOMBRE']." (".$muestra[$i]['TIPO'].")</option>";
				}
			break;
			case 4:
			// DISCAPACIDADES
				$muestra = discapacidades();
				for ($i = 0 ; $i < count($muestra) ; $i++) {
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['TIPO']."</option>";
				}
			break;
			case 5:
			// AYUDAS TECNICAS
				$muestra = ayudasTec();
				for ($i = 0 ; $i < count($muestra) ; $i++) {
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['NOMBRE']."</option>";
				}
			break;
			case 6:
			// LUGARES DE TRABAJO
				$muestra = lugares();
				for ($i = 0 ; $i < count($muestra) ; $i++) {
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['NOMBRE']." (".$muestra[$i]['TIPO'].") (".$muestra[$i]['TIPO_INSTITUCION'].") RIF:".$muestra[$i]['RIF']."</option>";
				}
			break;
			case 7:
			// LUGARES DE TRABAJO
				$muestra = lugares();
				for ($i = 0 ; $i < count($muestra) ; $i++) {
					if ($muestra[$i]['TIPO_INSTITUCION'] != "EDUCATIVA")
								continue;
					echo "<option value='".$muestra[$i]['ID']."'>".$muestra[$i]['NOMBRE']." (".$muestra[$i]['TIPO'].") (".$muestra[$i]['TIPO_INSTITUCION'].") RIF:".$muestra[$i]['RIF']."</option>";
				}
			break;

			default:
				echo 'Esta operacion no esta implementada';
			break;
		}
	}
?>