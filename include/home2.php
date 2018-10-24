<?php include ('header.php'); ?>
		
        <!-- Custom styles for this template -->
        <!-- 
       <link href="../asset/users/css/homestyle.css" rel="stylesheet">
          
 -->          <script src="../asset/users/js/counterup.min.js" type="text/javascript"></script>
          <script src="../asset/users/js/waypoints.min.js" type="text/javascript"></script>
          <script src="../asset/users/js/typeahead.min.js" type="text/javascript"></script>
       <!--    <script src="../asset/users/js/jquery.min.js" type="text/javascript"></script>
        <script src="../asset/users/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../asset/users/js/custom.js" type="text/javascript"></script> -->
        <div class="clearfix"></div>
		  
                <!-- top tiles -->
       <script type="text/javascript">
         $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 10
    });

    // $('input.typeahead').click(function(){
    //         $('.searched').hide(1000);
    //     });
});
       </script>
       <style type="text/css">
         .bs-example{
    font-family: sans-serif;
    position: relative;
    position: left;
}
.typeahead, .tt-query, .tt-hint {
    border: 2px solid #CCCCCC;
    border-radius: 10px 1px 0px 10px;
    font-size: 15px;
    height: 50px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 400px;
}
.typeahead {
    background-color: transparent;

}
.typeahead:focus {
    border: 2px solid #0097CF;
}
.tt-query {
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
    color: #999999;
}
.tt-dropdown-menu {
    background-color: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    margin-top: 12px;
    padding: 8px 0;
    width: 522px;
}
.tt-suggestion {
    font-size: 15px;
    line-height: 24px;
    padding: 3px 20px;

}
.tt-suggestion.tt-is-under-cursor {
    background-color: #0097CF;
    color: #FFFFFF;
  border-radius: 5px;
}
.tt-suggestion p {
    margin: 0;
}
       </style>
            <section style="margin-bottom: 300px;">
                <div class="container" >
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                                <h1><center>FIND PATIENT HERE!</center></h1>
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-md-3">
                           
                        </div>
                        <div class="col-md-6">
                             <form method="POST">
                             <input  style="width: 450px;" type="text" name="search1" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Search a patient here..." required/><input type="submit" style="margin-top:33px;height: 50px;border-radius:0px 10px 10px 0;" class="btn btn-success" value="Search">     
                             </form>
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>
                    <div class="row" style="margin-top: 50px; ">
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-6">
                         
                              <?php 
                         require ('include/dbcon.php');  
                                if (isset($_POST['search1'])){


                                    $booktitle = mysql_real_escape_string($_POST['search1']);
                                    $book_query = mysql_query("SELECT * FROM user WHERE firstname= '$booktitle'") or die (mysql_error());
                                    $book_count = mysql_num_rows($book_query);
                                    $book_row = mysql_fetch_array($book_query);
                                   
                                   

                                    if ($book_row['firstname'] != $booktitle){
                                        
                                                    $results='<b class="btn btn-danger" ">Sorry, no <i style="color:black"> "<u >'.$booktitle.'</u>" </i> found in database!</b>';
                                        
                                    } else{

                                        $profile=mysql_query("SELECT * FROM user  WHERE status='Active' and firstname = '$booktitle'  ORDER BY date_added ");

                                     ?>

                       <!-- <center> <p style="margin-bottom: 50px;"><?php echo '<b class="btn btn-success style="color:white;">Resuts on searched:  <i style="color:black;">   "<u>' .$book_row['firstname'].'</u>"  </i></b>'?></p></center> -->
     <hr>

                             <table class="table table-bordered">
                                <thead style="color:teal">
                                    <tr >
                                      <th>Full Name</th>
                                      <th>Guardian</th>
                                      <th>Room#</th>
                                      <th>Incharge Doctor</th>
                                      <th>Disease</th>
                                      <th>Patient Status</th>
                                 </tr>
                                </thead>
                                 <tbody>
                                  <tr>
                                     <td style="font-variant-caps: all-petite-caps;"><?php echo $book_row['firstname'] ." " . $book_row['middlename'] ." ". $book_row['lastname']; ?></td>
                                      <td><?php echo $book_row['guardian']; ?></td>
                                    <td><?php echo $book_row['room']; ?></td>
                                    <td><?php echo $book_row['doctor']; ?></td>
                                    <td><?php echo $book_row['disease']; ?></td>
                                    <td><?php echo $book_row['status']; ?></td>
                                   </tr>
                                 
                                  </tbody>
                            </table>
                             <button class="btn btn-primary" data-toggle="collapse" data-target="#demo">Additional Information</button>
                          <div id="demo" class="collapse">
                              <p>hi</p>
                          </div>
                 <?php   } }?>  
                          <center><?php echo $results; ?></center>
                          <br>
                         
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>
                </div>
            </section><hr>
        <?php include ('footer.php'); ?>
                <!-- /top tiles -->
					

