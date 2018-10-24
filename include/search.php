<?php
 include ('include/dbcon.php');
    $key=$_GET['key'];
    $array = array();
    $query=mysql_query("SELECT * FROM user where patient_id LIKE '%{$key}%' or  firstname LIKE '%{$key}%' or middlename like '%{$key}%' or lastname like '%{$key}%' or guardian like '%{$key}%'  order by patient_id ASC");
    $num=mysql_num_rows($query)or die(mysql_error());
      while($row=mysql_fetch_assoc($query))
         {
            if ($row==0)
             {
             echo "Not Found!";
             }
                else
             {
                            
             $array[] = $row['firstname'] . " ".$row['lastname'];
      
             }
        }
    echo json_encode($array);
?>