<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-plus-circle"></i> Employee</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->
                         <?php 

    
            require ('include/dbcon.php');

            function generateaccno()
            {
                $result = mysql_query("select count(*) from admin");
                $x = mysql_fetch_array($result);

                $count = $x[0];
                $ext = "02018190";
                $accno = "";

                         $accno = substr($ext,strlen($count));
                         $accno = $accno.((int)$count + 1);

                            return $accno;


                             }

                 ?>

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Employee ID<span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="text" value="<?php echo generateaccno() ?>" name="emp_id" id="first-name2" readonly="readonly" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">First Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="firstname" id="first-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Middle Name
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="middlename" placeholder="MI / Middle Name....." id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Last Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="lastname" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">User Name <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="username" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Password <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="password" name="password" value="123456" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Confirm Password <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="password" name="confirm_password" value="123456" id="last-name2" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                        -        <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Emp Type <span class="required">*</span>
                                    </label>
									<div class="col-md-4">
                                        <select name="admin_type" class="form-control" required="required" tabindex="-1" >
                                            <option value="Nurse">Nurse</option>
                                            <option value="Doctor">Doctor</option>
                                            <option value="Cashier">Cashier</option>
                                            <option value="Pharmacist">Pharmacist</option>
                                            <option value="Clerk">Clerk</option>
                                            <option value="Billings">Billings</option>
                                            <option value="Laboratory">Laboratory</option> 
                                    </div>
                                </div>	
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Emp Image
                                    </label>
                                    <div class="col-md-4">
                                        <input type="file" style="height:44px;" name="image" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="employee.php"><button type="button" class="btn btn-danger"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Submit</button>
                                    </div>
                                </div>
                            </form>
							
							<?php	
							include ('include/dbcon.php');
							if (!isset($_FILES['image']['tmp_name'])) {
							echo "";
							}else{
							$file=$_FILES['image']['tmp_name'];
							$image = $_FILES["image"] ["name"];
							$image_name= addslashes($_FILES['image']['name']);
							$size = $_FILES["image"] ["size"];
							$error = $_FILES["image"] ["error"];
							{
										if($size > 10000000) //conditions for the file
										{
										die("Format is not allowed or file size is too big!");
										}
										
									else
										{

									move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);			
									$profile=$_FILES["image"]["name"];
                                    $admin_id = $_POST['emp_id'];
									$firstname = $_POST['firstname'];
									$middlename = $_POST['middlename'];
									$lastname = $_POST['lastname'];
									$username = $_POST['username'];
									$password = $_POST['password'];
									$confirm_password = $_POST['confirm_password'];
							     	$admin_type = $_POST['admin_type'];
                                    $curdate = date('M d, Y h:i:sa');
					
					$result=mysql_query("select * from admin WHERE username='$username' ") or die (mySQL_error());
					$row=mysql_num_rows($result);
                    $row_select=mysql_fetch_array($result);
					if ($row > 0)
					{
					echo "<script>alert('Username already taken!'); window.location='add_admin.php'</script>";
					}
					elseif($password != $confirm_password)
					{
					echo "<script>alert('Password do not match!'); window.location='add_admin.php'</script>";
					}
                    else
					{		
						mysql_query("insert into admin (admin_id, firstname, middlename, lastname, username, password, confirm_password, admin_image,admin_type,admin_rol,admin_status, admin_added)
						values ('$admin_id','$firstname', '$middlename', '$lastname', '$username', '$password', '$confirm_password', '$profile','$admin_type','2','1','$curdate')")or die(mysql_error());
						echo "<script>alert('Account successfully added!'); window.location='employee.php'</script>";
					}
									}
									}
							}
								?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>