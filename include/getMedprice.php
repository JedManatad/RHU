<?php 
	include ('include/dbcon.php');
	$sql = mysql_query("SELECT * FROM medicine where med_name ='".$_POST["medName"]."' order by med_name ASC");
	while($row=mysql_fetch_array($sql))
	{
		$output = 'Price<input type="text" id="price" name="med_price"  class="form-control" value="'.$row["med_price"].'" onkeyup="total();">';
	}
	echo $output;

 ?>