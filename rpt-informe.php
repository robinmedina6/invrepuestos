<?php
session_start();
include("plano.php");
include("funciones.php");
//if (isset($_SESSION['nombre'])){
	
	
	
//}else{header("location:../login.php");}
escribir("se carga el informe ");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<script src="jquery-1.11.2.min.js"></script>
<script src="editcampos.js"></script>
<link rel="stylesheet" href="cssindex.css" type="text/css" />
<link rel="stylesheet" href="identilogueos.css" type="text/css" />
</head>

<body>


  <table id="main" >
      <tr>
          <td>
                          
              <table id="invmaquinas" border="1">
              <tr class="encabezado"><td colspan="2">JERSA</td><td colspan="12">INVENTARIO MAQUINAS</td></tr>
              <tr class="informacion"> <td>Fecha</td><td><?php echo date('d-M-Y'); ?></td><td>Zona</td><td colspan="11"><?php echo $_SESSION['nombrezona'] ;?></td></tr>
              <tr class="linea"><td colspan="14"><hr/></td></tr>
              <tr  class="titulo"><td colspan="15">Datafonos Spectra</td></tr>
              <tr class="encabezados"><td>IT</td><td>IDbd</td><td>refaccess</td><td>nombre</td><td>modelo</td><td>cantidad</td><td>salida</td><td>entrada</td><td>observacion</td><td>fcreacion</td><td>Estado</td>></tr>
              <?php
			  //contadores
			  $nmcv=0;
			  $nmsv20=0;
			  $nml=0;
			  $nms=0;
			  $nmp=0;
              // completar con la info de la bd el inventario de maquinas
              $sql="SELECT * FROM repuesto AS r WHERE 1=1";
              $rtarpt=ejecutarsql($sql);
              $contador=0;
              while($rowmrpt=mysqli_fetch_array($rtarpt)){
		      $contador++;
			  $id=$rowmrpt['id'];
              echo "<tr id='row$id' class='' fcol=''>";
              echo "<td class='item' >".$contador."</td>";
			  echo "<td class='id' ondblclick=\"fneditar('repuesto','id','$id',this)\">".$rowmrpt['id']."</td>";
			  echo "<td class='refaccess' ondblclick=\"fneditar('repuesto','refaccess','$id',this)\">".$rowmrpt['refaccess']."</td>";
			  echo "<td class='nombre' ondblclick=\"fneditar('repuesto','nombre','$id',this)\">".utf8_encode($rowmrpt['nombre'])."</td>";
			  echo "<td class='modelo' ondblclick=\"fneditar('repuesto','modelo','$id',this)\">".$rowmrpt['modelo']."</td>";
			  echo "<td class='nombre' ondblclick=\"fneditar('repuesto','cantidad','$id',this)\">".$rowmrpt['cantidad']."</td>";
			  echo "<td class='cantidad' ondblclick=\"fneditar('repuesto','salida','$id',this)\">".$rowmrpt['salida']."</td>";
			  echo "<td class='salida' ondblclick=\"fneditar('repuesto','entrada','$id',this)\">".$rowmrpt['entrada']."</td>";
			  echo "<td class='salida' ondblclick=\"fneditar('repuesto','observacion','$id',this)\">".$rowmrpt['observacion']."</td>";
			   echo "<td class='salida' ondblclick=\"fneditar('repuesto','fcreacion','$id',this)\">".$rowmrpt['fcreacion']."</td>";
                           echo "<td class='salida' ondblclick=\"fneditar('repuesto','estado','$id',this)\">".$rowmrpt['estado']."</td>";
              echo "</tr>\n";
              
              }
              ?>
              </table>
              
          </td>
      </tr>
      <tr><td>
      <table id="resumen" border="1">
      <tr><td class="encabezado" colspan="2">Resumen Inventario Maquinas</td></tr>
      <tr><td>Maquinas con Venta Reciente</td><td><?php echo $nmcv; ?></td></tr>
      <tr><td>Maquinas en laboratorio</td><td><?php echo $nml; ?></td></tr>
      <tr><td>Maquinas en STOCK</td><td><?php echo $nms; ?></td></tr>
      <tr><td>Maquinas perdidas</td><td><?php echo $nmp; ?></td></tr>
      <tr><td>Maquinas sin Venta hace 20 Dias</td><td><?php echo $nmsv20; ?></td></tr>
      <tr><td>Maquinas sin Ubicacion</td><td><?php echo $contador-$nmcv; ?></td></tr>
      <tr><td>Total Maquinas</td><td><?php echo $contador; ?></td></tr>
      
      </table>
      </td></tr>
  </table>

</body>
</html>
