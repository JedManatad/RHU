	<?php include ('include/dbcon.php');
	
	mysql_query ("UPDATE user SET status = 'Active' ")or die(mysql_error());
	
	echo "<script> window.location='user.php' </script>";
	
	?>			