<?php
$uploadedfileload="true";
$msg="";
$uploadedfile_size=$_FILES['uploadedfile']['size'];
echo "nombre:".$_FILES['uploadedfile']['name'];
echo "tipo:". $_FILES['uploadedfile']['type'];
if ($_FILES['uploadedfile']['size']>2000000)
{$msg=$msg."El archivo es mayor que 2000000KB, debes reduzcirlo antes de subirlo<BR>";
$uploadedfileload="false";}
echo $_FILES['uploadedfile']['type'];
if (!($_FILES['uploadedfile']['type'] =="application/vnd.ms-excel" OR $_FILES['uploadedfile']['type'] =="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"))
{$msg=$msg." Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos<BR>";
$uploadedfileload="false";}

$file_name=$_FILES['uploadedfile']['name'];

$hoy = date("Y-m-d"); 
mkdir("uploads/$hoy/",0777);
$add="uploads/$hoy/$file_name";
if($uploadedfileload=="true"){

if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $add)){
echo " Ha sido subido satisfactoriamente";
header("Location: logueonuevo.php?url=$add");
}else{echo "Error al subir el archivo";}

}else{echo $msg;}
?>


