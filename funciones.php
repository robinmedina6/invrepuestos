<?php
/*error_reporting(E_ALL ^ E_NOTICE);
session_start();*/
include("includes/local.settings.php");
function generarid($tabla){
	$cnx=conectar();
	$sql="SELECT MAX(id)+1 AS id FROM $tabla";
	$result = readersql($sql,$cnx);
	desconectar($cnx);
	$num_rows=mysqli_num_rows($result);
	if($num_rows>0){
		while($row=mysqli_fetch_array($result)){
			if($row['id']==NULL){return 1;}else{
			return $row['id'];
			}
			
		}
	}else{
		return "Error: ". mysqli_error($cnx).$sql;
	}
	
	}
function  conectar(){
	/*if (isset($_SESSION['cnx'])){
		return $_SESSION['cnx'];
	}else{*/
		global $db_host;
		global $db_username;
		global $db_password;
		global $db_database;
		$conection=mysqli_connect($db_host, $db_username ,$db_password);
		mysqli_select_db( $conection, $db_database);
		
		$_SESSION['cnx']=$conection;
		return $_SESSION['cnx'];
	
	/*}*/
	}
	function sqlretstring($sql){
		$cnx=conectar();
		$result=mysqli_query($cnx,$sql);
		desconectar($cnx);
		@$num_rows=mysqli_num_rows($result);
		if($num_rows>0){
			while($row=mysqli_fetch_array($result)){
			return $row[0];
			}
		}else{return "error:$sql";}
	}
function readersql($sql,$cnx){
	return mysqli_query($cnx,$sql);
	}
function ejecutarsql($sql){
	$cnx=conectar();
	
	$result=mysqli_query($cnx,$sql);
	/*$num_rows=mysqli_num_rows($result);
	if(!$num_rows>0){
		echo mysqli_error($cnx);
		}*/
	desconectar($cnx);
	return $result;
	
}
	function desconectar($cnx){
		mysqli_close($cnx);
	}

function repetido($nvar,$var,$tabla){
	$cnx=conectar();
	$num_rows=0;
	if ($var!=""){
	$sql="SELECT * FROM $tabla WHERE $nvar LIKE'%$var%'";
	$result= mysqli_query($cnx,$sql);
	$num_rows=mysqli_num_rows($result);
	desconectar($cnx);
	}
	if($num_rows>0){
		return true;
	}else{
		return false;
	}
	
	}function igual($nvar,$var,$tabla){
	$cnx=conectar();
	$num_rows=0;
	if ($var!=""){
	$sql="SELECT * FROM $tabla WHERE $nvar LIKE'$var'";
	$result= mysqli_query($cnx,$sql);
	$num_rows=mysqli_num_rows($result);
	desconectar($cnx);
	}
	if($num_rows>0){
		return true;
	}else{
		return false;
	}
	
	}

?>