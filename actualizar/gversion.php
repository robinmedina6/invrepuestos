<?php
session_start();
include("../plano.php");
include("../funciones.php");
if (isset($_SESSION['nombre'])){
	if(isset($_POST['serial'])){
		$serial=$_POST['serial'];
		$version="";
		$version=$_POST['version'];
		$fecha =  $_POST['fecha'];
		$idlog=$_POST['idlog'];
		$sql="SELECT * FROM logueo AS l WHERE l.id='".$idlog."' ORDER BY l.fecha DESC LIMIT 1";
		$rmaquina=ejecutarsql($sql);
		if($rmaquina){//si se encontro la ip
			$rowlogueo=mysqli_fetch_array($rmaquina);
			$id_logueo=$rowlogueo[0];
		}else{//si no se encontro la ip de datos
			$observacion="sin maquina";
			$id_logueo='NULL';
		}
		$sql="UPDATE logueo SET version='$version' WHERE id=$id_logueo ";
		$rta=ejecutarsql($sql);
		echo "<tr><td colspan='2'>$sql</td></tr>";
		echo "<tr><td>$serial</td><td>$version</td></tr>" ;
		
		  
	  }
	
	}
?>