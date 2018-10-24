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
                        <h2> Employee Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
<?php
$user_query  = mysql_query("select * from admin where admin_id = '$id_session'")or die(mysql_error());
$user_row =mysql_fetch_array($user_query);
$admin_type  = $user_row['admin_rol'];
?>
					<?php if ($admin_type ==1) {
					?>
                            <li>
							<a href="add_emp.php">
							<button class="btn btn-primary "><i class="fa fa-plus-circle"></i> Employee</button>
							</a>
							</li>
					<?php } ?>
                            
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
							<thead>
								<tr>
									<th>EMPLOYEE ID</th>
									<th>FULL NAME</th>
									<th>USERNAME</th>
									<th>PASSWORD</th>
									<th>EMPLOYEE TYPE</th>
									<th>STATUS</th>
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysql_query("select * from admin where admin_rol='2' order by admin_id ASC") or die (mysql_error());
							while ($row= mysql_fetch_array ($result) ){
							$id=$row['admin_id'];
							$display="";
							if ($row['admin_status']==1) {
								$display="<b style='color:teal'>ACTIVE</b>";
							}
							else{
								$display="<b style='color:maroon'>DEACTIVATED</b>";
							}
							?>
							<tr>
								<td>
									<!-- <?php if($row['admin_image'] != ""): ?>
									<img src="upload/<?php echo $row['admin_image']; ?>" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
									<?php else: ?>
									<img src="images/user.png" width="100px" height="100px" style="border:4px groove #CCCCCC; border-radius:5px;">
									<?php endif; ?>	 -->
									<?php echo $row['admin_id']; ?>
								</td> 
								<td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td>
								<td><?php echo $row['username']; ?></td>
								<td><?php echo $row['password']; ?></td>
								<td><?php echo $row['admin_type']; ?></td>
								<td><?php echo $display; ?></td>
							<!-- <td><?php  echo $row['admin_type']; ?></td>	 -->

								<?php if ($row['admin_status']==0):  ?>
							<td>
								
							 <a  href="activate_emp.php<?php echo '?admin_id='.$id; ?>">
										<button class="btn btn-success">ENABLED</button>
									</a>
							</td>
									<?php 

							else : ?>
									
									
								<td>
										<a href="unactive_emp.php<?php echo '?admin_id='.$id; ?>">
											<button class="btn btn-danger">DISABLED</button>
										</a>

								</td>
								<?php endif; ?>
								
									<!-- <a class="btn btn-primary" for="ViewAdmin" href="view_admin.php<?php echo '?admin_id='.$id; ?>">
										<i class="fa fa-search"></i>
									</a>
 -->									<!-- <a class="btn btn-warning" for="ViewAdmin" href="edit_admin.php<?php echo '?admin_id='.$id; ?>">
										<i class="fa fa-edit"></i>
									</a> -->
									<!-- <a class="btn btn-success" for="ViewAdmin" href="activate_admin.php<?php echo '?admin_id='.$id; ?>">
										<i class="fa fa-check"></i>
									</a>
									<a class="btn btn-danger" for="ViewAdmin" href="unactive_admin.php<?php echo '?admin_id='.$id; ?>">
										<i class="fa fa-times-circle" style="font-size: 20px"></i>
									</a> -->
									<!-- <a class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
										<i class="glyphicon glyphicon-trash icon-white"></i>
									</a>
			 -->
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