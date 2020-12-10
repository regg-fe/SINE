<?php
	function conexion(){
		#Cambiar estos valores según haga falta
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "nedb";
		$conection = new mysqli($servername, $username, $password, $dbname);
		if ($conection->connect_error)	die("Connection failed: " . $conection->connect_error);
		return $conection;
	}

	##				##
	##	CONSULTAS	##
	##				##

	## Tabla USUARIO ##

	function validarUsuario($user, $pass){
		$conn = conexion();
		$sql = "SELECT USUARIO, CLAVE FROM USUARIO WHERE USUARIO = '$user'";
		$result = $conn->query($sql);

		$aux;
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($pass == $row['CLAVE'])	$aux = 2;
			else	$aux = 1;
		}
		else	$aux = 0;
		$conn->close();
		return $aux;
	}

	## Tabla ENFERMEDAD - TIPOENFERMEDAD - DISCAPACIDAD - TIPODISCAPACIDAD - MEDICAMENTO - RECETA - AYUDATECNICA - TIPOAYUDATECNICA##

	function enfermedades(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM TIPOENFERMEDAD ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function enfermos(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT ENFERMEDAD.*, TIPOENFERMEDAD.NOMBRE AS NOMBRE_ENFERMEDAD, PERSONA.NOMBRES AS NOMBRE_PERSONA, PERSONA.APELLIDOS AS APELLIDO_PERSONA FROM ENFERMEDAD JOIN TIPOENFERMEDAD ON (ENFERMEDAD.ID_TIPOENFERMEDAD = TIPOENFERMEDAD.ID) JOIN PERSONA ON (ENFERMEDAD.ID_PERSONA = PERSONA.ID) ORDER BY PERSONA.ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE_ENFERMEDAD'] = $row['NOMBRE_ENFERMEDAD'];
				$tabla[$i]['ID_PERSONA'] = $row['ID_PERSONA'];
				$tabla[$i]['NOMBRE_PERSONA'] = $row['NOMBRE_PERSONA'];
				$tabla[$i]['APELLIDO_PERSONA'] = $row['APELLIDO_PERSONA'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function enfermedadesPorPersona($id_persona){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT ENFERMEDAD.*, TIPOENFERMEDAD.NOMBRE AS NOMBRE_ENFERMEDAD FROM ENFERMEDAD JOIN TIPOENFERMEDAD ON (ENFERMEDAD.ID_TIPOENFERMEDAD = TIPOENFERMEDAD.ID) WHERE ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE_ENFERMEDAD'] = $row['NOMBRE_ENFERMEDAD'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function discapacidades(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM TIPODISCAPACIDAD ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function discapacitados(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT DISCAPACIDAD.*, TIPODISCAPACIDAD.TIPO AS TIPO_DISCAPACIDAD, PERSONA.NOMBRES AS NOMBRE_PERSONA, PERSONA.APELLIDOS AS APELLIDO_PERSONA FROM DISCAPACIDAD JOIN TIPODISCAPACIDAD ON (DISCAPACIDAD.ID_TIPO = TIPODISCAPACIDAD.ID) JOIN PERSONA ON (DISCAPACIDAD.ID_PERSONA = PERSONA.ID) ORDER BY PERSONA.ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['TIPO_DISCAPACIDAD'] = $row['TIPO_DISCAPACIDAD'];
				$tabla[$i]['ID_PERSONA'] = $row['ID_PERSONA'];
				$tabla[$i]['NOMBRE_PERSONA'] = $row['NOMBRE_PERSONA'];
				$tabla[$i]['APELLIDO_PERSONA'] = $row['APELLIDO_PERSONA'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function discapacidadesPorPersona($id_persona){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT DISCAPACIDAD.*, TIPODISCAPACIDAD.TIPO AS TIPO_DISCAPACIDAD FROM DISCAPACIDAD JOIN TIPODISCAPACIDAD ON (DISCAPACIDAD.ID_TIPO = TIPODISCAPACIDAD.ID) WHERE ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['TIPO_DISCAPACIDAD'] = $row['TIPO_DISCAPACIDAD'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function medicamentos(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM MEDICAMENTO ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$tabla[$i]['TIPO'] = $row['TIPO'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function recetas(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT RECETA.*, MEDICAMENTO.NOMBRE AS NOMBRE_MEDICAMENTO, MEDICAMENTO.TIPO AS TIPO_MEDICAMENTO, PERSONA.NOMBRES AS NOMBRES_PERSONA, PERSONA.APELLIDOS AS APELLIDOS_PERSONA FROM RECETA JOIN MEDICAMENTO ON (RECETA.ID_MEDICAMENTO = MEDICAMENTO.ID) JOIN PERSONA ON (RECETA.ID_PERSONA = PERSONA.ID) ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['ID_PERSONA'] = $row['ID_PERSONA'];
				$tabla[$i]['NOMBRE_PERSONA'] = $row['NOMBRES_PERSONA']." ".$row['APELLIDOS_PERSONA'];
				$tabla[$i]['ID_MEDICAMENTO'] = $row['ID_MEDICAMENTO'];
				$tabla[$i]['NOMBRE_MEDICAMENTO'] = $row['NOMBRE_MEDICAMENTO'];
				$tabla[$i]['TIPO_MEDICAMENTO'] = $row['TIPO_MEDICAMENTO'];
				$tabla[$i]['DESCRIPCION'] = $row['DESCRIPCION'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function recetasPorPersona($id_persona){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT RECETA.*, MEDICAMENTO.NOMBRE AS NOMBRE_MEDICAMENTO, MEDICAMENTO.TIPO AS TIPO_MEDICAMENTO FROM RECETA JOIN MEDICAMENTO ON (RECETA.ID_MEDICAMENTO = MEDICAMENTO.ID) WHERE ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['ID_MEDICAMENTO'] = $row['ID_MEDICAMENTO'];
				$tabla[$i]['NOMBRE_MEDICAMENTO'] = $row['NOMBRE_MEDICAMENTO'];
				$tabla[$i]['TIPO_MEDICAMENTO'] = $row['TIPO_MEDICAMENTO'];
				$tabla[$i]['DESCRIPCION'] = $row['DESCRIPCION'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function ayudasTec(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM TIPOAYUDATECNICA ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function ayudasTecPorPersona($id_persona){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT AYUDATECNICA.*, TIPOAYUDATECNICA.NOMBRE AS TIPO_AYUDA FROM AYUDATECNICA JOIN TIPOAYUDATECNICA ON (AYUDATECNICA.ID_TIPOAYUDATECNICA = TIPOAYUDATECNICA.ID) WHERE ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['ID_TIPOAYUDATECNICA'] = $row['ID_TIPOAYUDATECNICA'];
				$tabla[$i]['TIPO_AYUDA'] = $row['TIPO_AYUDA'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	## Tabla CARNET - BONO - BONORECIBIDO - PROGRAMASOCIAL - PROGRAMAASIGNADO - BENEFICIO ##

	function carnet($id_persona){
		$arreglo = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM CARNET WHERE ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$arreglo['ID'] = $row['ID'];
			$arreglo['SERIAL_CARNET'] = $row['SERIAL_CARNET'];
			$arreglo['CODIGO_CARNET'] = $row['CODIGO_CARNET'];
		}
		$conn->close();
		return $arreglo;
	}

	function bonos(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM BONO ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function bonosPorCarnet($id_carnet) {
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT BONORECIBIDO.*, BONO.NOMBRE FROM BONORECIBIDO JOIN BONO ON (BONORECIBIDO.ID_BONO = BONO.ID) JOIN CARNET ON (CARNET.ID = BONORECIBIDO.ID_CARNET) WHERE ID_CARNET = '$id_carnet'";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE_BONO'] = $row['NOMBRE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function programasSociales(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM PROGRAMASOCIAL ORDER BY NOMBRE";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function programasSocialesPorPersona($id_persona){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT PROGRAMAASIGNADO.*, PROGRAMASOCIAL.NOMBRE AS NOMBRE FROM PROGRAMAASIGNADO JOIN PROGRAMASOCIAL ON (PROGRAMAASIGNADO.ID_PROGRAMA = PROGRAMASOCIAL.ID) WHERE ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function registroBeneficios(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT BENEFICIO.*, PERSONA.NOMBRES, PERSONA.APELLIDOS FROM BENEFICIO JOIN PERSONA ON (PERSONA.POSICION = 'JEFE' AND PERSONA.ID_FAMILIA = BENEFICIO.ID_FAMILIA) ORDER BY FECHA_ENTREGA";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['FECHA_ENTREGA'] = $row['FECHA_ENTREGA'];
				$tabla[$i]['ID_FAMILIA'] = $row['ID_FAMILIA'];
				$tabla[$i]['NOMBRE_JEFE'] = $row['NOMBRES']." ".$row['APELLIDOS'];
				$i++;
			}
		}

		$conn->close();
		return $tabla;
	}

	function registroBeneficiosPorFamilia($id_familia){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT BENEFICIO.*, PERSONA.NOMBRES, PERSONA.APELLIDOS FROM BENEFICIO JOIN PERSONA ON (PERSONA.POSICION = 'JEFE' AND PERSONA.ID_FAMILIA = BENEFICIO.ID_FAMILIA) WHERE BENEFICIO.ID_FAMILIA = $id_familia";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['CANTIDAD'] = $row['CANTIDAD'];
				$tabla[$i]['FECHA_ENTREGA'] = $row['FECHA_ENTREGA'];
				$tabla[$i]['NOMBRE_JEFE'] = $row['NOMBRES']." ".$row['APELLIDOS'];
				$i++;
			}
		}

		$conn->close();
		return $tabla;
	}

	## Tabla LUGAR - TRABAJO - ESCOLARIZACION ##

	function lugares(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM LUGAR ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRE'];
				$tabla[$i]['TIPO'] = $row['TIPO'];
				$tabla[$i]['	'] = $row['TIPO_INSTITUCION'];
				$tabla[$i]['RIF'] = $row['RIF'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function lugar($id_lugar){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM LUGAR WHERE ID = $id_lugar";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$tabla['ID'] = $row['ID'];
			$tabla['NOMBRE'] = $row['NOMBRE'];
			$tabla['TIPO'] = $row['TIPO'];
			$tabla['TIPO_INSTITUCION'] = $row['TIPO_INSTITUCION'];
			$tabla['RIF'] = $row['RIF'];
		}
		$conn->close();
		return $tabla;
	}

	function trabajadores(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT TRABAJO.*, PERSONA.NOMBRES, PERSONA.APELLIDOS FROM TRABAJO JOIN PERSONA ON (TRABAJO.ID_PERSONA = PERSONA.ID) ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['ID_LUGAR'] = $row['ID_LUGAR'];
				$tabla[$i]['ID_PERSONA'] = $row['ID_PERSONA'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRES']." ".$row['APELLIDOS'];
				$tabla[$i]['DESCRIPCION'] = $row['DESCRIPCION'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function trabajosPorPersona($id_persona){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM TRABAJO WHERE ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['ID_LUGAR'] = $row['ID_LUGAR'];
				$tabla[$i]['ID_PERSONA'] = $row['ID_PERSONA'];
				$tabla[$i]['DESCRIPCION'] = $row['DESCRIPCION'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function escolarizaciones(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT ESCOLARIZACION.*, PERSONA.NOMBRES, PERSONA.APELLIDOS, LUGAR.NOMBRE AS NOMBRE_INSTITUCION FROM ESCOLARIZACION JOIN PERSONA ON (ESCOLARIZACION.ID_PERSONA = PERSONA.ID) JOIN LUGAR ON (ESCOLARIZACION.ID_INSTITUCION = LUGAR.ID) ORDER BY ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NIVEL_EDUCACIONAL'] = $row['NIVEL_EDUCACIONAL'];
				$tabla[$i]['DESCRIPCION'] = $row['DESCRIPCION'];
				$tabla[$i]['ID_INSTITUCION'] = $row['ID_INSTITUCION'];
				$tabla[$i]['NOMBRE_INSTITUCION'] = $row['MOMBRE_INSTITUCION'];
				$tabla[$i]['ID_PERSONA'] = $row['ID_PERSONA'];
				$tabla[$i]['NOMBRE'] = $row['NOMBRES']." ".$row['APELLIDOS'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function escolarizacionPorPersona($id_persona){
		$arreglo = NULL;
		$conn = conexion();

		$sql = "SELECT ESCOLARIZACION.*, LUGAR.NOMBRE AS NOMBRE_INSTITUCION, LUGAR.RIF AS RIF_INSTITUCION FROM ESCOLARIZACION JOIN LUGAR ON (ESCOLARIZACION.ID_INSTITUCION = LUGAR.ID) WHERE ESCOLARIZACION.ID_PERSONA = $id_persona";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$arreglo['ID'] = $row['ID'];
			$arreglo['NIVEL_EDUCACIONAL'] = $row['NIVEL_EDUCACIONAL'];
			$arreglo['DESCRIPCION'] = $row['DESCRIPCION'];
			$arreglo['ID_INSTITUCION'] = $row['ID_INSTITUCION'];
			$arreglo['NOMBRE_INSTITUCION'] = $row['NOMBRE_INSTITUCION'];
			$arreglo['RIF_INSTITUCION'] = $row['RIF_INSTITUCION'];
		}
		$conn->close();
		return $arreglo;
	}

	## Tabla PERSONA - LIDER - BRIGADISTA ##

	function personas(){
		$personas = NULL;
		$conn = conexion();

		$sql = "SELECT P1.*, P2.APELLIDOS AS FAMILIA, CARNET.CODIGO_CARNET AS CODIGO_CARNET, CARNET.SERIAL_CARNET AS SERIAL_CARNET,	APARTAMENTO.ID AS ID_APARTAMENTO, APARTAMENTO.NUMERO_APARTAMENTO AS NRO_APARTAMENTO, BLOQUE.ID AS ID_BLOQUE, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM PERSONA AS P1 LEFT JOIN PERSONA AS P2 ON (P1.ID_FAMILIA = P2.ID_FAMILIA AND P2.POSICION = 'JEFE') LEFT JOIN CARNET ON (P1.ID = CARNET.ID_PERSONA) LEFT JOIN FAMILIA ON (P1.ID_FAMILIA = FAMILIA.ID) LEFT JOIN APARTAMENTO ON (FAMILIA.ID_APARTAMENTO = APARTAMENTO.ID) LEFT JOIN BLOQUE ON (APARTAMENTO.ID_BLOQUE = BLOQUE.ID) ORDER BY P1.ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while($row = $result->fetch_assoc()) {
				$personas[$i]['ID'] = $row['ID'];
				$personas[$i]['NOMBRES'] = $row['NOMBRES'];
				$personas[$i]['APELLIDOS'] = $row['APELLIDOS'];
				$personas[$i]['GENERO'] = $row['GENERO'];
				$personas[$i]['DNI'] = $row['DNI'];
				$personas[$i]['TELEFONO'] = $row['TELEFONO'];
				$personas[$i]['POSICION'] = $row['POSICION'];
				$personas[$i]['EMBARAZO'] = $row['EMBARAZO'];
				$personas[$i]['ENCAMADO'] = $row['ENCAMADO'];
				$personas[$i]['PENSION'] = $row['PENSION'];
				$personas[$i]['VOTO'] = $row['VOTO'];
				$personas[$i]['FECHA_NAC'] = $row['FECHA_NAC'];
				$personas[$i]['PESO'] = $row['PESO'];
				$personas[$i]['ESTATURA'] = $row['ESTATURA'];
				$personas[$i]['CODIGO_CARNET'] = $row['CODIGO_CARNET'];
				$personas[$i]['SERIAL_CARNET'] = $row['SERIAL_CARNET'];
				$personas[$i]['ID_FAMILIA'] = $row['ID_FAMILIA'];
				$personas[$i]['FAMILIA'] = $row['FAMILIA'];
				$personas[$i]['ID_APARTAMENTO'] = $row['ID_APARTAMENTO'];
				$personas[$i]['NRO_APARTAMENTO'] = $row['NRO_APARTAMENTO'];
				$personas[$i]['ID_BLOQUE'] = $row['ID_BLOQUE'];
				$personas[$i]['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
				$i++;
			}
		}
		$conn->close();
		return $personas;
	}

	function persona($id){
		$persona = NULL;
		$conn = conexion();
		$sql = "SELECT P1.*, 
		P2.APELLIDOS AS FAMILIA, 
		CARNET.CODIGO_CARNET AS CODIGO_CARNET,
		CARNET.SERIAL_CARNET AS SERIAL_CARNET,
		APARTAMENTO.ID AS ID_APARTAMENTO, 
		APARTAMENTO.NUMERO_APARTAMENTO AS NRO_APARTAMENTO,
		BLOQUE.ID AS ID_BLOQUE, 
		BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE 
		FROM PERSONA AS P1 
		LEFT JOIN PERSONA AS P2 ON (P1.ID_FAMILIA = P2.ID_FAMILIA AND P2.POSICION = 'JEFE') 
		LEFT JOIN CARNET ON (P1.ID = CARNET.ID_PERSONA) 
		LEFT JOIN FAMILIA ON (P1.ID_FAMILIA = FAMILIA.ID) 
		LEFT JOIN APARTAMENTO ON (FAMILIA.ID_APARTAMENTO = APARTAMENTO.ID) 
		LEFT JOIN BLOQUE ON (APARTAMENTO.ID_BLOQUE = BLOQUE.ID) 
		WHERE P1.ID = $id";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$persona['ID'] = $row['ID'];
			$persona['NOMBRES'] = $row['NOMBRES'];
			$persona['APELLIDOS'] = $row['APELLIDOS'];
			$persona['GENERO'] = $row['GENERO'];
			$persona['DNI'] = $row['DNI'];
			$persona['TELEFONO'] = $row['TELEFONO'];
			$persona['POSICION'] = $row['POSICION'];
			$persona['EMBARAZO'] = $row['EMBARAZO'];
			$persona['ENCAMADO'] = $row['ENCAMADO'];
			$persona['PENSION'] = $row['PENSION'];
			$persona['VOTO'] = $row['VOTO'];
			$persona['FECHA_NAC'] = $row['FECHA_NAC'];
			$persona['PESO'] = $row['PESO'];
			$persona['ESTATURA'] = $row['ESTATURA'];
			$persona['CODIGO_CARNET'] = $row['CODIGO_CARNET'];
			$persona['SERIAL_CARNET'] = $row['SERIAL_CARNET'];
			$persona['ID_FAMILIA'] = $row['ID_FAMILIA'];
			$persona['FAMILIA'] = $row['FAMILIA'];
			$persona['ID_APARTAMENTO'] = $row['ID_APARTAMENTO'];
			$persona['NRO_APARTAMENTO'] = $row['NRO_APARTAMENTO'];
			$persona['ID_BLOQUE'] = $row['ID_BLOQUE'];
			$persona['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
		}
		$conn->close();
		return $persona;
	}

	function personasPorFamilia($id_familia){
		$personas = NULL;
		$conn = conexion();

		$sql = "SELECT ID FROM PERSONA WHERE ID_FAMILIA = $id_familia";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$personas[$a] = persona($row['ID']);
				$a++;
			}
		}
		$conn->close();
		return $personas;
	}

	function lideres(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT LIDER.*, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE, BLOQUE.ID AS ID_BLOQUE FROM LIDER JOIN BLOQUE ON (LIDER.ID_BLOQUE = BLOQUE.ID) ORDER BY NRO_BLOQUE";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRES'] = $row['NOMBRES'];
				$tabla[$i]['APELLIDOS'] = $row['APELLIDOS'];
				$tabla[$i]['DNI'] = $row['DNI'];
				$tabla[$i]['TELEFONO'] = $row['TELEFONO'];
				$tabla[$i]['ID_BLOQUE'] = $row['ID_BLOQUE'];
				$tabla[$i]['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function lider($id_bloque){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT *, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM LIDER JOIN BLOQUE ON (LIDER.ID_BLOQUE = BLOQUE.ID) WHERE ID_BLOQUE = $id_bloque";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$tabla['ID'] = $row['ID'];
			$tabla['NOMBRES'] = $row['NOMBRES'];
			$tabla['APELLIDOS'] = $row['APELLIDOS'];
			$tabla['DNI'] = $row['DNI'];
			$tabla['TELEFONO'] = $row['TELEFONO'];
			$tabla['ID_BLOQUE'] = $row['ID_BLOQUE'];
			$tabla['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
		}
		$conn->close();
		return $tabla;
	}

	function brigadistas(){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT BRIGADISTA.*, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE, BLOQUE.ID AS ID_BLOQUE FROM BRIGADISTA JOIN BLOQUE ON (BRIGADISTA.ID_BLOQUE = BLOQUE.ID) ORDER BY NRO_BLOQUE";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$i]['ID'] = $row['ID'];
				$tabla[$i]['NOMBRES'] = $row['NOMBRES'];
				$tabla[$i]['APELLIDOS'] = $row['APELLIDOS'];
				$tabla[$i]['DNI'] = $row['DNI'];
				$tabla[$i]['TELEFONO'] = $row['TELEFONO'];
				$tabla[$i]['ID_BLOQUE'] = $row['ID_BLOQUE'];
				$tabla[$i]['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
				$i++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function brigadista($id_bloque){
		$tabla = NULL;
		$conn = conexion();

		$sql = "SELECT *, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM BRIGADISTA JOIN BLOQUE ON (BRIGADISTA.ID_BLOQUE = BLOQUE.ID) WHERE ID_BLOQUE = $id_bloque";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$tabla['ID'] = $row['ID'];
			$tabla['NOMBRES'] = $row['NOMBRES'];
			$tabla['APELLIDOS'] = $row['APELLIDOS'];
			$tabla['DNI'] = $row['DNI'];
			$tabla['TELEFONO'] = $row['TELEFONO'];
			$tabla['ID_BLOQUE'] = $row['ID_BLOQUE'];
			$tabla['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
		}
		$conn->close();
		return $tabla;
	}

	## Tabla FAMILIA ##

	function familias(){
		$familias = NULL;
		$conn = conexion();

		$sql = "SELECT FAMILIA.*, PERSONA.ID AS ID_JEFE, APARTAMENTO.NUMERO_APARTAMENTO AS NRO_APARTAMENTO, APARTAMENTO.ID_BLOQUE AS ID_BLOQUE, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM FAMILIA JOIN APARTAMENTO ON (FAMILIA.ID_APARTAMENTO = APARTAMENTO.ID) JOIN BLOQUE ON (APARTAMENTO.ID_BLOQUE = BLOQUE.ID) LEFT JOIN PERSONA ON (FAMILIA.ID = PERSONA.ID_FAMILIA AND PERSONA.POSICION = 'JEFE') ORDER BY ID";

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$familias[$i]['ID'] = $row['ID'];
				$familias[$i]['ID_JEFE'] = $row['ID_JEFE'];
				$familias[$i]['ID_APARTAMENTO'] = $row['ID_APARTAMENTO'];
				$familias[$i]['NRO_APARTAMENTO'] = $row['NRO_APARTAMENTO'];
				$familias[$i]['ID_BLOQUE'] = $row['ID_BLOQUE'];
				$familias[$i]['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
				$i++;
			}
		}
		$conn->close();
		return $familias;
	}
	
	function familia($id){
		$familia = NULL;
		$conn = conexion();

		$sql = "SELECT FAMILIA.*, PERSONA.ID AS ID_JEFE, APARTAMENTO.NUMERO_APARTAMENTO AS NRO_APARTAMENTO, APARTAMENTO.ID_BLOQUE AS ID_BLOQUE, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM FAMILIA JOIN APARTAMENTO ON (FAMILIA.ID_APARTAMENTO = APARTAMENTO.ID) JOIN BLOQUE ON (APARTAMENTO.ID_BLOQUE = BLOQUE.ID) LEFT JOIN PERSONA ON (FAMILIA.ID = PERSONA.ID_FAMILIA AND PERSONA.POSICION = 'JEFE') WHERE FAMILIA.ID = $id";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$familia['ID'] = $row['ID'];
			$familia['ID_JEFE'] = $row['ID_JEFE'];
			$familia['ID_APARTAMENTO'] = $row['ID_APARTAMENTO'];
			$familia['NRO_APARTAMENTO'] = $row['NRO_APARTAMENTO'];
			$familia['ID_BLOQUE'] = $row['ID_BLOQUE'];
			$familia['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
		}
		$conn->close();
		return $familia;
	}

	function familiasPorApartamento($id_apartamento){
		$familias = NULL;
		$conn = conexion();

		$sql = "SELECT ID FROM FAMILIA WHERE ID_APARTAMENTO = $id_apartamento";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$familias[$a] = familia($row['ID']);
				$a++;
			}
		}
		$conn->close();
		return $familias;
	}

	## Tabla APARTAMENTO ##

	function apartamentos(){
		$apartamentos = NULL;
		$conn = conexion();

		$sql = "SELECT APARTAMENTO.*, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM APARTAMENTO JOIN BLOQUE ON APARTAMENTO.ID_BLOQUE = BLOQUE.ID ORDER BY ID";

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$apartamentos[$i]['ID'] = $row['ID'];
				$apartamentos[$i]['NRO_APARTAMENTO'] = $row['NUMERO_APARTAMENTO'];
				$apartamentos[$i]['ANEXO'] = $row['ANEXO'];
				$apartamentos[$i]['ID_BLOQUE'] = $row['ID_BLOQUE'];
				$apartamentos[$i]['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
				$i++;
			}
		}
		$conn->close();
		return $apartamentos;
	}
	
	function apartamento($id){
		$apartamento = NULL;
		$conn = conexion();

		$sql = "SELECT APARTAMENTO.*, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM APARTAMENTO JOIN BLOQUE ON APARTAMENTO.ID_BLOQUE = BLOQUE.ID WHERE APARTAMENTO.ID = $id";

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$apartamento['ID'] = $row['ID'];
			$apartamento['NRO_APARTAMENTO'] = $row['NUMERO_APARTAMENTO'];
			$apartamento['ANEXO'] = $row['ANEXO'];
			$apartamento['ID_BLOQUE'] = $row['ID_BLOQUE'];
			$apartamento['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
		} 
		$conn->close();
		return $apartamento;
	}
	
	function apartamentosPorBloque($id_bloque){
		$apartamentos = NULL;
		$conn = conexion();

		$sql = "SELECT ID FROM APARTAMENTO WHERE ID_BLOQUE = $id_bloque";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$apartamentos[$a] = apartamento($row['ID']);
				$a++;
			} 
		} else {
			return false;
		}
		$conn->close();
		return $apartamentos;
	}

	function anexosPorBloque($id_bloque){
		$apartamentos = NULL;
		$conn = conexion();

		$sql = "SELECT ID FROM APARTAMENTO WHERE ID_BLOQUE = $id_bloque AND ANEXO = 'S'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$apartamentos[$a] = apartamento($row['ID']);
				$a++;
			} 
		} else {
			return false;
		}
		$conn->close();
		return $apartamentos;
	}


	function existeAnexo($nro_anexo,$id_bloque){
		$apartamentos = NULL;
		$conn = conexion();

		$sql = "SELECT ID FROM APARTAMENTO WHERE ID_BLOQUE = $id_bloque AND NUMERO_APARTAMENTO = $nro_anexo AND ANEXO = 'S'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$apartamentos[$a] = apartamento($row['ID']);
				$a++;
			} 
		} else {
			return false;
		}
		$conn->close();
		return $apartamentos;
	}

	## Tabla BLOQUE ##

	function bloques(){
		$bloques = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM BLOQUE ORDER BY ID";

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$bloques[$i]['ID'] = $row['ID'];
				$bloques[$i]['NRO_BLOQUE'] = $row['NUMERO_BLOQUE'];
				$i++;
			}
		}
		$conn->close();
		return $bloques;
	}
	
	function bloque($id){
		$bloque = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM BLOQUE WHERE ID = $id";

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$bloque['ID'] = $row['ID'];
			$bloque['NRO_BLOQUE'] = $row['NUMERO_BLOQUE'];
		}
		$conn->close();
		return $bloque;
	}

	## Tabla BOMBONA - TIPOBOMBONA - MARCABOMBONA ##

	function bombonas(){
		$bombonas = NULL;
		$conn = conexion();

		$sql = "SELECT BOMBONA.*, TIPOBOMBONA.TIPO AS TIPO, MARCABOMBONA.MARCA AS MARCA, PERSONA.NOMBRES AS NOMBRES, PERSONA.APELLIDOS AS APELLIDOS FROM BOMBONA JOIN TIPOBOMBONA ON (BOMBONA.ID_TIPO = TIPOBOMBONA.ID) JOIN MARCABOMBONA ON (BOMBONA.ID_MARCA = MARCABOMBONA.ID) JOIN PERSONA ON (BOMBONA.ID_FAMILIA = PERSONA.ID_FAMILIA AND PERSONA.POSICION = 'JEFE') ORDER BY BOMBONA.ID";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$bombonas[$a]['ID'] = $row['ID'];
				$bombonas[$a]['ID_FAMILIA'] = $row['ID_FAMILIA'];
				$bombonas[$a]['MARCA'] = $row['MARCA'];
				$bombonas[$a]['TIPO'] = $row['TIPO'];
				$bombonas[$a]['NOMBRE_JEFE'] = $row['NOMBRES']." ".$row['APELLIDOS'];
				$a++;
			}
		}
		$conn->close();
		return $bombonas;
	}
	function bombona($id){
		$bombona = NULL;
		$conn = conexion();

		$sql = "SELECT BOMBONA.*, TIPOBOMBONA.TIPO AS TIPO, MARCABOMBONA.MARCA AS MARCA, PERSONA.NOMBRES AS NOMBRES, PERSONA.APELLIDOS AS APELLIDOS FROM BOMBONA JOIN TIPOBOMBONA ON (BOMBONA.ID_TIPO = TIPOBOMBONA.ID) JOIN MARCABOMBONA ON (BOMBONA.ID_MARCA = MARCABOMBONA.ID) JOIN PERSONA ON (BOMBONA.ID_FAMILIA = PERSONA.ID_FAMILIA AND PERSONA.POSICION = 'JEFE') WHERE BOMBONA.ID = $id";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			$bombona['ID'] = $row['ID'];
			$bombona['ID_FAMILIA'] = $row['ID_FAMILIA'];
			$bombona['MARCA'] = $row['MARCA'];
			$bombona['TIPO'] = $row['TIPO'];
			$bombona['NOMBRE_JEFE'] = $row['NOMBRES']." ".$row['APELLIDOS'];
			}
		$conn->close();
		return $bombona;
	}
	function bombonasPorFamilia($id_familia){
		$bombonas = NULL;
		$conn = conexion();

		$sql = "SELECT ID FROM BOMBONA WHERE ID_FAMILIA = $id_familia";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$bombonas[$a] = bombona($row['ID']);
				$a++;
			}
		}
		$conn->close();
		return $bombonas;
	}

	function marcaBombona() {
		$marcas = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM MARCABOMBONA";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
			 	$marcas[$a]['ID'] = $row['ID'];
			 	$marcas[$a]['MARCA'] = $row['MARCA'];
			 	$a++;
			 } 
		}
		$conn->close();
		return $marcas;
	}

	function tipoBombona() {
		$tipos = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM TIPOBOMBONA";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
			 	$tipos[$a]['ID'] = $row['ID'];
			 	$tipos[$a]['TIPO'] = $row['TIPO'];
			 	$a++;
			 } 
		}
		$conn->close();
		return $tipos;
	}

	## Estadistica ##

	function estadoDeNutricion($option){
		$tabla = NULL;
		$conn = conexion();
		$limit;

		switch ($option) {
			case 1:
				$limit = "(P1.PESO)/(P1.ESTATURA * P1.ESTATURA) < 18.50";
				break;
			case 2:
				$limit = "(P1.PESO)/(P1.ESTATURA * P1.ESTATURA) < 25.00 AND (P1.PESO)/(P1.ESTATURA * P1.ESTATURA) > 18.49";
				break;
			case 3:
				$limit = "(P1.PESO)/(P1.ESTATURA * P1.ESTATURA) < 30.00 AND (P1.PESO)/(P1.ESTATURA * P1.ESTATURA) > 24.99";
				break;
			case 4:
				$limit = "(P1.PESO)/(P1.ESTATURA * P1.ESTATURA) > 30.00";
				break;
			default:
				$limit = "(P1.PESO)/(P1.ESTATURA * P1.ESTATURA) < 18.50";
				break;
		}

		$sql = "SELECT P1.*, (P1.PESO)/(P1.ESTATURA * P1.ESTATURA) AS IMC, P2.APELLIDOS AS FAMILIA,APARTAMENTO.ID AS ID_APARTAMENTO, APARTAMENTO.NUMERO_APARTAMENTO AS NRO_APARTAMENTO,BLOQUE.ID AS ID_BLOQUE, BLOQUE.NUMERO_BLOQUE AS NRO_BLOQUE FROM PERSONA AS P1 LEFT JOIN PERSONA AS P2 ON (P1.ID_FAMILIA = P2.ID_FAMILIA AND P2.POSICION = 'JEFE') LEFT JOIN FAMILIA ON (P1.ID_FAMILIA = FAMILIA.ID) LEFT JOIN APARTAMENTO ON (FAMILIA.ID_APARTAMENTO = APARTAMENTO.ID) LEFT JOIN BLOQUE ON (APARTAMENTO.ID_BLOQUE = BLOQUE.ID) WHERE ($limit)";

		$result = $conn->query($sql);
		echo $conn->error;
		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				$tabla[$a]['ID'] = $row['ID'];
				$tabla[$a]['NOMBRES'] = $row['NOMBRES'];
				$tabla[$a]['APELLIDOS'] = $row['APELLIDOS'];
				$tabla[$a]['GENERO'] = $row['GENERO'];
				$tabla[$a]['FECHA_NAC'] = $row['FECHA_NAC'];
				$tabla[$a]['DNI'] = $row['DNI'];
				$tabla[$a]['TELEFONO'] = $row['TELEFONO'];
				$tabla[$a]['PESO'] = $row['PESO'];
				$tabla[$a]['ESTATURA'] = $row['ESTATURA'];
				$tabla[$a]['ID_FAMILIA'] = $row['ID_FAMILIA'];
				$tabla[$a]['FAMILIA'] = $row['FAMILIA'];
				$tabla[$a]['ID_APARTAMENTO'] = $row['ID_APARTAMENTO'];
				$tabla[$a]['NRO_APARTAMENTO'] = $row['NRO_APARTAMENTO'];
				$tabla[$a]['ID_BLOQUE'] = $row['ID_BLOQUE'];
				$tabla[$a]['NRO_BLOQUE'] = $row['NRO_BLOQUE'];
				$tabla[$a]['IMC'] = intval($row['IMC']*100)/100;
				$a++;
			}
		}
		$conn->close();
		return $tabla;
	}

	function lactantes(){
		$tabla = NULL;
		$personas = personas();
		$hoy = new DateTime();
		for ($i=0, $a=0; $i < count($personas); $i++) {

			if ($personas[$i]['FECHA_NAC'] == NULL)
				continue;

			$aux = new DateTime($personas[$i]['FECHA_NAC']);
			
			if ($hoy->diff($aux)->y == 0) {
				$tabla[$a]['ID'] = $personas[$i]['ID'];
				$tabla[$a]['NOMBRES'] = $personas[$i]['NOMBRES'];
				$tabla[$a]['APELLIDOS'] = $personas[$i]['APELLIDOS'];
				$tabla[$a]['GENERO'] = $personas[$i]['GENERO'];
				$tabla[$a]['FECHA_NAC'] = $personas[$i]['FECHA_NAC'];
				$tabla[$a]['ID_FAMILIA'] = $personas[$i]['ID_FAMILIA'];
				$tabla[$a]['FAMILIA'] = $personas[$i]['FAMILIA'];
				$tabla[$a]['ID_APARTAMENTO'] = $personas[$i]['ID_APARTAMENTO'];
				$tabla[$a]['NRO_APARTAMENTO'] = $personas[$i]['NRO_APARTAMENTO'];
				$tabla[$a]['ID_BLOQUE'] = $personas[$i]['ID_BLOQUE'];
				$tabla[$a]['NRO_BLOQUE'] = $personas[$i]['NRO_BLOQUE'];
				$a++;
			}
		}
		return $tabla;
	}

	function adultosMayores(){
		$tabla = NULL;
		$personas = personas();
		$hoy = new DateTime();
		for ($i=0, $a=0; $i < count($personas); $i++) {

			if ($personas[$i]['FECHA_NAC'] == NULL)
				continue;

			$aux = new DateTime($personas[$i]['FECHA_NAC']);
			
			if ($hoy->diff($aux)->y > 65) {
				$tabla[$a]['ID'] = $personas[$i]['ID'];
				$tabla[$a]['NOMBRES'] = $personas[$i]['NOMBRES'];
				$tabla[$a]['APELLIDOS'] = $personas[$i]['APELLIDOS'];
				$tabla[$a]['GENERO'] = $personas[$i]['GENERO'];
				$tabla[$a]['FECHA_NAC'] = $personas[$i]['FECHA_NAC'];
				$tabla[$a]['ID_FAMILIA'] = $personas[$i]['ID_FAMILIA'];
				$tabla[$a]['FAMILIA'] = $personas[$i]['FAMILIA'];
				$tabla[$a]['ID_APARTAMENTO'] = $personas[$i]['ID_APARTAMENTO'];
				$tabla[$a]['NRO_APARTAMENTO'] = $personas[$i]['NRO_APARTAMENTO'];
				$tabla[$a]['ID_BLOQUE'] = $personas[$i]['ID_BLOQUE'];
				$tabla[$a]['NRO_BLOQUE'] = $personas[$i]['NRO_BLOQUE'];
				$a++;
			}
		}
		return $tabla;
	}

	function pensionados($filter = 'ALL'){
		$personas = NULL;
		$conn = conexion();

		$aux;
		switch ($filter) {
			case 'ALL':
				$aux = "'AM' OR PENSION = 'SS'";
				break;
			case 'NT':
			case 'AM':
			case 'SS':
				$aux = "'".$filter."'";
				break;
			default:
				$aux = "AM";
				break;
		}

		$sql = "SELECT ID, NOMBRES, APELLIDOS, PENSION FROM PERSONA WHERE PENSION = $aux";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while($row = $result->fetch_assoc()) {
				$personas[$a]['ID'] = $row["ID"];
				$personas[$a]['NOMBRES'] = $row["NOMBRES"];
				$personas[$a]['APELLIDOS'] = $row["APELLIDOS"];
				$personas[$a]['PENSION'] = $row["PENSION"];
				$a++;
			}
		}
		$conn->close();
		return $personas;
	}

	function embarazadas($boolean = TRUE) {
		$personas = NULL;
		$conn = conexion();

		$aux;
		if 		($boolean==true)	$aux = "'S'";	
		else if ($boolean==false)	$aux = "'N'";
		else	return NULL;
		$sql = "SELECT ID, NOMBRES, APELLIDOS FROM PERSONA WHERE (EMBARAZO = $aux AND GENERO = 'F')";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while($row = $result->fetch_assoc()) {
				$personas[$a]['ID'] = $row["ID"];
				$personas[$a]['NOMBRES'] = $row["NOMBRES"];
				$personas[$a]['APELLIDOS'] = $row["APELLIDOS"];
				$a++;
			}
		}
		$conn->close();
		return $personas;
	}

	function encamados($boolean = TRUE) {
		$personas = NULL;
		$conn = conexion();

		$aux;
		if 		($boolean==true)	$aux = "'S'";	
		else if ($boolean==false)	$aux = "'N'";
		else	return NULL;
		$sql = "SELECT ID, NOMBRES, APELLIDOS FROM PERSONA WHERE (ENCAMADO = $aux)";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while($row = $result->fetch_assoc()) {
				$personas[$a]['ID'] = $row["ID"];
				$personas[$a]['NOMBRES'] = $row["NOMBRES"];
				$personas[$a]['APELLIDOS'] = $row["APELLIDOS"];
				$a++;
			}
		}
		$conn->close();
		return $personas;
	}

	function tienenCarnet($boolean = TRUE){
		$personas = NULL;
		$conn = conexion();

		$aux;
		if 		($boolean == true)
			$sql = "SELECT PERSONA.ID AS ID, NOMBRES, APELLIDOS, SERIAL_CARNET, CODIGO_CARNET FROM PERSONA JOIN CARNET ON (PERSONA.ID = CARNET.ID_PERSONA)";	
		else if ($boolean == false)	
			$sql = "SELECT PERSONA.ID AS ID, NOMBRES, APELLIDOS, SERIAL_CARNET, CODIGO_CARNET FROM PERSONA LEFT JOIN CARNET ON (PERSONA.ID = CARNET.ID_PERSONA) WHERE (CARNET.ID IS NULL)";
		
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$a = 0;
			while($row = $result->fetch_assoc()) {
				$personas[$a]['ID'] = $row["ID"];
				$personas[$a]['NOMBRES'] = $row["NOMBRES"];
				$personas[$a]['APELLIDOS'] = $row["APELLIDOS"];
				if ($boolean == true) {
					$personas[$a]['SERIAL_CARNET'] = $row["SERIAL_CARNET"];
					$personas[$a]['CODIGO_CARNET'] = $row["CODIGO_CARNET"];
				}
				$a++;
			}
		}
		$conn->close();
		return $personas;
	}

	function apartamentosConUnaPersona(){
		$apartamentos = NULL;
		$conn = conexion();

		$sql = "SELECT FAMILIA.*, PERSONA.ID AS ID_PERSONA, PERSONA.NOMBRES AS NOMBRES, PERSONA.APELLIDOS AS APELLIDOS FROM FAMILIA JOIN PERSONA ON (FAMILIA.ID = PERSONA.ID_FAMILIA)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
				if (count(personasPorFamilia($row['ID'])) == 1) {
					if (count(familiasPorApartamento($row['ID_APARTAMENTO'])) == 1) {
						$apartamentos[$a]['ID_APARTAMENTO'] = $row['ID_APARTAMENTO'];
						$apartamentos[$a]['ID_PERSONA'] = $row['ID_PERSONA'];
						$apartamentos[$a]['NOMBRE_COMPLETO'] = $row['NOMBRES']." ".$row['APELLIDOS'];
						$a++;
					}
				}
			}
		}
		$conn->close();
		return $apartamentos;
	}

	function usuarios() {
		$usuarios = NULL;
		$conn = conexion();

		$sql = "SELECT * FROM USUARIO";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			$a = 0;
			while ($row = $result->fetch_assoc()) {
			 	$usuarios[$a]['ID'] = $row['ID'];
			 	$usuarios[$a]['USUARIO'] = $row['USUARIO'];
			 	$usuarios[$a]['NOMBRE'] = $row['NOMBRE'];
			 	$usuarios[$a]['APELLIDO'] = $row['APELLIDO'];
			 	$usuarios[$a]['CLAVE'] = $row['CLAVE'];
			 	$a++;
			 } 
		}
		$conn->close();
		return $usuarios;
	}

	## Funciones para desarrollo ##

	function familiasRandom($num_familias = 0){
		$conn = conexion();

		for ($i=0; $i < $num_familias; $i++){

			$sql = "INSERT INTO FAMILIA (ID_APARTAMENTO, ESTADO_VIVIENDA) VALUES (".rand(1,240).", ".rand(1,3).")";
			$conn->query($sql);
			echo $conn->error;
		}

		$conn->close();
	}
	function llenarFamiliasVacias(){
		$conn = conexion();

		$nombre[0]="Jose";$nombre[1]="Juan";$nombre[2]="Julian";$nombre[3]="Pedro";$nombre[4]="Robert";
		$nombre[5]="Josmar";$nombre[6]="Luis";$nombre[7]="Wilmer";$nombre[8]="Jesus";$nombre[9]="Alberto";
		$nombre[10]="Ana";$nombre[11]="Susana";$nombre[12]="Paola";$nombre[13]="Alexa";$nombre[14]="Gloria";
		$nombre[15]="Teresa";$nombre[16]="Jimena";$nombre[17]="Lucia";$nombre[18]="Angela";$nombre[19]="Maria";

		$apellido[0]="Colina";$apellido[1]="Perez";$apellido[2]="Veliz";$apellido[3]="Sanchez";
		$apellido[4]="Hernandez";$apellido[5]="Romero";$apellido[6]="Morales";$apellido[7]="Gonzales";
		$apellido[8]="Mora";$apellido[9]="Chirinos";

		$familias = familias();
		for ($i=0; $i < count($familias); $i++){
			if (count(personasPorFamilia($familias[$i]['ID'])) == 0) {
				echo "Llenando familia ID=".$familias[$i]['ID']."<br><br>";

				for ($j=0; $j < rand(1,5); $j++){
					$nm; $ap; $gn; $tf; $em; $ps; $en;

					#Seleccion de nombre y genero
					switch (rand(0,1)) {
						case 0:	$nm = $nombre[rand(0,9)]; 	$gn = 'M'; break;
						case 1: $nm = $nombre[rand(10,19)];	$gn = 'F'; break;
					}
					#Seleccion de posicion en la familia
					if ($j == 0){
						$ps = 1;
					}else{
						$ps = rand(3,7);
					}
					#Seleccion de apellido
					$ap = $apellido[rand(0,9)]." ".$apellido[rand(0,9)];

					#Seleccion de embarazo (S/N)
					if ($gn == 'F') {
						switch (rand(0,8)) {
							case 0:	$em = 'S';	break;
							default: $em = 'N'; break;
						}
					}else $em = 'N';
					#Seleccion de encamado (S/N)
					switch (rand(0,8)) {
						case 0:	$en = 'S';	break;
						default: $en = 'N'; break;
					}
					#Generador de numero de telefono
					switch (rand(1,6)) {
						case 1: $tf = "0412-".rand(1000000,9999999);	break;
						case 2: $tf = "0268-".rand(1000000,9999999);	break;
						case 3: $tf = "0414-".rand(1000000,9999999);	break;
						case 4: $tf = "0424-".rand(1000000,9999999);	break;
						case 5: $tf = "0416-".rand(1000000,9999999);	break;
						case 6: $tf = "0426-".rand(1000000,9999999);	break;
					}
					$sql = "INSERT INTO PERSONA (NOMBRES, APELLIDOS, GENERO, DNI, TELEFONO, POSICION, EMBARAZO, ENCAMADO, PENSION, VOTO, FECHA_NAC, PESO, ESTATURA, ID_FAMILIA) VALUES ('$nm', '$ap', '$gn', ".rand(7000000, 35000000).",'$tf', $ps, '$em', '$en', ".rand(1,3).", ".rand(1,3).", '".rand(1940,2002)."-".rand(1,12)."-".rand(1,29)."', ".(rand(6000,12000)/100).", ".(rand(140,205)/100).", ".$familias[$i]['ID'].")";
					$conn->query($sql);
				}
			}
		}
		$conn->close();
	}

	function carnetsRandom(){
		$conn = conexion();
		$notienen = tienenCarnet(false);

		for ($i=0; $i < count($notienen); $i++) {
			if (rand(1,4) == 4) continue;

			$sql = "INSERT INTO CARNET (SERIAL_CARNET,CODIGO_CARNET, ID_PERSONA) VALUES ('SAMPLESERIAL-".rand(1,999999)."-".rand(1,99)."', 'SAMPLECODE-".rand(1,999999)."-".rand(1,99)."', ".$notienen[$i]['ID'].")";
			$conn->query($sql);
			echo $conn->error;
		}
		$conn->close();
	}

	 function repeatDNI($dni,$con,$table) {
		$sql = "SELECT * FROM $table WHERE DNI ='$dni'"; 
		$result = $con->query($sql);
		if (mysqli_num_rows($result) > 0) {
			return 1;
		} else {
			return 0;
 		}
 	}
	
	function datosAleatorios($num_familias = 10) {
		familiasRandom($num_familias);
		llenarFamiliasVacias();
		carnetsRandom();
	}
	## Codigos de prueba ##
	#datosAleatorios(10);


?>