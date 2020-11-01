<?php
session_start();
include("plano.php");
include("funciones.php");
if (isset($_SESSION['nombre'])){
if(isset($_POST['tabla'])){
	$tabla=$_POST['tabla'];
	$campo=$_POST['campo'];
	$id=$_POST['id'];
	$valor=$_POST['rsto'];
	if($id==""){echo "no se  Guardo Recargue"; escribir("no se guardo $tabla:$campo:$id:$valor");}else{
	$sql="UPDATE $tabla SET $campo='$valor' WHERE id=$id";
	$res=ejecutarsql($sql);
	$sql="SELECT $campo FROM $tabla WHERE id=$id";
	$res=ejecutarsql($sql);
	$row=mysqli_fetch_array($res);
	 escribir("se edito $tabla:$campo:$id:$valor");
	echo $row["$campo"];
	}
	}	
	
}
?>