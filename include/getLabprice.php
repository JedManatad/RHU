<?php 
	include ('include/dbcon.php');
	$sql = mysql_query("SELECT * FROM laboratory where lab_name ='".$_POST["labName"]."' order by lab_name ASC");
	while($row=mysql_fetch_array($sql))
	{
		$output = '<option value="'.$row["lab_price"].'">P'.$row["lab_price"].'</option>';
	}
	echo $output;

 ?>