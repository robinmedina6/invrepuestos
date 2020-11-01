// JavaScript Document
$(function(){
    $('.btn').mousedown(function() { 
        $(this).toggleClass('btnmd');
    });
	$('.btn').mouseup(function() { 
        $(this).toggleClass('btnmd');
    });
});
function redir(url){
	window.location.assign(url);
	
}