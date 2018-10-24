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
                        <h2><i class="fa fa-plus-circle"></i> New Medicine</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->
                         
                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Medicine Name<span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="text" name="med_name" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label col-md-4" >Medicine Price <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="number" name="med_price" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-4" >Medicine Qty <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="number" name="med_qty" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" >Expiry Date <span class="required" style="color:red;">*</span>
                                    </label>
                                    <div class="col-md-2">
                                        <input type="date" name="expiry_date"  required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="medicine.php"><button type="button" class="btn btn-danger"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Submit</button>
                                    </div>
                                </div>
                            </form>
							
							<?php	
							include ('include/dbcon.php');
							     if(isset($_POST['submit']))
                                 {  
                                    $med_name = $_POST['med_name'];
                                    $med_price = $_POST['med_price'];
                                    $med_qty   = $_POST['med_qty'];
                                    $expiry_date = $_POST['expiry_date'];
                                    $curdate = date('Y-m-d H:i:s');
                                    $query = mysql_query("INSERT INTO medicine(med_name,med_price,med_qty,expiryDate,med_date_added,med_status)
                                     VALUES('$med_name','$med_price','$med_qty','$expiry_date','$curdate','active')") or die(mysql_error());
                                    echo "<script>alert('Successfully Added!'); window.location='medicine.php'</script>";
                                 }
						      ?>
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>