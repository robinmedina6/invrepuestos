<table border="1">
<?php
session_start();
date_default_timezone_set('America/Bogota');
include("../../plano.php");
include("../../funciones.php");


$urlfile=$_GET['url'];

//incluimos la libreria excel

require_once("../../PHPExcel-1.8/Classes/PHPExcel.php");


//instanciemos el objeto
$objPHPExcel=PHPExcel_IOFactory::load("$urlfile");

$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


foreach($objHoja as $Indice => $objFila){
	$ideq=$objFila['C'];
	if($ideq>0){
		$fnideq=$ideq;
		$fnserial="";
		$fnfecha=substr($objFila['O'],0,10);
		$fnzona="";
		$fnusuario=$objFila['L'];
		$fnnombre=$objFila['M'];
		$fnip=$objFila['S'];
		$fnsim=$objFila['R'];
		$fnversion=$objFila['H'];
		$fnfh=$objFila['O'];
		$fnobservacion="";
		if($fnfecha==""  OR $fnusuario==""){echo "campos vacios<br>";}else{
		 crear_logueo($ideq,$fnserial,$fnfecha,$fnzona,$fnusuario,$fnnombre,$fnip,$fnsim,$fnversion,$fnobservacion);
		}
		}else{
		
		}
	}
			echo "Total Analizadas:$Indice";
	



function crear_logueo($fnideq,$fnserial,$fnfecha,$fnzona,$fnusuario,$fnnombre,$fnip,$fnsim,$fnversion,$fnobservacion){
			$ideq=$fnideq;
			$serial=$fnserial;
			$fecha =$fnfecha;
			$zona=$fnzona;
			$usuario=$fnusuario;
			$nombre=$fnnombre;
			$ip=$fnip;
			$sim=substr(preg_replace('/[^0-9]+/', '', $fnsim),0,19);
			$version=$fnversion;
			$observacion=$fnobservacion;
			
			//encontrar la zona de la maquina
			$sql="SELECT * FROM maquina WHERE ideq=$ideq LIMIT 1";
			$rmaq=ejecutarsql($sql);
			if($rmaq){//si se encontro la ip
				$nummaq=mysqli_num_rows($rmaq);
				if($nummaq>0){
					$rowmaq=mysqli_fetch_array($rmaq);
					$id_maquina=$rowmaq['id'];
					$serial=$rowmaq['serial'];
					$id_zona=$rowmaq['id_zona'];
				
					  //fin econtrar la zona de la maquina
					  $sql="SELECT id FROM datos WHERE imei LIKE '%$sim%' AND id_zona='".$id_zona."' LIMIT 1";
					  $rdatos=ejecutarsql($sql);
					  if($rdatos){//si se encontro la ip
							$numdatos=mysqli_num_rows($rdatos);
						  if($numdatos>0){
							  $rowdatos=mysqli_fetch_array($rdatos);
							  $id_datos=$rowdatos[0];
						  }else{
							  $observacion="$sim";
							  $id_datos='NULL';
						  }
					  }else{//si no se encontro la ip de datos
						  $observacion="No Se encontro ip";
						  $id_datos='NULL';
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
						  
			  
						$sql="INSERT INTO `logueo`(`id`, `fecha`, `ip`, `usuario`, `nombre`, `version`, `observacion`, `id_datos`, `id_maquina`) VALUES ('','$fecha','$sim','$usuario','$nombre','$version','$observacion',$id_datos,$id_maquina)";
						$res=ejecutarsql($sql);
						if($res){
						echo "<tr><td>".$ideq."</td><td>".$serial."</td><td>".$fecha."</td><td>".$version."</td><td>".$usuario."</td><td>".$nombre."</td><td>".$ip."</td> <td>".$id_datos."</td><td>".$id_maquina."</td></tr>";
						echo "<tr><td colspan='9'>"."".$sql."</td> </tr>";
						}else{
						echo "<tr><td colspan='9'>"."error".$sql."</td> </tr>";
						  }
					  }  
				
				
				}else{//no se econtro maquina
						  $observacion="No Se encontro maquina";
						  $id_zona='NULL';
				}
			}else{
				$observacion="sin zona";
				$id_zona='NULL';
			}
		}
	?>
	</table>