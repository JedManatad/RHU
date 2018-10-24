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
                        <h2> Patient Transaction History</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="history.php" style="background:none;">
							<button class="btn btn-primary"><i class="fa fa-users"></i> All History</button>
							</a>
							</li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
								
							<thead>
								<tr>
									<th>Patient Transaction#</th>
									<th>Incharge Doctor</th>
									<th>Ward Name</th>
									<th>Bed No</th>
									<th>Guardian Name</th>
									<th>Date Admitted</th>
									<th>Date Discharge</th>
									<th>Admitting Diagnosis</th>
									<th>Final Diagnosis</th>
									<th>Prescription</th>
									<th>Vital Sign Result</th>
									<th>Total Billings</th>
								</tr>
							</thead>
							<tbody>
<?php
			   
		if (isset($_GET['patient_trans_id']))
		$id=$_GET['patient_trans_id'];
		$result1 = mysql_query("SELECT * from user u 
  Left JOIN patient_transaction pt ON u.patient_id = pt.patient_id LEFT JOIN patient_vsr pv ON pt.patient_trans_id=pv.patient_trans_id

  where pt.patient_trans_id='$id'");
		while($row = mysql_fetch_array($result1)){
		?>
							<tr>
								<td><?php echo $id; ?></td>
								<td><?php echo $row['incharge_doc']; ?></td>
								<td><?php echo $row['patient_ward_no']; ?></td>
								<td><?php echo $row['patient_bed_no']; ?></td>
								<td><?php echo $row['guardian']; ?></td>
								<td><?php echo $row['patient_date_incharge']; ?></td>
								<td><?php echo $row['patient_date_discharge']; ?></td>
								<td><?php echo $row['patient_admit_diagnos']; ?></td>
								<td><?php echo $row['patient_findings']; ?></td>
								<td><?php echo $row['patient_doc_prescription']; ?></td>
								<td><?php echo "<b>Temp: </b>".$row['vsr_temp']."<br><b>PR:</b> ".$row['vsr_pr']."<br><b>BP: </b>".$row['vsr_bp']."<br><b>RR: </b>".$row['vsr_rr']; ?></td>
								<td><?php echo $row['patient_total_bills']; ?></td>
							</tr>
							<?php } ?>
							</tbody>
							</table>
						</div>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>