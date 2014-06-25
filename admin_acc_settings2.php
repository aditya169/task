<?php
//============================================================+
// File name   : admin_acc_settings2.php
//
// Description : Admin Account Settings
//
// Author:  Aditya Mathur
//
// (c) Copyright:
//               Aditya Mathur
//               eztasker.com
//
// License:
//    Copyright (C) 2014 Aditya Mathur - eztasker.com
//============================================================+
session_start();
if(isset($_SESSION['li_uname111'])){
		$e=$_SESSION['li_uname111'];
		$type=1;
		$permission=$_SESSION['li_permission111'];
		if($permission==1){
				// proceed.
		}
		else{
				//deny
			echo "<script> alert('Sorry! you do not have enough privileges to view this page!') </script>" ;
			header('location:index.php');die;
		}
}else{
	header('location:index.php');die; //kill script & jump to login page
}
?>


<!-- Header -->
<?php include('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>


<?php
function checkEmail($email){
   $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    if (preg_match($pattern, trim(strip_tags($email)))){
        return true;	
    } else {
            return false;		
        }
}
?>

<?php
function searchAccount($row){ 

$url=base64_encode($row[0]); 
$url2=base64_encode($row[6]);
?>

<table class='main-table'>
<tr><td>
<table class=''>

	<tr><td colspan=2><br/><h2><?php echo $row['fname']." ".$row['lname'];?> </h2></td></tr>
	
	<tr>
		<td colspan=2>
			<a href="admin_acc_settings3.php?v=<?php echo $url?>">Edit Account</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="admin_acc_settings2.php?v=<?php echo $url?>&v2=<?php echo $url2?>" onclick="return confirm('Are you sure?');">Delete</a>&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr><td colspan=2><br/><div class="hr"><hr /></div><br/></td></tr>
	<tr>
		<td><strong>Account Name</strong></td>
		<td><?php echo $row['fname']." ".$row['lname'];?></td>
	</tr>
	<tr>
		<td><strong>Email</strong></td>
		<td><?php echo $row['email']?></td>
	</tr>
	<tr>
		<td><strong>Permission</strong></td>
		<td><?php if($row['permission']==1){echo "Is Owner";}else{echo "Is Admin";}?></td>
	</tr>
	<tr>
		<td><strong>Account Created on</strong></td>
		<td><?php echo $row['created']?></td>
	</tr>
</table>
</td></tr>
</table>
<br><br>
	

<?php } ?>


<?php
function delAccount($id,$permission){
	require_once './includes/db_config.php';
	connect();
	if($permission==1){
			$query1 = "select * from admin where permission=1";
			$result1=mysql_query($query1) or die(mysql_error());
			if(mysql_num_rows($result1)<2){
				//deny
				echo "<script> alert('Can not delete owner\'s last account. Please create a new one before deleting this.')</script>";
				echo "<script> window.location='admin_acc_settings.php'</script>";die;
			
			}else{
				$query = "DELETE from admin where id = '".$id."' ";
				mysql_query($query) or die(mysql_error());
				echo "<script> alert('Account Deleted!')</script>";
				echo "<script> window.location='admin_acc_settings.php'</script>";	
			}
		}
		else{
			$query = "DELETE from admin where id = '".$id."' ";
			mysql_query($query) or die(mysql_error());
			echo "<script> alert('Account Deleted!')</script>";
			echo "<script> window.location='admin_acc_settings.php'</script>";	
		}
}
	//get data via del link
	if(isset($_REQUEST['v']) && isset($_REQUEST['v2'])){ 	
		$t1=trim($_REQUEST['v']); 
		$id=base64_decode($t1); 
		$t2=trim($_REQUEST['v2']); 
		$permission=base64_decode($t2); 
		delAccount($id, $permission);
	}

?>

<table class='main-table' >
<form name='form1' method='GET' action="admin_acc_settings2.php">
	<tr>
		<td colspan="2"><center></br></br>
			<input type='text' name='email' size='70' placeholder='Enter Email'>
			<input type='submit' name='search'  value='Search'>
			<input type='submit' name='view' value='View All'></center>
		</td>
	</tr>
	<tr><td colspan=2><br/><br/></td></tr>
</form><br>
</table><br><br>

<?php 
/* ___code to Search Particular Record________*/

if(isset($_GET['search'])){
		$email=$_GET['email'];
		$email=preg_replace( '/\s+/','',$email);
		if($email==""){
			unset($email);
			echo "<script>window.location='admin_acc_settings.php'</script>" ;die;
		}	
		if(!checkEmail($email)){
			echo "<script> alert('Please Enter valid email ID.') </script>" ;
			echo "<script>window.location='admin_acc_settings.php'</script>" ;die;
		}			
		
	require_once './includes/db_config.php';
	connect();
	$query1 = "select * from admin where email='".$email."'";
	$result1=mysql_query($query1) or die(mysql_error());
	if(mysql_num_rows($result1)>0){
		while($row=mysql_fetch_array($result1)){
		
				searchAccount($row);
			}
		}else{
			echo "<script> alert('No record found for this email') </script>" ;
			echo "<script>window.location='admin_acc_settings.php'</script>" ;die;
	}
}
?>	

<?php 
//////////* ______code to display All Admin Record________*///////////

if(isset($_GET['view']))
{
	require_once './includes/db_config.php';
	connect();
	echo"<table><tr><td colspan=2><br/><h2>All Admins</h2><br/></td></tr></table>";
	$query1 = "select * from admin";
	$result1=mysql_query($query1) or die(mysql_error());
	if(mysql_num_rows($result1)>0){
		while($row=mysql_fetch_array($result1)){
	
				searchAccount($row);
			}
		}else{
			echo "<script> alert('No record found for this email') </script>" ;
			echo "<script>window.location='admin_acc_settings.php'</script>" ;die;
	}
}
?>

<!-- footer -->
<?php include('./includes/footer.php');?>