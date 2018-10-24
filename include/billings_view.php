<?php include ('include/dbcon.php');
$ID=$_GET['patient_trans_id'];
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
                        <h2><?php echo $ID; ?> Patient Billings History</h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->
<?php
  $patient_updates = mysql_query("SELECT * FROM user u left JOIN patient_transaction pt ON u.patient_id=pt.patient_id left JOIN billings b ON pt.patient_trans_id=b.bill_ptrans_id WHERE patient_trans_id='$ID'");
        $row_updates = mysql_fetch_array($patient_updates);
        
                        
  ?>

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
                            Trans/Bill No. <u style="color:teal"><?php  echo $row_updates['patient_trans_id'];; ?></u><br>
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
                            Date Discharge:<u style="color:teal">___<?php echo date('M d, Y h:i:sa',strtotime($row_updates['patient_date_discharge'])); ?>___</u>
                        </div>
                    </div>
                    <hr style="color:black">
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                        <div class="col-lg-6 text-center">
                            <center><h4><u><b>CHARGE</b></u></h4></center>
                        
                            <?php $timezone = "Asia/Manila";
                   if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone); ?>
                            <p>Subsistence and accommodation <br> from <u style="color:teal"><?php echo date('M d, Y h:i:sa',strtotime($row_updates['patient_date_incharge'])); ?></u> to <u style="color:teal"><?php 
                                                  echo date('M d, Y',strtotime($row_updates['patient_date_discharge']));
                                             
                                 ?></u></p>
                            <?php 
                                $datedischarge= $row_updates['patient_date_discharge'];
                                $dateadmitted = $row_updates['patient_date_incharge'];
                                $totaldays = round((float)(strtotime($datedischarge) - strtotime($dateadmitted)) / (60 * 60 *24));
                                $amountdue= 1 * 50;
                             ?>
                            <p>for <u style="color:teal"><?php echo $totaldays; ?></u> day/s <u style="color:red">(P50/day)</u></p><br>
                            <p>Physican's Fee ______________________</p>
                            <h4><u><b>special charges</b></u></h4>
                            
                        </div>
                        <div class="col-lg-6 text-center">
                            <center><h4><u><b>DUE FROM PATIENT</b></u></h4></center>
                            <br><br><br>
                                <u>___________________<b style="color:teal;font-size: 20px;"><?php  echo "P ".number_format($amountdue); ?></b>__________________</u>
                            <br><br>
                            ____________________________________________
                            <br><br>
                            
                        </div>
                        
                    </div>
                    
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">

                        <?php
                          $patient_update = mysql_query("SELECT * FROM user u left JOIN patient_transaction pt ON u.patient_id=pt.patient_id left JOIN billings b ON pt.patient_trans_id=b.bill_ptrans_id WHERE patient_trans_id='$ID'");
                                while($row_update = mysql_fetch_array($patient_update))
        
                                    {
                     ?>

                        <div class="col-lg-6 text-center">
                            
                        
                            <p style="color:teal;font-size: 20px;"><?php echo $row_update['bill_name']; ?></p>
                             ___________________________________
                            

                            
                        </div>
                        <div class="col-lg-6 text-center">
                            
                            
                            <p style="color:teal;font-size: 20px;"><?php if(empty($row_update['bill_price'])){  } else { echo "P ".number_format($row_update['bill_price']); }?></p>
                            ____________________________________________
                            <br>
                        </div>
                            <?php } ?>
                    </div>
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
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>