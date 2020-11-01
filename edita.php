<?php
session_start();
include("plano.php");
include('funciones.php');



escribir("se envia datos para modificar campo");
$t = explode(" ",microtime());
$time= date("H:i:s",$t[1]).substr((string)$t[0],1,4);
$data=array('el'=>array(),'hora'=>$time);
$msj="";
if(isset($_SESSION['nombre'])){
	if(isset($_POST['idreg'])){
		$idreg=$_POST['idreg'];
		$campo=$_POST['campo'];
		$valor=$_POST['valor'];
		$sql="select * from logueo WHERE id=".$idreg;
		$rta=ejecutarsql($sql);
		if($rta){
			$numrows=mysqli_num_rows($rta);
			if($numrows>0){
				$rowt=mysqli_fetch_array($rta);
				
				 $data['valorant']=$rowt[$campo];
				if($rowt[$campo]!=$valor){
					 
					  $sql="UPDATE logueo SET $campo='".$valor."' WHERE id=".$idreg." ";
					  $data['sql']=$sql;
					  $rta=ejecutarsql($sql);
					  if($rta){
						  $data['vb']=true;
					  }else{$msj="no se edito algun error actualice";}
					}else{$msj="el valor anterior es el mismo a nuevo";}
					
			}else{$msj="sin registros con id";}
		}else{$msj="sin respuesta de registro";}
		
		
	}else{$msj="no hay datos para registrar";}
	
}else{$msj="no hay session activa";}
$data['msj']=$msj;
echo json_encode($data);
?>