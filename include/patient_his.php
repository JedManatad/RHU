<?php include ('header.php'); ?>
<?php 
  $patient_id = $_GET['patient_id'];
  
  $user_query = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
  $user_row = mysql_fetch_array($user_query);
?>
        <div class="page-title">
            <div class="title_left">

                <h3>
          Patient Transaction 
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 <link rel="stylesheet" type="text/css" href="../asset/users/css/modalform.css" />
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
          
          <?php
            $sql = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
            $row = mysql_fetch_array($sql);
          ?>
          <h2>
          Patient Name : <span style="color:maroon;"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']." (".$row['patient_id'].")"; ?></span>
          </h2>
          <ul class="nav navbar-right panel_toolbox">
            <?php  $emp= mysql_query("SELECT * FROM admin where admin_id='$id_session'")or die(mysql_error());
                            $emprow=mysql_fetch_array($emp);
                            $sqlcount = mysql_query("SELECT * FROM patient_transaction where patient_id ='$patient_id' ");
                            while($scount_row = mysql_fetch_array($sqlcount))
                            {
                                $patient_trans_id = $scount_row['patient_trans_id'];
                            }
                            $sqls = mysql_query("SELECT * FROM patient_transaction where patient_trans_id='$patient_trans_id'");
                            while($rowsql = mysql_fetch_array($sqls)) 
                            {
                                if($rowsql['patient_status']=='Active')
                                {
                                    $disp = "none";
                                }
                                else
                                {   
                                         $disp = "display";
                                }
                            }
                                
                         ?>
                            <li>
                        <form method="post" action="">
                          <input type="hidden" name="patient_id" value="<?php echo $row['patient_id']; ?>">
                            <?php  if($emprow['admin_type'] == 'Clerk' or $emprow['admin_type'] == 'Billings' or $emprow['admin_type'] == 'Cashier' or $emprow['admin_type'] == 'Laboratory' or $emprow['admin_type'] == 'Pharmacist' )
                                    { } else {?>
              <button style="width:190px;display:<?php echo $disp; ?>;text-align:center;font-variant-caps: all-petite-caps;" class="btn btn-primary" name="submit2"><i class="fa fa-plus-square"></i> New Record</button>   <?php } ?>          
                          </form>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <?php
  include ('include/dbcon.php');

  if (isset($_POST['submit2'])) {

  $patient_id = $_POST['patient_id'];

  $sql = mysql_query("SELECT * FROM user WHERE patient_id = '$patient_id' ");
  $count = mysql_num_rows($sql);
  $row = mysql_fetch_array($sql);

    if($count <= 0){
      echo "<script>alert('There is already ongoing transaction')</script>";
    }else{
      
      header('location: add_new_trans.php?patient_id='.$patient_id);
    }
  }
  ?>
                        <!-- content starts here -->
            <?php 
              $showtables = mysql_query("select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
                             while($shows = mysql_fetch_array($showtables))
                             {
                             $transx = $shows['patient_trans_id'];
                             }

              $showtable = mysql_query("select * from patient_transaction where patient_trans_id='$transx' ");
                             $show = mysql_fetch_array($showtable);
                             if ($show['patient_status']=='Active') {
                              
                            
             ?>
            <div  class="table-responsive text-center">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered"><!-- id="example" -->
                
              <thead>
                <tr>
                  <th>Transaction #</th>
                  <th>Incharge Doctor</th>
                  <th>Ward Name</th>
                  <th>Bed #</th>
                  <th>Guardian Name</th>
                  <th>Date Admitted</th>
                  <th>Admitting Diagnosis</th>
                  <th>Date Discharge</th>
                  <th>Final Diagnosis</th>
                  <th>Doctors Prescription</th>
                  <th>Total Billings</th>
                                    <?php 
                                        if($emprow['admin_type'] == 'Laboratory')
                                        {
                                        }
                                        else
                                        {
                                     ?>
                  <th>Action</th>
                                    <?php } ?>
                </tr>
              </thead>
              <tbody>
              <?php 
                $user = mysql_query("SELECT * from patient_transaction where patient_id='".$user_row['patient_id']."'");
                while($rowuser= mysql_fetch_array($user))
                {
                  $trans_id = $rowuser['patient_trans_id'];
                }
                
                $billq = mysql_query("SELECT sum(bill_price) as total_bill from billings where bill_ptrans_id='$trans_id' ");
                while($row = mysql_fetch_array($billq))
                {
                $rows =$row['total_bill'];
                }


                           $bill_med = mysql_query("SELECT sum(mb_total) as total_mb from med_billings where patient_trans_id='$trans_id' order by mb_id ASC ");
                          while($med_row = mysql_fetch_array($bill_med))
                          {
                          $med_rows =$med_row['total_mb'];
                          }
                         

                $patient_query = mysql_query("SELECT * from patient_transaction Left join user ON patient_transaction.patient_id = user.patient_id where patient_trans_id='$transx' and patient_status='Active' ");
                while($row_patient = mysql_fetch_array($patient_query))
                  {
              ?>
              <tr>
                <td><?php echo $row_patient['patient_trans_id'];  ?></td>
                <td><?php echo $row_patient['incharge_doc'];  ?></td>
                <td><?php echo $row_patient['patient_ward_no'];?></td>
                <td><?php echo $row_patient['patient_bed_no']; ?></td>  
                <td><?php echo $row_patient['guardian']; ?></td>
                <td><?php echo date('F d, Y',strtotime($row_patient['patient_date_incharge'])); ?></td>
                <td><?php echo $row_patient['patient_admit_diagnos']; ?></td>
                                <td><?php if(empty($row_patient['patient_date_discharge'])){
                                    if($emprow['admin_type']== 'Clerk' or $emprow['admin_type']== 'Cashier' or $emprow['admin_type']== 'Laboratory' or $emprow['admin_type']== 'Pharmacist' or $emprow['admin_type']== 'Billings')
                                    {   ?>
                                            <button class="btn btn-danger" onclick="alert('Only nurse can Discharge Patient!')">Discharge</button>
                                <?php    }
                                    else{


                                 ?> <form method="POST"> <button name="discharge" class="btn btn-danger">Discharge</button> </form>
                                 <?php } } else { echo date('F d, Y h:i:sa', strtotime($row_patient['patient_date_discharge']));} ?></td>
                                <?php 
                                        if(isset($_POST['discharge']))
                                        {
                                            $curdate = date('Y-m-d H:i:s');
                                            $u_discharge = mysql_query("UPDATE patient_transaction SET patient_date_discharge='$curdate' where patient_trans_id='".$row_patient['patient_trans_id']."' ")or die(mysql_error());
                                            if($u_discharge)
                                            {
                                                header('location: patient_his.php?patient_id='.$patient_id);
                                            }
                                        }

                                 ?>
                <!-- <!-- <?php 
                          
                        if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone); 
                          $dateadmitted = $row_patient['patient_date_incharge'];
                          $datenow = date("Y-m-d H:i:s");
                          $totaldays = round((float)(strtotime($datenow) - strtotime($dateadmitted)) / (86400));
                          $totalamount= $totaldays * 50;
                          $overalltotal = $totalamount + $rows;
                         ?> --> 
                         <?php if(empty($row_patient['patient_date_discharge'])) { 
                                        if (date('M d, Y',strtotime($row_patient['patient_date_incharge'])) == date("M d, Y")) {
                                             $totaldays = 1;
                                            
                                        }
                                        else{
                                            $datenows = date("Y-m-d H:i:s");
                                             $dateadmitted = $row_patient['patient_date_incharge'];
                                             $totaldays = round((float)(strtotime($datenows) - strtotime($dateadmitted)) / (60 * 60 *24));
                                        
                                        }
                                } 
                                else { 
                                if (date('M d, Y',strtotime($row_patient['patient_date_discharge'])) == date("M d, Y")) {
                                            $totaldays = 1;
                                            
                                        }
                                        else{
                                            $datenows = $row_patient['patient_date_discharge'];
                                             $dateadmitted = $row_patient['patient_date_incharge'];
                                            $totaldays = round((float)(strtotime($datenows) - strtotime($dateadmitted)) / (60 * 60 *24));
                                        
                                        }
                                    
                                }
                                $amountdues= $totaldays * 50;
                                $totalamount = $rows + $amountdues + $med_rows;
                                ?>

                <td><?php if(empty($row_patient['patient_findings'])){
                                     if($emprow['admin_type']== 'Clerk' or $emprow['admin_type'] == 'Cashier' or $emprow['admin_type'] == 'Laboratory' or $emprow['admin_type'] == 'Pharmacist' or $emprow['admin_type'] == 'Billings')
                                    {   ?>
                                            <button style="width: 80px;" class="btn btn-primary" onclick="alert('Only nurse can Input Findings!')">INPUT</button>
                                <?php    }
                                    else{

                                  ?>
                <button style="width: 80px;" class="btn btn-primary" onclick="document.getElementById('finding').style.display='block'">INPUT</button>
                <?php }
                                 }else{echo $row_patient['patient_findings'];}  ?></td>

                <td><?php if(empty($row_patient['patient_doc_prescription'])){
                                    if($emprow['admin_type']=='Clerk' or $emprow['admin_type']== 'Cashier' or $emprow['admin_type'] == 'Laboratory' or $emprow['admin_type'] == 'Pharmacist' or $emprow['admin_type'] == 'Billings')
                                    {   ?>
                                            <button style="width: 80px;" class="btn btn-primary" onclick="alert('Only nurse can Input Prescription!')">INPUT</button>
                                <?php    }
                                    else{
               ?> 
                        <button style="width: 80px;" class="btn btn-primary" onclick="document.getElementById('prescription').style.display='block'">INPUT</button>
                       <?php }
                }else{echo $row_patient['patient_doc_prescription']; } ?></td>
                <td><?php if (empty($rows)) {
                  echo "P".number_format($totalamount);
                }else { echo "P".number_format($totalamount); } ?></td>

                                <?php 
                                        if($emprow['admin_type'] == 'Laboratory')
                                        {
                                        }
                                        else
                                        {
                                     ?>
                                        <td>
                                    <?php 
                                        if($emprow['admin_type'] == 'Clerk' or $emprow['admin_type'] == 'Cashier' or $emprow['admin_type'] =='Laboratory'  or $emprow['admin_type'] == 'Pharmacist' or $emprow['admin_type'] =='Billings')
                                        { ?>
                                            <button class="btn btn-success" onclick="alert('You are not authorized to edit this!')"><span class="fa fa-edit"></span> Update</button>
                                        <?php }
                                        else{
                                     ?>
                                    <button class="btn btn-success" onclick="document.getElementById('updateinfo').style.display='block'"><span class="fa fa-edit"></span> Update</button> <button class="btn btn-primary" onclick="document.getElementById('pdatasheet').style.display='block'"><span class="fa fa-eye"></span> View</button> <?php } ?>
                                </td>

                                    <?php } ?>
                
              </tr>
              <?php 
                               $pdd= $row_patient['patient_date_discharge'];
                               $id= $row_patient['patient_trans_id'];
                               $stat = $row_patient['patient_status'];
                               $pi= $row_patient['patient_id'];
                        } ?>
              
            </table>
            
            
          </div>
          
          </div>
                     <?php 
                            if($emprow['admin_type'] == 'Clerk' or $emprow['admin_type'] == 'Nurse')
                            {

                            }
                            else
                            {
                          ?>
          <div class="row">
            <div class="col-md-2">
                             <?php 
                                if($emprow['admin_type'] == 'Billings')
                                {

                                } else {

                                    if($emprow['admin_type'] == 'Pharmacist')
                                    { ?>
                                                <button style="font-variant-caps: all-petite-caps;text-align: left;width: 187px;" class="btn btn-primary" onclick="document.getElementById('medicine').style.display='block'"><span class="fa fa-plus-circle"></span> Input Medicines</button> 
                                  <?php  } else {
                              ?>
                              <?php 
                                if($emprow['admin_type'] == 'Cashier')
                                    { ?>


                                        <button class="btn btn-success" style="display: <?php echo $diss; ?>;font-variant-caps: all-petite-caps;text-align: left;width: 187px;" onclick="document.getElementById('viewbillings').style.display='block'" ><span class="fa fa-eye"></span> View Billings</button>


                                    <?php  

                                      $viewbill='none';
                                     }else{
                               ?>
            <button style="font-variant-caps: all-petite-caps;text-align: left;width: 187px;" class="btn btn-primary" onclick="document.getElementById('billings').style.display='block'"><span class="fa fa-plus-circle"></span> Input Laboratory</button> 
                                    <?php } } }?>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-4 text-right">
                                    <?php
                                          if($emprow['admin_type'] == 'Laboratory')
                                          { ?>
                                                <!-- <a href="print_billings.php<?php echo '?patient_trans_id='.$id; ?>" target="_blank"><button class="btn btn-warning" style="display: <?php echo $diss; ?>;font-variant-caps: all-petite-caps;text-align: left;width: 187px;" ><span class="fa fa-print"></span> Update Laboratory</button></a> -->
                                         <?php   } 
                                         else {  

                                                    if($emprow['admin_type'] == 'Billings'or $emprow['admin_type'] == 'Pharmacist')
                                                    {

                                                    }
                                                    else {
                                             ?>          
                                                    <?php if($pdd != null){ ?>
                                                    <button style="width: 187px;text-align: left;font-variant-caps: all-petite-caps;" class="btn btn-warning" onclick="document.getElementById('payments').style.display='block'"><span class="fa fa-money"></span> Recieve Payments</button>
                                                <?php } else { ?>
                                                    <button style="width: 187px;text-align: left;font-variant-caps: all-petite-caps;" class="btn btn-warning" onclick="alert('The Patient must discharge first!')"><span class="fa fa-money"></span> Recieve Payments</button>
                                                  <?php } } }
                                    
                             ?>
                        </div>
          </div>
          <?php   } $display ="none"; }
            else{
              echo "<center><h2 style='color:red;'>No new data yet!</h2></center>";
              $diss ="none";
            } ?>
          <div class="row">

            <div class="col-md-2">
                             <?php 
                                if($emprow['admin_type']=='Nurse' or $emprow['admin_type'] =='Clerk')
                                {   
                                             if($emprow['admin_type']=='Nurse')
                                            {   ?>
<!-- 
                                                    <button class="btn btn-success" style="display: <?php echo $diss; ?>;font-variant-caps: all-petite-caps;text-align: left;width: 187px;" onclick="document.getElementById('viewbillings').style.display='block'" ><span class="fa fa-send"></span> Send Lab. Request</button> -->

                                            <?php    }

                                }
                                else{
                             ?>
                            <button class="btn btn-success" style="display: <?php if($emprow['admin_type'] == 'Cashier'){ echo $viewbill; } echo $diss; ?>;font-variant-caps: all-petite-caps;text-align: left;width: 187px;" onclick="document.getElementById('viewbillings').style.display='block'" ><span class="fa fa-eye"></span> View Billings</button>
                            <?php } ?>
                        </div>

            <div class="col-md-6"></div>
            <div class="col-md-4 text-right">
                          
                                    <a href="phistory.php<?php echo '?patient_id='.$patient_id; ?>">
                    <button type="submit" style="width: 187px;text-align: left;font-variant-caps: all-petite-caps; display: <?php echo $display; ?>;" class="btn btn-danger" style="color:white;"><span class="fa fa-history"></span>  &nbsp;Patient History</button></a>
                             
            </div>
          </div>  
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
             <!--payment modal--> 
             <?php include ('payment.php'); ?>
             <script>
function payment() {
            var txtFirstNumberValue = document.getElementById('amount_due').value;
            var txtSecondNumberValue = document.getElementById('amount_tender').value;
            var txtThirdNumberValue = document.getElementById('discount').value;
            var result = parseFloat(txtFirstNumberValue) - (parseFloat(txtThirdNumberValue) / 100) * parseFloat(txtFirstNumberValue);
            var change = parseFloat(txtSecondNumberValue) - parseFloat(result);
            var ndchange = parseFloat(txtSecondNumberValue) - parseFloat(txtFirstNumberValue);
           
                    if (!isNaN(result)) {
                    document.getElementById('txt3').value = result;
                        
                    }
                    if(!isNaN(change))
                    {
                        document.getElementById('change').value = change;
                    }
                    if(!isNaN(ndchange))
                    {
                        document.getElementById('ndchange').value = ndchange;
                    }
            }
        $(document).ready(function(){
            $('#discount').click(function(){
                $('#ndchange').hide();
                $('#change').show();
            });
        });
        // $(document).ready(function(){
        //     $('#hasd').click(function(){
        //         $('#discount_row').show();
        //         $('#discount_rows').show();
        //         $('#change').show();
        //         $('#ndchange').hide();
        //     });
        // });
        // $(document).ready(function(){
        //     $('#no').click(function(){
        //         $('#discount_row').hide();
        //         $('#discount_rows').hide();
        //         $('#discount').val("");
        //         $('#change').hide();
        //         $('#change').val("");
        //         $('#txt3').val("");
        //         $('#disc_id').val("");
        //         $('#ndchange').show();
        //     });
        // });
    function mewhat(val){
    if(val != ''){
        if(val == 'Government'){
            $('#disc_id').hide();
            $("#off_name").show();
        }
        else{
            $("#off_name").hide();
            $('#disc_id').show();
        }
    }
    else{
        $("#off_name").hide();
        $('#disc_id').hide();
    }
    }    
    function detDiscount(val){
    
        if(val == 'No'){
            $('#discount_row').hide();
                $('#discount_rows').hide();
                $('#discount').val("");
                $('#change').hide();
                $('#change').val("");
                $('#txt3').val("");
                $('#disc_id').val("");
                $('#ndchange').show();
        }
        else if(val == 'Yes'){
            $('#discount_row').show();
                $('#discount_rows').show();
                $('#change').show();
                $('#ndchange').hide();
        }
        else
        {

        }
    
    
}
</script>

             


  <!-- update patient_transaction -->    
  <?php 
            $users = mysql_query("SELECT * from patient_transaction where patient_id='".$user_row['patient_id']."'");
                while($foru= mysql_fetch_array($users))
                {
                  $for =$foru['patient_trans_id'];
                }
              $patient_update = mysql_query("SELECT * from patient_transaction Left join user ON patient_transaction.patient_id = user.patient_id where patient_trans_id='$for' ");
                while($row_update = mysql_fetch_array($patient_update))
                {

       ?>       
<div id="updateinfo" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-edit"></span> Update Patient Transaction</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:gray;font-size: 10px;">
                        <div class="col-md-8">
                          <p>Patient Name :</p><span style="color:teal;font-variant-caps: all-petite-caps;font-size: 12px;"><?php echo $row_update['firstname']." ".$row_update['middlename']." ".$row_update['lastname']; ?></span>  
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
                        Ward Name:<input type="text" name="ward" value="<?php echo $row_update['patient_ward_no']; ?>" class="form-control">
                      </div>
                      <div class="col-md-4">
                        Bed #:<input type="text" name="bed" value="<?php echo $row_update['patient_bed_no']; ?>" class="form-control">
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
                        <textarea  value="<?php echo $row_update['patient_findings']; ?>" name="presc" rows="3" cols="12" style="width:455px"><?php echo $row_update['patient_doc_prescription']; ?></textarea>
                      </div>
                    </div>
                    <div class="row" style="color:gray;font-size: 10px; margin-top: 10px;">
                      <div class="col-md-4"></div>
                      <div class="col-md-4 text-center">
                        <!-- Total Billings
                        <input style="text-align: center;" class="form-control" type="text" name="" value="<?php if(empty($rows)){ echo '0'; }else{echo 'P'.$rows;} ?>" readonly="readonly"> -->
                      </div>
                      
                      <div class="col-md-4"></div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                      <div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('updateinfo').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                      <div class="col-md-6"><button type="submit" name="update" class="btn btn-success"><span class="fa fa-check-circle"></span> Update</button></div>
                    </div>
                   </div>
               </div>
             </form><?php } ?>
           <?php include ('include/dbcon.php');

          if (isset($_POST['update'])) {
            $doc = $_POST['p_doc_name'];
            $ward = $_POST['ward'];
            $bed = $_POST['bed'];
            $pfind = $_POST['p_finds'];
            $ppresc = $_POST['presc'];
                $patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
                while($row_patient = mysql_fetch_array($patient_query))
                {
                  $transs=$row_patient['patient_trans_id'];
                }
                

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
                        <div class="col-lg-6">
                          <select name="p_med" class="form-control" required="required">
                            <option>Select Medicines</option>
                            <?php 
                              $med =mysql_query("SELECT * FROM medicine");
                              while($row=mysql_fetch_array($med))
                              { ?>
                                  <option value="<?php echo $row['med_name']; ?>"><?php echo $row['med_name']; ?></option>
                            <?php  }

                             ?>
                          </select>
                        </div>
                        <div class="col-lg-6">
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
            $pdur = $_POST['p_dur'];
            $doc_pres = $pmed." ".$pdur;
                $patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
                while($row_patient = mysql_fetch_array($patient_query))
                {
                  $transs=$row_patient['patient_trans_id'];
                }
                

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
                while($row_patient = mysql_fetch_array($patient_query))
                {
                  $transs=$row_patient['patient_trans_id'];
                }
                

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
     <!--add Lab billings modal-->
     <div id="billings" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-plus-circle"></span> Laboratory Billings</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:gray;">
                      <form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-2">
                            
                        </div>
                        <div class="col-lg-4">
                          <label>Lab. Name</label>
                          <select name="lab_name" id="lab_name" class="form-control">
                                <?php 
                                    $select_labtype = mysql_query("SELECT * FROM laboratory ");
                                    while ($row_labtype = mysql_fetch_array($select_labtype)) {
                                 ?>
                                 <option value="<?php echo $row_labtype['lab_name']; ?>"><?php echo $row_labtype['lab_name']; ?></option>
                                 <?php } ?>
                          </select> 
                        </div>
            <script type="text/javascript" src="js/jquery-1.10.2.js"></script>          
                        <div class="col-lg-4">
                            <label>Lab Price</label>
                          <select name="lab_price" id="lab_price"  class="form-control">  
                            </select>
                        </div>
                        <div class="col-md-2"></div>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $('#lab_name').change(function(){
                                    var lab_name = $(this).val();
                                    $.ajax({
                                        url: "getLabprice.php",
                                        method: "POST",
                                        data:{labName:lab_name},
                                        dataType:"text",
                                        success:function(data)
                                        {
                                            $('#lab_price').html(data);
                                        }
                                    });
                                });
                            }); 
                        </script>
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
                $bill_price = $_POST['lab_price'];
                $patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
                while($row_patient = mysql_fetch_array($patient_query))
                {
                $transs=$row_patient['patient_trans_id'];
                $trans_patientId = $row_patient['patient_id'];
                }

            $insertp = mysql_query("INSERT into billings(bill_name, bill_price, bill_ptrans_id, bill_patient_id, bill_date) VALUES('$bill_name','$bill_price','$transs','$trans_patientId',NOW() )")or die(mysql_error());
            if ($insertp) {

               header('location: patient_his.php?patient_id='.$patient_id);
            }
          
          }
        ?>
     <!--add pharma billings modal-->
     <div id="medicine" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-plus-circle"></span> Medicine Billings</button></div>
                    </div>
                    <div class="row" style="margin-top:50px;color:gray;">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4">
                            Description
                            <select name="med_name" id="med_name" class="form-control">
                                  <option>Select Medicines</option>
                                <?php 
                                    $select_med = mysql_query("SELECT * FROM medicine ");
                                    while ($row_med = mysql_fetch_array($select_med)) {
                                 ?>
                                 <option value="<?php echo $row_med['med_name']; ?>"><?php echo $row_med['med_name']; ?></option>
                                 <?php } ?>
                            </select> 
                        </div> 
                        <div class="col-lg-2">
                            Qty
                                <input type="text" id="qty" name="med_qty" placeholder="qty" class="form-control" onkeyup="total();">
                        </div>        
                        <div class="col-lg-4" id="meds_price" >
                            Price
                            <input type="text" placeholder="price" class="form-control" onkeyup="total();" >
                        </div>
                       <div class="col-lg-2">
                        Total
                            <input type="text" id="result" name="med_total" placeholder="total" class="form-control" onkeyup="total();" >
                        </div>
        <script>
                 function total(){

                        var price = document.getElementById('price').value;
                        var qty = document.getElementById('qty').value;
                       
                        var result = parseFloat(price) * parseFloat(qty);
                                if (!isNaN(result)) {
                                document.getElementById('result').value = result;
                                    
                                }
                            }
                            $(document).ready(function(){
                                $('#med_name').change(function(){
                                    var med_name = $(this).val();
                                    $.ajax({
                                        url: "getMedprice.php",
                                        method: "POST",
                                        data:{medName:med_name},
                                        dataType:"text",
                                        success:function(data)
                                        {
                                            $('div#meds_price').html(data);
                                        }
                                    });
                                });
                            }); 
                        </script>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                        <div class="col-md-6"><button type="submit" name="sub_pharma_bill" class="btn btn-success"><span class="fa fa-plus-circle"></span> Add</button></div>
                    </div>
                    </div>
                    </div>
                    </form>
                   <?php include ('include/dbcon.php');

                    if (isset($_POST['sub_pharma_bill'])) {
                                $med_name = $_POST['med_name'];
                                $med_price = $_POST['med_price'];
                                $med_qty = $_POST['med_qty'];
                                $med_total = $_POST['med_total'];
                                $patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
                                while($row_patient = mysql_fetch_array($patient_query))
                                {
                                $transs=$row_patient['patient_trans_id'];
                                $trans_patientId = $row_patient['patient_id'];
                                }

                        $insertp = mysql_query("INSERT into med_billings(mb_desc, mb_qty, mb_price, mb_total, patient_trans_id, mb_date) VALUES('$med_name','$med_qty','$med_price','$med_total','$transs',NOW() )")or die(mysql_error());
                        if ($insertp) {

                             header('location: patient_his.php?patient_id='.$patient_id);
                        }
                    
                    }
                ?>    
      <!--view billlings-->
     <?php 
            $userss = mysql_query("SELECT * from patient_transaction where patient_id='".$user_row['patient_id']."'");
                while($forus= mysql_fetch_array($userss))
                {
                  $fors =$forus['patient_trans_id'];
                }
              $patient_updates = mysql_query("SELECT * FROM patient_transaction pt LEFT JOIN
  user u ON pt.patient_id=u.patient_id LEFT JOIN billings b ON u.patient_id=b.bill_patient_id WHERE patient_trans_id='$fors' ");
                while($row_updates = mysql_fetch_array($patient_updates))
                {

       ?>    
       <div id="viewbillings" class="modal">
            <form method="POST" style="width: 600px;" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-eye"></span> Billings</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:black;zoom:50%;">
                      <div class="col-md-3 text-right">
                        <!-- <img src="images/llc_logo.png" width="200"> -->
                      </div>
                      <div class="col-lg-6 text-center">
                          <h3>Republic of the Philippines <br> Municipality of Buenavista <br> Rural Helath Unit </h3>
                          <h2>(PHILHEALTH ACCREDITED)</h2>
                          <p>Tel. # 340-0249 / 340-0148</p>
                          <p>Fax # 341-3892 * COH # 236-1106</p>
                          <b>S T A T E M E N T &nbsp; O F &nbsp; A C C O U N T</b>
                      </div>
                      <div class="col-md-3">
                        <!-- <img src="images/llc_logo.png" width="200"> -->
                      </div>
                    </div>
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                      <div class="col-lg-6  text-center" >
                        <u style="color:teal"><?php echo  $row_updates['firstname']." ".$row_updates['middlename']." ".$row_updates['lastname']; ?></u> <br>
                        <center>(Name of Patient)</center>
                      </div>
                      <div class="col-lg-6">
                        Trans/Bill No. <u style="color:teal"><?php  echo $row_updates['patient_trans_id']; ?></u><br>
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
                        Date Discharge:  <?php if (empty($row_updates['patient_date_discharge'])) {
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
                            <p>Subsistence and accommodation <br> from <u style="color:teal"><?php echo date('M d, Y',strtotime($row_updates['patient_date_incharge'])); ?></u> to <u style="color:teal">


                                <?php 
                                if(empty($row_updates['patient_date_discharge'])) { 
                                        if (date('M d, Y',strtotime($row_updates['patient_date_incharge'])) == date('M d, Y')) {
                                             $totaldays =1;
                                            echo "AS OF TODAY";
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
                                                  $datenow = $row_updates['patient_date_discharge'];;
                                                  $dateadmitted = $row_updates['patient_date_incharge'];
                                                 $totaldays = round((float)(strtotime($datenow) - strtotime($dateadmitted)) / (60 * 60 *24));
                                                  echo date('M d, Y',strtotime($row_updates['patient_date_discharge']));
                                             }
                                } ?>
                                    




                                </u></p>
                            <?php 
                                $amountdue= $totaldays * 50;
                             ?>
                            <p>for <u style="color:teal"><?php echo $totaldays; ?></u> day/s <u style="color:red">(P50/day)</u></p><br>
                        <h4><u><b>special charges</b></u></h4>
                        
                      </div>
                      <div class="col-lg-6 text-center">
                        <center><h4><u><b>DUE FROM PATIENT</b></u></h4></center>
                        <br><br><br>
                          <u>___________________<b style="color:teal;font-size: 20px;"><?php echo "P ".number_format($amountdue); ?></b>__________________</u>
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
                    <div class="row" style="margin-top:10px;color:black;zoom:50%;">
                      <div class="col-lg-6 text-center">
                         <p><b>Medicines</b>  ________________________</p>

                         
                        
                      </div>
                      <div class="col-lg-6 text-center">
                        ____________________________________________

                      </div>
                      
                    </div>
                    <?php 
                   
                    $medselek = mysql_query("SELECT * FROM med_billings  WHERE patient_trans_id='$for'");
                    while($rowmed=mysql_fetch_array($medselek))
                    { ?>
                      

                     <div class="row" style="margin-top:20px;color:black;zoom:50%;">
                      <div class="col-lg-6 text-center">
          
                        <u style="color:teal;"><?php echo $rowmed['mb_desc']." <b style='color:black;'>(".$rowmed['mb_qty']."x P".$rowmed['mb_price'].")</b>"; ?></u>
                         
                        
                      </div>
                      <div class="col-lg-6 text-center">
                         ____________________<u style="color:teal;"><?php echo "P ".number_format($rowmed['mb_total']); ?></u>____________________

                      </div>
                      
                    </div>
                    <?php } ?>
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                      <div class="col-lg-6 text-center">

                         <br><br> 
                         <p>total amount ________________________</p>
                         <br><br>
                         <b>prepared by:</b>
                         <br><br>
                             <?php 
                                    $selekcasir = mysql_query("SELECT * FROM admin where admin_type='Billings'");
                                    $row=mysql_fetch_array($selekcasir);
                              ?>
                         <u><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></u><br>(billing in-charge)

                        
                      </div>
                      <div class="col-lg-6 text-center">
            
                        <p style="color:teal;font-size: 20px;"><?php echo "P ".number_format($med_rows + $rows + $amountdue); ?></p>
                        ____________________________________________
                            <br><br><br>
                            <b>date prepared:</b>
                             <br><br><u><?php echo date('F d, Y h:i:sa'); ?></u>

                      </div>
                      
                    </div>

                    <div class="row" style="margin-top: 30px;">
                        <div class="col-md-2"></div>
                      <div class="col-md-4"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> EXIT</button></div>
                      <div class="col-md-4"><a style="margin-top: 8px;width: 180px;" class="btn btn-warning" href="print_billings.php<?php echo '?patient_trans_id='.$id; ?>" target="_blank"><span class="fa fa-plus-circle"></span> Print</a></div>
                        <div class="col-md-2"></div>
                    </div>
                    </div>
                    </div>
                    </form>
                    <?php } ?>
           <script>
                    function printPage() {
                        window.print();
                    }
                    </script>
                  <!--patient-datasheet-->
                    <?php 
            $userss = mysql_query("SELECT * from patient_transaction where patient_id='".$user_row['patient_id']."'");
                while($forus= mysql_fetch_array($userss))
                {
                  $fors =$forus['patient_trans_id'];
                }
              $patient_updates = mysql_query("SELECT * FROM patient_transaction pt LEFT JOIN
  user u ON pt.patient_id=u.patient_id LEFT JOIN billings b ON u.patient_id=b.bill_patient_id WHERE patient_trans_id='$fors' ");
                while($row_updates = mysql_fetch_array($patient_updates))
                {

       ?>    
       <div id="pdatasheet" class="modal">
            <form method="POST" style="width: 600px;" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;"><span class="fa fa-eye"></span> PATIENT DATA SHEET</button></div>
                    </div>
                    <div class="row" style="margin-top:20px;color:black;zoom:50%;">
                      <div class="col-md-3 text-right">
                        <!-- <img src="images/llc_logo.png" width="200"> -->
                      </div>
                      <div class="col-lg-6 text-center">
                          <h3>Republic of the Philippines <br> Municipality of Buenavista <br> Rural Health Unit </h3>
                          <h2>(PHILHEALTH ACCREDITED)</h2>
                          <p>Tel. # 340-0249 / 340-0148</p>
                          <p>Fax # 341-3892 * COH # 236-1106</p>
                          <b>P A T I E N T &nbsp; D A T A  &nbsp; S H E E T</b>
                      </div>
                      <div class="col-md-3">
                        <!-- <img src="images/llc_logo.png" width="200"> -->
                      </div>
                    </div>
                    <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5" >
                        NAME:<u style="color:teal"><?php echo  $row_updates['firstname']." ".$row_updates['middlename']." ".$row_updates['lastname']; ?></u>
                        <br>
                        ADDRESS:<u style="color:teal">__<?php echo $row_updates['address']; ?>__</u><br>
                        DATE OF BIRTH:<u style="color:teal"><?php  echo date('M d, Y',strtotime($row_updates['birthdate'])); ?></u><br>
                         AGE:<u style="color:teal"><?php  echo $row_updates['age']; ?></u><br>
                         STATUS:<u style="color:teal"><?php  echo $row_updates['status']; ?></u>
                      </div>
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5">
                        Trans/Bill No.: <u style="color:teal"><?php  echo $row_updates['patient_trans_id']; ?></u><br>
                        SEX:<u style="color:teal"><?php  echo $row_updates['gender']; ?></u><br>
                        RELIGION:<u style="color:teal"><?php  echo $row_updates['religion']; ?></u><br>
                        CONTACT:<u style="color:teal"><?php  echo $row_updates['contact']; ?></u><br>
                        GUARDIAN:<u style="color:teal"><?php  echo $row_updates['guardian']; ?></u>
                      </div>
                    </div>
                    <?php 
                          $result1 = mysql_query("SELECT * from user u 
  Left JOIN patient_transaction pt ON u.patient_id = pt.patient_id LEFT JOIN patient_vsr pv ON pt.patient_trans_id=pv.patient_trans_id

  where pt.patient_trans_id='$fors'");
                          $row = mysql_fetch_array($result1);

                     ?>
                    <hr style="color:black">
                   <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5" >
                        <h4><b><u>ADMISSION</u></b></h4>
                        DATE:<u style="color:teal"><?php  echo date('M d, Y',strtotime($row_updates['patient_date_incharge'])); ?></u><br>
                        BY: <br><br>
                       WARD NAME:<u style="color:teal"><?php  echo $row_updates['patient_ward_no']; ?></u> <br>
                      </div>
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5">
                        <h4><b><u>DISCHARGE</u></b></h4>
                       DATE:<u style="color:teal"><?php  echo date('M d, Y',strtotime($row_updates['patient_date_discharge'])); ?></u><br>
                       BY: <br><br>
                        BED NO:<u style="color:teal"><?php  echo $row_updates['patient_bed_no']; ?></u>
                      </div>
                    </div>
                     <hr style="color:black">
                   <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5" >
                        <h4><b><u>VITAL SIGN RESULTS</u></b></h4>
                        TEMPERATURE: <u style="color:teal"><?php  echo $row['vsr_temp']."Degree Celsius"; ?></u><br>
                        PULSE RATE: <u style="color:teal"><?php  echo $row['vsr_pr']; ?></u>
                      </div>
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5">
                       <br>
                       BLOOD PRESSURE: <u style="color:teal"><?php  echo $row['vsr_bp']; ?></u><br>
                       RESPIRATION RATE: <u style="color:teal"><?php  echo $row['vsr_rr']; ?></u>
                      </div>
                    </div>
                    <hr style="color:black">
                     <div class="row" style="margin-top:30px;color:black;zoom:50%;">
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5" >
                       
                        ADMITTING DIAGNOSIS:<u style="color:teal"><?php  echo $row_updates['patient_admit_diagnos']; ?></u><br>
                         <br><br>
                       INCHARGE DOCTOR:<u style="color:teal"><?php  echo $row_updates['incharge_doc']; ?></u> <br><br><br><br>
                        <?php 
                                    $selekcasir = mysql_query("SELECT * FROM admin where admin_type='Nurse'");
                                    $row=mysql_fetch_array($selekcasir);
                              ?>
                        
                       PREPARED BY :<br><br>
                       <b><u style="color:teal"><?php echo $row['firstname']." ".$row['middlename']." ".$row['lastname']; ?></u></b><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NURSE
                      </div>
                      <div class="col-lg-1" ></div>
                      <div class="col-lg-5">
                        FINAL DIAGNOSIS:<u style="color:teal"><?php  echo $row_updates['patient_findings']; ?></u><br><br><br>
                        REMARKS:  <br><br><br><br>
                        DATE PREPARED :<br><br>
                        <u style="color:teal"><?php echo date('F d, Y h:i:sa'); ?>
                      </div>
                    </div>


                    <div class="row" style="margin-top:50px;">
                        <div class="col-md-4"></div>
                      <div class="col-md-4"><button class="btn btn-danger" onclick="document.getElementById('bak').style.display='none'"><span class="fa fa-times-circle-o"></span> EXIT</button></div>
                      <div class="col-md-4"><!-- <a style="margin-top: 8px;width: 180px;" class="btn btn-warning" href="print_billings.php<?php echo '?patient_trans_id='.$id; ?>" target="_blank"><span class="fa fa-plus-circle"></span> Print</a> --></div>
                       
                    </div>
                    </div>
                    </div>
                    </form>
                    <?php } ?>
<?php include ('footer.php'); ?>