 <?php ob_start(); ?>
   <?php include ('include/dbcon.php'); ?>
   <?php $ID=$_GET['patient_trans_id']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/llc_logo.png">
    <title>Patient Billings</title>
</head>
<style type="text/css">
    @media print
        {
        #print {
                     display:none;
                }
        }
</style>
   <script>
       function printPage() {
         window.print();
       }
      </script>
<body style="width: 100%;" onload="printPage()">
     <?php 
                    $patient_updates = mysql_query("SELECT * FROM patient_transaction pt LEFT JOIN
  user u ON pt.patient_id=u.patient_id LEFT JOIN billings b ON u.patient_id=b.bill_patient_id WHERE patient_trans_id='$ID' ");
                                $row_updates = mysql_fetch_array($patient_updates);
                                

       ?>    
 <button id="print" onclick="printPage()">Print</button>                   
                        <div>
                            <center>
                                    <!-- <img src="images/llc_logo.png" width="200"> -->
                                     <h3>Republic of the Philippines <br> Municipality of Buenavista <br> Rural Health Unit </h3></h3>
                                    <p>(PHILHEALTH ACCREDITED)</p>
                                    <p>Tel. # 340-0249 / 340-0148   <br>  
                                    Fax # 341-3892 * COH # 236-1106</p>
                                    <b>S T A T E M E N T &nbsp; O F &nbsp; A C C O U N T</b>
                            </center>
                        </div><br>
                        <div>
                                <b>Name of Patient:</b> <u><?php echo $row_updates['firstname']." ". $row_updates['middlename']."  ".$row_updates['lastname']; ?></u>
                        </div>
                        <div align="right" style="margin-right: 100px;">
                                <b>Trans/Bill No.: </b><u style="color:teal"><?php echo $row_updates['patient_trans_id']; ?></u><br>
                                <b style="margin-right: 30px;">Ward No.:</b> <u style="color:teal;margin-right: 40px;"><?php echo $row_updates['patient_ward_no']; ?></u>
                                <br>
                                <b style="margin-right: 45px;">Bed No.:</b> <u style="color:teal;margin-right: 40px;"><?php echo $row_updates['patient_bed_no']; ?></u>
                        </div>
                        <div>
                                <b>Address:</b> <u><?php echo $row_updates['address']; ?></u>
                        </div>
                        <div align="right" style="margin-right: 70px;">
                                <b> Date Admitted: </b><u style="color:teal"><?php echo date('M d, Y',strtotime($row_updates['patient_date_incharge'])); ?></u><br>
                                <b>Date Discharge:</b> <?php if (empty($row_updates['patient_date_discharge'])) {
                        echo "_______";
                        } else {?><u style="color:teal">___<?php echo date('M d, Y h:i:sa',strtotime($row_updates['patient_date_discharge'])); } ?>___</u>
                                <br>
                               
                        </div>  
                    <hr style="color:black">
                    <div>
                                <?php echo str_repeat('&nbsp;',30);?><u><b>CHARGE</b></u><?php echo str_repeat('&nbsp;',70);?> <u><b>DUE FROM PATIENT</b></u>
                    </div>

                        <?php $timezone = "Asia/Manila";
                   if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone); ?>
                    <p>Subsistence and accomodation <br>   
                    from 

                    <u style="color:teal"><?php echo date('M d, Y',strtotime($row_updates['patient_date_incharge'])); ?></u> to <u style="color:teal">


                                <?php 
                                if(empty($row_updates['patient_date_discharge'])) { 
                                        if (date('M d, Y',strtotime($row_updates['patient_date_incharge'])) == date('M d, Y')) {
                                             $totaldays =1;
                                            echo "AS OF TODAYs";
                                        }
                                        else{
                                            $datenow = date("Y-m-d H:i:s");
                                            $dateadmitted = $row_updates['patient_date_incharge'];
                                            $totaldays = round((float)(strtotime($datenow) - strtotime($dateadmitted)) / (60 * 60 *24));
                                            echo "AS OF TODAY";
                                        }
                                } 
                                else { 
                                       if (date('M d, Y',strtotime($row_updates['patient_date_discharge'])) == date('M d, Y')) {
                                                 $totaldays =1;
                                                  echo date('M d, Y',strtotime($row_updates['patient_date_discharge']));
                                             }
                                             else{
                                                  $datenow = $row_updates['patient_date_discharge'];
                                                  $dateadmitted = $row_updates['patient_date_incharge'];
                                                 $totaldays = round((float)(strtotime($datenow) - strtotime($dateadmitted)) / (60 * 60 *24));
                                                  echo date('M d, Y',strtotime($row_updates['patient_date_discharge']));
                                             }
                                } ?>
                              </u>

                     <br>
                      <?php 
                                $amountdue= $totaldays * 50;
                           ?>
                    for <u style="color:teal"><?php echo $totaldays; ?></u> day/s <u style="color:red">(P50/day)</u>___________________ <?php echo str_repeat('&nbsp;',15);?>____________<u><?php echo "P ".number_format($amountdue); ?></u>_______________</p>
                    
                    <p><u>Special Charges</u></p>


                      <?php 
                   
                    $billingselek = mysql_query("SELECT * FROM billings  WHERE bill_ptrans_id='$ID'");
                    while($row=mysql_fetch_array($billingselek))
                    { ?>


                     <p>
                       <?php echo str_repeat('&nbsp;',22);?> ______<u><?php echo $row['bill_name']; ?></u>_____<?php echo str_repeat('&nbsp;',35);?>____________<u><?php echo "P " .$row['bill_price']; ?></u>______________
                    </p>  

                    <?php } ?>
                    <?php 
                          $billq = mysql_query("SELECT sum(bill_price) as total_bill from billings where bill_ptrans_id='$ID' ");
                          while($row = mysql_fetch_array($billq))
                          {
                          $rows =$row['total_bill'];
                          }


                           $bill_med = mysql_query("SELECT sum(mb_total) as total_mb from med_billings where patient_trans_id='$ID'");
                          while($med_row = mysql_fetch_array($bill_med))
                          {
                          $med_rows =$med_row['total_mb'];
                          }
                     ?>

                    <p>
                    Medicines <br>  

                      <?php 
                   
                    $billingmed = mysql_query("SELECT * FROM med_billings  WHERE patient_trans_id='$ID'");
                    while($rowmed=mysql_fetch_array($billingmed))
                    { ?>

                     <?php echo str_repeat('&nbsp;',20);?><u><?php echo $rowmed['mb_desc']."&nbsp;(".$rowmed['mb_qty']." x"."&nbsp;P".$rowmed['mb_price'].")"; ?></u> <?php echo str_repeat('&nbsp;',20);?>_______________<u><?php echo "P".number_format($rowmed['mb_total']); ?></u>____________

                     <?php } ?>
                    <br><br> <?php echo str_repeat('&nbsp;',12);?>TOTAL AMOUNT<?php echo str_repeat('&nbsp;',45);?>______________<u style="font-size: 20px;"><?php echo "P ".number_format($rows + $amountdue + $med_rows); ?></u>_____________
                    </p><br>
                    <p>  <?php echo str_repeat('&nbsp;',16);?>PREPARED BY: <?php echo str_repeat('&nbsp;',78);?> DATE PREPARED:
                        <br><br>
                      <?php echo str_repeat('&nbsp;',12);?>
                      <u><?php $select= mysql_query("SELECT * FROM admin where admin_type='Billings'");

                          $row=mysql_fetch_array($select);
                          echo "<b style='font-variant-caps: all-petite-caps;'>".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</b>";
                       ?></u>  <?php echo str_repeat('&nbsp;',68);?> <?php echo date('F d, Y h:i:sa'); ?>
    <br> <?php echo str_repeat('&nbsp;',12);?>
                      (Billing-in-charge)

                    </p>

</body>
</html>
           