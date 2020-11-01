<?php
session_start();
include("plano.php");
escribir("se envia datos para modificar campo");
if(isset($_SESSION['nombre'])){
	if(isset($_POST['opr'])){
		$id=$_POST['id'];
		$campo=$_POST['campo'];
		$valor=$_POST['valor'];
		include('funciones.php');
		$valorant=sqlretstring("SELECT $campo FROM sim WHERE id=$id");
		
		$sql="UPDATE sim SET $campo='$valor' WHERE id=$id";
		$result=ejecutarsql($sql);
		if ($result){
			escribir("se modifica id: ".$id." :campo: ".$campo." :valorant: ".$valorant." :valorn: ".$valor." :SQL: ".$sql);
			echo $valor;
		}
	}
	
}

?>