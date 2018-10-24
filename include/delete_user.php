<?php 

include('include/dbcon.php');

$get_id=$_GET['user_id'];

mysql_query("update user set remarks='Incative' where user_id = '$get_id' ")or die(mysql_error());

header('location:user.php');
?>