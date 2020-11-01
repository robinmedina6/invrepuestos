<?php 
session_start();
include("plano.php");
include("funciones.php");
$clav=0;
$cdg='';
if(isset($_POST['pass'],$_POST['user'])){
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	/*$sql="SELECT * FROM zona WHERE user='$user' LIMIT 1";
	$rta=ejecutarsql($sql);
	if($rta){
		$numrows=mysqli_num_rows($rta);
		if($numrows>0){
			$row=mysqli_fetch_array($rta);
		*/		if("almacen"==$pass and "almacen"==$user){
					$_SESSION['nombre']=$user;
					//$_SESSION['zona']=$row['id'];
					$_SESSION['nombrezona']="almacen";
					escribir("se logueo");
				}else{echo "contraseña Incorrecta";}
}

if (isset($_SESSION['nombre'])){
	header("location:repuestos.php");
}else{}

?>
	<script src="jquery-1.11.2.min.js"></script>
	<h1><form method="POST">
	<table>
	<tr><td>Usuario-></td><td>
	<input id="foco" name="user" type="text" >
	</td></tr>
	<tr><td>Contrasena-></td><td>
	<input name="pass" type="password" >
	</td></tr>
	<tr><td colspan="2">
	<input class="btn" type="submit" value="Ingresar">
	</td></tr>
	</table>
	</form><h1>
<style>
.btn{
color:;
border:;
background:white;
border-radius:5px;
box-shadow:0px 0px 2px;
margin:auto;
padding:5px;
}
.btn:hover{
font-weigth:bold;
color:gray;
border:white;
}
input{
	color:rgba(50,50,100,1);
	font-weigth:bold;
}
table{
	margin:auto;
	border-radius:5px;
	padding:5px;
	color:white;
text-shadow: 0px 0px 5px black;
text-align:center;

background: rgb(30,87,153); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover, rgba(30,87,153,1) 0%, rgba(41,137,216,1) 50%, rgba(32,124,202,1) 51%, rgba(125,185,232,1) 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(30,87,153,1)), color-stop(50%,rgba(41,137,216,1)), color-stop(51%,rgba(32,124,202,1)), color-stop(100%,rgba(125,185,232,1))); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover, rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover, rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover, rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* IE10+ */
background: radial-gradient(ellipse at center, rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
}
</style>
<script>
$("#foco").focus();
</script>
<?php
			
?>