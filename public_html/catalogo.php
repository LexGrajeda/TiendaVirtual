<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php 
	#include "carro.php";
	include "lgc/cat_functions.php";
	session_start();
	$categorias=getCategorias();
?>

<head>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Catálogo</title>
</head>
<body>

<div id="header">
	<h1>Ventas en línea</h1>
	<br/>
</div>

<div id="menu">
<ul>
	<li><a  href="index.php"><span>Home</span></a></li>
	<li><a class="current" href="#"><span>Catálogo</span></a></li>
	<li><a  href="#"><span>Carrito</span></a></li>
	
<?php 
	if(!isset($_SESSION['username'])){
		echo '<li><a href="login.php"><span>Sign in</span></a></li>
			  <li><a href="registro.php"><span>Registrarse</span></a></li>';
	}else{
		echo '<li><a><span>'.$_SESSION['nombre'].'</span></a></li><li><a href="logout.php"><span> Logout</span> </a></li>';
	
	}
?>
</ul>
</div>

<form action="catalogo.php" method="post">
	<select name="seleccion">
		<option value="0">Seleccione una categoría</option>
		<?php 
			if($categorias!=NULL){
				foreach ($categorias as $valor){
					echo '<option value="'.$valor[0].'">'.$valor[1].'</option>';
				}
			}
		?>
	</select>
	<input type="submit" value="Seleccionar"/>
</form>

<?php 
	if(isset($_POST['seleccion'])){
		$_SESSION['categoria']=$_POST['seleccion'];
	}
	if(isset($_SESSION['categoria'])){
		$productos=getProductos($_SESSION['categoria']);
		echo '<table border=1>';
		foreach ($productos as $prod){
			echo '<tr>';
			echo '<td>'.$prod[0].'</td>';
			echo '<td>'.$prod[1].'</td>';
			echo '<td>'.$prod[2].'</td>';
			echo '<td>'.$prod[3].'</td>';
			echo '<td>'.$prod[4].'</td>';
			echo '<td><a href="lgc/addToCart.php?id='.$prod[0].'">ADD(+)</a></td>';
			echo '</tr>';
		}
		echo '</table>';
	}
?>

</body>

</html>