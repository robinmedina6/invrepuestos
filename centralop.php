<?php
session_start();
include("includes/local.settings.php");
include("funciones.php");
 $db_host = 'localhost';

 

if(isset($_REQUEST['opr'])){//si se ha declarado una operacion
		switch ($_REQUEST['opr']){//caso de operacion
			case "consulta":
			$query="";
				  if(isset($_POST['tabla']) and !empty($_POST['tabla'])){
					$query="SELECT ";
						if(isset($_POST['campos']) and !empty($_POST['campos'])){
						   foreach($_POST['campos'] as $campo){
							   $query=$query."$campo, ";
						   }
						   if(stripos($query,"id,")==false){
						   $query=str_replace("SELECT ","SELECT id, ",$query);
						   }
						   $query=substr($query,0,strlen($query)-2);
						   $query=$query." ";
					  }else{//si no hay campos
						$query=$query."* ";
					  }//haya o no campos
					  $tabla=$_POST['tabla'];
					  $query=$query."FROM $tabla ";
					  if(isset($_POST['campo']) and !empty($_POST['campo'])){
						  $campo=$_POST['campo'];
						  $query=$query."WHERE $campo ";
						  if(isset($_POST['valor'])  and !empty($_POST['valor'])){
							  $valor=$_POST['valor'];
							  $query=$query."LIKE '%$valor%' ";
						  }else{//si no hay valor
						  }
					  }else{//si no hay Campo
					  }//haya o no campo
					  if(isset($_POST['ordpor'])  and !empty($_POST['ordpor'])){
									$ordpor=$_POST['ordpor'];
									$query=$query."ORDER BY $ordpor ";
										if(isset($_POST['orden'])  and !empty($_POST['orden'])){
										  $orden=$_POST['orden'];
										  $query=$query."$orden ";
										}else{
										}
						}else{}
					  if(isset($_POST['limite'])  and !empty($_POST['limite'])){
											$limite=$_POST['limite'];
											$query=$query."LIMIT $limite ";
					  }else{
						
					  }
					  if(isset($_POST['pag'])  and !empty($_POST['pag'])){
											$pag=$_POST['pag'];
					  }else{
											$pag=1;
					  }
					  
					
						$result=ejecutarsql($query);
						$num_rows = mysqli_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;
							$numcampos=mysqli_num_fields($result);
							
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysqli_fetch_field($result);
							$info['campos'][$i]=$infcampos;
							
							}
							$cnt=0;
							
							while($row= mysqli_fetch_array($result)){
								if($cnt>=($pag*10)-10 and $cnt<($pag*10)){
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									//lee los campos y les quita los caracteres especiales los converte
									foreach ($row as $key => $val) {
									  $row[$key] = utf8_encode($val);
									}
									$info['elementos'][]=$row;
									
									for($i=0;$i<$numcampos;$i++){
									//	$info['elementos'][][$i]=$row[$i];	
									
									}
								}
								$cnt++;
							}
							//echo htmlentities((print_r($info));
							
							echo json_encode($info);
							//echo "robinson";
							//$string =json_encode($info, JSON_UNESCAPED_UNICODE) ;
							//echo $string; 
							//echo $decoded = html_entity_decode( $string );
						}
				}else{
					echo "no se Declaro una Tabla";
				}
					
			break;
			case "t":	//caso de operacion crear
				if(isset($_REQUEST['tor'])){//tipo de operacion
					switch($_REQUEST['tor']){//caso de tipo de operacion
						case "t"://caso toperacion programa
							
											$query = "SHOW TABLES";
											$result = ejecutarsql($query);
											$num_rows = mysqli_num_rows($result);
											if ($num_rows > 0) {
												$tablas = array('tablas' => array());
												while($row= mysqli_fetch_array($result)){
													$tablas['tablas'][] = array('nombre'=> $row['0']);
												}
												echo json_encode($tablas); 
											}
						break;
						case "camp"://caso toperacion campos
						 if(isset($_POST['camsel'])and!empty($_POST['camsel'])){
							
											$query = "DESCRIBE ".$_POST['camsel']."";
											$result = ejecutarsql($query);
											$num_rows = mysqli_num_rows($result);
											if ($num_rows > 0) {
												$tablas = array('campos' => array());
												while($row= mysqli_fetch_array($result)){
													$tablas['campos'][] = array('nombre'=> $row['0']);
												}
												echo json_encode($tablas); 
											}
						 }else{echo 'no se declaro una talba';}
						break;
					}
                }
				break;
				case "consfechas"://consultar por fechas y consolidado  
				
					$query="";
				  if(isset($_POST['tabla']) and !empty($_POST['tabla'])){
					$query="SELECT ";
						if(isset($_POST['campos']) and !empty($_POST['campos'])){
						   foreach($_POST['campos'] as $campo){
							   $query=$query."$campo, ";
						   }
						   if(stripos($query,"id,")==false){
						   $query=str_replace("SELECT ","SELECT id, ",$query);
						   }
						   $query=substr($query,0,strlen($query)-2);
						   $query=$query." ";
					  }else{//si no hay campos
						$query=$query."* ";
					  }//haya o no campos
					  $tabla=$_POST['tabla'];
					  $query=$query."FROM $tabla ";
					  if(isset($_POST['campo']) and !empty($_POST['campo'])){
						  $campo=$_POST['campo'];
						  $query=$query."WHERE $campo ";
						  if(isset($_POST['valor'])  and !empty($_POST['valor'])){
							  $valor=$_POST['valor'];
							  $query=$query."LIKE '%$valor%' ";
						  }else{//si no hay valor
						  }
						$query=$query. " AND ";
					  }else{//si no hay Campo
						$query=$query. " WHERE ";
					  }//haya o no campo
					  if(isset($_POST['finicio'],$_POST['ffinal'])){
							  $finicio=$_POST['finicio'];
							  $ffinal=$_POST['ffinal'];
							  $query=$query." `fecha` BETWEEN '$finicio'  AND '$ffinal'";
						  }
						 
					  if(isset($_POST['ordpor'])  and !empty($_POST['ordpor'])){
									$ordpor=$_POST['ordpor'];
									$query=$query."ORDER BY $ordpor ";
										if(isset($_POST['orden'])  and !empty($_POST['orden'])){
										  $orden=$_POST['orden'];
										  $query=$query."$orden ";
										}else{
										}
						}else{}
					  if(isset($_POST['limite'])  and !empty($_POST['limite'])){
											$limite=$_POST['limite'];
											$query=$query."LIMIT $limite ";
					  }else{
						
					  }
					  if(isset($_POST['pag'])  and !empty($_POST['pag'])){
											$pag=$_POST['pag'];
					  }else{
											$pag=1;
					  }
						$result = ejecutarsql($query);
						$num_rows = mysqli_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/100)+1;
							$info['pag']['pact']=$pag;
							$valtotal=0;//es para sumar el consolidado
							$numfacts=0;//es el numero total de facturas
							$numcampos=mysqli_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysqli_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							$cnt=0;
							while($row= mysqli_fetch_array($result)){
								if($cnt>=($pag*100)-100 and $cnt<($pag*100)){
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									$info['elementos'][]=$row;
									$valtotal=$valtotal+$row['valtotal'];
									$numfacts++;
									for($i=0;$i<$numcampos;$i++){
									//	$info['elementos'][][$i]=$row[$i];	
									}
								}
								$cnt++;
							}
							$info['consolidado']['valtotal']=$valtotal;
							$info['consolidado']['numfacts']=$numfacts;
							echo json_encode($info);
						}
				}else{
					echo "no se Declaro una Tabla";
				}
					
				
				break;
				
				
				
				case "crear-remision-rpto":
				      $info['msj']="";
					  $info['error']=0;
					  if(isset($_POST['fremision']) and isset($_POST['observacion']) and isset($_POST['zona'])){
					  $frm_id_remision=generarid("remisionrpto");	
					  $frm_fremision=$_POST['fremision'];
					  $frm_observacion=$_POST['observacion'];
					  $frm_observacion=$_POST['observacion'];
					  $frm_r_auto="";
					  $frm_r_confrec="";
					  $frm_fcreacion=date("Y-m-d H:i:s");
					  $frm_narchivo=date("Y-m-d-H-i-s");
					  
						if ($_FILES['autorizacion']["error"] > 0){
							//no se ha cargado		  
						}else{
							$ext_auto = ".".@end(explode(".", $_FILES['autorizacion']['name']));
							$frm_r_auto="documentos/rmaut$frm_id_remision"."_".$frm_narchivo.$ext_auto;
							move_uploaded_file($_FILES['autorizacion']['tmp_name'],$frm_r_auto);
						}
						if ($_FILES['confrecibido']["error"] > 0){
							//no se ha cargado
						}else{
							$ext_confr = ".".@end(explode(".", $_FILES['confrecibido']['name']));
							$frm_r_confrec="documentos/rmcon$frm_id_remision"."_".$frm_narchivo.$ext_confr;
							move_uploaded_file($_FILES['confrecibido']['tmp_name'],$frm_r_confrec);
						}
					  
					  $frm_zona=$_POST['zona'];
					  
					  
					  
					  $sql_rm="INSERT INTO `remisionrpto`(`id`,`fremision`, `observacion`, `autorizacion`, `confrecibido`, `fcreacion`, `zona`) VALUES ('$frm_id_remision','$frm_fremision','$frm_observacion','$frm_r_auto','$frm_r_confrec','".$frm_fcreacion."','$frm_zona')";
					  $rsteje=ejecutarsql($sql_rm);
					  if(!$rsteje){$info['msj']=$info['msj']."no se pudo crear la remision sql";$info['error']++;}else{}
						  if (isset($_POST['id_repuesto']) and isset($_POST['cnt_repuesto']) and  isset($_POST['obs_repuesto'])){
							  $frm_id_repuesto=$_POST['id_repuesto'];
							  $frm_cantidad=$_POST['cnt_repuesto'];
							  $frm_obs_repuesto=$_POST['obs_repuesto'];
							  $cntri=0;
							  $countrpto=count($frm_id_repuesto);
							  foreach ($frm_id_repuesto as $key => $vlr_id_repuesto){
								  $cnt_rpto=$frm_cantidad[$key];
								  $obs_rpto=$frm_obs_repuesto[$key];
								  $sql_rpt="INSERT INTO `detalle_remisionrpto`(`id_repuesto`, `id_remision`, `cantidad`, `observacion`, `extra`) VALUES ('$vlr_id_repuesto','$frm_id_remision','$cnt_rpto','$obs_rpto','')";
								  //$sql_rrpt ="select * from repuesto";
								  $sql_rrpt="UPDATE `repuesto` SET `cantidad` = (`cantidad`-$cnt_rpto) ,`salida` = (`salida` + $cnt_rpto) WHERE id=$vlr_id_repuesto";
								  $rstrpt=ejecutarsql($sql_rpt);
								  $rstrrpt=ejecutarsql($sql_rrpt);
								  if(!$rstrpt){$info['msj']=$info['msj']." no se pudo insertar repuesto";$info['error']++;}else{
									  if(!$rstrrpt){$info['msj']=$info['msj']." no se pudo actualizar cnt repuesto";$info['error']++;}else{
										  $cntri++;
									  }
								  }
							  }
						  }else{$info['msj']=$info['msj']."no se cargaron repuestos"; $info['error']++;}
						  
					  }else{$info['msj']=$info['msj'].="no hay datos para insertar"; $info['error']++;}
					  	if($cntri==$countrpto){$info['msj']="remision exitosa";$info['idremi']=$frm_id_remision;}else{
							$info['msj']="ocurrio un error";$info['error']++;
						}
						echo json_encode($info);
				break;
				
				
				
				
				
				
				
				
				
				
				
				case "eliminarremisionrpto":
				      $info['msj']="";
					  $info['error']=0;
					  if(isset($_POST['idremision'])){	
						  $idremision=$_POST['idremision'];
							  
						  
						  $sql_rm="select * from remisionrpto where id=".$idremision;
						  $rsteje=ejecutarsql($sql_rm);
						  $num_rows=mysqli_num_rows($rsteje);
						  if($num_rows>0){
							$rowsql= mysqli_fetch_array($rsteje);
							if ($rowsql['id']==$idremision and $rowsql['zona']!="ELIMINADA"){
								  $sqlbsr="SELECT * FROM detalle_remisionrpto where id_remision=".$idremision;
								  $rstbsr=ejecutarsql($sqlbsr);
								  $num_rowsbsr=mysqli_num_rows($rstbsr);
								  $cntci=0;
								   while ($rowbsr= mysqli_fetch_array($rstbsr)){
									 $id_detalle=$rowbsr['id'];
									 $cantidad=$rowbsr['cantidad'];
									 $id_repuesto=$rowbsr['id_repuesto'];
									 $sqlur="UPDATE `repuesto` SET `cantidad` = (`cantidad`+$cantidad) ,`salida` = (`salida` - $cantidad) WHERE id=$id_repuesto";
									 $sqludr="UPDATE `detalle_remisionrpto` SET observacion = 'ELIMINADO' WHERE id=".$id_detalle;
									 $rstur=ejecutarsql($sqlur);
									  $rstudr=ejecutarsql($sqludr);
									  if(!$sqludr){$info['msj']=$info['msj']." no se pudo Eliminar el detalle repuesto";$info['error']++;}else{
										  if(!$sqlur){$info['msj']=$info['msj']." no se pudo actualizar cnt repuesto";$info['error']++;}else{
											  $cntci++;
										  }
									  } 
								   }
								   if ($num_rowsbsr==$cntci){
										$sqlurm="UPDATE `remisionrpto` SET zona='ELIMINADA' WHERE id=".$idremision;
										$rsturm=ejecutarsql($sqlurm);
										if($rsturm){$info['msj'].="Se pudo Eliminar / actualizar la rem";$info['idremi']=$idremision;}else{$info['msj'].="nos se pudo eliminar la rem";$info['error']++;}
									   }else{$info['msj'].="no se inserto la misma cantidad de rpto encontr";$info['error']++;}
							}else{$info['msj'].="nos es la misma remision o esta eliminada";$info['error']++;}	  
						  }else{$info['msj'].="no se encuentra la remision";$info['error']++;}
							
						
					}else{$info['msj'].="no llego el id de remision";$info['error']++;}
						echo json_encode($info);
				break;
				
				
				
				
				
				
				
				
				
				
				case "crear-repuesto":
				      $info['msj']="";
					  $info['error']=0;
					  if(isset($_POST['refaccess']) and isset($_POST['nombre']) and isset($_POST['cantidad'])and isset($_POST['entrada']) and isset($_POST['salida']) and isset($_POST['observacion']) and isset($_POST['fcreacion'])){
						  $frm_iddb=generarid("repuesto");	
						  $frm_refaccess=$_POST['refaccess'];
						  $frm_nombre=$_POST['nombre'];
						  $frm_cantidad=$_POST['cantidad'];
						  $frm_salida=$_POST['salida'];
						  $frm_observacion=$_POST['observacion'];
						  $frm_entrada=$_POST['entrada'];
						  $frm_fcreacion=date("Y-m-d H:i:s");
						  
							
						  
						  $sql_rm="INSERT INTO `repuesto`(`id`, `refaccess`, `nombre`, `cantidad`, `salida`, `entrada`, `observacion`, `fcreacion`) VALUES ($frm_iddb,'$frm_refaccess','$frm_nombre',$frm_cantidad,$frm_salida,$frm_entrada,'$frm_observacion','$frm_fcreacion')";
						  $rsteje=ejecutarsql($sql_rm);
						  if(!$rsteje){$info['msj'].="No se pudo insertar el repuesto";$info['error']++;}else{
							  $info['msj']="insert exitosa";$info['idrep']=$frm_iddb;
							}
					  }else{$info['msj']=$info['msj'].="no hay datos para insertar"; $info['error']++;}
					  	
						echo json_encode($info);
				break;
				
				
				
				
				
				case "crear-ingreso-rpto":
				      $info['msj']="";
					  $info['error']=0;
					  if(isset($_POST['fingreso']) and isset($_POST['observacion']) and isset($_POST['zona'])){
					  $frm_id_ingreso=generarid("ingresorpto");	
					  $frm_fingreso=$_POST['fingreso'];
					  $frm_observacion=$_POST['observacion'];
					  $frm_observacion=$_POST['observacion'];
					  $frm_r_auto="";
					  $frm_r_confrec="";
					  $frm_fcreacion=date("Y-m-d H:i:s");
					  $frm_narchivo=date("Y-m-d-H-i-s");
					  
						if ($_FILES['autorizacion']["error"] > 0){
							//no se ha cargado		  
						}else{
							$ext_auto = ".".@end(explode(".", $_FILES['autorizacion']['name']));
							$frm_r_auto="documentos/rmaut$frm_id_ingreso"."_".$frm_narchivo.$ext_auto;
							move_uploaded_file($_FILES['autorizacion']['tmp_name'],$frm_r_auto);
						}
						if ($_FILES['confrecibido']["error"] > 0){
							//no se ha cargado
						}else{
							$ext_confr = ".".@end(explode(".", $_FILES['confrecibido']['name']));
							$frm_r_confrec="documentos/rmcon$frm_id_ingreso"."_".$frm_narchivo.$ext_confr;
							move_uploaded_file($_FILES['confrecibido']['tmp_name'],$frm_r_confrec);
						}
					  
					  $frm_zona=$_POST['zona'];
					  
					  
					  
					  $sql_rm="INSERT INTO `ingresorpto`(`id`,`fingreso`, `observacion`, `autorizacion`, `confrecibido`, `fcreacion`, `zona`) VALUES ('$frm_id_ingreso','$frm_fingreso','$frm_observacion','$frm_r_auto','$frm_r_confrec','".$frm_fcreacion."','$frm_zona')";
					  $rsteje=ejecutarsql($sql_rm);
					  if(!$rsteje){$info['msj']=$info['msj']."no se pudo crear la ingreso sql";$info['error']++;}else{}
						  if (isset($_POST['id_repuesto']) and isset($_POST['cnt_repuesto']) and  isset($_POST['obs_repuesto'])){
							  $frm_id_repuesto=$_POST['id_repuesto'];
							  $frm_cantidad=$_POST['cnt_repuesto'];
							  $frm_obs_repuesto=$_POST['obs_repuesto'];
							  $cntri=0;
							  $countrpto=count($frm_id_repuesto);
							  foreach ($frm_id_repuesto as $key => $vlr_id_repuesto){
								  $cnt_rpto=$frm_cantidad[$key];
								  $obs_rpto=$frm_obs_repuesto[$key];
								  $sql_rpt="INSERT INTO `detalle_ingresorpto`(`id_repuesto`, `id_ingreso`, `cantidad`, `observacion`, `extra`) VALUES ('$vlr_id_repuesto','$frm_id_ingreso','$cnt_rpto','$obs_rpto','')";
								  //$sql_rrpt ="select * from repuesto";
								  $sql_rrpt="UPDATE `repuesto` SET `cantidad` = (`cantidad`+$cnt_rpto) ,`entrada` = (`entrada` + $cnt_rpto) WHERE id=$vlr_id_repuesto";
								  $rstrpt=ejecutarsql($sql_rpt);
								  $rstrrpt=ejecutarsql($sql_rrpt);
								  if(!$rstrpt){$info['msj']=$info['msj']." no se pudo insertar repuesto";$info['error']++;}else{
									  if(!$rstrrpt){$info['msj']=$info['msj']." no se pudo actualizar cnt repuesto";$info['error']++;}else{
										  $cntri++;
									  }
								  }
							  }
						  }else{$info['msj']=$info['msj']."no se cargaron repuestos"; $info['error']++;}
						  
					  }else{$info['msj']=$info['msj'].="no hay datos para insertar"; $info['error']++;}
					  	if($cntri==$countrpto){$info['msj']="ingreso exitosa";$info['idremi']=$frm_id_ingreso;}else{
							$info['msj']="ocurrio un error";$info['error']++;
						}
						echo json_encode($info);
				break;
				
				
				
				
				
				
				
				
				
				
				
				case "eliminaringresorpto":
				      $info['msj']="";
					  $info['error']=0;
					  if(isset($_POST['idingreso'])){	
						  $idingreso=$_POST['idingreso'];
							  
						  
						  $sql_rm="select * from ingresorpto where id=".$idingreso;
						  $rsteje=ejecutarsql($sql_rm);
						  $num_rows=mysqli_num_rows($rsteje);
						  if($num_rows>0){
							$rowsql= mysqli_fetch_array($rsteje);
							if ($rowsql['id']==$idingreso and $rowsql['zona']!="ELIMINADA"){
								  $sqlbsr="SELECT * FROM detalle_ingresorpto where id_ingreso=".$idingreso;
								  $rstbsr=ejecutarsql($sqlbsr);
								  $num_rowsbsr=mysqli_num_rows($rstbsr);
								  $cntci=0;
								   while ($rowbsr= mysqli_fetch_array($rstbsr)){
									 $id_detalle=$rowbsr['id'];
									 $cantidad=$rowbsr['cantidad'];
									 $id_repuesto=$rowbsr['id_repuesto'];
									 $sqlur="UPDATE `repuesto` SET `cantidad` = (`cantidad`-$cantidad) ,`entrada` = (`entrada` - $cantidad) WHERE id=$id_repuesto";
									 $sqludr="UPDATE `detalle_ingresorpto` SET observacion = 'ELIMINADO' WHERE id=".$id_detalle;
									 $rstur=ejecutarsql($sqlur);
									  $rstudr=ejecutarsql($sqludr);
									  if(!$sqludr){$info['msj']=$info['msj']." no se pudo Eliminar el detalle repuesto";$info['error']++;}else{
										  if(!$sqlur){$info['msj']=$info['msj']." no se pudo actualizar cnt repuesto";$info['error']++;}else{
											  $cntci++;
										  }
									  } 
								   }
								   if ($num_rowsbsr==$cntci){
										$sqlurm="UPDATE `ingresorpto` SET zona='ELIMINADA' WHERE id=".$idingreso;
										$rsturm=ejecutarsql($sqlurm);
										if($rsturm){$info['msj'].="Se pudo Eliminar / actualizar la rem";$info['idremi']=$idingreso;}else{$info['msj'].="nos se pudo eliminar la rem";$info['error']++;}
									   }else{$info['msj'].="no se inserto la misma cantidad de rpto encontr";$info['error']++;}
							}else{$info['msj'].="nos es la misma ingreso o esta eliminada";$info['error']++;}	  
						  }else{$info['msj'].="no se encuentra la ingreso";$info['error']++;}
							
						
					}else{$info['msj'].="no llego el id de ingreso";$info['error']++;}
						echo json_encode($info);
				break;
				


				
				
				
		}
}






?>
