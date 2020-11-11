<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>SINE</title>
	<link rel="stylesheet" href="css/styleshome.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		*{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
  }
  body{
	  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	  color: #3a3a3a;
  }
  header{
	  display: flex;
	  background: #4C9EA3;
  }
  .navbar{
	  padding: 5px 40px;
	  width: 100%;
	  display: inline-flex;
	  justify-content: space-between;
  }
  .navbar ul, header a{
	  display: inline-flex;
	  list-style: none;
	  flex-wrap: wrap;
	  align-items: center;
  }
  .navbar ul li.logo{
	  margin-right: auto;
  }
  .navbar ul li{
	  padding: 4px 0;
	  cursor: pointer;
  }
  .navbar ul li.items{
	  position: relative;
	  width: auto;
	  margin: 0 16px;
	  text-align: center;
	  order: 3;
  }
  .navbar ul li.items::after{
	  position: absolute;
	  content: ' ';
	  left: 0;
	  bottom: -6px;
	  height: 2px;
	  width: 100%;
	  background:  #ccc;
	  opacity: 0;
	  transition: all 0.2s linear;
  }
  .navbar ul li.items:hover:after{
	  opacity: 1;
	  bottom: -2px;
  }
  .navbar img{
	  height: 50px;
  }
.navbar ul li a, header a.btn{
	text-decoration: none;
	color: white;
	font-size: 15px;
	transition: .4s;
}
.navbar ul li:hover a, header a:hover{
	color: #ccc;
}
header a i{
	font-size: 23px;
}
header a.btn{
	position: relative;
	right: 40px;
	top: 25px;
	display: none;
}
header a.btn.hide i:before{
	content: '\f00d';
}
/*Pantallas menores a 900px*/
@media all and (max-width:900px){
	.navbar{
		padding: 5px 30px;
	}
	.navbar.show{
		flex-direction: column;
	}
	.navbar .list.show{
		flex-direction: column;
	}
	.navbar ul li.items{
		width: 100%;
		display: none;
		padding: 10px 0;
	}
	.navbar ul li.items.show{
		display: block;   
	}
	header a.btn{
		display: block;
	}
    .navbar ul li.items:hover{
	  border-radius: 5px;
	  background-color: #45898d;
	}
	.navbar ul li.items:hover:after{
	  opacity: 0;
	}
}
	</style>
</head>
<body>
	<header>
		<nav class="navbar">
			<!--left side-->
			<ul class="list"> 
				<li class="logo"><a href="home.php"><img src="img/logoFina1l.png"></a>
				</li>
				<li class="items"><a href="home.php">Inicio</a></li>
				<li class="items"><a href="statistics.php">Estadisticas</a></li>
				<li class="items"><a href="leaders.php">Lideres y Brigadistas</a></li>
				<li class="items"><a href="#">Nuevo Usuario</a></li>
			</ul>
			<!--right side-->
			<ul class="list">
				<li class="items"><a href="#">Buscar</a></li>
				<li class="items"><a href="exit.php">Cerrar Sesión</a></li>
			</ul>
		</nav>
		<a class="btn" href="#"><i class="fas fa-bars"></i></a>
	</header>
	
