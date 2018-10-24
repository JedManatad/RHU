<?php include ('header.php'); ?>

        <div class="page-title">
            <div class="title_left">
                <h3>
					All Reports
                </h3>
            </div>
        </div>
        <div class="clearfix"></div>
 
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-book"></i> Returned Books Monitoring</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
							<a href="returned_book_print.php" target="_blank" style="background:none;">
							<button name="print" type="submit" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
							</a>
							</li>
                           
                        </ul>
						
                        <div class="clearfix"></div>
						

                        <form method="POST" action="returned_book_search.php" class="form-inline">
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="datefrom" class="form-control has-feedback-left" placeholder="Date From" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <div class="col-md-3">
                                            <input type="date" style="color:black;" value="<?php echo date('Y-m-d'); ?>" name="dateto" class="form-control has-feedback-left" placeholder="Date To" aria-describedby="inputSuccess2Status4" required />
                                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                            <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                        </div>
                                    </div>
                                </div>
								
								<button type="submit" name="search" class="btn btn-primary btn-outline"><i class="fa fa-calendar-o"></i> Search By Date Transaction</button>
								
						</form>

						<span style="float:left;">
					<?php 
				$count = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM `report`")) or die(mysql_error());
					$count1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM `report` WHERE `detail_action` = 'Borrowed Book'")) or die(mysql_error());
				$count2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) as total FROM `report` WHERE `detail_action` = 'Returned Book'")) or die(mysql_error());
					?>
				-			<a href="report.php"><button class="btn btn-primary"><i class="fa fa-info"></i> All Reports <?php echo $count['total']; ?></button></a>
							<a href="borrowed_report.php"><button class="btn btn-success btn-outline"><i class="fa fa-info"></i> Borrowed Reports (<?php echo $count1['total']; ?>)</button></a>
							<a href="returned_report.php"><button class="btn btn-danger btn-outline"><i class="fa fa-info"></i> Returned Reports (<?php echo $count2['total']; ?>)</button></a>
				
				</span>
						
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- content starts here -->

						<div class="table-responsive">
							<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
								
					
							<thead>
								<tr>
									<th>AccNo</th>
									<th>SubAccNo</th>
									<th>Book Title</th>
									<th>Users Name</th>
									<th>Task</th>
									<th>Person In Charge</th>
									<th>Admin Type</th>
									<th>Date Transaction</th>
								</tr>
							</thead>
							<tbody>
    <?php
    	$_SESSION['datefrom'] = $_POST['datefrom'];
    	$_SESSION['dateto'] = $_POST['dateto'];
    	$datefrom = $_POST['datefrom'];
    	$dateto = $_POST['dateto'];


    						$return_query= mysql_query("select * from report 
							LEFT JOIN book ON report.book_id = book.book_id 
							LEFT JOIN user ON report.user_id = user.user_id 
							where report.date_transaction BETWEEN '".$_POST['datefrom']." 00:00:01' and '".$_POST['dateto']." 23:59:59' 
							order by report.report_id DESC") or die (mysql_error());
							
								
							
							?>
							
<?php
							while ($return_row= mysql_fetch_array ($return_query) ){
							$id=$return_row['return_book_id'];
?>
							<tr>
								<td><?php echo $return_row['accNo']; ?></td>
								<td><?php echo $return_row['subaccno']; ?></td>
								<td style="text-transform: capitalize"><?php echo $return_row['book_title']; ?></td>
								td style="text-transform: capitalize"><?php echo $return_row['firstname']." ".$return_row['lastname']; ?></td>
						<td style="text-transform: capitalize"><?php echo $return_row['detail_action']; ?></td>
								<td><?php echo $return_row['admin_name']; ?></td> 
								<td><?php echo $return_row['reportadmin_type']; ?></td>
								<td><?php echo date("M d, Y h:i:A",strtotime($return_row['date_transaction'])); ?></td>		
								<tr>
							<?php } ?>
							</tbody>
							</table>
						</div>
						
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>

<?php include ('footer.php'); ?>