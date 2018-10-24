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
                                   <h3>Republic of the Philippines <br> Municipality of Buenavista <br> Rural Health Unit </h3>
                                    <p>(PHILHEALTH ACCREDITED)</p>
                                    <p>Tel. # 340-0249 / 340-0148   <br>  
                                    Fax # 341-3892 * COH # 236-1106</p>
                                    
                                    <b style="font-size:20px;">O F F I C I A L &nbsp; R E C E I P T</b>
                            </center>
                        </div><br>
                        <div><br>
                                <b>Name of Patient:</b> <u><?php echo $row_updates['firstname']." ". $row_updates['middlename']."  ".$row_updates['lastname']; ?></u>
                        </div>
                        <div align="right" style="margin-right: 100px;">
                                <b>Trans/Bill No.: </b><u style="color:teal"><?php echo $row_updates['patient_trans_id']; ?></u><br>
                        </div>
                        <div>
                                <b>Address:</b> <u><?php echo $row_updates['address']; ?></u>
                        </div>
                       
                    <hr style="color:black">
                    <div>
                                <?php echo str_repeat('&nbsp;',30);?><u><b>CHARGE</b></u><?php echo str_repeat('&nbsp;',70);?> <u><b>DUE FROM PATIENT</b></u>
                    </div>
                        <br><br>
                        <?php 
                                if(empty($row_updates['patient_date_discharge'])) { 
                                        if (date('M d, Y',strtotime($row_updates['patient_date_incharge'])) == date('M d, Y')) {
                                             $totaldays =1;
                                           
                                        }
                                        else{
                                            $datenow = date("Y-m-d H:i:s");
                                            $dateadmitted = $row_updates['patient_date_incharge'];
                                            $totaldays = round((float)(strtotime($datenow) - strtotime($dateadmitted)) / (60 * 60 *24));
                                        }
                                } 
                                else { 
                                       if (date('M d, Y',strtotime($row_updates['patient_date_discharge'])) == date('M d, Y')) {
                                                 $totaldays =1;
                                                  
                                             }
                                             else{
                                                  $datenow = date("Y-m-d H:i:s");
                                                  $dateadmitted = $row_updates['patient_date_incharge'];
                                                 $totaldays = round((float)(strtotime($datenow) - strtotime($dateadmitted)) / (60 * 60 *24));
                                                
                                             }
                                }
                                    $amountdue= $totaldays * 50;
                                 ?>

                        Room Accmodation___________________ <?php echo str_repeat('&nbsp;',45);?>__________<u><?php echo "P ".number_format($amountdue); ?></u>___________</p>
                        <br>
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
                        Laboratory__________________________ <?php echo str_repeat('&nbsp;',45);?>__________<u><?php echo "P ".number_format($rows); ?></u>___________</p>

                        <br>
                        Medicine____________________________ <?php echo str_repeat('&nbsp;',45);?>__________<u><?php echo "P ".number_format($med_rows); ?></u>___________</p>
                        <br>
                        <b>TOTAL DUE:</b> _______________________ <?php echo str_repeat('&nbsp;',45);?>__________<u><b><?php echo "P ".number_format($med_rows+$rows+$amountdue); ?></b></u>___________</p>
                        <p><?php echo str_repeat('&nbsp;',5);?> LESS: <u style="font-variant-caps: titling-case;"><?php echo $row_updates['patient_type_disc']; ?></u> DISC ___________________<?php echo str_repeat('&nbsp;',45);?>__________<u><b><?php echo "P ".number_format($row_updates['patient_total_discounted']); ?></b></u>___________</p>
                        <p><b>TENDERED AMOUNT:</b> ______________<?php echo str_repeat('&nbsp;',45);?>__________<u><b><?php echo "P ".number_format($row_updates['patient_tender_amount']); ?></b></u>___________</p>
                        
                         <p><?php echo str_repeat('&nbsp;',23);?><b>CHANGE:</b> ______________ <?php echo str_repeat('&nbsp;',45);?>__________<u><b><?php echo "P ".number_format($row_updates['patient_change']); ?></b></u>___________</p>
                    <br>
                    <p>  <?php echo str_repeat('&nbsp;',16);?>PREPARED BY: <?php echo str_repeat('&nbsp;',78);?> DATE PREPARED:
                        <br><br>
                      <?php echo str_repeat('&nbsp;',12);?>
                      <u><?php $select= mysql_query("SELECT * FROM admin where admin_type='Cashier'");

                          $row=mysql_fetch_array($select);
                          echo "<b style='font-variant-caps: all-petite-caps;'>".$row['firstname']." ".$row['middlename']." ".$row['lastname']."</b>";
                       ?></u>  <?php echo str_repeat('&nbsp;',78);?> <?php echo date('F d, Y h:i:sa'); ?>
    <br> <?php echo str_repeat('&nbsp;',8);?>
                      (Cashier-in-charge)

                    </p>

</body>
</html>
           