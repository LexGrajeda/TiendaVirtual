<?php
	function getCategorias(){
		if(file_exists("protected/config.json")){
			$archivo=file_get_contents("protected/config.json");
			$obj=json_decode($archivo);
			$dbname=$obj->{'db_name'};
			$dbhost=$obj->{'db_host'};
			$dbuser=$obj->{'db_user'};
			$dbpass=$obj->{'db_pass'};
			
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if($conn){
				mysql_select_db($dbname,$conn);
				
				$sql="select * from Catproducto;";
				$query=mysql_query($sql);
				if($query){
					$array=NULL;
					$i=0;
					while($fila=mysql_fetch_row($query)){
						$array[$i][0]=$fila[0];
						$array[$i][1]=$fila[1];
						$i++;
					}
					return $array;
				}
			}
			mysql_close($conn);
		}
		return NULL;
	}
	
	function getProductos($categoria){
		if(file_exists("protected/config.json")){
			$archivo=file_get_contents("protected/config.json");
			$obj=json_decode($archivo);
			$dbname=$obj->{'db_name'};
			$dbhost=$obj->{'db_host'};
			$dbuser=$obj->{'db_user'};
			$dbpass=$obj->{'db_pass'};
				
			$conn=mysql_connect($dbhost,$dbuser,$dbpass);
			if($conn){
				mysql_select_db($dbname,$conn);
				
				$sql="select p.idProducto,p.nombre,m.nombre,p.precio,p.existencias
						from Producto p,Marca m
						where p.marca=m.idMarca and p.tipo=".$categoria." and p.existente=1;";
				$query=mysql_query($sql);
				if($query){
					$array=NULL;
					$i=0;
					while($fila=mysql_fetch_row($query)){
						$array[$i][0]=$fila[0];
						$array[$i][1]=$fila[1];
						$array[$i][2]=$fila[2];
						$array[$i][3]=$fila[3];
						$array[$i][4]=$fila[4];
						$i++;
					}
					return $array;
				}
			}
			mysql_close($conn);
		}
		return NULL;
	}
	
	function addToCart($carro,$producto){
		
	}
?>