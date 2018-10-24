<?php 

include('include/dbcon.php');

$get_id=$_GET['adminid'];

mysql_query("delete from admin where adminid = '$get_id' ")or die(mysql_error());

header('location:admin_profile.php');
?>