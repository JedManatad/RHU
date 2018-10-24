<?php include ('header.php'); ?>

<?php 
    $patient_id = $_GET['patient_id'];
    
    $user_query = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
    $user_row = mysql_fetch_array($user_query);
?>
        <div class="page-title">
            <div class="title_left">
             
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-pencil"></i> Add New Transaction <?php echo $user_row['patient_id']; ?> </h2>
                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      
                        <?php 

    
            require ('include/dbcon.php');

            function generateaccno()
            {
                $result = mysql_query("select count(*) from patient_transaction");
                $x = mysql_fetch_array($result);

                $count = $x[0];
                $ext = "000";
                $accno = "";

                         $accno = substr($ext,strlen($count));
                         $accno = $accno.((int)$count + 1);

                            return $accno;


                             }
                             
                             
               $trans_id = $user_row['patient_id'].generateaccno();

                 ?>

                            <form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="first-name">Patient Transaction #:
                                    </label>
                                    <div class="col-md-2">
                                        <input type="text" value="<?php echo $trans_id;?>" name="p_trans_id" id="first-name2" readonly="readonly" class="form-control col-md-7 col-xs-12" style="width: 170px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Assigned Doctors:
                                    </label>
									<div class="col-md-4">
                                        <select name="p_doc_name" class="form-control" required="required" tabindex="-1" style="width: 170px;">
                                            <option value="0">Select your Doctor</option>
                                            <?php 
                                                  $doc = mysql_query("SELECT * FROM admin where admin_type='Doctor' and admin_status='1'");
                                                    while($doc_row = mysql_fetch_array($doc))
                                                    {
                                                    
                                             ?>
                                            <option value="<?php echo $doc_row['firstname']." ".$doc_row['middlename']." ".$doc_row['lastname'];?>">Dr. <?php echo $doc_row['firstname']." ".$doc_row['middlename']." ".$doc_row['lastname']; ?></option>
                                            <?php } ?>
                                        </select>
                                        
                                    </div>
                                </div>								
                               <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Ward Name:
                                    </label>
                                    <div class="col-md-4">
                                        <select name="p_ward" class="form-control" required="required" tabindex="-1" style="width: 170px;" >
                                            <option value="In-Patient">Select Ward Name</option>
                                            <option value="MCHA">MCHA</option>
                                            <option value="FCHA">FCHA</option>
                                            <option value="MixCHA">MixCHA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Ward No.:
                                    </label>
                                    <div class="col-md-4">
                                        <select name="pwardno" class="form-control" required="required" tabindex="-1" style="width: 170px;" >
                                            <option value="In-Patient">Select Ward No</option>
                                            <?php 
                                                $x='10';
                                                for ($i=1; $i <= $x ; $i++) { 
                                             ?>
                                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Bed No.:
                                    </label>
                                    <div class="col-md-4">
                                        <select name="p_bed" class="form-control" required="required" tabindex="-1" style="width: 170px;" >
                                            <option value="In-Patient">Select Bed No</option>
                                            <?php 
                                                $x='10';
                                                for ($i=1; $i <= $x ; $i++) { 
                                             ?>
                                             <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Admitting Diagnosis:
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="adiag" class="form-control" style="width: 170px;">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                        
                                    <label class="control-label col-md-4" for="last-name">VITAL SIGN RESULTS
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Body Temperature:
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="temp" class="form-control" style="width: 170px;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Blood Pressure:
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="bp" class="form-control" style="width: 170px;">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label class="control-label col-md-4" for="last-name">Pulse Rate:
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="pr" class="form-control" style="width: 170px;">
                                    </div>
                                </div>
                                <div class="form-group">    
                                    <label class="control-label col-md-4" for="last-name">Respiration Rate:
                                    </label>    
                                    <div class="col-md-4">
                                        <input type="text" name="rr" class="form-control" style="width: 170px;">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <input type="hidden" name="p_id" value="<?php echo $user_row['patient_id'] ?>">
                                     <button type="submit" name="canc" class="btn btn-danger"><i class="fa fa-times-circle-o"></i> Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Submit</button>
                                    </div>
                                </div>
                            </form>
                                						
							<?php	
							
                if (isset($_POST['submit'])){
                                    $p_id = $_POST['p_id'];
                                    $p_trans_id = $_POST['p_trans_id'];
                                    $pdocname = $_POST['p_doc_name'];
                                    $pwardno =$_POST['pwardno'];
                                    $pward = $_POST['p_ward']."-".$pwardno;
                                    $pbed = $_POST['p_bed'];
                                    $curdate = date('Y-m-d H:i:s');
                                    $adiag = $_POST['adiag'];
                                    $temp =$_POST['temp'];
                                    $bp= $_POST['bp'];
                                    $pr= $_POST['pr'];
                                    $rr= $_POST['rr'];

					  
						$s=mysql_query("insert into patient_transaction (patient_trans_id, patient_id, incharge_doc, patient_date_incharge, patient_ward_no, patient_bed_no, patient_admit_diagnos, patient_status)
						values ('$p_trans_id','$p_id','$pdocname','$curdate','$pward','$pbed','$adiag','Active')")or die(mysql_error());
                        $vital= mysql_query("INSERT INTO patient_vsr(patient_trans_id,vsr_temp,vsr_bp, vsr_pr, vsr_rr, vsr_date)
                            VALUES('$trans_id','$temp','$bp','$pr','$rr','$curdate')") or die(mysql_error());
                        if ($s && $vital) {

                                    header('location: patient_his.php?patient_id='.$patient_id);
                        }
						
					}								?>
					
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>
<?php
                                

                                    if (isset($_POST['canc'])) {

                                    
                                            
                                            header('location: patient_his.php?patient_id='.$patient_id);
                                        
                                    }
                                    ?>
<?php include ('footer.php'); ?>