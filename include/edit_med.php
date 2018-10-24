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
                        <h2><i class="fa fa-pencil"></i> Edit Medicine</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->
<?php
  $query=mysql_query("select * from medicine where med_id='$ID'")or die(mysql_error());
$row=mysql_fetch_array($query);
  ?>

                           <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Medicine Name<span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="text" name="med_name" value="<?php echo $row['med_name']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-4" >Medicine Price <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="number" name="med_price" value="<?php echo $row['med_price']; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" >Medicine Qty <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="number" name="med_qty" value="<?php echo $row['med_qty'] ?>" required="required" class="form-control col-md-7 col-xs-12" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" >Expiry Date <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="date" name="expiry_date" value="<?php echo $row['expiryDate'] ?>"  required="required" class="form-control col-md-7 col-xs-12">
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
			

     $med_name = $_POST['med_name'];
     $med_price = $_POST['med_price'];
     $med_qty   = $_POST['med_qty'];
     $expiry_date = $_POST['expiry_date'];
{		
mysql_query(" UPDATE medicine SET med_name='$med_name',med_price='$med_price', expiryDate='$expiry_date' WHERE med_id = '$ID' ")or die(mysql_error());
echo "<script>alert('Successfully Updated Patient Info!'); window.location='medicine.php'</script>";
}

}


?>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>