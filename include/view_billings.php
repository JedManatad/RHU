  <!--view billlings-->
     <?php 

      				$patient_updates = mysql_query("SELECT * FROM patient_transaction pt LEFT JOIN
  user u ON pt.patient_id=u.patient_id LEFT JOIN billings b ON u.patient_id=b.bill_patient_id WHERE patient_trans_id='$rp' and patient_status='Inactive' ");
	$row_updates = mysql_fetch_array($patient_updates);
								

       ?>    
       <div id="viewbillings" class="modal">
            <form method="POST" style="width: 600px;" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-eye"></span> <?php echo $rp; ?> Billings</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:black;zoom:50%;">
                    	<div class="col-md-3 text-right">
                    		<img src="images/llc_logo.png" width="200">
                    	</div>
                    	<div class="col-lg-6 text-center">
                    			<h3>Republic of the Philippines <br> City of Lapu-lapu <br> Lapu-lapu City Hospital <br> Lapu-lapu City 6015</h3>
                    			<h2>(PHILHEALTH ACCREDITED)</h2>
                    			<p>Tel. # 340-0249 / 340-0148</p>
                    			<p>Fax # 341-3892 * COH # 236-1106</p>
                    	</div>
                    	<div class="col-md-3">
                    		<img src="images/llc_logo.png" width="200">
                    	</div>
                    </div>
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                    	<div class="col-lg-6  text-center" >
                    		<u style="color:teal"><?php echo  $row_updates['firstname']." ".$row_updates['middlename']." ".$row_updates['lastname']; ?></u> <br>
                    		<center>(Name of Patient)</center>
                    	</div>
                    	<div class="col-lg-6">
                    		Trans/Bill No. <u style="color:teal"><?php  echo $rp; ?></u><br>
                    		Ward No. <u style="color:teal">_____<?php echo $row_updates['patient_ward_no']; ?>_____</u>
                    	</div>
                    </div>
                    <div class="row" style="margin-top:10px;color:black;zoom:50%;">
                    	<div class="col-lg-6 text-center" >
                    		<u style="color:teal">__<?php echo $row_updates['address']; ?>__</u>
                    		<br>
                    		<center>(Address)</center>
                    	</div>
                    	<div class="col-lg-6">
                    		Bed No. <u style="color:teal">_____<?php echo $row_updates['patient_bed_no']; ?>_____</u>
                    		<br>
                    		Date Admitted:<u style="color:teal">___<?php echo date('M d, Y h:i:sa',strtotime($row_updates['patient_date_incharge'])); ?>___</u>
                    		<br>
                    		Date Discharge:	 <?php if (empty($row_updates['patient_date_discharge'])) {
                    		echo "_______________________";
                    		} else {?><u style="color:teal">___<?php echo date('M d, Y h:i:sa',strtotime($row_updates['patient_date_discharge'])); } ?>___</u>
                    	</div>
                    </div>
                    <hr style="color:black">
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                    	<div class="col-lg-6 text-center">
                    		<center><h4><u><b>CHARGE</b></u></h4></center>
                    	
                    		<?php $timezone = "Asia/Manila";
                   if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone); ?>
                            <p>Subsistence and accommodation <br> from <u style="color:teal"><?php echo date('M d, Y h:i:sa',strtotime($row_updates['patient_date_incharge'])); ?></u> to <u style="color:teal"><?php if(empty($row_updates['patient_date_discharge'])) { 
                                        if (date('M d, Y',strtotime($row_updates['patient_date_incharge'])) == date('M d, Y')) {
                                            $datenow = date("Y-m-d H:i:s") +1 ;
                                            echo "AS OF TODAYs";
                                        }
                                        else{
                                            $datenow = date("Y-m-d H:i:s");
                                            echo "AS OF TODAY";
                                        }
                                } 
                                else { 
                                       if (date('M d, Y',strtotime($row_updates['patient_date_discharge'])) == date('M d, Y')) {
                                                  $datenow = date("Y-m-d H:i:s") + 1;
                                                  echo date('M d, Y',strtotime($row_updates['patient_date_discharge']));
                                             }
                                             else{
                                                  $datenow = date("Y-m-d H:i:s");
                                                  echo date('M d, Y',strtotime($row_updates['patient_date_discharge']));
                                             }
                                } ?></u></p>
                            <?php 
                                $dateadmitted = $row_updates['patient_date_incharge'];
                                $totaldays = round((float)(strtotime($datenow) - strtotime($dateadmitted)) / (60 * 60 *24));
                                $amountdue= $totaldays * 50;
                             ?>
                            <p>for <u style="color:teal"><?php echo $totaldays; ?></u> day/s <u style="color:red">(P50/day)</u></p><br>
                    		<p>Physican's Fee ______________________</p>
                    		<h4><u><b>special charges</b></u></h4>
                    		
                    	</div>
                    	<div class="col-lg-6 text-center">
                    		<center><h4><u><b>DUE FROM PATIENT</b></u></h4></center>
                    		<br><br><br>
                    			<u>___________________<b style="color:teal;font-size: 20px;"><?php echo "P ".number_format($amountdue); ?></b>__________________</u>
                    		<br><br>
                    		____________________________________________
                    		<br><br>
                    		
                    	</div>
                    	
                    </div>
                    	
                  		<?php 
                  		$users = mysql_query("SELECT * from patient_transaction where patient_id='".$user_row['patient_id']."'");
								while($foru= mysql_fetch_array($users))
								{
									$for =$foru['patient_trans_id'];
								}
										$billingselek = mysql_query("SELECT * FROM billings  WHERE bill_ptrans_id='$for'");
										while($row=mysql_fetch_array($billingselek))
										{	
											
										

							 ?>
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                    	<div class="col-lg-6 text-center">
                    		
                    	
                    		<p style="color:teal;font-size: 20px;"><?php echo $row['bill_name']; ?></p>
                    		 ___________________________________
                    		

                    		
                    	</div>
                    	<div class="col-lg-6 text-center">
                    		
                    		
                    		<p style="color:teal;font-size: 20px;"><?php echo "P ".number_format($row['bill_price']); ?></p>
                    		____________________________________________
                    		<br>
                    	</div>
                    </div>
                    <?php } ?>
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                    	<div class="col-lg-6 text-center">
                    		
                    		 <br><br> 
                    		 <p>Anesthesias Fee ____________________</p>
                    		 <br><br>
                    		 <p>Medicines  ________________________</p>

                    		 <br><br>
                    		 <p>total amount ________________________</p>
                    		 <br><br>
                    		 <b>prepared by:</b>
                    		 <br><br>
                    		 <u>__________________</u><br>
                    		 Administrative Assistant iii
                    		 <br>(billinfg in-charge)

                    		
                    	</div>
                    	<div class="col-lg-6 text-center">
                    		<br>
                    		____________________________________________
                    		<br><br>
                    		
                    		<br><br>
                    		____________________________________________
                    		<br><br>
                    		<p style="color:teal;font-size: 20px;"><?php echo "P ".number_format($row_updates['patient_total_bills']); ?></p>
                    		____________________________________________
                    	</div>
                    	
                    </div>

                    <div class="row" style="margin-top: 30px;">
                    	<div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> Exit</button></div>
                    	<div class="col-md-6"><button type="submit" name="sub2" class="btn btn-warning"><span class="fa fa-plus-circle"></span> Print</button></div>
                    </div>
                    </div>
                    </div>
                    </form>