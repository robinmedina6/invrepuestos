<head>
<title>admin</title>
<script src="jquery-1.11.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/cssindex.css" >
</head>
<body>
   <form action="admin.php" method="post">
      <label type="label"> INSERTAR Consulta de Seleccion: </label>
      <input type="text" name="sql"></input>
      <input type="submit"></input>
   </form>
   <form action="admin.php" method="post">
      <label type="label"> INSERTAR  consulta de ejecucion : </label>
      <input type="text" name="sqldu"></input>
      <input type="submit"></input>
   </form>
 
</body>
 <script type="text/javascript">
    function ajustar(el) {
        var texto=$(el).val();
        var txt=texto;
        var tamano=$(el).val().length;
        tamano*=8.1; //el valor multiplicativo debe cambiarse dependiendo del tamaño de la fuente
        $(el).css('width',tamano+"px");
    }
	function editar(id,campo,elemento){
	var valor=$(elemento).val();
	if(valor != ""){
		var confirma=window.confirm("desea acualizar "+campo+" id: "+id+" valor: " + valor);
		if(confirma==true){
			  var url="edita.php";
			  $.ajax({
				type: "POST",
				dataType:"json",
				 url: url,
				 data:{idreg:id,campo:campo,valor:valor},
				 beforeSend: function(){},
				 error: function(){},
				success: function(data){
					if(data.vb==true){
					alert("el campo se edito correctamente");
					}else{alert(data.msj);}
					}
				});
			}else{}
	}else{alert("no se enviaron datos para editar");}
	}
    </script>
<?php
 session_start();
include("plano.php");
include('funciones.php');
if (isset($_SESSION['nombre'])){
	
}else{header("location:login.php");}

function displayTable($sql){
   //generamos la consulta
   if(!$result = ejecutarsql($sql)) die();
 
   $rawdata = array();
   //guardamos en un array multidimensional todos los datos de la consulta
   $i=0;
 
   while($row = mysqli_fetch_array($result))
   {
       $rawdata[$i] = $row;
       $i++;
   }
 
 
   //DIBUJAMOS LA TABLA
 
   echo '<table width="100%" border="1" style="text-align:center;">';
   $columnas = count($rawdata[0])/2;
   //echo $columnas;
   $filas = count($rawdata);
   //echo "<br>".$filas."<br>";
 
   //Añadimos los titulos
 	$arkeys=array();
   for($i=1;$i<count($rawdata[0]);$i=$i+2){
      next($rawdata[0]);
	  $arkeys[]=key($rawdata[0]);
      echo "<th><b>".key($rawdata[0])."</b></th>";
      next($rawdata[0]);
   }
 print_r($arkeys);
   for($i=0;$i<$filas;$i++){
 
      echo "<tr>";
      for($j=0;$j<$columnas;$j++){
         echo "<td><input value='".$rawdata[$i][$j]."' onKeyUp='ajustar(this)' onchange= 'editar(".$rawdata[$i][0].",\"".$arkeys[$j]."\",this)' /></td>";
 
      }
      echo "</tr>";
   }
 
   echo '</table>';
 
}
if(isset($_POST['sql'])){
	$sql = $_POST["sql"];
	echo $sql;
	displayTable($sql);
 }
 if(isset($_POST['sqldu'])){
	$sql = $_POST["sqldu"];
	$rta=ejecutarsql($sql);
 }

?>