<?php 
include ('include/dbcon.php');
	$id =$_GET['admin_id'];

	$update_admin=mysql_query("update admin SET admin_status='1' where admin_id = '$id' ");

	echo "<script> window.location='employee.php'</script>";
 ?>