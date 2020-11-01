<?php
	include("includes/local.settings.php");
	include("funciones.php");
	session_start();
	/*if(!isset($_SESSION['id'],$_SESSION['tuser'])){
		if($_SESSION['tuser']!="admin"){header('location:index.php');}
	}*/
	if(isset($_POST['opr'])){//si se ha declarado una operacion
		switch ($_POST['opr']){//caso de operacion
			case "c":break; //crear
			case "e":
/*
EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR 
*/
			if(isset($_POST['tor'])){//tipo de operacion
					switch($_POST['tor']){//caso de tipo de operacion
					
/*
Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre
					*/
					case "li":

							$id="";$tabla="";$campo="";$valor="";
							if(isset($_POST['id'],$_POST['tabla'],$_POST['campo'],$_POST['valor'])){
								if(!empty($_POST['id']) and !empty($_POST['tabla']) and !empty($_POST['campo']) and !empty($_POST['valor'])){
									$id=$_POST['id'];
									$tabla=$_POST['tabla'];
									$campo=$_POST['campo'];
									$valor=$_POST['valor'];
									$query = "UPDATE `$tabla` SET `$campo`='".htmlspecialchars($valor)."' WHERE `id`= $id".""."";
									$result = ejecutarsql($query);
									if($result){
										echo $valor;
									}else{
										echo "error".mysql_error();
									}
								}else{//hay campos vacios
									echo "$valor";
								}
							}else{//hay campos sin delcarar
								echo "$valor";
							}
						
					break;
/*
Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre 
*/					
					}
			}
/*
EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR EDITAR 
*/
			
			break;//editar
			case 'd'://eliminar
/*
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
*/
if(isset($_POST['tor'])){//tipo de operacion
	switch($_POST['tor']){//caso de tipo de operacion
		/*
Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre
					*/
					case "li":
							$id="";$tabla="";
							if(isset($_POST['id'],$_POST['tabla'])){
								if(!empty($_POST['id']) and !empty($_POST['tabla'])){
									$id=$_POST['id'];
									$tabla=$_POST['tabla'];
									
									$query = "DELETE FROM `$tabla` WHERE `id`= $id".""."";
									$result = ejecutarsql($query);
									if($result){
										echo True;
									}else{
										echo mysql_error();
									}
								}else{//hay campos vacios
									echo "hay campos vacios";
								}
							}else{//hay campos sin delcarar
								echo "hay campos si delcarar";
							}
						
					break;
/*
Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre Libre 
*/	
		
	}
}
			 
			 
/*
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR ELIMINAR 
*/
			
			break;//eliminar
		}//fin switch caso operacion
	}else{//si no se a declarado una operacion
		echo"No se ha Delcarado una Operacion";
	}//fin if operacion;
?>