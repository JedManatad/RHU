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
                        <h2> List of Laboratory</h2>
                        <ul class="nav navbar-right panel_toolbox">

                            <li>
							<a href="add_laboratory.php">
							<button class="btn btn-primary "><i class="fa fa-plus-circle"></i> Laboratory</button>
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
									<th>Laboratory Name</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysql_query("select * from laboratory order by lab_name ASC") or die (mysql_error());
							while ($row= mysql_fetch_array ($result) ){
								$id=$row['lab_id'];
							?>
							<tr>
								
								<td><?php echo $row['lab_name']; ?></td>
								 
								<td>
									<a href="edit_lab.php<?php echo '?lab_id='.$id; ?>">
									<button class="btn btn-success"><i class="fa fa-edit"></i></button>
									</a>
								</td>
									<!-- delete modal admin -->
									<div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Admin</h4>
										</div>
										<div class="modal-body">
												<div class="alert alert-danger">
													Are you sure you want to delete?
												</div>
												<div class="modal-footer">
												<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
												<a href="delete_admin.php<?php echo '?admin_id='.$id; ?>" style="margin-bottom:5px;" class="btn btn-primary"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</a>
												</div>
										</div>
										</div>
									</div>
									</div>
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