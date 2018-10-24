<?php include ('patient_his.php'); ?>
<div id="updateinfo" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-edit"></span> Update Patient Transaction</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:gray;font-size: 10px;">
                        <div class="col-md-8">
                        	<p>Patient Name :</p><span style="color:teal;font-variant-caps: all-petite-caps;font-size: 12px;"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></span>	
                        </div>
                        <div class="col-md-4">
                        	<p>Guardian Name: </p><span style="color:teal;font-variant-caps: all-petite-caps;font-size: 12px;"><?php echo $row_update['guardian']; ?></span>
                        </div>    
                    </div>
                    <hr>
                    <div class="row" style="color:gray;font-size: 10px;margin-top: 20px;">
                    	<div class="col-md-6">
                    		Trans #:<input class="form-control" type="text" name="trans_id" value="<?php echo $row_update['patient_trans_id']; ?>" readonly="readonly">
                    	</div>
                    	<div class="col-md-6">
                    		Incharged Doctor:
                    		<select style="width: 218px;" name="p_doc_name" class="select2_single form-control" required="required" tabindex="-1">
                                            <option value="<?php echo $row_update['incharge_doc']; ?>"><?php echo "Dr. ".$row_update['incharge_doc']; ?></option>
                                            <?php 
                                                  $doc = mysql_query("SELECT * FROM doctor");
                                                    while($doc_row = mysql_fetch_array($doc))
                                                    {
                                                    
                                             ?>
                                            <option value="<?php echo $doc_row['doc_name'];?>">Dr. <?php echo $doc_row['doc_name']; ?></option>
                                            <?php } ?>
                                        </select>
                    	</div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px; margin-top: 10px;">
                    	<div class="col-md-4">
                    		Ward #:<input type="text" name="ward" value="<?php echo $row_update['patient_ward_no']; ?>" class="form-control">
                    	</div>
                    	<div class="col-md-4">
                    		Bed #:<input type="text" name="bed" value="<?php echo $row_update['patient_ward_no']; ?>" class="form-control">
                    	</div>
                    	<div class="col-md-4">
                    		Date Admitted:<input type="text" name="" value="<?php echo $row_update['patient_date_incharge']; ?>" class="form-control" readonly="readonly">
                    	</div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px; margin-top: 10px;">
                    	<div class="col-md-12">
                    		Findings:
                    		<textarea  value="<?php echo $row_update['patient_findings']; ?>" name="p_finds" rows="3" cols="12" style="width:455px"><?php echo $row_update['patient_findings']; ?></textarea>
                    	</div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px; margin-top: 10px;">
                    	<div class="col-md-12">
                    		Doctor's Prescription:
                    		<textarea  value="<?php echo $row_update['patient_findings']; ?>" name="presc" rows="3" cols="12" style="width:455px"><?php echo $row_update['patient_doc_prescription']; ?>
                        	</textarea>
                    	</div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px; margin-top: 10px;">
                    	<div class="col-md-4"></div>
                    	<div class="col-md-4 text-center">
                    		Total Billings
                    		<input style="text-align: center;" class="form-control" type="text" name="" value="<?php if(empty($row_update['patient_total_bills'])){ echo '0'; }else{echo 'P'.$row_update['patient_total_bills'];} ?>" readonly="readonly">
                    	</div>
                    	<div class="col-md-4"></div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                    	<div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('updateinfo').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                    	<div class="col-md-6"><button type="submit" name="update" class="btn btn-success"><span class="fa fa-check-circle"></span> Update</button></div>
                    </div>
                   </div>
               </div>
             </form>
				   <?php include ('include/dbcon.php');

					if (isset($_POST['update'])) {
						$doc = $_POST['p_doc_name'];
						$ward = $_POST['ward'];
						$bed = $_POST['bed'];
						$pfind = $_POST['p_finds'];
						$ppresc = $_POST['presc'];
								$patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
								$row_patient = mysql_fetch_array($patient_query);
								$transs=$row_patient['patient_trans_id'];

						$insertp = mysql_query(" UPDATE patient_transaction set incharge_doc='$doc', patient_ward_no='$ward', patient_bed_no='$bed', patient_findings='$pfind', patient_doc_prescription='$ppresc' where patient_trans_id='$transs' ")or die(mysql_error());
						if ($insertp) {
							 header('location: patient_his.php?patient_id='.$patient_id);
						}
					
					}
				?>
     
      <!--prescriptiom modal-->
      
       <div id="prescription" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-plus-circle"></span> Prescription</button></div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px;margin-top: 20px;">
                    	<form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4">
                        	<select name="p_med" class="form-control" required="required">
	                       		<option>Select Medicines</option>
	                       		<option value="Biogesic">Biogesic</option>
	                       		<option value="Lopermide">Lopermide</option>
	                       		<option value="Diatabs">Diatabs</option>
	                       		<option value="Neozep">Neozep</option>
	                       	</select>
                        </div>
                        <div class="col-lg-4">	
                       	<input type="text" name="p_dos" class="form-control" placeholder="dosage">	
                        </div>
                        <div class="col-lg-4">
                        	<input type="text" name="p_dur" class="form-control" placeholder="duration"> 
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                    	<div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                    	<div class="col-md-6"><button type="submit" name="sub2" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add</button></div>
                    </div>
                    </div>
                    </div>
                    </form>
				   <?php include ('include/dbcon.php');

					if (isset($_POST['sub2'])) {
						$pmed = $_POST['p_med'];
						$pdos = $_POST['p_dos'];
						$pdur = $_POST['p_dur'];
						$doc_pres = $pmed." ".$pdos." ".$pdur;
								$patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
								$row_patient = mysql_fetch_array($patient_query);
								$transs=$row_patient['patient_trans_id'];

						$insertp = mysql_query(" UPDATE patient_transaction set patient_doc_prescription='$doc_pres' where patient_trans_id='$transs' ")or die(mysql_error());
						if ($insertp) {
							 header('location: patient_his.php?patient_id='.$patient_id);
						}
					
					}
				?>

<!--findings modal-->
<div id="finding" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-plus-circle"></span> Findings</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:black;">
                    	<form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-12" style="color:gray;font-size: 10px;">
                        	Patient Findings:
                        	<textarea name="findings" rows="3" cols="12" style="width:455px"></textarea>
                        </div>
                        
                    </div>
                    <div class="row" style="margin-top: 30px;">
                    	<div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('finding').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                    	<div class="col-md-6"><button type="submit" name="sub1" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add</button></div>
                    </div>
                   </div>
               </div>
             </form>
				   <?php include ('include/dbcon.php');

					if (isset($_POST['sub1'])) {
						$pfinding = $_POST['findings'];
								$patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
								$row_patient = mysql_fetch_array($patient_query);
								$transs=$row_patient['patient_trans_id'];

						$insertp = mysql_query(" UPDATE patient_transaction set patient_findings='$pfinding' where patient_trans_id='$transs' ")or die(mysql_error());
						if ($insertp) {
							 header('location: patient_his.php?patient_id='.$patient_id);
						}
					
					}
				?>
     
      <!--prescriptiom modal-->
       <div id="prescription" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-plus-circle"></span> Prescription</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:black;">
                    	<form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4">
                        	<select name="p_med" class="form-control" required="required">
	                       		<option>Select Medicines</option>
	                       		<option value="Biogesic">Biogesic</option>
	                       		<option value="Lopermide">Lopermide</option>
	                       		<option value="Diatabs">Diatabs</option>
	                       		<option value="Neozep">Neozep</option>
	                       	</select>
                        </div>
                        <div class="col-lg-4">	
                       	<input type="text" name="p_dos" class="form-control" placeholder="dosage">	
                        </div>
                        <div class="col-lg-4">
                        	<input type="text" name="p_dur" class="form-control" placeholder="duration"> 
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                    	<div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                    	<div class="col-md-6"><button type="submit" name="sub2" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add</button></div>
                    </div>
                    </div>
                    </div>
                    </form>
				   <?php include ('include/dbcon.php');

					if (isset($_POST['sub2'])) {
						$pmed = $_POST['p_med'];
						$pdos = $_POST['p_dos'];
						$pdur = $_POST['p_dur'];
						$doc_pres = $pmed." ".$pdos." ".$pdur;
								$patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
								$row_patient = mysql_fetch_array($patient_query);
								$transs=$row_patient['patient_trans_id'];

						$insertp = mysql_query(" UPDATE patient_transaction set patient_doc_prescription='$doc_pres' where patient_trans_id='$transs' ")or die(mysql_error());
						if ($insertp) {
							 header('location: patient_his.php?patient_id='.$patient_id);
						}
					
					}
				?>
	<!--addbillings modal-->
     <div id="billings" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-plus-circle"></span> Laboratory Billings</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:gray;">
                    	<form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4">
                        	<label>Lab. Name</label>
                        	<select name="lab_name" class="form-control" required="required">
	                       		<option>Select</option>
	                       		<option value="Blood Typing">Blood Typing</option>
	                       		<option value="CBC">CBC</option>
	                       		<option value="NS1 dengue test">NS1 dengue test</option>
	                       		<option value="HBsAg">HBsAg</option>
	                       		<option value="PSA">PSA</option>
	                       		<option value="Pregnancy Test">Pregnancy Test</option>
	                       		<option value="Urinalysis">Urinalysis</option>
	                       		<option value="Stoot Routine Exam">Stoot Routine Exam</option>
	                       		<option value="Albumin">Albumin</option>
	                       		<option value="Blood Urea Nitrogen">Blood Urea Nitrogen</option>
	                       		<option value="Blood Uric Acid">Blood Uric Acid</option>
	                       		<option value="Creatinine">Creatinine</option>
	                       		<option value="FBS">FBS</option>
	                       		<option value="Lipid Profile">Lipid Profile</option>
	                       		<option value="SGOT">SGOT</option>
	                       		<option value="SGPT">SGPT</option>
	                       		<option value="Na">Na</option>
	                       		<option value="K">K</option>
	                       		<option value="Cl">Cl</option>
	                       		<option value="Glycosylated Hgb">Glycosylated Hgb</option>

	                       	</select>
                        </div>
                        <div class="col-lg-4">	
		                       <label>Lab. Type</label>
		                        	<select name="lab_cat" class="form-control" required="required">
			                       		<option>Select</option>
			                       		<option value="HERMATOLOGY">HERMATOLOGY</option>
			                       		<option value="SEROLOGY">SEROLOGY</option>
			                       		<option value="CLINICAL MICROSCOPY">CLINICAL MICROSCOPY</option>
			                       		<option value="CHEMISTRY">CHEMISTRY</option>
			                       	</select>		
                        </div>
                        <div class="col-lg-4">
                        	<label>Lab. Price</label>
                        	<input type="text" name="lab_price" class="form-control" placeholder="price"> 
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                    	<div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                    	<div class="col-md-6"><button type="submit" name="sub_lab_bill" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add</button></div>
                    </div>
                    </div>
                    </div>
                    </form>
				   <?php include ('include/dbcon.php');

					if (isset($_POST['sub_lab_bill'])) {
								$bill_name = $_POST['lab_name'];
								$bill_cat = $_POST['lab_cat'];
								$bill_price = $_POST['lab_price'];
								$patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
								$row_patient = mysql_fetch_array($patient_query);
								$transs=$row_patient['patient_trans_id'];
								$trans_patientId = $row_patient['patient_id'];

						$insertp = mysql_query("INSERT into billings(bill_cat, bill_name, bill_price, bill_ptrans_id, bill_patient_id, bill_date) VALUES('$bill_cat','$bill_name','$bill_price','$transs','$trans_patientId',NOW() )")or die(mysql_error());
						if ($insertp) {

							 header('location: patient_his.php?patient_id='.$patient_id);
						}
					
					}
				?>