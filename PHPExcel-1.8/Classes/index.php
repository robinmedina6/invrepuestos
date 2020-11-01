<?php


//incluimos la libreria excel

require_once("PHPExcel.php");


//instanciemos el objeto
$objPHPExcel=PHPExcel_IOFactory::load("archivo.xlsx");

$objHoja=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


foreach($objHoja as $Indice => $objCelda){
	echo $objCelda['A']."_";
	echo $objCelda['B']."_";
	echo $objCelda['C']."<br>";	
	}
	











?>