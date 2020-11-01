// JavaScript Document
var editando=false;
var llfn="";
function fneditar(table,campo,id,el){
	if(editando==false){
		editando=true;
	var ancho=parseInt($(el).css('width'))+2;
	var alto=parseInt($(el).css('height'))+2;
	llfn=$(el).attr('ondblclick');
	$(el).html("<textarea style='width:"+ancho+"px; height:"+alto+"px; ' onblur=\"fnguardar('"+table+"','"+campo+"','"+id+"',this)\">"+$(el).html()+"</textarea>");
	$("textarea").focus();
	$(el).attr('ondblclick',"");
	}else{alert("ya se esta editando otro campo");}
	}
function fnguardar(table,campo,id,eltxt){
	if(editando==true){
		editando=true;
	var	el=$(eltxt).parent();
	var ancho=parseInt($(el).css('width'));
	var alto=parseInt($(el).css('height'));
	
	var vtabla=table;
	var vcampo=campo;
	var vid=id;
	var vrsto=$(eltxt).val();
	
	var url="gcampo.php";
	  $.ajax({
		  type: "POST",
		  dataType:"text",
		   url: url,
		   data:{tabla:vtabla,campo:vcampo,id:vid,rsto:vrsto},
		   beforeSend: function(){},
		   error: function(){},
		  success: function(data){
		   	$(el).html(data);
			$(el).attr('ondblclick',llfn);
		   editando=false;
		  }
		  
	  });
	
	}else{alert("no hay campos editandos");}
	}
	