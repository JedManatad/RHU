<div id="payments" class="modal">
            <form method="POST" class="modal-content animate" enctype="multipart/form-data" ?>">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-lg-12"><button class="btn btn-primary" style="color:;font-variant-caps: all-petite-caps;font-size: 20px;" readonly="readonly"><span class="fa fa-money"></span> Receive Payments</button></div>
                    </div>
                     <div class="row" style="margin-top:20px;color:black;">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4 text-right" style="color:gray;font-size: 10px;">
                             Total Billings :   
                        </div>
                        <div class="col-lg-4" style="color:gray;font-size: 10px;">
                            
                            <input type="text" name="amount_due" value="<?php echo $totalamount; ?>"  id="amount_due" class="form-control" onkeyup="payment();" readonly="readonly">
                        </div>
                       
                        <div class="col-lg-4">
                            <select name="det_discount" onChange="detDiscount(this.value);" class="form-control" style="color:teal;">
                                    <option>has discount?</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                               </select>
                        </div>
                    </div>
                     <div id="discount_row" class="row" style="color:black;display: none;">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4 text-right" style="color:gray;font-size: 10px;">
                             Discount(%) :   
                        </div>
                        <div class="col-lg-4" style="color:gray;font-size: 10px;">
                            
                            <input type="number" id="discount" name="amount_discount" class="form-control" onkeyup="payment();">
                            
                        </div>
                        <div class="col-lg-4" style="color:gray;font-size: 10px;">
                             <select name="type_discount" onChange="mewhat(this.value);" class="form-control">
                                 <option>Discounts</option>
                                 <option value="PWD">PWD</option>
                                 <option value="SC">SC</option>
                                 <option value="Government">Government</option>
                                 <option value="Philhealth">Philhealth</option>
                             </select>   
                        </div>
                    </div>
                    <div id="discount_rows" class="row" style="color:black;display: none;">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4 text-right" style="color:gray;font-size: 10px;">
                             Total Amount Discounted :   
                        </div>
                        <div class="col-lg-4" style="color:gray;font-size: 10px;">
                            
                            <input type="text" id="txt3" name="total_discounted" class="form-control" onkeyup="payment();" readonly="readonly">
                        </div>
                        <div class="col-lg-4">
                            <input style="display: none;" type="text" id="disc_id" name="discount_id" placeholder="PhilHealth/Senior/PWD ID" class="form-control"><input style="display: none;" type="text" id="off_name" name="off_name" placeholder="Official Name" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="color:black;">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4 text-right" style="color:gray;font-size: 10px;">
                             Tender Amount :   
                        </div>
                        <div class="col-lg-4" style="color:gray;font-size: 10px;">
                            
                            <input type="text" id="amount_tender" name="tender_amount" class="form-control"  onkeyup="payment();">
                        </div>
                        <div class="col-lg-4">
                                
                        </div>
                    </div>
        
                    <div class="row" style="margin-top:10px;color:black;">
                        <form method="POST" enctype="multipart/form-data">
                        <div class="col-lg-4 text-right" style="color:gray;font-size: 10px;">
                             Change :   
                        </div>
                        <div class="col-lg-4" style="color:gray;font-size: 10px;">
                            
                            <input type="text" id="change" name="wd_change" class="form-control" onkeyup="payment();" style="display: none;">
                            <input type="text" id="ndchange" name="nd_change" class="form-control" onkeyup="payment();" >
                        </div>
                        <div class="col-lg-4">
                                
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                    	<div class="col-md-6"><button class="btn btn-danger" onclick="document.getElementById('finding').style.display='none'"><span class="fa fa-times-circle-o"></span> Cancel</button></div>
                    	<div class="col-md-6"><button type="submit" name="rpayment" class="btn btn-success"><span class="fa fa-plus-circle"></span> Receive</button></div>
                    </div>
                   </div>
               </div>
             </form>
				   <?php include ('include/dbcon.php');

					if (isset($_POST['rpayment'])) {
						$tender_amount = $_POST['tender_amount'];
                        $amount_due = $_POST['amount_due'];
                        $change = $_POST['nd_change'];
                        $wdchange = $_POST['wd_change'];
                        $discount_id = $_POST['discount_id'];
                        $off_name = $_POST['off_name'];
                        $total_discounted = $_POST['total_discounted'];
                        $type_discount = $_POST['type_discount'];
                        $amount_discount = $_POST['amount_discount'];
                        $det_discount = $_POST['det_discount'];

								$patient_query = mysql_query("Select * from patient_transaction where patient_id='".$user_row['patient_id']."' ");
								while($row_patient = mysql_fetch_array($patient_query))
								{
									$transs=$row_patient['patient_trans_id'];
								}
							
                        if($det_discount == 'Yes')
                        {
                                if($type_discount == 'Government')
                                {
                                    $wg_insert = mysql_query("UPDATE patient_transaction set patient_total_bills='$amount_due', patient_amount_disc='$amount_discount', patient_total_discounted='$total_discounted', patient_type_disc='$type_discount', patient_discSponsor='$off_name', patient_detDiscount='$det_discount', patient_tender_amount='$tender_amount', patient_change='$wdchange', patient_status='Inactive' where patient_trans_id='$transs' ") or die(mysql_error());
                                    if($wg_insert)
                                    {
                                        header('location: print_receipt.php?patient_trans_id='.$transs);
                                    }
                                }
                                else
                                {
                                     $psc_insert = mysql_query("UPDATE patient_transaction set patient_total_bills='$amount_due', patient_amount_disc='$amount_discount', patient_total_discounted='$total_discounted', patient_type_disc='$type_discount', patient_discountId='$discount_id', patient_detDiscount='$det_discount', patient_tender_amount='$tender_amount', patient_change='$wdchange', patient_status='Inactive' where patient_trans_id='$transs' ") or die(mysql_error());
                                    if($psc_insert)
                                    {
                                        header('location: print_receipt.php?patient_trans_id='.$transs);
                                    }
                                }
                        }
                        else
                        {
                            $insertp = mysql_query(" UPDATE patient_transaction set patient_total_bills='$amount_due', patient_tender_amount='$tender_amount', patient_change='$change', patient_status='Inactive', patient_detDiscount='No' where patient_trans_id='$transs' ")or die(mysql_error());
                            if ($insertp) {
                                 header('location: print_receipt.php?patient_trans_id='.$transs);
                            }
                        }
						
					
					}
				?>