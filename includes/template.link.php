<?php 
include('local.settings.php'); 
$connection = mysqli_connect($db_host,$db_username,$db_password); 
mysqli_select_db($db_database); 
 
$query = "select * from mb_link order by mb_link_order asc"; 
$result = mysqli_query($query,$connection); 
 
$num_rows = mysqli_num_rows($result); 
if($num_rows > 0){ 
?> 
<ul class="links"> 
<?php 
 while($row = mysqli_fetch_array($result)){ 
?> 
<li><a href="<?php echo $row['mb_link_url']; ?>" target="_blank"><?php echo 
$row['mb_link_text']; ?></a></li> 
<?php 
 } 
?> 
</ul> 
<?php 
} 
mysqli_close($connection); 
?>