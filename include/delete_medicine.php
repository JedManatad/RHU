<?php 

include('include/dbcon.php');

$get_id=$_GET['med_id'];

mysql_query("update medicine set med_status='Incative' where med_id = '$get_id' ")or die(mysql_error());

header('location:medicine.php');
?>