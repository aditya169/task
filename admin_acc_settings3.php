<?php
//============================================================+
// File name   : admin_acc_settings3.php
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
if(isset($_POST['save'])){

//gathering user's entered data
$id=trim($_POST["id"]);
$pass=trim($_POST["pass"]);
$pass=preg_replace( '/\s+/','',$pass);
$cpass=trim($_POST["cpass"]);
$cpass=preg_replace( '/\s+/','',$cpass);
//gathering other data
$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
$date = date("m/d/y", $today);

//validating form content
if($pass =="" ){
	$error= "error : Please type your new password.";
	$code= "1";
}
elseif($cpass =="" ){
	$error= "error : Please retype your new password.";
	$code= "2";
}
elseif($cpass!==$pass){
	$error= "error : Password mismatch! Please Re-enter Password.";
	unset($cpass);	
	unset($pass);	
	$code= "1";
}
else{
//processing form content

	require_once './includes/db_config.php';
	connect();
	$query1 = "update admin set password='".$pass."' where id='".$id."' ";
	$result1=mysql_query($query1);
	$query2 = "insert into password_history values('','$id','$type','$date')";
	$result2=mysql_query($query2);
	
	if($result1 && $result2){
	 echo "<script> alert('Account Updated') </script>" ;
	 echo "<script> window.location='admin_acc_settings.php'</script>";

	}else{
			echo"Oops! Something went wrong!";
		}
  }
 
 
}
?>	

<?php
if(isset($_REQUEST['v'])){ 	
		$t1=trim($_REQUEST['v']); 
		$id=base64_decode($t1); 
		require_once './includes/db_config.php';
		connect();
		$query=" Select * from admin where id='".$id."' ";
		$result=mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_array($result);
}
?>	

<form name=frm method="POST" action="">
<table class='main-table'>
<tr><td>
<table class='main-table'>
	<tr><td colspan=2><br/><h2><?php echo $row['fname']." ".$row['lname'];?> </h2></td></tr>
	<tr><td colspan=2><br/><div class="hr"><hr /></div></td></tr>
	<tr>
		<td><input type="hidden" name="id" value="<?php echo $row[0];?>"></td>
		<td><?php if(isset($error)){ echo'<p class=message >' .$error. ' <br></p>';}?></td>
	</tr>
	
	<tr>
		<td><strong>Account Name</strong></td>
		<td><?php echo $row['fname']." ".$row['lname'];?></td>
	</tr>
	
	<tr>
		<td><strong>Permission</strong></td>
		<td><?php if($row['permission']==1){echo "Is Owner";}else{echo "Is Admin";}?></td>
	</tr>
	
	<tr>
		<td><strong>Email</strong></td>&nbsp;
		<td><input type='text' name='email' size=40 readonly value="<?php echo $row['email'] ?>" ></td>
	</tr>
	
	<tr>
		<td>*<strong>New Password</strong></td>&nbsp;
		<td><input type='password' name='pass' size=40 placeholder='Type new password' value="<?php if(isset($pass)){echo $pass;} ?>" <?php if(isset($code) && $code ==1){echo "class=error" ;} ?> ></td>
	</tr>
		
	<tr>
		<td>*<strong>Confirm Password</strong></td>&nbsp;
		<td><input type='password' name='cpass' size=40 placeholder='Retype new password' value="<?php if(isset($cpass)){echo $cpass;} ?>" <?php if(isset($code) && $code ==2){echo "class=error" ;} ?> ></td>
    </tr>
	
	
	<tr>
		<td></td>
		<td><input type='submit' name='save' value='save'></td>
	</tr>
</table>
</td></tr>
</table>
</form>
<!-- footer -->
<?php include('./includes/footer.php');?>