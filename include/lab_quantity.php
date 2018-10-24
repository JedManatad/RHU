<?php 
include ('include/dbcon');
			$lab_name =$_GET['lab_name'];

			$select_labquantity= mysql_query("SELECT lab_quantity from lab_type where lab_name='$lab_name'");
                                echo $lab_name;
                                while($row_labquantity = mysql_fetch_array($select_labquantity))
                                {
                                		echo $row_labquantity['lab_quantity'];
                                }


 ?>