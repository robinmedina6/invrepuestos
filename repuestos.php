<?php
session_start();
include("plano.php");
include("funciones.php");
if (isset($_SESSION['nombre'])){
	
}else{header("location:cs.php");}
	?>
<!DOCTYPE html>
<html>
<title>Inventario Maquinas RJME</title>
<head>
<script src="jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="cssindex.css" type="text/css" />
<link rel="stylesheet" href="pestanas.css" type="text/css" />
<link rel="stylesheet" href="styles.css" type="text/css" />
<style>

</style>
<script src="acciones.js"></script>
<script>
	
// parametros 
function cam(){
$('#resp').css('color','red');
}
function generar(){
	$('#frmparametros').submit();
}
//simcard
function buscarsc(){
	$('#frmsimcard').submit();
	}
function editar(id,campo,elemento){
	$(elemento).html("<input class="+campo+" type='text' onblur='guardar("+id+",\""+campo+"\",this);' value='"+$(elemento).text()+"'   />");
	$(elemento).attr("onclick","");
}
function guardar(id,campo,elemento){
	var valor=$(elemento).val();
	var url="ajax.php";
	$.ajax({
		type: "POST",
		 url: url,
		data:{opr:'e',tabla:'sim',campo:campo,id:id,valor:valor}, // Adjuntar los campos del formulario enviado.
		  success: function(data){
			  var el=$(elemento.parentNode);
			$(el).attr("onclick","editar("+id+",'"+campo+"',this);");
			var val=$(elemento).val()
			$(el).html(val);
		  }
	});
	
}
// funcion link de botones
function redir(url){
	window.location.assign(url);
	
}
function cpestana(p) {
			  for (i=1;i<=9;i++){
				  $("#cpestana"+i).css('display','none');
				  $("#p"+i).css('padding-bottom',''); 
				  }
				  $("#cpestana"+p+" iframe").attr('src',function(i,val){return $("#cpestana"+p+" iframe").attr('dir');})//esta funcion vuelve a colocar la src al iframe que este dentro de la pestaña a mostrar para actualziarlo
			  $("#cpestana"+p).css('display','');
			  $("#p"+p).css('padding-bottom','2px'); 
		  
		  }
function autofitfrm(id){
	var sims = setInterval(function () {
		if (!window.opera && document.all && document.getElementById){
		id.style.height=id.contentWindow.document.body.scrollHeight;
		} else if(document.getElementById) {
		id.style.height=(id.contentDocument.body.scrollHeight+20)+"px";
		}
		window.clearInterval(sims);
		}, 2000);
}
</script>
</head>
<body onLoad="cpestana(2)">
<h3 style="position:absolute; right:0px; top:0px; margin:0px;  0px 0px 100px; color:rgba(0,153,0,1); background-color:rgba(240,240,240,1);">RJME</h3>
	<div id="container">
      <div class="contpes">
      <div class="titulo">
      </div>
      <div id="pestanas">
          <ul id=lista>
              <li id="p1"><a href='javascript:cpestana(1);'>Inicio</a></li>
              <li id="p2"><a href='javascript:cpestana(2);'>Informe</a></li>
              <li id="p3"><a href='javascript:cpestana(3);'>Crear</a></li>
              <li id="p4"><a href='javascript:cpestana(4);'>remisiones</a></li>
              <li id="p4"><a href='javascript:cpestana(5);'>entradas</a></li>
              <li id="p4"><a href='javascript:cpestana(6);'>Stock</a></li>
              <li id="p4"><a href='javascript:cpestana(7);'>SinVenta</a></li>
              <li id="p4"><a href='javascript:cpestana(8);'>Maquinas</a></li>
              <li id="p4"><a href='javascript:cpestana(9);'>Datos</a></li>
          </ul>
      </div>
 
      <div id="contenidopestanas">
          <div id="cpestana1">
          <style>
          table#contenido{
			  margin:auto;		  
			  }
          </style>
          <table id="contenido">
          <tr><td><div id="btncmaquina" class="btn" ><a href="crearmaquina.php">Crear Maquinas</a></div></td><td><div id="btncsim" class="btn"><a href="guardarsim.php">Crear SIM<a></div></td></tr>
          <tr><td><div id="btninforme" class="btn" ><a href="crearmaquina.php">Crear Maquinas</a></div></td><td><div id="btncmaquina" class="btn"><a href="guardarsim.php">Crear SIM<a></div></td></tr>
          </table>
          </div>
          <div id="cpestana2">
          <style>
          	#frminforme{
				width:100%;
				height:1500px;
				}
          </style>
          	<iframe id="frminforme" dir="rpt-informe.php" onload="autofitfrm(this)" ></iframe>
          </div>
          <div id="cpestana3">
          <style>
          	#frmcrear{
				width:100%;
				height:1500px;
				}
          </style>
          	<iframe id="frmcrear" dir="frm-repuesto.php" onload="autofitfrm(this)" ></iframe>
          </div>
          <div id="cpestana4">
          <style>
          	#frmperdidas{
				width:100%;
				}
          </style>
          	<iframe id="frmperdidas" dir="rpt-remision.php" onload="autofitfrm(this)" ></iframe>
          </div>
          <div id="cpestana5">
          <style>
          	#frmlaboratorio{
				width:100%;
				}
          </style>
          	<iframe id="frmlaboratorio" dir="rpt-ingreso.php" onload="autofitfrm(this)" ></iframe>
          </div>
          <div id="cpestana6">
          <style>
          	#frmstock{
				width:100%;
				}
          </style>
          	<iframe id="frmstock" dir="" onload="autofitfrm(this)" ></iframe>
          </div>
          <div id="cpestana7">
          <style>
          	#frmsinventa{
				width:100%;
				}
          </style>
          	<iframe id="frmsinventa" dir="" onload="autofitfrm(this)" ></iframe>
          </div>
          <div id="cpestana8">
          <style>
          	#frmmaquinas{
				width:100%;
				}
          </style>
          	<iframe id="frmmaquinas" dir="" onload="autofitfrm(this)" ></iframe>
          </div>
          <div id="cpestana9">
          <style>
          	#frmsims{
				width:100%;
				}
          </style>
          	<iframe id="frmsims" dir="" onload="autofitfrm(this)" longdesc=""></iframe>
            <div class="btn" id="opr" onClick="autofitfrm(frmsims)"><a href="javascript:autofitfrm(frminventario)">calcular<a></div>
          </div>
  <div class="btn" id="opr"><a href="cs.php">Cerrar Session<a></div>
  </div>
</div>
</body>
</html>
<script>


</script>
	<?php
?>


