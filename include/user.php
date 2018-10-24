<?php include ('header.php'); ?>
<?php  $emp= mysql_query("SELECT * FROM admin where admin_id='$id_session'")or die(mysql_error());
                            $emprow=mysql_fetch_array($emp); ?>
        <div class="page-title">
            <div class="title_left">
                
            </div>
        </div>
        <div class="clearfix"></div>
 		<div class="row" style="margin-top:40px;">
 			<div class="col-md-8">
 				<form method="post" action="">
                                        <select name="patient_id" class="select2_single form-control" required="required" tabindex="-1" style="width:400px;">
										<option value="0" style="text-align:left;">Select Patient</option>
										<?php
										$result= mysql_query("select * from user where remarks = 'Active' order by patient_id ASC ") or die (mysql_error());
										while ($row= mysql_fetch_array ($result) ){
									
										?>
                                            <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['patient_id']."--".$row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></option>
										<?php } ?>
                                        </select><button name="submit" type="submit" class="btn btn-primary" style="height: 40px;margin-top: 5px;width: 40px;"><i class="fa fa-search"></i></button>
						
						</form>
												<?php
							include ('include/dbcon.php');

							if (isset($_POST['submit'])) {



							$patient_id = $_POST['patient_id'];

							$sql = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
							$count = mysql_num_rows($sql);
							$row = mysql_fetch_array($sql);

								if($count <= 0){
									echo "<div class='alert alert-danger' style='width:400px;text-align:center;'>".'No Patient found!'."</div>";
								}else{
									
									header('location: patient_his.php?patient_id='.$patient_id);
								}
							}
						?>

 			</div>
 			<div class="col-md-4 text-right" style="margin-top: 10px;">
 					<?php 
 							if($emprow['admin_type'] == 'Administrator' OR $emprow['admin_type'] == 'Clerk')
 							{ ?>
 								<!-- <a href="add_user.php" style="background:none;"> -->
							<button style="width:100px;" class="btn btn-primary" onclick="document.getElementById('adduser').style.display='block'"><i class="fa fa-plus-circle" style="font-size: 20px;"></i> PATIENT</button>
							<!-- </a> -->
 						<?php	} else {
 					 						 } ?>
 			</div>
 		</div>
 		<link rel="stylesheet" type="text/css" href="../asset/users/css/modalform.css" />
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            	                <div class="x_panel">
						
                    <div class="x_title">
                    	
                    		
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"> <!-- id="example" -->
								 
							<thead>
								<tr>
							
									<th>Patient ID</th>
									<th>Full Name</th>
									<th>Address</th>
									<th>Gender</th>
									<th>Guardian Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							
							<?php
							$result= mysql_query("select * from user where remarks='Active' order by user_id ASC") or die (mysql_error());
							while ($row= mysql_fetch_array ($result) ){
							$id=$row['user_id'];
							$p_id = $row['patient_id'];
							?>
							<tr>
						
								<td><?php echo $row['patient_id']; ?></a></td> 
								<td style="font-variant-caps:all-small-caps;"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></td> 
								<td style="font-variant-caps:all-small-caps;"><?php echo $row['address']; ?></td> 
								<td style="font-variant-caps:all-small-caps;"><?php echo $row['gender']; ?></td> 
								<td style="font-variant-caps:all-small-caps;"><?php echo $row['guardian']; ?></td> 
								<td>
									<a href="view_user.php<?php echo '?user_id='.$id; ?>"> <button style="width:50px;" class="btn btn-primary"><i class="fa fa-eye"></i></button>
										<?php 
										if($emprow['admin_type']== 'Administrator' or $emprow['admin_type'] == 'Clerk' or $emprow['admin_type'] == 'Nurse')
										{ ?>
												<a href="edit_user.php<?php echo '?user_id='.$id; ?>">
												<button style="width:50px;" class="btn btn-success"><i class="fa fa-edit" style="font-size: 20px;"></i></button></a>
												<a style="margin-top:8px;width:50px;" class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
												<i class="glyphicon glyphicon-trash icon-white""></i>
												
												</a>
									<?php	} else {}
																					 ?>
									</a>
                                    
									<!-- <a class="btn btn-danger" for="DeleteAdmin" href="#delete<?php echo $id;?>" data-toggle="modal" data-target="#delete<?php echo $id;?>">
										<i class="glyphicon glyphicon-trash icon-white"></i>
									</a> -->
			
									<!-- delete modal user -->
									<div class="modal fade" id="delete<?php  echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog" >
										<div class="modal-content" style="width: 500px;">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-user"></i> User</h4>
											</div>
											<div class="modal-body">
													<div" style="color:red;">
														Are you sure you want to delete?
													</div>
													<div class="modal-footer">
														<div class="row">
															<div class="col-lg-6">	
																<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="glyphicon glyphicon-remove icon-white"></i> No</button>
															</div>	
															<div class="col-lg-6">
																<a href="delete_user.php<?php echo '?user_id='.$id; ?>"> <button class="btn btn-success"><i class="glyphicon glyphicon-ok icon-white"></i> Yes</button></a>
														    </div>
														</div>
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
             <!--add user modal-->
             <?php 

    
            require ('include/dbcon.php');

            function generateaccno()
            {
                $result = mysql_query("select count(*) from user");
                $x = mysql_fetch_array($result);

                $count = $x[0];
                $ext = "000000";
                $accno = "";

                         $accno = substr($ext,strlen($count));
                         $accno = $accno.((int)$count + 1);

                            return $accno;


                             }
                            
                                   
                 ?>
       <div id="adduser" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" style="width: 600px;">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-edit"></span> Patient Data Form</button></div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px;margin-top:50px;">
                    	<div class="col-lg-3">
                        	<input type="text" value="<?php echo generateaccno() ?>" name="patient_id" class="form-control" title="Patient ID" readonly/> 
                        </div>	
                        <div class="col-lg-3">
                        	<input type="text" name="firstname" placeholder="Firstname" class="form-control" title="Firstname">
                        </div>
                        <div class="col-lg-3">	
                       	<input type="text" name="middlename" class="form-control" placeholder="Middlename" title="Middlename">	
                        </div>
                        <div class="col-lg-3">
                        	<input type="text" name="lastname" class="form-control" placeholder="Lastname" title="Lastname"> 
                        </div>
                    </div>
                     <div class="row" style="color:gray;font-size: 10px;margin-top:20px;">
                     	<div class="col-lg-3">
                        	<select name="status" class="form-control" title="Status">
                        		<option>Status</option>
                        		<option value="Single">Single</option>
                        		<option value="Married">Married</option>
                        		<option value="Widow">Widow</option>
                        		<option value="Separated">Separated</option>
                        		<option value="Child">Child</option>
                        	</select>
                        </div>
                        <div class="col-lg-3">
                        	<input type="text" name="address" placeholder="Address" class="form-control" title="Address">
                        </div>
                        <div class="col-lg-3">	
                       	<input type="tel" name="contact" pattern="[0-9]{11,11}" autocomplete="off"  maxlength="11" class="form-control" placeholder="Contact" title="Contact">	
                        </div>
                        <div class="col-lg-3">
                        	<input type="text" name="gn" class="form-control" placeholder="Guardian" title="Guardian"> 
                        </div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px;margin-top:20px;">
                        <div class="col-lg-3">	
                       	<select name="gender" class="form-control" title="Gender">
                       			<option>Gender</option>
                        		<option value="Male">Male</option>
                        		<option value="Female">Female</option>
                        		<option value="others">others</option>
                        	</select>
                        </div>
                        <div class="col-lg-3">
                        	<select name="religion" class="form-control" title="Religion">
                        		<option>Religion</option>
                        		<option value="Protestant">Protestant</option>
                        		<option value="Born Again">Born Again</option>
                        		<option value="Roman Catholic">Roman Catholic</option>
                        		<option value="Christan">Christan</option>
                        		<option value="Muslim">Muslim</option>
                        	</select> 
                        </div>
                        <div class="col-lg-3">
                        		<input type="date" name="birthdate"  class="form-control" title="Birthdate">	
                        </div>
                        <div class="col-lg-3">
                        	<input type="number" name="age" class="form-control" placeholder="Age" title="Age"> 
                        </div>
                    </div>
                    <div class="row" style="margin-top: 50px;">
                    	<div class="col-lg-3"></div>
                    	<div class="col-md-3"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                    	<div class="col-md-3"><button type="submit" name="sub" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add</button></div>
                    	<div class="col-lg-3"></div>
                    </div>
                    </div>
                    </div>
                    </form>
				  <?php	
							include ('include/dbcon.php');
                if (isset($_POST['sub'])){
		
									$patient_id = $_POST['patient_id'];
									$firstname = $_POST['firstname'];
									$middlename = $_POST['middlename'];
									$lastname = $_POST['lastname'];
									$contact = $_POST['contact'];
									$address = $_POST['address'];
									$religion = $_POST['religion'];
									$age = $_POST['age'];
									$status = $_POST['status'];
									$gender = $_POST['gender'];
                                     $gn=$_POST['gn'];
									$birthdate = $_POST['birthdate'];
					
					$result=mysql_query("select * from user WHERE patient_id='$patient_id' ") or die (mySQL_error());
					$row=mysql_num_rows($result);
					if ($row > 0)
					{
					echo "<script>alert('ID Number already active!'); window.location='user.php'</script>";
					}
					else
					{		
						mysql_query("insert into user (patient_id, firstname, middlename, lastname, contact, gender,guardian, address, religion, status, age, birthdate, remarks, date_added)
						values ('$patient_id','$firstname', '$middlename', '$lastname', '$contact', '$gender','$gn', '$address', '$religion','$status','$age','$birthdate','Active', NOW())")or die(mysql_error());
						echo "<script>alert('User successfully added!'); window.location='user.php'</script>";
					}

							}
								?>
 
<?php include ('footer.php'); ?>