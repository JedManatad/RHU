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
                    	
                    			<a href="user.php" style="background:none;">
							<button class="btn btn-success "></i>All Patient</button>
							</a>
                    		
                    			<a href="in_patient.php" style="background:none;">
							<button class="btn btn-success "></i>In-Patient</button>
							</a>
							<a href="out_patient.php" style="background:none;">
							<button class="btn btn-success "></i>Out-Patient</button>
							</a>
                    		
                    		
                        <!-- <h2><i class="fa fa-users"></i>ALL PATIENT</h2> -->
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="add_user.php" style="background:none;">
							<button class="btn btn-primary"><i class="fa fa-plus"></i> Add Patient</button>
							</a>
							</li>
                           
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
							
									<th>Patient ID</th>
									<th>Full Name</th>
									<th>Type of Patient</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysql_query("select * from user where type='Out-Patient' order by user_id DESC") or die (mysql_error());
							while ($row= mysql_fetch_array ($result) ){
							$id=$row['user_id'];
							?>
							<tr>
						
								<td><?php echo $row['patient_id']; ?></a></td> 
								<td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td> 
								<td><?php echo $row['type']; ?></td> 
								<td><?php echo $row['status']; ?></td> 
								<td>
									<a class="btn btn-primary" for="ViewAdmin" href="view_user.php<?php echo '?user_id='.$id; ?>">
										<i class="fa fa-eye"></i>
									</a>
									<a class="btn btn-success" for="ViewAdmin" href="edit_user.php<?php echo '?user_id='.$id; ?>">
									<i class="fa fa-edit"></i>
									</a>
									<!-- <a class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
										<i class="glyphicon glyphicon-trash icon-white"></i>
									</a> -->
			
									<!-- delete modal user -->
									<div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> User</h4>
										</div>
										<div class="modal-body">
												<div class="alert alert-danger">
													Are you sure you want to delete?
												</div>
												<div class="modal-footer">
												<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
												<a href="delete_user.php<?php echo '?user_id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
												</div>
										</div>
										</div>
									</div>
									</div>
								</td> 
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