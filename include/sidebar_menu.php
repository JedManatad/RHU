            <?php 
    
            include('include/dbcon.php');
            session_start();
            
         ?>
                    <div class="col-md-3 left_col" style="background-color:teal ;">
                <div class="left_col scroll-view">

					<a href="#">
                    <div class="profile">

                        <div class="profile_pic" style="margin-left: 10px;">
									
								<img src="images/buenavistalogo.png" class="img-circle profile_img">
								
                        </div>

                    </div>
					</a>
                    <br />

                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">

							<h3 style="margin-top:105px;margin-left:-10px;text-align: center;">RURAL HEALTH UNIT AUTOMATED SYSTEM</h3>
							<div class="separator"></div>
                            <ul class="nav side-menu">
                                 <?php 
                                     include('include/dbcon.php');
                                     $hide=mysql_query("select * from admin where admin_id = $id_session ") or die (mysql_error());   
                                     $row=mysql_fetch_array($hide);
                                     if ($row['admin_rol']==1) {
                                       
                                 ?>

                                <li>
									<a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                                </li>
                                <li>
                                    <a href="employee.php"><i class="fa fa-user"></i> Employee</a>
                                </li>
                                 <li>
                                    <a href="user.php"><i class="fa fa-users"></i> Patient</a>
                                </li>
                                <li>
                                    <a href="medicine.php"><i class="fa fa-medkit"></i> Medicines</a>
                                </li>
                                 <li>
                                    <a href="laboratory.php"><i class="fa fa-user-md"></i> Laboratory</a>
                                </li>
                                <?php }else {
                                    # code...
                                 ?>
                                 <li>
                                    <a href="user.php"><i class="fa fa-users"></i> Patient</a>
                                </li>
                                <?php } ?>
                                    <?php 
                                        if($row['admin_type'] == 'Laboratory')
                                        {

                                     ?>
                                <li>
                                    <a href="laboratory.php"><i class="fa fa-user-md"></i> Laboratory</a>
                                </li>
                                <?php } ?>
                                 <?php 
                                        if($row['admin_type'] == 'Pharmacist')
                                        {

                                     ?>
                                <li>
                                    <a href="medicine.php"><i class="fa fa-medkit"></i> Medicines</a>
                                </li>
                                     <?php } ?>
                                <li>
                                    <a href="history.php"><i class="fa fa-history"></i> History</a>
                                </li>
                                 <li>
                                    <a href="about_us.php"><i class="fa fa-users"></i> About Developers</a>
                                </li>
                                
                            </ul>
                        </div>
                      

                    </div>
            
                </div>
            </div>
