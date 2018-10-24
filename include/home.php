<?php include ('header.php'); ?>
		<?php 
    
    include('include/dbcon.php');

    // if(!isset($_SESSION['username']))
    // {
    //     header('Location: index.php');
    // }
    
 ?>
        <!-- Custom styles for this template -->
       <link href="../asset/users/css/homestyle.css" rel="stylesheet">
          <script src="../asset/users/js/counterup.min.js" type="text/javascript"></script>
          <script src="../asset/users/js/waypoints.min.js" type="text/javascript"></script>
        <div class="clearfix"></div>
		
                <!-- top tiles -->
       
            <section id="professional" class="section-padding" style="margin-top:20px;margin-bottom:100px; ;padding:0;background-image: url('images/s2.jpg');opacity: 1.5;">
            <div class="full-bg-image" style="border-radius: 10px;height: 400px;padding-top:100px;">
                <div class="container benefits-block-inner">
                    <div class="counter-bgbanner">
                        <div class="row text-center" style="zoom:200%;padding-bottom:10px;">
                            <div class="col-md-1 col-sm-3 col-xs-12 width-set-50">
                               
                            </div>
                             <div class="col-md-1 col-sm-3 col-xs-12 width-set-50">
                               
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12 width-set-50" style="color:black">
                                <div class="information">
                                    <?php
                            $result = mysql_query("SELECT * FROM admin where admin_status='1' and admin_rol='2'");
                            $num_rows = mysql_num_rows($result);
                            ?>
                                   <button class="btn btn-primary"><h1 class='blue-line counter' data-slno='1' data-min='0' data-max='1000' data-delay='.1' data-increment=1><?php echo $num_rows; ?></h1><h6>Total Staff</h6></button> 
                                
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12 width-set-50" style="color:black">
                                <div class="information">
                                    <?php
                            $result = mysql_query("SELECT * FROM user");
                            $num_rows = mysql_num_rows($result);
                            ?>
                                   <button class="btn btn-primary"><h1 class='blue-line counter' data-slno='1' data-min='0' data-max='1000' data-delay='.1' data-increment=1><?php echo $num_rows; ?></h1><h6>All Patient</h6></button> 
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12 width-set-50" style="color:black">
                                <div class="information">
                                    <?php
                            $result = mysql_query("SELECT * FROM user;");
                            $num_rows = mysql_num_rows($result);
                            ?>
                                  <button class="btn btn-primary"><h1 class='blue-line counter' data-slno='1' data-min='0' data-max='1000' data-delay='.1' data-increment=1><?php echo $num_rows; ?></h1><h6>In-Patient</h6></button> 
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12 width-set-50" style="color:black">
                                <div class="information">
                                    <?php
                            $result = mysql_query("SELECT * FROM user;");
                            $num_rows = mysql_num_rows($result);
                            ?>
                                    <button class="btn btn-primary"><h1 class='blue-line counter' data-slno='1' data-min='0' data-max='1000' data-delay='.1' data-increment=1>0</h1><h6>Out-Patient</h6></button> 
                                </div>
                            </div>
                           
                            
                            
                            <div class="col-md-1 col-sm-3 col-xs-12 width-set-50">
                               
                            </div>
                        </div>


                      
                        <script>
                            jQuery(document).ready(function ($) {
                                $('.counter').counterUp({
                                    delay: 10,
                                    time: 1000
                                });
                            });
                        </script>
                    </div>

                </div>
            </div>
        </section>
        <?php include ('footer.php'); ?>
                <!-- /top tiles -->
					

