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
	<h1>Ventas en línea</h1>
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

<form>

  <br /><br /><br><br>
</form>

<?php 
	    $nombre = $_POST['nombre'];
	    $precio = $_POST['precio'];
	    $existencia = $_POST['existencia'];
	    $marca = $_POST['marca'];
	    $categoria = $_POST['categoria'];
	    
	    if($nombre!=NULL && $nombre!="" && $precio!=NULL && $precio!="" && $existencia!=NULL && $existencia!="" && $marca!=NULL && $marca!="" && $categoria!=NULL && $categoria!="")
	    {
	    
	    //ver si ya ha existe el producto 
		$verificacion = "SELECT idProducto, nombre, marca FROM Producto WHERE nombre ='".$nombre."' AND marca =".$marca."";
		$result_verificacion = mysql_query($verificacion) or die ("No se pudo ejecutar la consulta");
		$fila_verificacion = mysql_fetch_array($result_verificacion,MYSQL_NUM);
		$bandera_codigo = $fila_verificacion["0"];
	    
	    if($bandera_codigo!=NULL)
		
	{
		
echo '
<div style="background-color:#eaeaea; width:500px; height:auto; border:1px dashed #333333; margin:0px auto 0px auto; padding:8px 8px 8px 8px;">
<p style="color:#000000; font-size:15px">El producto ya se encuentra registrado.</p>

<div style="clear:both; text-align:center; margin:0px auto; padding:6px 0px 0px 0px;">
&nbsp;
<a id = "btn_nueva_inscripcion" href="crearproducto.php">Crear Nuevo Producto</a></div>	
<p style="color:#000000; font-size:16px">&nbsp;</p<br>
</div>	';
	
	}
	else 
	{
	
	
	
	    
		/*..... INCIAN MIS TRANSACCIONES ...............................*/

	    $sql = "SET AUTOCOMMIT=0;";
	    mysql_query( "BEGIN" );
	    $sql = "START TRANSACTION";
	    
	    
	    
	    $sql_ins_producto = "INSERT INTO Producto (nombre, tipo, marca, existencias, precio, existente)
VALUES ('".$nombre."',".$categoria.",".$marca.",".$existencia.",".$precio.",'1')";
$query = mysql_query($sql_ins_producto);

/*...........INICIA EL IF SI LA TRANSACCION FUE EXITOSA .........*/
	if( $query )
	
		{
			mysql_query( "COMMIT" );
	
		echo '
<div style="background-color:#eaeaea; width:500px; height:auto; border:1px dashed #333333; margin:0px auto 0px auto; padding:8px 8px 8px 8px;">
<p style="color:#000000; font-size:15px">GUARDADO EXITOSAMENTE, DESEA REGISTRAR OTRO PRODUCTO.</p>
<p style="color:#000000; font-size:16px">&nbsp;</p>
<div style="clear:both; text-align:center; margin:0px auto; padding:6px 0px 0px 0px;">
&nbsp;
<a id = "btn_nueva_inscripcion" href="crearproducto.php">NUEVO PRODUCTO</a></div>
<br /> <br />
		<div style="clear:both; text-align:center; margin:0px auto; padding:6px 0px 0px 0px;">
&nbsp;
<a id = "btn_nueva_inscripcion" href="catalogo.php">CANCELAR</a></div><br>
</div>';
		?>


<?php 
	
	

exit();			
	} 
/*.... FINALIZA EL IF SI LA TRANSACCION FUE EXITOSA ..............*/
	
/*.........INICIA ELSE SI LA TRANSACCION FUE FALLIDA ..........*/		
else {
		
			mysql_query( "ROLLBACK" );

echo '
<div style="background-color:#eaeaea; width:500px; height:auto; border:1px dashed #333333; margin:0px auto 0px auto; padding:8px 8px 8px 8px;">
<p style="color:#000000; font-size:15px">A ocurrido un Error al guardar el producto.</p>
<p style="color:#000000; font-size:16px">&nbsp;</p>
</div>';

exit();
}
/*........ FINALIZA ELSE SI LA TRANSACCION FUE FALLIDA ...........*/
	   
	 } // si no existe
	 
	 
	}
	
	else 
	
	{
	
	echo '
<div style="background-color:#eaeaea; width:500px; height:auto; border:1px dashed #333333; margin:0px auto 0px auto; padding:8px 8px 8px 8px;">
<p style="color:#000000; font-size:15px">Se deben ingresar Correctamente todos los Datos, las existencias deben ser mayores de 0.</p>

<div style="clear:both; text-align:center; margin:0px auto; padding:6px 0px 0px 0px;">
&nbsp;
<a id = "btn_nueva_inscripcion" href="crearproducto.php">Crear Nuevo Producto</a></div>	
<p style="color:#000000; font-size:16px">&nbsp;</p<br>
</div>	';
	}
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