<?php
include("funciones.php");
session_start();
if($_SESSION['id']){
	if(isset($_POST['opr'])){
		switch($_POST['opr']){
			//traer informacion de pago por id y tabla
			case "tinfocuenta":
				$id=$_POST['id'];
				$tabla=$_POST['ntabla'];
				$info = array('idcta' => $id,'tabla',$tabla);
				$sql="SELECT df . * , p.nombre
FROM detalle_$tabla AS df, producto AS p
WHERE df.id_$tabla =$id
AND p.id = df.id_producto";
				$result=ejecutarsql($sql);
				$info=array_merge($info,array('sqldet'=>$sql));
				$num_rows=mysql_num_rows($result);
				if($num_rows>0){
					$totcuenta=0;
					while($row=mysql_fetch_array($result)){
						$idp=$row['id'];
						$vtotal=$row['vtotal'];
						$totcuenta=$totcuenta+$vtotal;
					}
				}
				$info=array_merge($info,array('totcta'=>$totcuenta));
				
// salect case proque en caso de que el valor de la variable tabla sea igual a factura la tabla esta ocom  PAgo y no como pago_facturas
				
				
					$sql="SELECT * FROM pago_$tabla WHERE id_$tabla = $id ";
					
				
				$info=array_merge($info,array('sqlpago'=>$sql));
				$result=ejecutarsql($sql);
				$num_rows=mysql_num_rows($result);
				$info=array_merge($info,array('dtpago'=>array()));
				$totpago=0;//suma los valores de los pagos
				if($num_rows>0){
					$totpago=0;//suma los valores de los pagos
					while($row=mysql_fetch_array($result)){
						$idp=$row['id'];
						$fcreacion=$row['fcreacion'];
						$valor=$row['valor'];
						$forma=$row['forma'];
						$totpago=$totpago+$valor;
						$info['dtpago'][]=$row;
					}
					
				}
				$info=array_merge($info,array('totpago'=>$totpago));
				$copago="";
				$valrest=$totcuenta-$totpago;
				$info=array_merge($info,array('valrest'=>$valrest));
				$info=array_merge($info,array('idpagonuevo'=>generarid("pago_$tabla")));
					if($totpago==$totcuenta){$copago="Cancelada";}else{$copago="Pendiente";}
					
					
					$sql="SELECT formas_pago FROM sigafi WHERE id=1 LIMIT 1";
				$result=ejecutarsql($sql);
				$info=array_merge($info,array('sqlfpago'=>$sql));
				$num_rows=mysql_num_rows($result);
				if($num_rows>0){
					$totcuenta=0;
					$info=array_merge($info,array('formapago'=>0));
					while($row=mysql_fetch_array($result)){
						$info['formapago']=$row[0];
					}
				}
					$info=array_merge($info,array('fechapago'=>date("Y-m-d")));
					echo json_encode($info);
				
			break;
			//traer clientes por consulta traer clientes por consulta traer clientes por consulta traer clientes por consulta
			//traer clientes por consulta traer clientes por consulta traer clientes por consulta traer clientes por consulta			
			case "tclientes":
				$campo=$_POST['campo'];
				$val=$_POST['valor'];
				$pag=1;
				if(strlen($val)>2){
				$sql="SELECT * FROM cliente WHERE $campo LIKE '%$val%' ";
				$result = ejecutarsql($sql);
						$num_rows = mysql_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());/*
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;*/
							$numcampos=mysql_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysql_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							$cnt=0;
							while($row= mysql_fetch_array($result)){
								/*if($cnt>=($pag*10)-10 and $cnt<($pag*10)){*/
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									$info['elementos'][]=$row;
									for($i=0;$i<$numcampos;$i++){
									//	$info['elementos'][][$i]=$row[$i];	
									/*}*/
								}
								$cnt++;
							}
							echo json_encode($info);
						}else{echo "no arrojo resultados";}
				}else{echo "cantidad incrrecta";}
				
			break;
			//traer clientes por seleccion traer clientes por seleccion traer clientes por seleccion traer clientes por seleccion
			//traer clientes por seleccion traer clientes por seleccion traer clientes por seleccion traer clientes por seleccion			
			case "tcliselect":
				if(3>2){
				$sql="SELECT * FROM ".$_SESSION['tablasel']." WHERE id = ".$_SESSION['idsel'];;
				$result = ejecutarsql($sql);
						$num_rows = mysql_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());/*
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;*/
							$numcampos=mysql_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysql_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							$cnt=0;
							while($row= mysql_fetch_array($result)){
								/*if($cnt>=($pag*10)-10 and $cnt<($pag*10)){*/
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									$info['elementos'][]=$row;
									for($i=0;$i<$numcampos;$i++){
									//	$info['elementos'][][$i]=$row[$i];	
									/*}*/
								}
								$cnt++;
							}
							echo json_encode($info);
						}else{echo "no arrojo resultados";}
				}else{echo "cantidad incrrecta";}
				
			break;
			//traer Productos por seleccion traer Productos por seleccion traer Productos por seleccion traer Productos por seleccion 
			//traer Productos por seleccion traer Productos por seleccion traer Productos por seleccion traer Productos por seleccion 			
			case "tprovsel":
				if(3>2){
				$sql="SELECT * FROM ".$_SESSION['tablasel']." WHERE id = ".$_SESSION['idsel'];;
				$result = ejecutarsql($sql);
						$num_rows = mysql_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());/*
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;*/
							$numcampos=mysql_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysql_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							$cnt=0;
							while($row= mysql_fetch_array($result)){
								/*if($cnt>=($pag*10)-10 and $cnt<($pag*10)){*/
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									$info['elementos'][]=$row;
									for($i=0;$i<$numcampos;$i++){
									//	$info['elementos'][][$i]=$row[$i];	
									/*}*/
								}
								$cnt++;
							}
							echo json_encode($info);
						}else{echo "no arrojo resultados";}
				}else{echo "cantidad incrrecta";}
				
			break;
			//traer productos por seleccion traer productos por seleccion traer productos por seleccion traer productos por seleccion traer productos por seleccion traer productos por seleccion traer productos por seleccion traer productos por seleccion 			
			case "tprodselect":
				if(3>2){
					$prodsel=$_SESSION['prodsel'];
					$psql="";
					for($i=0;$i<=count($prodsel)-1;$i++){
						$psql=$psql . "id=".$prodsel[$i];
						if($i!=count($prodsel)-1){
							$psql=$psql." or ";	
						}
					}
				$sql="SELECT * FROM producto WHERE $psql";
				$result = ejecutarsql($sql);
						$num_rows = mysql_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());/*
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;*/
							$numcampos=mysql_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysql_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							$cnt=0;
							while($row= mysql_fetch_array($result)){
								/*if($cnt>=($pag*10)-10 and $cnt<($pag*10)){*/
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									$info['elementos'][]=$row;
									for($i=0;$i<$numcampos;$i++){
									//	$info['elementos'][][$i]=$row[$i];	
									/*}*/
								}
								$cnt++;
							}
							echo json_encode($info);
						}else{echo "no arrojo resultados";}
				}else{echo "cantidad incrrecta";}
				
			break;
			//Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura Cargar Nfactura 			
			case "cargarnfact":
				$tipo=$_POST['tipo'];
				if(3>2){
				$sql="SELECT max(codigofv)+1 as id FROM factura WHERE  tipo='$tipo'";
				$result = ejecutarsql($sql);
						$num_rows = mysql_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());/*
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;*/
							$numcampos=mysql_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysql_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							$cnt=0;
							while($row= mysql_fetch_array($result)){
								/*if($cnt>=($pag*10)-10 and $cnt<($pag*10)){*/
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									if($row['id']==NULL){$row['id']=1;}
									$info['elementos'][]=$row;
									/*for($i=0;$i<$numcampos;$i++){
										$info['elementos'][][$i]=$row[$i];
									}*/
			
								$cnt++;
							}
							echo json_encode($info);
						}else{echo "No hay Resultados";}
				}else{echo "cantidad incrrecta";}
				
			break;
			//Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision	Cargar NRemision		
			case "cargarnrem":
				$tipo=$_POST['tipo'];
				if(3>2){
				$sql="SELECT max(codigofv)+1 as id FROM remision WHERE  tipo='$tipo'";
				$result = ejecutarsql($sql);
						$num_rows = mysql_num_rows($result);$cnt=0;
						if ($num_rows > 0) {
							$info = array('elementos' => array());/*
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;*/
							$numcampos=mysql_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysql_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							
							while($row= mysql_fetch_array($result)){
								/*if($cnt>=($pag*10)-10 and $cnt<($pag*10)){*/
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									if($row['id']==NULL){$row['id']=1;}
									$info['elementos'][]=$row;
									/*for($i=0;$i<$numcampos;$i++){
										$info['elementos'][][$i]=$row[$i];
									}*/
			
								$cnt++;
							}
							echo json_encode($info);
						}else{echo "No hay Resultados";}
				}else{echo "cantidad incrrecta";}
				
			break;
			//Cargar NPedido Npedido NpedidoNpedido NpedidoNpedido NpedidoNpedido NpedidoNpedido NpedidoNpedido NpedidoNpedido Npedido
			case "cargarnpedido":
				$tipo=$_POST['tipo'];
				if(3>2){
				$sql="SELECT max(codigofv)+1 as id FROM pedido WHERE  tipo='$tipo'";
				$result = ejecutarsql($sql);
						$num_rows = mysql_num_rows($result);
						if ($num_rows > 0) {
							$info = array('elementos' => array());/*
							$info['pag']['numreg']=$num_rows;
							$info['pag']['numpag']=intval($num_rows/10)+1;
							$info['pag']['pact']=$pag;*/
							$numcampos=mysql_num_fields($result);
							for($i=0;$i<$numcampos;$i++){
							$infcampos=mysql_fetch_field($result,$i);
							$info['campos'][$i]=$infcampos;
							}
							$cnt=0;
							while($row= mysql_fetch_array($result)){
								/*if($cnt>=($pag*10)-10 and $cnt<($pag*10)){*/
									//$id=array(0=>$row['id']);
									ksort($row);
									array_slice($row,1,$numcampos,true);
									if($row['id']==NULL){$row['id']=1;}
									$info['elementos'][]=$row;
									/*for($i=0;$i<$numcampos;$i++){
										$info['elementos'][][$i]=$row[$i];
									}*/
			
								$cnt++;
							}
							echo json_encode($info);
						}else{echo "No hay Resultados";}
				}else{echo "cantidad incrrecta";}
				
			break;
		}	
	}
}else{
echo "error de logueo";	
}

?>
