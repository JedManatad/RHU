<?php include ('include/dbcon.php');
$ID=$_GET['user_id'];
 ?>
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
                        <h2><i class="fa fa-pencil"></i> Edit Patient</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->
<?php
  $query=mysql_query("select * from user where user_id='$ID'")or die(mysql_error());
$row=mysql_fetch_array($query);
  ?>

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                       
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">ID Number
                                    </label>
                                    <div class="col-md-2">
                                        <input type="number" value="<?php echo $row['patient_id']; ?>" name="patient_id" id="first-name2" class="form-control col-md-7 col-xs-12" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">First Name
									</label>
                                    <div class="col-md-3">
                                        <input type="text" value="<?php echo $row['firstname']; ?>" name="firstname" id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Middle Name
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" name="middlename" value="<?php echo $row['middlename']; ?>" placeholder="MI / Middle Name....." id="first-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Last Name
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" value="<?php echo $row['lastname']; ?>" name="lastname" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Contact
                                    </label>
                                    <div class="col-md-3">
                                        <input type='tel' value="<?php echo $row['contact']; ?>" autocomplete="off"  maxlength="11" name="contact" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Gender
                                    </label>
									<div class="col-md-3">
                                        <select name="gender" class="select2_single form-control" tabindex="-1" >
                                            <option value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Religion
                                    </label>
                                            <div class="col-md-3">
                                                    <select name="religion" class="select2_single form-control" tabindex="-1" >
                                                        <option value="<?php echo $row['status']; ?>"><?php echo $row['religion']; ?></option>
                                                        <option value="Protestant">Protestant</option>
                                                        <option value="Born Again">Born Again</option>
                                                        <option value="Roman Catholic">Roman Catholic</option>
                                                        <option value="Christan">Christan</option>
                                                        <option value="Muslim">Muslim</option>
                                                    </select>
                                                </div>
                                </div>							
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Address
                                    </label>
                                    <div class="col-md-3">
                                        <input type="text" value="<?php echo $row['address']; ?>" name="address" id="last-name2" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Birthday</label>
                                <div class="col-md-3">
                                    <input type="date" value="<?php echo $row['birthdate']; ?>" name="birthdate" class="form-control col-md-7 col-xs-12">
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Age</label>
                                <div class="col-md-3">
                                    <input type="text" value="<?php echo $row['age']; ?>" name="age" class="form-control col-md-7 col-xs-12">
                                </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Status
                                    </label>
                                    <div class="col-md-3">
                                                    <select name="status" class="select2_single form-control" tabindex="-1" >
                                                        <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widow">Widow</option>
                                                        <option value="Separated">Separated</option>
                                                        <option value="Child">Child</option>
                                                    </select>
                                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Guardian Name</label>
                                <div class="col-md-3">
                                    <input type="text" value="<?php echo $row['guardian']; ?>" name="gn" class="form-control col-md-7 col-xs-12">
                                </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="user.php"><button type="button" class="btn btn-danger"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="update" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Update</button>
                                    </div>
                                </div>
                            </form>
							
<?php
$id =$_GET['user_id'];
if (isset($_POST['update'])) {
			

$patient_id = $_POST['patient_id'];
$firstname = mysql_real_escape_string($_POST['firstname']);
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$gn = $_POST['gn'];
$status=$_POST['status'];
$age = $_POST['age'];
$religion = $_POST['religion'];
$birthdate = $_POST['birthdate'];
{		
mysql_query(" UPDATE user SET patient_id='$patient_id', firstname='$firstname', middlename='$middlename', lastname='$lastname', contact='$contact', 
gender='$gender', address='$address', guardian='$gn', status='$status', age='$age', religion='$religion', birthdate='$birthdate' WHERE user_id = '$id' ")or die(mysql_error());
echo "<script>alert('Successfully Updated Patient Info!'); window.location='user.php'</script>";
}

}


?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>