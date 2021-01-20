<?php
	include_once 'includes/functions.php';
	if (isset($_POST['DNI']) && isset($_POST['TABLE'])){
		echo verifydni();
	}

	function verifydni(){
		return repeatDNI($_POST['DNI'], conexion(), $_POST['TABLE']);
	}

?>