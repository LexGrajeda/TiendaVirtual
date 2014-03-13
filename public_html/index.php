<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"><head>

<link rel="stylesheet" href="css/main.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Home</title>
</head>
<body>
<div id="header">
	<h1>Ventas en línea</h1>
	<br/>
</div>

<div id="menu">
<ul>	
<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		echo '<li><a href="login.php"><span>Login</span></a></li>
			  <li><a href="registro.php"><span>Registrarse</span></a></li>';
	}else{
		echo '<li><a><span>'.$_SESSION['nombre'].'</span></a></li><li><a href="logout.php"><span> Logout</span> </a></li>';
	}
?>
	<li><a class="current" href="#"><span>Home</span></a></li>
	<li><a  href="catalogo.php"><span>Catálogo</span></a></li>
	<li><a  href="carro-de-compras.php"><span>Carrito</span></a></li>
</ul>
</div>
<br>
	<div id="contenido">
		<center>
		<h1>
			Bienvenido a éste sistema de ventas en línea <br>Seleccione una de las opciones en nuestro menú
		</h1>
	</center>
		
	</div>

</body>
</html>