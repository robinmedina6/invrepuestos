 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Documento sin título</title>
   </head>
   <body>
   <table id='remisionrpt' border='1'style='background:white;'>
   <tr><th colspan="2"><img src="images/jerencrem.fw.png" width="150" height="100" /></th><th colspan="4">RELACION DE SALIDA DE REPUESTOS</th></tr>
   <tr class='encab'><th>idRem</th><th>Fremision</th><th>Zona</th><th colspan="2">____________Observacion_________</th><th>FecCreacion</th></tr>
<?php
session_start();
include("plano.php");
include("funciones.php");

function imprimir_remision($id_rm){
		$sqle="SELECT * FROM `remisionrpto` rm WHERE  rm.id=$id_rm";
		$rtarme=ejecutarsql($sqle);
		$rowrme=mysqli_fetch_array($rtarme);
		?>
		<style>
            #remisionrpt{
				background:rgba(255,255,255,1);
				}
			#remisionrpt .encab{
				background-color:rgba(0,102,0,0.5);
				font-weight:bold;
				}
				#remisionrpt td{
					padding:0px;
				}
        </style>
		<?php
		
        echo "<tr><td>".$rowrme['id']."</td><td>".$rowrme['fremision']."</td><td>".$rowrme['zona']."</td><td colspan=2>".$rowrme['observacion']."</td><td>".substr($rowrme['fcreacion'],0,10)."</td></tr>";
		echo "<tr><td colspan='6'>Detalle de Remision</td></tr>";
		echo "<tr class='encab'><td>idrep</td><td colspan='2'>_____________Nombre______________</td><td>cantidad</td><td>observacion</td><td>extra</td></tr>";
		
		$sql="SELECT  * FROM `remisionrpto` rm,`repuesto` r,`detalle_remisionrpto` drr WHERE rm.id=drr.id_remision and drr.id_repuesto=r.id and rm.id=$id_rm";
		$rtarm=ejecutarsql($sql);
		while($rowrm=mysqli_fetch_array($rtarm)){
				echo "<tr><td>".$rowrm['id']."</td><td colspan='2'>".utf8_encode($rowrm['nombre'])."</td><td>".$rowrm['cantidad']."</td><td>".$rowrm['observacion']."</td><td>".$rowrm['extra']."</td></tr>";
			}
			echo "<tr><td colspan='3'>Autorizacion</td><td colspan='3'><a target='_blank' href='".utf8_encode($rowrme['autorizacion'])."'>Descargar</a></td></tr>";
			echo "<tr><td colspan='3'>Conf_recibido</td><td colspan='3'><a target='_blank' href='".utf8_encode($rowrme['confrecibido'])."'>Descargar</a></td></tr>";
	}
	if(isset($_REQUEST['idrem'])){
	imprimir_remision(intval($_REQUEST['idrem']));
	}
?>
<tr><td colspan="3"><br />Firma:<br /></td><td colspan="3"></td></tr>
</table>
</body>
</html>
