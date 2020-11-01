<?php
$fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-15 day' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
 
echo $nuevafecha;
?>