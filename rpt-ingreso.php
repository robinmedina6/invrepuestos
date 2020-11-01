<?php 
session_start();
include("plano.php");
include("funciones.php");

 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <link rel="stylesheet" href="css/estiloger.css" />
      <title>Documento sin título</title>
   </head>
   <body onload="cpestana41(6);">
      <style>
         .contpes4-1{
         margin: auto;
         background: rgba(255,255,255,0.5);
         color: rgba(0,0,0,1)
         padding: 0px 0px 0px 0px;
         border-radius: 10px;
         box-shadow: 0 10px 10px 0px rgba(0, 0, 0, 0.8);
         }
         .contpes4-1 .titulo4-1{
         font-size: 3.5ex;
         font-weight: bold;
         margin-left: 10px;
         margin-bottom: 10px;
         }
         #pestanas4-1 {
         float: top;
         font-size: 3ex;
         font-weight: bold;
         }
         #pestanas4-1 ul{
         margin-left: 0px;    
         }
         #pestanas4-1 li{
         list-style-type: none;
         float: left;
         text-align: center;
         margin: 0px 2px -2px -0px;
         background: darkgrey;
         border-top-left-radius: 5px;
         border-top-right-radius: 5px;
         border: 2px solid black;
         border-bottom: dimgray;
         padding: 0px 20px 0px 20px;
         }
         #pestanas4-1 a:link{
         text-decoration: none;
         color: rgba(0,0,0,1);
         text-shadow:rgba(255,255,255,1) 1px 1px 1px;
         }
         #contenidopestanas4-1{
         clear: both;  
         background: dimgray;
         border-radius: 5px;
         border-top-left-radius: 0px;
         border: 2px solid black;
         /*width: 800px;*/
         }
         #contenidopestanas4-1 div{
         }
         #pestanas4-1 #p4-1-1, #cpestana4-1-1{
         background: rgba(215,246,255,1);
         }
         #pestanas4-1 #p4-1-2, #cpestana4-1-2{
         background:  rgba(253,252,239,1);
         }
         #pestanas4-1 #p4-1-3, #cpestana4-1-3{
         background: rgba(233,255,223,1);
         }
         #pestanas4-1 #p4-1-4, #cpestana4-1-4{
         background: rgba(251,230,252,1);
         }
         #pestanas4-1 #p4-1-5, #cpestana4-1-5{
         background: rgba(256,249,230,1);
         }
         #pestanas4-1 #p4-1-6, #cpestana4-1-6{
         background: rgba(256,230,252,1);
         }
      </style>
      <script src="js/jquery-1.7.min.js"></script>
      <script src="Scripts/scripts.js" ></script>
      <script>
         function cpestana41(p) {
          for (i=1;i<=6;i++){
           $("#cpestana4-1-"+i).css('display','none');
           $("#p4-1-"+i).css('padding-bottom',''); 
           }
		   $("#cpestana4-1-"+p+" iframe").attr('src',function(i,val){return $("#cpestana4-1-"+p+" iframe").attr('dir');})//esta funcion vuelve a colocar la src al iframe que este dentro de la pestaña a mostrar para actualziarlo
          $("#cpestana4-1-"+p).css('display','');
          $("#p4-1-"+p).css('padding-bottom','2px'); 
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
      <div class="contpes4-1">
      <div>--------------------------------------------</div>
      <div id="pestanas4-1">
         <ul id=lista>
            <li id="p4-1-6"><a href='javascript:cpestana41(6);'>Nueva</a></li>
            <li id="p4-1-1"><a href='javascript:cpestana41(1);'>Recientes</a></li>
            <li id="p4-1-2"><a href='javascript:cpestana41(2);'>Buscar</a></li>
            <li id="p4-1-4"><a href='javascript:cpestana41(4);'>Detal ingreso</a></li>
            <li id="p4-1-5"><a href='javascript:cpestana41(5);'>Eliminarrem</a></li>
         </ul>
      </div>
      <div id="contenidopestanas4-1" style="padding:0px;">
      <div id="cpestana4-1-6">
          <?php
          
          
            /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
              
          // completar con la info de la bd el inventario de maquinas
                        $sig_id_ingreso=generarid("ingresorpto");
                        $fingreso=date("Y-m-d");
                        $observacion="";
                        $autorizacion="";
                        $confrecibido="";
                        $fcreacion=date("Y-m-d H:i:s");
                        $zona="";
                        $id_detingreso=generarid("detalle_ingresorpto");
          //}else{header("location:../login.php");}
          escribir("se imprimen variables para ingreso ");
          ?>
          <style>
          input[type=number]{
              width:50px;
              
              }
          input{
              width:auto;
              
              
			  }
		   #main-rpt-crear{
			   background-color:rgba(255,255,255,1);
			   
			   }
		   #tbl2-rpto-crear{			   
			   }
		   #tbl2-rpto-crear .encabezado{	
				   background-color:rgba(255,255,255,1);
				  text-align: center;
				  font-Size: 30px;
		   		   
			   }
			#tbl2-rpto-crear tr.encabezados{
				  background-color:rgba(0,102,0,0.5);;
				  text-align: center;
				  font-Size: 15px;
				  font-weight:bold;
				}
				
          </style>
          
         
          
          <datalist id="lstproducto">
                          <?php
                          $sql="SELECT * FROM repuesto AS r WHERE 1=1";
                          $rtarpt=ejecutarsql($sql);
                          $contador=0;
                          $jsonrpt=array();
                          while($rowmrpt=mysqli_fetch_array($rtarpt)){
                            $contador++;
                            $id=$rowmrpt['id'];
                            $jsonrpt[$id]=utf8_encode($rowmrpt['nombre']);
                            
                            echo "<option value='".$rowmrpt['id']."'>".utf8_encode($rowmrpt['nombre'])."</option>";
                          }
                          
                          ?>
                        </datalist>
                        <?php
           
                        ?>
          
          <form id="frm-crear-rpto" name="formulario-rpt" method="post" action="centalop.php" enctype="multipart/form-data">
          
            <table id="main-rpt-crear" >
                <tr>
                    <td>
                                    
                        <table id="tbl2-rpto-crear" border="1">
                        <tr class="encabezado"><td colspan="2"><img src="images/jerencrem.fw.png" /></td><td colspan="12">RELACION DE SALIDA DE REPUESTOS</td></tr>
                        <tr class="linea"><td colspan="14">
                        <input name="opr" type="hidden"  value="crear-ingreso-rpto"/>
                        <input name="opr" type="hidden"  value="crear-ingreso-rpto"/>
                        </td></tr>
                        <tr  class="titulo"><td colspan="15">Crear ingreso</td></tr>
                        <tr class="encabezados"><td>Id</td><td>Fingreso</td><td>Observacion</td><td>Autorizacion</td><td>Confrecibido</td><td>fcreacion</td><td>zona</td></tr>
                        <tr>
                        <td><input name="idingreso" type="number"  value="<?php echo $sig_id_ingreso; ?>" disabled /></td>
                        <td><input name="fingreso" type="date" value="<?php echo $fingreso; ?>" enabled  required="required"/></td>
                        <td><input name="observacion" type="observacion" value="<?php echo $observacion; ?>" enabled required /></td>
                        <td><input type="file" name="autorizacion" id="archivo" required="required"></input></td>
                        <td><input type="file" name="confrecibido" id="archivo"></input></td>
                        <td><input   name="fcreacion" type="datetime" value="<?php echo $fcreacion; ?>" disabled  /></td>
                        <td><input   name="zona" type="text" value="<?php echo $zona; ?>"  required="required"/></td>
                        </tr>
                        <tr>
                        <td colspan="6" >Repuestos Entregados</td>
                        </tr>
                        <tr>
                        <td colspan >id</td>
                        <td colspan >id_repuesto</td>
                        <td colspan >id_ingreso</td>
                        <td colspan >cantidad</td>
                        <td colspan >observacion</td>
                        <td colspan >extra</td>
                        <td colspan >Action</td>
                        
                        </tr>
                        <tr><td colspan="6"></td></tr>
                        <tr id="traddrepuesto">
                        <td><input name="id_detingreso[]" type="number" value="<?php echo $id_detingreso; ?>" disabled />
                        </td>
                        <td><input id="idrpt" name="id_repuesto[]" type="text" value="<?php ?>" enabled list="lstproducto"  required="required"/></td>
                        <td><input name="id_ingreso[]" type="number" value="<?php echo $sig_id_ingreso; ?>" disabled  /></td>
                        <td><input name="cnt_repuesto[]" type="number" value="<?php ?>" enabled required /></td>
                        <td><input name="obs_repuesto[]" type="text" value="<?php ?>" enabled required /></td>
                        <td><input name="extra_repuesto[]" type="text" value="<?php ?>" enabled /></td>
                        <td><div class="btn" onClick="fnaddrepuesto();">Insertar</div></td>
                        </tr>
                        <tr id="traddrptaft"></tr>
                        <tr>
                        <td colspan="6"><input name="btnguardar" type="submit" class="btnverde" value="Guardar"></td>
                        </tr>
                        
                      </table>
                        
                    </td>
                </tr>
                <tr><td>hola
                </td></tr>
            </table>
          </form>
          <script>
                       function fnaddrepuesto(){
                            var html = $("#traddrepuesto");
                            $('#traddrptaft').before(html.clone());
							
                            }
                       						
							$('#frm-crear-rpto').submit(function(event){
							  event.preventDefault();
							  var form = $(this);
							  var formdata = false;
							  if (window.FormData){
								  formdata = new FormData(form[0]);
							  }
						  	
							if(confirm("Esta Seguro de insertar")){}else{return false;}
							  var formAction = form.attr('action');
							  $.ajax({
								  url         : 'centralop.php',
								  data        : formdata ? formdata : form.serialize(),
								  cache       : false,
								  contentType : false,
								  processData : false,
								  type        : 'POST',
								  dataType:"JSON",
								  success     : function(data, textStatus, jqXHR){
									 curnormal();
                                    //dtconsul=data;
                                    //$('#curtaid').html("<tr><td>"+data+" robin</td></tr>");
                                    //$('#curtaidtd').html("<tr><td>"+data[campo].name+"</td></tr>");
                                    
									if(data.error==0){
									   alert(data.msj + "id rem="+data.idremi);	
										}else{
										alert(data.msj);
									}
								  }
							  });
							});	
                        </script>
      
      </div>
      <div id="cpestana4-1-1">
         <div id="crearcliente">
            <script>
               $("#crearcliente").submit(function(e){
               e.preventDefault();
               enviarform($("#frmcrearcliente"));
               
               });
            </script>
            <style>
               #tinfo{
               margin:auto;
               background-color:rgba(240,255,240,1);
               }
            </style>
            <script>
               var tablac="ingresorpto"//tabla a la que se realizaran las consultas 
               function clicreados(p){
               	var url="centralop.php";
               	var iddiv="#clicreados";
               	var idfun="clicreados";
               	$(iddiv).html('');
               	var vtabla=tablac;
               	var vordpor='id';
               	var vorden='DESC';
               	var vcampos="";
               	var vcampo="";
               	var vvalor="";
               	var vlimite="";
               	var pagi=p;
               	$.ajax({
               		type: "POST",
               		dataType:"JSON",
               		url: url,
               		//data:{opr:'t',tor:'t'},
               		data:{opr:'consulta',tabla:vtabla,campos:vcampos,campo:vcampo,valor:vvalor,ordpor:vordpor,orden:vorden,limite:vlimite,pag:pagi},
               		beforeSend: function(){curcarg();},
               		complete: function(){curnormal();},
               		success: function(data){
               		curnormal();
               		//dtconsul=data;
               		//$('#curtaid').html("<tr><td>"+data+" robin</td></tr>");
               		//$('#curtaidtd').html("<tr><td>"+data[campo].name+"</td></tr>");
               		var strcp;
               		strcp="<table id='tinfo' border='1'><tr>";
               		var numcampos=0;
               		for(campo in data.campos){ 
               			numcampos++;
               			strcp+="<th><div>"+data.campos[campo].name+"</div></th>";
               		} 
               		strcp+="</tr>";
               		for(el in data.elementos){ 
               			strcp+="<tr id='tr"+data.elementos[el][0]+"'>";
               		for(i=0;i<numcampos;i++){
               			strcp+="<td>"+data.elementos[el][i]+"</td>";
               		}
               			strcp+="<td><div onclick='cargaminif("+data.elementos[el][0]+")' class='btn'>VerDetalle</div></td>";
               			strcp+="</tr>";
               		} 
               			strcp+="<tfoot>";
               			strcp+="<tr><td colspan='"+(numcampos+1)+"'>";
               		for(i=1;i<=data.pag['numpag'];i++){
               			if(i==data.pag['pact']){
               				strcp+="<a class='pagact' href='javascript:"+idfun+"("+i+")'>"+i+"</a>";
               			}else{
               				strcp+="<a class='pag' href='javascript:"+idfun+"("+i+")'>"+i+"</a>";	 
               			}
               		}
               		strcp+="</td></tr>";
               		strcp+="</tfoot>";
               		strcp+="</table>";
               		$(iddiv).html(strcp);
               		}
               	});
               }
               clicreados(1);
               //funcion para cargar la ingreso en el iframe de abajo al dar click en el boton de la ingreso correspondiente
               function cargaminif(idrem){$("#framingreso").attr('src','infoingreso.php?idrem='+idrem);}
                                      
            </script>        
            <div id="clientescreados">
               <div id="clicreados">
               </div>
            </div>
            <style>
               div#miningreso{
				   width:700px;
				   
               margin:auto;
               display:table;
               }
               #framingreso{
               width:750px;
               height:600px;
               /*-moz-transform: scale(0.65);-moz-transform-origin: 0 0;-o-transform: scale(0.65);-o-transform-origin: 0 0;-webkit-transform: scale(0.65);-webkit-transform-origin: 0 0;*/
               }
            </style>
            <div id="miningreso">
               <iframe id="framingreso" dir=""></iframe>
            </div>
         </div>
      </div>
      <div id="cpestana4-1-2">
      <style>
         #cpestana4-1-2 #curtaidtd .cell{
         display:inline;
         margin:0px;
         min-height:5px;
         min-width:10px;
         }
         #cpestana4-1-2 #curtaidtd{
         /*overflow:auto;
         max-width:1000px;
         max-height:800px;*/
         }
         #cpestana4-1-2 #tregres{
         background-color:rgba(253,253,253,1);
         }
         #cpestana4-1-2 #tregres td{
         /*border:rgba(0,0,0,1) 1px solid;*/
         }
         #camposasel{margin:auto;}
         .tregistro #btnbuscar{
         background-color:rgba(166,189,41,1);
         color:rgba(255,255,255,1);
         border:1px rgba(166,189,41,1) solid;
         border-radius:5px;
         width:100px;
         margin:auto;
         font-weight:normal;
         font-family: "Comic Sans MS", cursive;
         cursor:pointer;
         }
         .tregistro #btnbuscar:hover{
         background-color:rgba(255,255,255,1);
         color:rgba(166,189,41,1);
         }
         #curtaid div th input{
         width:30px;
         }
         #curtaid div .cell{
         margin-bottom:0px;
         overflow:auto;
         min-width:10px;
         min-height:10px;
         }
         #curtaid div th{
         width:100px;
         background-color:rgba(102,204,204,1);
         border-radius:3px;
         }
         #curtaid div td:hover{ background-color:rgba(0,153,204,0.2); cursor:pointer;}
         #curtaid tr:hover{border:rgba(153,153,153,1) 1px solid;}
         #curtaid div td{
         /*width:100px;*/
         padding:0px;
         box-shadow: rgba(0,153,0,0.2) 0px 0px 50px;
         border-radius:1px;
         border-bottom:rgba(255,255,255,1) 1px solid;
         }
         #curtaidtd #tregres tr td input{
         padding:0px;
         margin:0px;
         }
         #curtaidtd #tregres{
         background-color:rgba(255,255,255,1);
         }
         #curtaidtd #tregres tr td #btneliminar{
         background-color:rgba(166,189,41,1);
         color:rgba(255,255,255,1);
         border:1px rgba(166,189,41,1) solid;
         border-radius:5px;
         width:50px;
         margin:auto;
         font-weight:normal;
         cursor:pointer;
         }
         #curtaidtd #tregres tr td #btneliminar:hover{
         background-color:rgba(255,255,255,1);
         color:rgba(166,189,41,1);
         }
         .tregistro{
         margin:auto;
         background-color:rgba(220,224,205,1);
         }
         .cell{
         width:5px;
         height:5px;
         }
         .pag{
         background-color:rgba(202,236,196,1);
         padding:5px;
         border:rgba(0,51,0,1) 1px solid;
         border-radius:2px;
         }
         .pagact{
         background-color:rgba(0,102,0,1);
         padding:5px;
         border:rgba(0,51,0,1) 1px solid;
         border-radius:2px;
         }
      </style>
      <div id="editar-aprendiz">
      <datalist  id="listtablas">
      </datalist>
      <datalist id="listcampos">
      </datalist>
      <datalist id="listorden">
         <option value="ASC" >Ascendente</option>
         <option value="DESC">Descendente</option>
      </datalist>
      <table class="tregistro"  border="0">
         <thead>
            <tr>
               <th colspan="5">Selecciones Los Campos que quiere Ver</th>
            </tr>
            <tr>
               <th colspan="5"><input id="txttabla" type="text" required  list="listtablas" onBlur="traercampos()" value="ingreso"  hidden="true"/></label></th>
            </tr>
            <tr>
               <th colspan="5">
                  <div id="divcamposasel">
                     <table id="camposasel"></table>
                     <div>
               </th>
            </tr>
            <tr><th colspan="5">Buscar POR: <input id="txtcampo" type="text"  required  list="listcampos" onBlur="identicampos()" />Valor: <input id="txtvalor" type="text"  required /></th></tr>
            <tr><th colspan="5">Ordenar Por: <input id="txtordpor" type="text" required  list="listcampos" onBlur="identicampos()" />Orden: <input id="txtorden" type="text"  required list="listorden"/></th></tr>
            <tr><th colspan="5"> Numero Maximo de Registros: <input id="txtlimite" type='number'/> </th></tr>
            <tr><th colspan="5"></th></tr>
            <tr><th colspan="5"><div id="btnbuscar" onClick="consultar(1)">Buscar</div></th></tr>
            <tr><th></th><th></th><th></th><th></th></tr>
         </thead>
         <tbody id="curtaid">
         <tr><td colspan="5"><div id="curtaidtd"></div></td></tr>
         </tbody>
         <tr><td colspan="2"><div id="ob1"></div></td><td colspan="2">
         <div id="ob2"></div></td></tr>
      </table>
      <script>
         function geliminar(id,tabla,elem){
         if(confirm('Desea Eliminar el elemento con el id:'+id)){
         var url="central.php";
         	$.ajax({
         		type: "POST",
         		url: url,
         		data:{opr:'d',tor:'li',id:id,tabla:tabla}, // Adjuntar los campos del formulario enviado.
         		success: function(data){
         		if(data==true){
         		$(elem.parentNode.parentNode).hide(500);
         		}
         		else{
         		mostrarmsj(data);
         		}
         		}
         	});
         }
         else{
         //si decide que no
         }
         }
         var dtconsul;
         function gedinput(idreg,namecamp,typecamp,elem){
         var url="central.php";
         $.ajax({
         	type: "POST",
         	url: url,
         	data:{opr:'e',tor:'li',tabla:typecamp,campo:namecamp,id:idreg,valor:$(elem).val()}, // Adjuntar los campos del formulario enviado.
         	success: function(data){
         	$(elem.parentNode).html("<div class='cell' onclick=\"camparaedit('"+idreg+"','"+namecamp+"','"+typecamp+"',this)\">"+data+"</div>"); 
         	}
         });
         }
         function obtipodato(str){
         	switch (str.toLowerCase()){
         	case 'fcreacion':
         	return 'text';
         	break;
         	case 'ndocumento':
         	return 'number';
         	break;
         	case 'correo':
         	return 'email';
         	break;
         	default:
         	return 'text';
         	break;
         	}
         }
         function camparaedit(idreg,namecamp,typecamp,elem){
         if (namecamp.toLowerCase()=="id" || namecamp.toLowerCase()=="html" || namecamp.toLowerCase()=="idadministrador" || namecamp.toLowerCase()=="tfoto" || namecamp.toLowerCase()=="foto"|| namecamp.toLowerCase()=="nfoto" || namecamp.toLowerCase()=="tamfoto")
         {
         }else{
         	$(elem.parentNode).html("<input onblur=\"gedinput('"+idreg+"','"+namecamp+"','"+typecamp+"',this)\" id="+idreg+namecamp+" type="+obtipodato(namecamp)+" value='"+$(elem).text()+"' />");
         	$("input#"+idreg+namecamp).focus();
         }
         }
         //funciones para cargar el detalle de la ingreso
         function cargaminif2p(idrem){$("#framingreso2p").attr('src','infoingreso.php?idrem='+idrem);}
         function cargaringreso2p(idrem){
         	open('imprremg.php?idrem='+idrem,'','top=50px,left=300px,width=500px,height=500px') ; 
         }
         function consultar(p){
         	var url="centralop.php";
         	$("#curtaidtd").html('');
         	var vtabla=tablac;//coloco la tabla de la cual se realizara la consulta
         	var vcampos=new Array()
         	$('input[name="campos[]"]:checked').each(function() {
         		vcampos.push($(this).val());
         	});
         	var vcampo=$('#txtcampo').val();
         	var vvalor=$('#txtvalor').val();
         	var vordpor=$('#txtordpor').val();
         	var vorden=$('#txtorden').val();
         	var vlimite=$('#txtlimite').val();
         	var pagi=p;
         	$.ajax({
         		type: "POST",
         		dataType:"JSON",
         		url: url,
         		//data:{opr:'t',tor:'t'},
         		data:{opr:'consulta',tabla:vtabla,campos:vcampos,campo:vcampo,valor:vvalor,ordpor:vordpor,orden:vorden,limite:vlimite,pag:pagi},
         		beforeSend: function(){curcarg();},
         		error: function(){curnormal();},
         			success: function(data){
         				curnormal();
         				//dtconsul=data;
         				//$('#curtaid').html("<tr><td>"+data+" robin</td></tr>");
         				//$('#curtaidtd').html("<tr><td>"+data[campo].name+"</td></tr>");
         				var strcp;
         				strcp="<table id='tregres'><tr>";
         				var numcampos=0;
         
         				for(campo in data.campos){ 
         				numcampos++;
         				strcp+="<th id="+data.campos[campo].name+"><div id="+data.campos[campo].name+" >"+data.campos[campo].name+"</div></th>";
         				} 
         				strcp+="<th>"+"Opcion"+"</th>";
         				strcp+="</tr>";
         				for(el in data.elementos){ 
         				strcp+="<tr id='tr"+data.elementos[el][0]+"'>";
         				for(i=0;i<numcampos;i++){
         				strcp+="<td><div class='cell' onclick=\"camparaedit('"+data.elementos[el][0]+"','"+data.campos[i].name+"','"+data.campos[i].table+"',this)\">"+data.elementos[el][i]+"</div></td>";
         				}
         				strcp+="<td><div class='btn' onclick='cargaringreso2p("+data.elementos[el][0]+")'>"+"Ver rem"+"</div></td>";
         				strcp+="</tr>";
         				} 
         				strcp+="<tfoot>";
         				strcp+="<tr><td colspan='"+(numcampos+1)+"'>";
         				for(i=1;i<=data.pag['numpag'];i++){
         				if(i==data.pag['pact']){
         				strcp+="<a class='pagact' href='javascript:consultar("+i+")'>"+i+"</a>";
         				}else{
         				strcp+="<a class='pag' href='javascript:consultar("+i+")'>"+i+"</a>";	 
         				}
         				}
         				strcp+="</td></tr>";
         				strcp+="</tfoot>";
         				strcp+="</table>";
         				$('#curtaidtd').html(strcp);
         				$('#curtaidtd th div#fcreacion').css('width','135px');
         			}
         		});
         	}
         function identicampos(){}
         function traertablas(){
         var url="centralop.php";
         $("#listtablas").html('');
         $.ajax({
         type: "POST",
         dataType:"JSON",
         url: url,
         data:{opr:'t',tor:'t'}, // Adjuntar los campos del formulario enviado.
         success: function(data){
         for(tabla in data.tablas){ 
         $("#listtablas").append("<option value='"+data.tablas[tabla].nombre+"'></option>");
         } 
         }
         });
         }
         
         function traercampos(){
         var url="centralop.php";
         $("#camposasel").html('');
         $("#listcampos").html('');
         var camselec=tablac;
         $.ajax({
         type: "POST",
         dataType:"JSON",
         url: url,
         data:{opr:'t',tor:'camp',camsel:camselec}, // Adjuntar los campos del formulario enviado.
         success: function(data){
         $("#camposasel").append("<tr>");
         for(campo in data.campos){ 
         $("#listcampos").append("<option value='"+data.campos[campo].nombre+"'></option>");
         $("#camposasel").append("<td>"+data.campos[campo].nombre+"</td><td><input id='cmps' name='campos[]' type='checkbox' value='"+data.campos[campo].nombre+"'/></td>");
         } 
         $("#camposasel").append("</tr>");
         $('#divcamposasel').show(200);
         }
         });
         }
         traercampos();
      </script>
      <!--
         <style>
         #miningreso2p{
         margin:auto;
         display:table;
         }
         #framingreso2p{
         width:650px;
         height:300px;
         /*-moz-transform: scale(0.65);-moz-transform-origin: 0 0;-o-transform: scale(0.65);-o-transform-origin: 0 0;-webkit-transform: scale(0.65);-webkit-transform-origin: 0 0;*/
         }
         </style>
         <div id="miningreso2p">
         <iframe id="framingreso2p" dir=""></iframe>
         </div>
         -->                                                
      </div>
      </div>
      
            <div id="cpestana4-1-4">
               <table border="1" style="margin:auto;background-color:rgba(255,255,255,1);text-align:center;">
                  <tr>
                     <th colspan="2">Consultar Detalle de ingreso</th>
                  </tr>
                  <tr>
                     <td>Ingrese el id de la ingreso</td>
                     <td><input id="numremdf" type="number"/></td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <div onclick="cargaminif4p()" class="btn">Consultar</div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <script>
                           //funcion para cargar la ingreso en el iframe de abajo al dar click en el boton de la ingreso correspondiente
                           function cargaminif4p(){
                           var idrem=$("#numremdf").val();
                           $("#framingreso4p").attr('src','infoingreso.php?idrem='+idrem);
                           }
                           function cargaringreso4p(idrem){
                           
                           open('imprremg.php?idrem='+idrem,'','top=50px,left=300px,width=500px,height=500px') ; 
                           
                           }
                        </script>
                        <style>
                           #miningreso4p{
                           margin:auto;
                           display:table;
                           }
                           #framingreso4p{
                           width:750px;
                           height:500px;
                           /*-moz-transform: scale(0.65);-moz-transform-origin: 0 0;-o-transform: scale(0.65);-o-transform-origin: 0 0;-webkit-transform: scale(0.65);-webkit-transform-origin: 0 0;*/
                           }
                        </style>
                        <div id="miningreso4p">
                           <iframe id="framingreso4p" dir=""></iframe>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
            
            
            
             <div id="cpestana4-1-5">
               <table border="1" style="margin:auto;background-color:rgba(255,255,255,1);text-align:center;">
                  <tr>
                     <th colspan="2">Consultar Detalle de ingreso y Eliminar</th>
                  </tr>
                  <tr>
                     <td>Ingrese el id de la ingreso a Eliminar</td>
                     <td><input id="numremdf5p" type="number"/></td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <div id="btnconsul415" onclick="cargaminif5p()" class="btn">Consultar</div>
                        <div id="btnelimin415" onclick="eliminarrem415()" class="btn" style="display:none">EliminarRem</div>
                        
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <script>
                           //funcion para cargar la ingreso en el iframe de abajo al dar click en el boton de la ingreso correspondiente
						   
                           function cargaminif5p(){
                           var idrem=$("#numremdf5p").val();
                           $("#framingreso5p").attr('src','infoingreso.php?idrem='+idrem);
						   $("#btnelimin415").attr('onclick','fneliminarrem('+idrem+')');
						   $("#btnelimin415").html("EliminarRem:"+idrem);
						   $("#btnelimin415").css('display','inline-block');
                           }
                           function cargaringreso5p(idrem){
                           open('imprremg.php?idrem='+idrem,'','top=50px,left=300px,width=500px,height=500px') ; 
                           }
						   
						   function fneliminarrem(idrem){
							if(confirm("Esta seguro Eliminar la rem id:"+idrem)){
								
								//tabla a la que se realizaran las consultas 
								   
									var url="centralop.php";
									
									$.ajax({
										type: "POST",
										dataType:"JSON",
										url: url,
										//data:{opr:'t',tor:'t'},
										data:{opr:'eliminaringresorpto',idingreso:idrem},
										beforeSend: function(){curcarg();},
										complete: function(){curnormal();},
										success: function(data){
											if(data.error==0){
											   alert(data.msj + "id rem="+data.idremi);	
												}else{
												alert(data.msj);
											}
										}
									})
							}   
							   
						   }
						   
                        </script>
                        <style>
                           #miningreso5p{
                           margin:auto;
                           display:table;
                           }
                           #framingreso5p{
                           width:750px;
                           height:500px;
                           /*-moz-transform: scale(0.65);-moz-transform-origin: 0 0;-o-transform: scale(0.65);-o-transform-origin: 0 0;-webkit-transform: scale(0.65);-webkit-transform-origin: 0 0;*/
                           }
                        </style>
                        <div id="miningreso5p">
                           <iframe id="framingreso5p" dir=""></iframe>
                        </div>
                     </td>
                  </tr>
               </table>
            </div>
            
         </div>
      </div>
   </body>
</html>