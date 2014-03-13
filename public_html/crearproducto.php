<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php 

// CREACION DE PRODUCTO
	/*
	#include "carro.php";
	include "lgc/cat_functions.php";
	session_start();
	$categorias=getCategorias();
	*/
?>

<head>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Catálogo</title>
</head>
<body>

<div id="header">
	<h1>Agregar Productos</h1>
	<br/>
</div>

<div id="menu">
<ul>
	<li><a  href="index.php"><span>Home</span></a></li>
	<li><a class="current" href="#"><span>Catálogo</span></a></li>
	<li><a  href="#"><span>Carrito</span></a></li>

<?php
		
		$DB_HOST = "localhost"; 
$DB_USERNAME = "root"; 
$DB_PASSWORD = "123456"; 
$DB_NAME = "tienda";  

$con = mysql_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD); 
mysql_select_db($DB_NAME, $con) or die('Error en la base de datos, Favor de intentarlo mas tarde.'); 

?>

<?php 
/*
	if(!isset($_SESSION['username'])){
			echo '<li><a href="login.php"><span>Sign in</span></a></li>
			  <li><a href="registro.php"><span>Registrarse</span></a></li>';
	}else{
	*/
		
	//	if (strncmp($_SESSION['username'],"Admin",4)==0)
	//	{
	//	  echo '<li><a><span>'.$_SESSION['nombre'].'</span></a></li><li><a href="logout.php"><span> Logout</span> </a></li>';
		
		
?>
</ul>
</div>

<form action="guardar-producto.php" method="post">

	<br>
    <input type="hidden" value="Usuario" id="pageOperation" name="pageOperation" />
    <br>
    <b style = "position:absolute; top:100px; left:500px;" >Nombre: </b>
    <br>
    <input style = "position:absolute; top:120px; left:500px;" name="nombre" type="text">
    <br>
    <b style = "position:absolute; top:150px; left:500px;" >Precio: </b>
    <br>
    <input style = "position:absolute; top:170px; left:500px;" name="precio" type="text">
    <br>
    <b style = "position:absolute; top:200px; left:500px;" >Existencia: </b>
    <br>
    <input style = "position:absolute; top:220px; left:500px;" name="existencia" type="text" >
    
    <br>
    <b style = "position:absolute; top:250px; left:500px;" >Marca: </b>
    <br>
    <select style = "position:absolute; top:270px; left:500px;" name="marca">    
    <option value="0">Seleccione una marca</option>
    <?php
    	$consulta1 = "select * from Marca;";
		$resultado1 = mysql_query($consulta1) or die ("No se pudo ejecutar la consulta");

				while($row1 = mysql_fetch_array($resultado1))
		  {
		  
		echo"
		<option value=". $row1["0"] .">". $row1["1"] ."</option>";
		
		}
		
    ?>
    </select>
    
    <br>
    <b style = "position:absolute; top:300px; left:500px;" >Categoria: </b>
    <br>
    <select style = "position:absolute; top:320px; left:500px;" name="categoria">
    <option value="0">Seleccione una categoría</option>
    <?php
    	$consulta1 = "select * from Catproducto;";
		$resultado1 = mysql_query($consulta1) or die ("No se pudo ejecutar la consulta");

				while($row1 = mysql_fetch_array($resultado1))
		 {
		  
		echo"
		<option value=". $row1["0"] .">". $row1["1"] ."</option>";
		}
	
    ?>
    </select>
	  <br /><br /><br><br>
	<input style = "position:absolute; left:500px;" type="submit" value="Guardar"/>
</form>

<?php 

	
	$consulta2 = "select p.idProducto,p.nombre,m.nombre,p.precio,p.existencias
						from Producto p,Marca m
						where p.marca=m.idMarca and p.existente>=1;";
						
	$resultado2 = mysql_query($consulta2) or die ("");
	
	echo '<br/ >';
	echo '<br/ >';
	echo '<div align="center" style = "position:absolute; top:430px; left:500px;">';
	echo '<table  bordercolor="#cad6d6" align="center" border=1>';
	echo "<tr bgcolor='#cad6d6' style ='font-size: 15px;'>
		<td height='49' align='center'>No
		</td>
		<td height='49' align='center'>Producto
		</td>
		<td height='49' align='center'>Marca
		</td>
		<td height='49' align='center'>Precio
		</td>
		<td height='49' align='center'>Existencias
		</td>
		<td height='49' align='center'>Modificar
		</td>
		</tr>";
	
	while($row2 = mysql_fetch_array($resultado2))
		  {
		 echo '<tr style ="font-size: 15px;">';
			echo '<td align="center">'.$row2["0"].'</td>';
			echo '<td align="center">'.$row2["1"].'</td>';
			echo '<td align="center">'.$row2["2"].'</td>';
			echo '<td align="center">'.$row2["3"].'</td>';
			echo '<td align="center">'.$row2["4"].'</td>';
			echo '<td align="center"><a href="lgc/addToCart.php?id='.$row2["0"].'">Modificar(+)</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		echo ' <br><br>';
		echo '</div>';
		  
		  
	/*					
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
	*/
	
/*	}
	      else 
	      {
	      echo 'Usted no tiene permisos para poder agregar productos';
	      }
	*/      
	
//	}
	?>

</body>

</html>