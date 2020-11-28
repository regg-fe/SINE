<?php
	$ubch = "CEIS Simón Bolívar";
	$comunidad = "URB. Velita 1";
	$cc= "Nuestro Esfuerzo";
	$clap = "Lcda. Franco Farias";
	$version = "Version 0.15-111120";
	
	$conexion = new mysqli("localhost", "root", "", "nedb");
		if ($conexion->connect_errno){
			die("Error 404 ".$conexion->error);
		}
?>