<?php
session_start();
include("../plano.php");
include("../funciones.php");

if (isset($_SESSION['nombre'])){
	}else{header('location:../login.php');}
	?>
    <script src="../jquery-1.11.2.min.js"></script>
	<?php
$sql="SELECT m.* FROM maquina AS m  WHERE 1";
              $rtamaquinas=ejecutarsql($sql);
              $contador=0;
			  $numrows=mysqli_num_rows($rtamaquinas);
			  ?>
              <table border="1">
              <tr><td>total</td><td><div id="total"><?php echo $numrows; ?></div></td></tr>
			  <tr><td>logueos</td><td><div id="logueos">0</div></td></tr>
              <tr><td>recibidos</td><td><div id="recibidos">0</div></td></tr>
    		  <tr><td>avc</td><td><div id="avc"></div></td></tr>
              </table>
              <table id="rtam" border="1"></table>
			  <div id="resptversiones"></div>
              
              </table>
			  <?php
              while($rowmaquina=mysqli_fetch_array($rtamaquinas)){
              $contador++;
              $sql="SELECT * FROM logueo AS l WHERE l.id_maquina=".$rowmaquina['id']. "  ORDER BY l.fecha DESC LIMIT 1";
              $rtalogueo=ejecutarsql($sql);
              $rowlogueo=mysqli_fetch_array($rtalogueo);
			  $id=$rowmaquina['id'];
			  $idlog="sdkjañfdasñ";
			  $idlog=$rowlogueo['id'];
			  $fecha=$rowlogueo['fecha'];
			  $usuario="234523452345243";
			  $usuario=$rowlogueo['usuario'];
			  $serial=$rowmaquina['serial'];
			  if($idlog==''){$idlog="99999999999999999";}
			  
			  
			  ?>
              
			  <script>
			  var url="http://www.globalsa.com.co/produccion/vendedores/edicion.php";
							 var rfecha="<?php echo $fecha; ?>";
							 var flogueo=rfecha;
							  var terminal="<?php echo $serial; ?>";
							$.ajax({
								type: "POST",
								dataType:"text",
								 url: url,
								 data:{empresa:2,codigo:'<?php echo $usuario; ?>',submit1:''},
								 beforeSend: function(){$("#avc").html("esperando: "+'<?php echo $usuario; ?>');},
								 error: function(){$("#avc").html("error");},
								success: function(data){
									$("#recibidos").html(parseInt($("#recibidos").html())+1);
									$("#avc").html("recibido");
									var idof=(data.indexOf("NO. TERMINAL"));
									var str=data.slice(idof-130);
									$("#resptversiones").html(str+"fin");
									var rversion="_";
									var tmnal="_";
									tmnal=$("#resptversiones > table > tbody > tr:nth-child(1) > td:nth-child(3)").html();
									rversion=$("#resptversiones > table > tbody > tr:nth-child(1) > td:nth-child(4)").html();
										
										var rfecha=flogueo;
										var url="gversion.php";
										$.ajax({
											type: "POST",
											dataType:"text",
											 url: url,
											 data:{serial:"<?php echo $serial;?>",version:rversion,fecha:rfecha,idlog:<?php echo $idlog; ?>},
											 beforeSend: function(){},
											 error: function(){},
											success: function(data){$("#avc").html("recibido");
											$("#rtam").append(data);
											$("#logueos").html(parseInt($("#logueos").html())+1);
											}
											
										});
									
									
									
								}
							});
			  </script>
			  <?php 
			  
			  }
?>