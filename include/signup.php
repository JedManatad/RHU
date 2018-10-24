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
</head>

<body style="background:white;color:black" >
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
                        <h1>SIGN UP HERE</h1>
                        <div class="container" style="border:1px solid teal;padding: 50px;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Username">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
                <div class="text-center" style="margin-top:70px;">
                    <p>RHU@incorporated </p>
                    <p>© All Right Reserved <?php echo date('Y'); ?></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>