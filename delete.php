<?php  
	session_start();
	include_once 'includes/functions.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
	$con = conexion();
	$op = $con->real_escape_string($_GET['op']);
	if (empty($op)) {
		header('Location:home.php');
	}
	$id = $con->real_escape_string($_GET['id']);
	if (empty($id)) {
		header('Location:home.php');
	}

	
	switch ($op) {
		case 1: //LIDERES
			$sql = "DELETE FROM LIDER WHERE ID = '$id'";
			$result = $con->query($sql);
			if(!$result) {
				die("Delete Error".mysqli_error($con));
			} else {
				header('Location:leaders.php');
			}
		break;

		case 2: //BRIGADISTAS
			$sql = "DELETE FROM BRIGADISTA WHERE ID = '$id'";
			$result = $con->query($sql);	
			if(!$result) {
				die("Delete Error".mysqli_error($con));
			} else {
				header('Location:leaders.php');
			}
		break;

		case 3: //PERSONAS
			$f = $con->real_escape_string($_GET['f']);
			if (empty($f)) {
				header('Location:home.php');
			}
			$sql = "DELETE FROM PERSONA WHERE ID = '$id'";
			$result = $con->query($sql);	
			if(!$result) {
				die("Delete Error".mysqli_error($con));
			} else {
				header('Location:afamily.php?id='.$f);
			}
		break;

		case 4: //FAMILIAS
			$a = $con->real_escape_string($_GET['a']);
			if (empty($a)) {
				header('Location:home.php');
			}
			$sql = "DELETE FROM FAMILIA WHERE ID = '$id'";
			$result = $con->query($sql);	
			if(!$result) {
				die("Delete Error".mysqli_error($con));
			} else {
				header('Location:families.php?id='.$a);
			}
		break;

		case 5: //BENEFICIOS
			$f = $con->real_escape_string($_GET['f']);
			if (empty($f)) {
				header("'Location:home.php");
			}
			$sql = "DELETE FROM BENEFICIO WHERE ID = '$id'";
			$result = $con->query($sql);
			if(!$result) {
				die("Delete Error".mysqli_error($con));
			} else {
				header('Location:afamily.php?id='.$f);
			}
		break;

		case 6: //BOMBONAS
			$f = $con->real_escape_string($_GET['f']);
			if (empty($f)) {
				header("'Location:home.php");
			}
			$sql = "DELETE FROM BOMBONA WHERE ID = '$id'";
			$result = $con->query($sql);
			if(!$result) {
				die("Delete Error".mysqli_error($con));
			} else {
				header('Location:afamily.php?id='.$f);
			}
		break;

		case 7: //USUARIOS
			$sql = "DELETE FROM USUARIO WHERE ID = '$id'";
			$result = $con->query($sql);
			if(!$result) {
				die("Delete Error".mysqli_error($con));
			} else {
				header('Location:user.php');
			}
		break;
		
		default:
			header('Location:home.php');
		break;
	}
?>