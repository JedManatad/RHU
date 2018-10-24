<?php 
    include('include/dbcon.php');
     session_start();
    if(isset($_SESSION['id']))
    {
        header('Location:user.php');
    }
 
    
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/llc_logo.png">
    <title>RHU Automated System</title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>



<style>
.blink_text {
-webkit-animation-name: blinker;
-webkit-animation-duration: 1s;
-webkit-animation-timing-function: linear;
-webkit-animation-iteration-count: infinite;

-moz-animation-name: blinker;
-moz-animation-duration: 1s;
-moz-animation-timing-function: linear;
-moz-animation-iteration-count: infinite;

 animation-name: blinker;
 animation-duration: 1s;
 animation-timing-function: linear;
 animation-iteration-count: infinite;

 color:white;
 font-size:16px;
}

@-moz-keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }

@-webkit-keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }

@keyframes blinker {  
 0% { opacity: 1.0; }
 50% { opacity: 0.0; }
 100% { opacity: 1.0; }
 }
</style>
<script type="text/javascript">
    window.history.forward();
    function back()
    {
        window.history.forward();
    }

</script>
</head>

<body style="background:white;color:black" onload="back()" onpageshow="if (event.persisted) back(); ">
   <div class="container-fluid" style="padding-top:10px;margin-bottom:10px;background-color: teal;height: 90px;color:blue;text-shadow: 2px 2px 2px white;font-family: andalus;">
        <h3 style=
        "font-weight: bolder;text-align:left;font-size: 50px;"><b>R</b> <b>H</b> <b>U</b> <b style="text-transform: capitalize;color:maroon;text-shadow: 2px 2px 2px white;">Automated System <b style="font-size: 20px;text-transform:uppercase;color:orange;">Buenavista, Bohol</b></b></h3>
        </div>
    <div class="">

        <div id="wrapper">
            <div id="login" class="animate form">
                <center>
                    <img src="images/buenavistalogo.png" class="img-responsive" width="200">
                    <h3 style="font-variant-caps: all-small-caps;font-size: 30px;">RURAL HEALTH UNIT AUTOMATED SYSTEM</h3>
                </center>
                <section class="login_content" style="zoom:80%">
                    <form action="" method="post">
                        <h1>ADMINISTRATOR</h1>
                        <div>
                            <input type="text" class="form-control" name="username" placeholder="Username" autofocus='autofocus' required />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required />
                        </div>
                       <!--  <div>
                            <select name="admintype" class="form-control" required="required" tabindex="-1" style="width:350px;color:black;border-radius:5px;height: 36px;">
                                <option value="0">Select Admin type</option>
                                <option value="1">SUPER     ADMIN</option>
                                <option value="2">ADMIN</option>
                            </select>
                        </div> -->
                        <div style="margin-top:50px;">
								<button class="btn btn-success submit" type="submit" name="login"><i class="fa fa-check"></i> Log in</button>
                        </div>
                        <div class="row text-center" style="margin-top:20px;">
                            <div class="col-lg-12">Not yet member? <a href="signup.php">Sign up</a></div>
                        </div>
                        <div class="clearfix"></div>

                            <div class="clearfix"></div>
                            <br />
                            <div style="margin-top:70px;">
                                <p>RHU@incorporated </p>
                                <p>© All Right Reserved <?php echo date('Y'); ?></p>
                            </div>
                        </div>
                    </form>
<?php
include('include/dbcon.php');

    if (isset($_POST['login'])){

            $username=$_POST['username'];
            $password=$_POST['password'];
            $admintype=$_POST['admintype'];

               
                $login_query=mysql_query("select * from admin where username='$username' and password='$password'");
                $count=mysql_num_rows($login_query);
                $row=mysql_fetch_array($login_query);
              
               if ($count > 0){
                            
                            $_SESSION['id']=$row['admin_id'];
                            
                                if ($row['admin_status']==1) {

                                        if ($row['admin_rol']==1) {
                                                 echo "<script>window.location='home.php'</script>";
                                                
                                                }
                                            else {
                                                echo "<script>window.location='user.php'</script>";
                                            }
                                            
                
                                     }
                                     else{
                                                  echo "<script>alert('You have been Deactivated!   '); window.location='index.php'</script>";
                                     }
                                
                }                   
                else{ 
                        echo "<script>alert('Invalid Username or Password!');window.location='index.php'</script>";

                }
    }
?>                  
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>