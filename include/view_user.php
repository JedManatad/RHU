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
                        <h2> Patient Information</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="user.php" style="background:none;">
							<button class="btn btn-primary"><i class="fa fa-arrow-left"></i> Back</button>
							</a>
							</li>
                            
                        <!-- If needed 
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a></li>
                                    <li><a href="#">Settings 2</a></li>
                                </ul>
                            </li>
						-->
                           <!--  <li><a class="close-link"><i class="fa fa-close"></i></a></li> -->
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
								
							<thead>
								<tr>
									<th>Patient Full Name</th>
									<th>Contact</th>
									<th>Gender</th>
									<th>Address</th>
									<th>Guardian Name</th>
									<th>Birthday</th>
									<th>Age</th>
									<th>Religion</th>
									<th>Status</th>
									<th>Remarks</th>
									<th>Date Added</th>
								</tr>
							</thead>
							<tbody>
<?php
			   
		if (isset($_GET['user_id']))
		$id=$_GET['user_id'];
		$result1 = mysql_query("SELECT * FROM user WHERE user_id='$id'");
		while($row = mysql_fetch_array($result1)){
		?>
							<tr>
			
								<td><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td> 
								<td><?php echo $row['contact']; ?></td> 
								<td><?php echo $row['gender']; ?></td> 
								<td><?php echo $row['address']; ?></td> 
								<td><?php echo $row['guardian']; ?></td> 
								<td><?php echo date("M d, Y ", strtotime($row['birthdate'])); ?></td> 
								<td><?php echo $row['age']; ?></td> 
								<td><?php echo $row['religion']; ?></td> 
								<td><?php echo $row['status']; ?></td>
								<td><?php echo $row['remarks']; ?></td>  
								<td><?php echo date("M d, Y ", strtotime($row['date_added'])); ?></td>
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