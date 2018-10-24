<?php include ('include/dbcon.php');
$ID=$_GET['med_id'];
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
                        <h2><i class="fa fa-pencil"></i> Medicine Releasing Form</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->
<?php
  $query=mysql_query("select * from medicine where med_id='$ID'")or die(mysql_error());
$row=mysql_fetch_array($query);
  ?>        


                           <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                            <?php  $emp= mysql_query("SELECT * FROM admin where admin_id='$id_session'")or die(mysql_error());
                            $emprow=mysql_fetch_array($emp); ?>
                            <input type="hidden" name="added_by" value="<?php echo $emprow['firstname'].' '.$emprow['middlename'].' '.$emprow['lastname']; ?>">
                             <input type="hidden" name="med_id" value="<?php echo $row['med_id']; ?>">
                                 <div class="form-group">
                                    <label class="control-label col-md-4">Medicine Name<span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="med_name" value="<?php echo $row['med_name']; ?>" class="form-control col-md-7 col-xs-12" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Patient Name<span class="required" style="color:red;">*</span>
                                    </label>
                                    <input type="hidden" name="current_qty" value="<?php echo $row['med_qty'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <div class="col-md-4">
                                        <select name="patient_id" class="select2_single form-control" required="required" tabindex="-1" >
                                        <option value="0" style="text-align:left;">Select Patient</option>
                                        <?php
                                        $result= mysql_query("select * from user where remarks = 'Active' order by patient_id ASC ") or die (mysql_error());
                                        while ($row= mysql_fetch_array ($result) ){
                                    
                                        ?>
                                            <option value="<?php echo $row['patient_id']; ?>"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="user.php" style="color:red;">Patient not yet registered?</a>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4" >Medicine Qty <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <input type="number" name="med_qty"  required="required" class="form-control col-md-7 col-xs-12">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" >Reason Why? <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-4">
                                        <textarea name="reasons" class="form-control" rows="2" cols="60"></textarea>

                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="medicine.php"><button type="button" class="btn btn-danger"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="update" class="btn btn-success"><i class="fa fa-plus-square"></i> Submit</button>
                                    </div>
                                </div>
                            </form>
<?php
if (isset($_POST['update'])) {
			

     $patient_id = $_POST['patient_id'];
     $med_id = $_POST['med_id'];
     $med_qty   = $_POST['med_qty'];
     $reasons = $_POST['reasons'];
     $new_qty = $_POST['current_qty'] - $med_qty;
     $curdate = date('Y-m-d H:i:s');
     $added_by = $_POST['added_by'];
{		
mysql_query(" UPDATE medicine SET med_qty='$new_qty' WHERE med_id = '$ID' ")or die(mysql_error());
mysql_query("INSERT INTO med_out(patient_id,med_id,medout_qty,reasons,added_by,transaction_date)
                                     VALUES('$patient_id','$med_id','$med_qty','$reasons','$added_by','$curdate')") or die(mysql_error());
echo "<script>alert('Successfully Medicine Release!'); window.location='medicine.php'</script>";
}

}


?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>