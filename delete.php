<?php  
	session_start();
	include_once 'includes/database.php';
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}

	$op = $_GET['op'];
	if (empty($op)) {
		header('Location:home.php');
	}

	$id = $_GET['id'];
	if (empty($id)) {
		header('Location:home.php');
	}
	switch ($op) {
		case 1: //LIDERES
			$sql = "DELETE FROM lider WHERE ID = '$id'";
			$result = $conexion->query($sql);	
			if(!$result) {
				die("Delete Error".mysqli_error($conexion));
			} else {
				header('Location:leaders.php');
			}
		break;

		case 2: //BRIGADISTAS
			$sql = "DELETE FROM brigadista WHERE ID = '$id'";
			$result = $conexion->query($sql);	
			if(!$result) {
				die("Delete Error".mysqli_error($conexion));
			} else {
				header('Location:leaders.php');
			}
		break;
		
		default:
			header('Location:leaders.php');
		break;
	}

?>