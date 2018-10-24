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
                        <h2> List of Medicine</h2>
                        <ul class="nav navbar-right panel_toolbox">

                            <li>
							<a href="add_medicine.php">
							<button class="btn btn-primary "><i class="fa fa-plus-circle"></i> New Medicine</button>
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
									<th>Medicine Name</th>
									<!-- <th>Medicine Price</th> -->
									<th>Quantity</th>
									<th>Expiry Date</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysql_query("select * from medicine where med_status='active' order by med_name ASC") or die (mysql_error());
							while ($row= mysql_fetch_array ($result) ){
								$id=$row['med_id'];
								$curdate = date('Y-m-d');
							?>
							<tr>
								
								<td><?php echo $row['med_name']; ?></td>
								<!-- <td><?php echo "P".number_format($row['med_price']).".00"; ?></td> -->
								<td><?php echo $row['med_qty']; ?></td>
								<td><?php echo $row['expiryDate']; ?></td>
								<td><?php 
										if($curdate >= $row['expiryDate'])
											echo "<b style='color:red;'>Expired </b>";
										elseif($row['med_qty'] == 0 || $row['med_qty'] < 0)
										{
											echo "<b style='color:red;'>Out Of Stock </b>";
										} else{
											echo "<b style='color:green;'>Active</b>";
										}
								 ?></td>
								<td>
									<a href="med_in.php<?php echo '?med_id='.$id; ?>">
									<button class="btn btn-success"><i class="fa fa-plus-circle"></i></button>
									</a>
									<a href="edit_med.php<?php echo '?med_id='.$id; ?>">
									<button class="btn btn-primary"><i class="fa fa-edit"></i></button>
									</a>
									<?php if($curdate >= $row['expiryDate']){ ?>
									
									<button class="btn btn-danger" onclick="alert('This Medicine is Expired!')" ><i class="fa fa-minus-circle"></i></button>
									<?php } elseif ( $row['med_qty'] == 0 || $row['med_qty'] < 0) { ?>
										<button class="btn btn-danger" onclick="alert('This Medicine is Out Of Stock !')" ><i class="fa fa-minus-circle"></i></button>
									
								<?php } else { ?>
									<a href="med_out.php<?php echo '?med_id='.$id; ?>">
									<button class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
									</a>
								<?php } ?>
								<a style="width:50px;" class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
												<i class="glyphicon glyphicon-trash icon-white""></i>
												
												</a>
								</td>
									<!-- delete modal medicine -->
									<div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content" style="width: 500px;">
										<div class="modal-header">
											<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> Medicine</h4>
										</div>
										<div class="modal-body">
												<div >
													Are you sure you want to delete?
												</div>
												<div class="modal-footer">
														<div class="row">
															<div class="col-lg-6">	
																<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
															</div>	
															<div class="col-lg-6">
																<a href="delete_medicine.php<?php echo '?med_id='.$id; ?>"> <button class="btn btn-success"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</button></a>
														    </div>
														</div>
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