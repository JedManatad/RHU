<?php include ('header.php'); ?>

        
<div class="row">
	<h1>Search Patient here</h1>
	<div class="col-md-2"></div>
	<div class="col-md-8" style="margin-top: 30px;">
	
						<form method="post" action="">
                                        <select name="patient_id" class="select2_single form-control" required="required" tabindex="-1" style="width:400px;">
										<option value="0" style="text-align:left;">Select Patient Name</option>
										<?php
										$result= mysql_query("select * from user where status = 'Active' order by patient_id ASC ") or die (mysql_error());
										while ($row= mysql_fetch_array ($result) ){
									
										?>
                                            <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id']."----".$row['firstname']." ".$row['lastname']; ?></option>
										<?php } ?>
                                        </select><button name="submit" type="submit" class="btn btn-primary" style="height: 40px;margin-top: 5px;"><i class="fa fa-search"></i></button>
						
						</form>

<?php
	include ('include/dbcon.php');

	if (isset($_POST['submit'])) {

	$patient_id = $_POST['patient_id'];

	$sql = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
	$count = mysql_num_rows($sql);
	$row = mysql_fetch_array($sql);

		if($count <= 0){
			echo "<div class='alert alert-success'>".'No Patient found!'."</div>";
		}else{
			
			header('location: patient_his.php?patient_id='.$patient_id);
		}
	}
?>

	</div>
	<div class="col-md-2"></div>
</div>
<?php include ('footer.php'); ?>