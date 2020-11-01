<?php
session_start();
include("plano.php");
include("funciones.php");
escribir("Cerro la Session");
$ar=array('a'=>0);
$_SESSION=$ar;
session_destroy();
header("location:index.php");
?>