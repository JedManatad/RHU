<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
               
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                			<br />
							<br />
                    <div class="x_title">
                        <h2> All Patient History</h2>
                        <ul class="nav navbar-right panel_toolbox">
<?php
$user_query  = mysql_query("select * from admin where admin_id = '$id_session'")or die(mysql_error());
$user_row =mysql_fetch_array($user_query);
$admin_type  = $user_row['admin_rol'];
?>
					<?php if ($admin_type ==1) {
					?>
                            <li>
							<a href="add_emp.php" style="display: none;">
							<button class="btn btn-primary "><i class="fa fa-plus-circle"></i> Employee</button>
							</a>
							</li>
					<?php } ?>
                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->

						<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered text-left" id="example"><!-- id="example" -->
								
							<thead>
								<tr>
									<th>Date of Transaction</th>
									<th>Patient ID</th>
									<th>Patient Name</th>
									<th>Transaction #</th>
									<th>Final Diagnosis</th>
									<th>Total Billings</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								
								$patient_query = mysql_query("SELECT * from patient_transaction Left join user ON patient_transaction.patient_id = user.patient_id where patient_status='inactive' ");
								while($row_patient = mysql_fetch_array($patient_query))
									{
										$id= $row_patient['patient_trans_id'];
							?>
							<tr>
								<td><?php echo date('M d, Y',strtotime($row_patient['patient_date_incharge']))."--".date('M d, Y',strtotime($row_patient['patient_date_discharge'])); ?></td>
								<td><?php echo $row_patient['patient_id']; ?></td>
								<td><?php echo $row_patient['firstname']." ".$row_patient['middlename']." ".$row_patient['lastname']; ?></td>
								<td><?php echo $row_patient['patient_trans_id'];  ?></td>
								<td><?php echo $row_patient['patient_findings']; ?></td>
								<td><?php echo "P ".number_format($row_patient['patient_total_bills']); ?></td>
								<td><a href="view_patientHis.php<?php echo '?patient_trans_id='.$id; ?>">
									<button class="btn btn-primary" style="width: 100px;" ><span class="fa fa-eye"></span> View</button>
									</a>
								</td>
								<?php 
									
							} ?>
							</tr>
						</tbody>
						</table>
						</div>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>