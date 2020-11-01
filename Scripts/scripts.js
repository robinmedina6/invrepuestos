// JavaScript Document
function curcarg(){
				$('body').css('cursor','wait');
				}
			function  curnormal(){
				$('body').css('cursor','default');
				}
function enviarform(form){

	 $.ajax({
	 	url: "centralop.php",
		type: "POST",
		data: $(form).serialize(),
		success: function(resp) {
				
				alert(resp);
		},
		error: function(jqXHR, estado, error) {
			alert("error:"+error);
		},
		beforeSend: function(){curcarg();},
		
		complete: function(){curnormal();clicreados(1);},
		timeout: 10000
	});
}