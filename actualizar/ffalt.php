<?php
session_start();
include("../plano.php");
include("../funciones.php");

if (isset($_SESSION['nombre'])){
	}else{header('location:../login.php');}
if(isset($_POST['nda'])){
	$dias=$_POST['nda'];
	$mi=$_POST['mi'];
	$fecha = date('Y-m-d');
	$nuevafecha = strtotime ( "-$dias day" , strtotime ( $fecha ) ) ;
	$fecha= date ( 'Y-m-d' , $nuevafecha );
 
	$mf=$_POST['mf'];
	$sql="SELECT serial FROM maquina WHERE id >= $mi AND id<=$mf";
	$rtamaquinas=ejecutarsql($sql);
	$numrows=mysqli_num_rows($rtamaquinas);
	?> 
    <div id='resptversiones' ></div>
    <table id="info">
    <tr><td>Total</td><td id="total"><?php echo $numrows; ?></td></tr>
    <tr><td>Registradas</td><td id="registradas" >0</td></tr>
    <tr><td>Respondidas</td><td id="respondidas">0</td></tr>
        <tr><td>logueos</td><td id="logueos">0</td></tr>
    </table>
    <div id="avc"></div>
    <table id="rtam" border="1"><tr><td colspan="5">Logueos Registrados</td></tr></table>
    
    <script src="../jquery-1.11.2.min.js"></script>
	<script>
	function mostrarFecha(days){
		milisegundos=parseInt(35*24*60*60*1000);
		fecha=new Date();
		day=("0"+fecha.getDate()).slice(-2);
		month=fecha.getMonth()+1;
		year=fecha.getFullYear();
		tiempo=fecha.getTime();
		milisegundos=parseInt(days*24*60*60*1000);
		total=fecha.setTime(tiempo+milisegundos);
		day=("0"+fecha.getDate()).slice(-2);
		month=("0"+(fecha.getMonth("")+1)).slice(-2);
		year=fecha.getFullYear();
		return day+"/"+month+"/"+year;
	}
	var flogueo=mostrarFecha(-<?php echo $dias; ?>);//fecha menos uno sobre la cual se buscara los logueos
	
	<?php
	while($rowmaquina=mysqli_fetch_array($rtamaquinas)){
		$serial=$rowmaquina['serial'];
		?>
		
		var url="http://www.globalsa.com.co/produccion/reportes/porterminal.php";
		  var pagi=1;
		   var fecha=flogueo;
			var terminal="<?php echo $serial ?>";
		  $.ajax({
			  type: "POST",
			  dataType:"text",
			   url: url,
			   data:{requiredcodigo:terminal,fechdesde:fecha,fechasta:fecha,submit1:''},
			   beforeSend: function(){$("#avc").html("esperando: "+terminal);},
			   error: function(){$("#avc").html("error");},
			  success: function(data){
				  $("#avc").html("recibido");
				  $("#respondidas").html(parseInt($("#respondidas").html())+1);
				  if(data.indexOf("ENCONTRARON")==-1){//se encontro resultados
				  		if(data.indexOf("INGRESAR")==-1){//si no se encontro la palabra ingresar
							lgo=true;$("#avc").html("conresultadosr");
							$("body").append("<div id='respt<?php echo $serial; ?>' ></div>")
							$("#respt<?php echo $serial; ?>").html(data.slice(660));
							
							var rip=$("#respt<?php echo $serial; ?> > center > table > tbody:nth-child(2) > tr > td:nth-child(12)").html();
							var rusuario=$("#respt<?php echo $serial; ?> > center > table > tbody:nth-child(2) > tr > td:nth-child(4)").html();
							var rnombre=$("#respt<?php echo $serial; ?> > center > table > tbody:nth-child(2) > tr > td:nth-child(5)").html();
							$("#respt<?php echo $serial; ?>").html(".");
							
							
							
							
							
							var url="glogueo.php";
							var pagi=1;
							var rfecha=flogueo;
							$.ajax({
								type: "POST",
								dataType:"text",
								 url: url,
								 data:{serial:"<?php echo $serial ?>",fecha:rfecha,usuario:rusuario,nombre:rnombre,ip:rip},
								 beforeSend: function(){$("#avc").html("esperando: "+terminal);},
								 error: function(){$("#avc").html("error");},
								success: function(data){$("#avc").html("recibido");
								$("#rtam").append(data);
								$("#registradas").html(parseInt($("#registradas").html())+1);
								}
								
							});
								
							
						}else{$("#avc").html("usted no se ha logueado en el sistema de global");}
					}else{//no se encontraron resultados
						lgo=false;$("#avc").html("sin resultados");
						
				  }
				  
				  //$("#logs").val(data);
				}
		  });
		
		<?php	
	}	
	?></script><?php
	}else{
		
		$sql="SELECT serial FROM maquina ";
		$rtamaquinas=ejecutarsql($sql);
		$numrows=mysqli_num_rows($rtamaquinas);
		
		?>
        <link rel="stylesheet" href="../styles.css" />
<script src="../jquery-1.11.2.min.js"></script>
<script>
function redir(url){
	window.location.assign(url);
	
}
</script>
		<form method="post">
        <table border="1">
          <tr>
            <td><p>Ndias</p></td>
            <td><input name="nda" type="number" value="1" /></td>
           </tr>
           <tr>
           	<td>minicial</td><td>mfinal</td>
           </tr>
           <tr>
           	<td><input name="mi" type="number" value="1" /></td><td><input name="mf" type="number" value="<?php echo $numrows; ?>" /></td>
           </tr>
            <tr>
            <td colspan="2"><input class="btn" type="submit" value="Actualizar"></td>
    		</tr>
          </table>
            </form>
            <div class="btn" onclick="redir('versiones.php')">ActVersiones</div>
        
		<?php
		}

?>