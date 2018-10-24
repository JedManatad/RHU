<?php  
include('include/dbcon.php');

if (isset($_POST['login'])){

$username=$_POST['username'];
$password=$_POST['password'];

$login_query=mysql_query("select * from admin where username='$username' and password='$password' and admin_status='1' ");
$count=mysql_num_rows($login_query);
$row=mysql_fetch_array($login_query);

if ($count > 0){
	ob_start(); 
session_start();
$_SESSION['id']=$row['admin_id'];
			
			// if ($row['admin_status']==1) {
			// 	echo "<script>alert('You have beeb Deactivated!'); window.location='index.php'</script>";
				
			// }
			// else
			// {
			// 	echo "<script>alert('Successfully Login!'); window.location='home.php'</script>";
			}

}else{
	echo "<script>alert('Invalid Username and Password! Try again.'); window.location='index.php'</script>";
?>
<?php } 

?>