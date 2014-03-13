<?php
include "cat_functions.php";
session_start();
if(isset($_GET["id"])){
	if(file_exists("../protected/config.json")){
		$archivo=file_get_contents("../protected/config.json");
		$obj=json_decode($archivo);
		$dbname=$obj->{'db_name'};
		$dbhost=$obj->{'db_host'};
		$dbuser=$obj->{'db_user'};
		$dbpass=$obj->{'db_pass'};
	
		$conn=mysql_connect($dbhost,$dbuser,$dbpass);
		if($conn){
			mysql_select_db($dbname,$conn);
			
			$query="select nombre from Producto where idProducto=".$_GET["id"].";";
			$query=mysql_query($query);
			if($query){
				$producto[0]=$_GET["id"];
				$producto[1]=mysql_fetch_row($query)[0];
				if(isset($_SESSION["carro"])){
					addToCart($_SESSION["carro"],$producto);
				}
			}
		}
		mysql_close($conn);
	}
}
header("Location:../catalogo.php");
//echo '<script>location.href="../catalogo.php";';
?>