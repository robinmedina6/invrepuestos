<?php
ini_set('error_reporting',E_ALL^E_NOTICE);
function addlog($message) {
$ip = $_SERVER['REMOTE_ADDR'];
$date_file=date('Y-m-d');
$date_event=date('Y-m-d H:i:s');
$file_execute=$_SERVER[‘PHP_SELF’];
$file=fopen("logs/log-$date_file.txt",'a+');
fwrite($file,"$ip-$date_event-$file_execute-$message \r\n");
fclose($file);
}
function phplog($num_err,$string_err,$file_err,$line_err){
	$message="";
	switch($num_err){
		
		case E_USER_ERROR:
		$message="Error($num_err)_Linea $line_err $string_err";
		break;
		
		case E_USER_WARNING:
		$message="Advertencia($num_err)_Linea $line_err $string_err";
		break;
		
		case E_USER_NOTICE:
		$message="Mensaje($num_err)_Linea $line_err $string_err";
		break;
		
		default:
		$message="Desconocido($num_err)_Linea $line_err $string_err";
		break;
		
		}
		addlog($message);
		return true;
	}
set_error_handler(phplog);
?>


