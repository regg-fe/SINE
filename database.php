<?php
	$ubch = "CEIS Simón Bolívar";
	$comunidad = "UBR. Velita 1";
	$cc= "Nuestro Esfuerzo";
	$clap = "Lida Franco Farias";
	$version = "Version 0.15-031120";
	
	$conexion = new mysqli("localhost", "root", "", "nedb");
		if ($conexion->connect_errno){
			die("Error 404 ".$conexion->error);
		}
?>