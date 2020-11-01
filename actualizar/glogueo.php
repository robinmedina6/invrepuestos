<?php
session_start();
include("../plano.php");
include("../funciones.php");
if (isset($_SESSION['nombre'])){
	if(isset($_POST['serial'])){
		$serial=$_POST['serial'];
		$fecha = explode('/', $_POST['fecha']);
		$fecha = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];
		$zona=$_SESSION['zona'];
		$usuario=$_POST['usuario'];
		$nombre=$_POST['nombre'];
		$ip=$_POST['ip'];
		$observacion="";
		
		//encontrar la zona de la maquina
		$sql="SELECT * FROM maquina WHERE serial LIKE '$serial' LIMIT 1";
		$rmaq=ejecutarsql($sql);
		if($rmaq){//si se encontro la ip
			$nummaq=mysqli_num_rows($rmaq);
			if($nummaq>0){
				$rowmaq=mysqli_fetch_array($rmaq);
				$id_zona=$rowmaq['id_zona'];
			}else{
				$observacion="sin zona";
				$id_zona='NULL';
			}
		}else{//si no se encontro la ip de datos
			$observacion="No Se encontro maquina";
			$id_zona='NULL';
		}
		//fin econtrar la zona de la maquina
		$sql="SELECT id FROM datos WHERE ip LIKE '$ip' AND id_zona='".$id_zona."' LIMIT 1";
		$rdatos=ejecutarsql($sql);
		if($rdatos){//si se encontro la ip
			$numdatos=mysqli_num_rows($rdatos);
			if($numdatos>0){
				$rowdatos=mysqli_fetch_array($rdatos);
				$id_datos=$rowdatos[0];
			}else{
				$observacion="Sin datos";
				$id_datos='NULL';
			}
		}else{//si no se encontro la ip de datos
			$observacion="No Se encontro ip";
			$id_datos='NULL';
		}
		$sql="SELECT id FROM maquina WHERE serial LIKE '$serial'";
		$rmaquina=ejecutarsql($sql);
		if($rmaquina){//si se encontro la maquina
			$rowmaquina=mysqli_fetch_array($rmaquina);
			$id_maquina=$rowmaquina[0];
		}else{//si no se encontro la ip de datos
			$observacion="sin maquina";
			$id_maquina='NULL';
		}
		$repetido=false;
		$sql="SELECT * FROM logueo WHERE fecha='$fecha' AND id_maquina='$id_maquina'";
		$rlogueo=ejecutarsql($sql);
		if($rlogueo){//si hay resuesta de logueo
			$numlogueo=mysqli_num_rows($rlogueo);
			if($numlogueo>0){
				//si existe logueo
				$repetido=true;
			}else{
				//si no existe logueo
				$repetido=false;
			}
		}else{//si no se encontro logueo
			$repetido=false;
		}
		if($repetido){//si esta repetido
		  echo "<tr><td colspan='5'>"."registro de logueo repetsido"."</td> </tr>";
		  }else{//si no esta repetido
		  $version="";
		  $sql="SELECT l.version FROM logueo AS l WHERE l.id_maquina=".$id_maquina. "  ORDER BY l.fecha DESC LIMIT 1";
		  $rlogueo=ejecutarsql($sql);
			$numlogueo=mysqli_num_rows($rlogueo);
			if($numlogueo>0){
				$rowlogueo=mysqli_fetch_array($rlogueo);
				$version=$rowlogueo['version'];
				}else{
				$version="";
				}
		  

		  $sql="INSERT INTO `logueo`(`id`, `fecha`, `ip`, `usuario`, `nombre`, `version`, `observacion`, `id_datos`, `id_maquina`) VALUES ('','$fecha','$ip','$usuario','$nombre','$version','$observacion',$id_datos,$id_maquina)";
		  $res=ejecutarsql($sql);
		  if($res){
		  echo "<tr><td>".$serial."</td><td>".$fecha."</td><td>".$version."</td><td>".$usuario."</td><td>".$nombre."</td><td>".$ip."</td> </tr>";
		  }else{
		  echo "<tr><td colspan='5'>"."error".$sql."</td> </tr>";
			  }
		  }
	  }
	
	}
?>