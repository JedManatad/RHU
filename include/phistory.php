<?php include ('header.php'); ?>
<?php 
	$patient_id = $_GET['patient_id'];
	
	$user_query = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
	$user_row = mysql_fetch_array($user_query);
?>
        <div class="page-title">
            <div class="title_left">

                <h3>
					Patient Transaction History
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 <link rel="stylesheet" type="text/css" href="../asset/users/css/modalform.css" />
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
					
					<?php
						$sql = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
						$row = mysql_fetch_array($sql);
					?>
					<h2>
					Patient Name : <span style="color:maroon;"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']." (".$row['patient_id'].")"; ?></span>
					</h2>
					<ul class="nav navbar-right panel_toolbox">
						
                            <li>
                        <form method="post" action="">
                        	<input type="hidden" name="patient_id" value="<?php echo $row['patient_id']; ?>">
							
							<button style="display:none;text-align: left;font-variant-caps: all-petite-caps;" class="btn btn-primary" name="submit2"><i class="fa fa-plus-square"></i> New Record</button>							
                        	</form>
                        	</li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                    	<?php
	include ('include/dbcon.php');

	if (isset($_POST['submit2'])) {

	$patient_id = $_POST['patient_id'];

	$sql = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
	$count = mysql_num_rows($sql);
	$row = mysql_fetch_array($sql);

		if($count <= 0){
			echo "<div class='alert alert-success'>".'No Patient found'."</div>";
		}else{
			
			header('location: add_new_trans.php?patient_id='.$patient_id);
		}
	}
	?>
                        <!-- content starts here -->
						

							<?php 
							$showtables = mysql_query("select * from patient_transaction where patient_id='$patient_id' ");
                             while($shows = mysql_fetch_array($showtables))
                             {
                             $transx = $shows['patient_trans_id'];
                             }

							$showtable = mysql_query("select * from patient_transaction where patient_trans_id='$transx' ");
                             $show = mysql_fetch_array($showtable);
                             if ($show['patient_status']=='Inactive') {
                             	
                            
						 ?>
						<div  class="table-responsive text-left">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered text-left" ><!-- id="example" -->
								
							<thead>
								<tr>
									<th>Date of Transaction</th>
									<th>Transaction #</th>
									<th>Total Billings</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								
								$patient_query = mysql_query("SELECT * from patient_transaction where patient_id='".$user_row['patient_id']."' and patient_status='inactive' ");
								while($row_patient = mysql_fetch_array($patient_query))
									{
										$id= $row_patient['patient_trans_id'];
							?>
							<tr>
								<td><?php echo date('M d, Y',strtotime($row_patient['patient_date_incharge']))."--".date('M d, Y',strtotime($row_patient['patient_date_discharge'])); ?></td>
								<td><?php echo $row_patient['patient_trans_id'];  ?></td>
								<td><?php echo "P ".number_format($row_patient['patient_total_bills']); ?></td>
								<td><a href="view_invid_phistory.php<?php echo '?patient_trans_id='.$id; ?>">
									<button class="btn btn-primary" style="width: 100px;" ><span class="fa fa-eye"></span> View</button>
									</a>
								</td>
								<?php 
									$rp = $row_patient['patient_trans_id'];
									echo $rp;
							} ?>
							</tr>
						</tbody>
						</table>
						<?php }
						else{
							echo "<center style='margin-bottom:50px;'><b style='color:red'>The Patient has no history yet</b></center>";
						} ?>
								<div class="row">
							
						
								<div class="col-md-4">
									
								</div>
								<div class="col-md-4">
										<form method="post">
									<button name="current" class="btn btn-warning"><span class="fa fa-history"></span> Current Transaction</button>
										</form>
								</div>
								<div class="col-md-4">
									<?php 
											if(isset($_POST['current']))
											{
												 header('location: patient_his.php?patient_id='.$patient_id);
											}
									 ?>
								</div>
								</div>
					</div>

                        <!-- content ends here -->
                    </div>	
                </div>
            </div>
            <?php include ('view_billings.php'); ?>
<?php include ('footer.php'); ?>