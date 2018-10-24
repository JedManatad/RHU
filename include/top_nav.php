            <!-- top navigation -->
<?php 
    include('include/dbcon.php');
     session_start();
    // if(isset($_SESSION['username']))
    // {
    //     header('Location: index.php');
    // }
 
    
 ?>
            <div>

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right" style="">
<?php
	include('include/dbcon.php');
	$user_query=mysql_query("select * from admin where admin_id='$id_session'")or die(mysql_error());
	$row=mysql_fetch_array($user_query); {
?>
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    
									<?php if($row['admin_image'] != ""): ?>
									<img src="upload/<?php echo $row['admin_image']; ?>">
									<?php else: ?>
									<img src="images/user.png">
									<?php endif; ?>	<?php echo "Welcome,  <b style='font-variant-caps: all-small-caps;font-size:15px;'>(".$row['username'].") ". $row['firstname'] ." ". $row['lastname']."</b>" ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                  
                                   <li>
										<a href="admin_profile.php"><i class="fa fa-user pull-right"></i> Profile</a>
                                    </li>
                                    <li>
										<a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
<?php } ?>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->