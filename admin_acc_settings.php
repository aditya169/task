<?php
//============================================================+
// File name   : admin_acc_settings.php
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
}
else{
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

<!-- Validation library  -->
<?php include './includes/validation_lib.php';?> 




<?php
if(isset($_POST['create'])){

//gathering user's entered data
$fname=trim($_POST["fname"]);
$fname=preg_replace( '/\s+/','',$fname);
$lname=trim($_POST["lname"]);
$lname=preg_replace( '/\s+/','',$lname);
$gender=trim($_POST["gender"]);
$email=trim($_POST["email"]);
$email=preg_replace( '/\s+/','',$email);
$pass=trim($_POST["pass"]);
$pass=preg_replace( '/\s+/','',$pass);
$cpass=trim($_POST["cpass"]);
$cpass=preg_replace( '/\s+/','',$cpass);
$permission=trim($_POST["permission"]);
//gathering other data
$today = mktime(0,0,0,date("m"),date("d"),date("Y"));
$date = date("m/d/y", $today);

//validating form content
if($fname == "" ){
	$error= "error : You did not enter first name.";
	$code= "1" ;
}
elseif(!checkName($fname)){
	$error= "error : Name should not contain numbers";
	$code= "1";
	unset($fname);
}
elseif($lname == "" ){
	$error= "error : Please enter the last name";
	$code= "2";
}
elseif(!checkName($lname)){
	$error= "error : Name should not contain numbers";
	$code= "2";
	unset($lname);
}
elseif($gender == "" ){
	$error= "error : you did not select gender.";
	$code= "3";
}
elseif($email == "" ){
	$error= "error : Please enter your email.";
	$code= "4";
}
elseif(!checkEmail($email)){
	$error= "error : Please Enter your valid email ID.";
	$code= "4";
	unset($email);	
}	
elseif(checkExistence($email,$type)){
	$error= "error : There is an existing account associated with this Email.";
	$code= "4";
	unset($email);	
}	
elseif($pass =="" ){
	$error= "error : Please type your new password.";
	$code= "5";
}
elseif($cpass =="" ){
	$error= "error : Please retype your new password.";
	$code= "6";
}
elseif($cpass!==$pass){
	$error= "error : Password mismatch! Please Re-enter Password.";
	unset($cpass);	
	unset($pass);	
	$code= "5";
}
elseif($permission =="" ){
	$error= "error : you did not select permission.";
	$code= "7";
}

else{
//processing form content

	require_once './includes/db_config.php';
	connect();
	$query1 = "insert into admin values('','$fname','$lname','$gender','$email','$pass','$permission','$date')";
	$result1=mysql_query($query1);
	if($result1){
	 echo "<script> alert('New Account is Created.') </script>" ;
	 echo "<script> window.location='index.php'</script>";

	}else{
			echo"Oops! Something went wrong!";
		}
  }
 
 
}
?>	

<table class="main-table">
<form name='form1' method='GET' action="admin_acc_settings2.php">
	<tr>
		<td colspan="2"><center></br></br>
			<input type='text' name='email' size='70' placeholder='Enter Email'>
			<input type='submit' name='search'  value='Search'>
			<input type='submit' name='view' value='View All'></center>
		</td>
	</tr>
	<tr><td colspan=2><br/><div class="hr"><hr /></div><br/></td></tr>
</form>
<form name='form2' method='post' action="">	
	<tr><td colspan=2><h2>Create New Admin</h2></td></tr>
	<tr>
		<td colspan=2><?php if(isset($error)){ echo'<p class=message >' .$error. ' <br></p>';}?></td>
	</tr>
	<tr>
		<td>*First Name</td>&nbsp;
		<td><input type='text' name='fname' size=40 placeholder='Enter first name' value="<?php if(isset($fname)){echo $fname;} ?>" <?php if(isset($code) && $code ==1){echo "class=error" ;} ?> ></td>
	</tr>
	<tr>
		<td>*Last Name</td>&nbsp;
		<td><input type='text' name='lname' size=40 placeholder='Enter last name' value="<?php if(isset($lname)){echo $lname;} ?>" <?php if(isset($code) && $code ==2){echo "class=error" ;} ?> ></td>
	</tr>
	<tr>
        <td>&nbsp;Gender</td>&nbsp;
        <td>
			<select name="gender" <?php if(isset($code) && $code ==3){echo "class=error" ;} ?>>
				<Option value="">Select</Option>	
				<option value="1" <?php if(isset($gender) && $gender ==1){echo "selected";}?>>Male</option>  
				<option value="2" <?php if(isset($gender) && $gender ==2){echo "selected";}?>>Female</option>   
			</select>
		</td> 		
    </tr>
	<tr>
		<td>*Email</td>&nbsp;
		<td><input type='text' name='email' size=40 placeholder='Your email' value="<?php if(isset($email)){echo $email;} ?>" <?php if(isset($code) && $code ==4){echo "class=error" ;} ?> ></td>
	</tr>
	<tr>
		<td>*New Password</td>&nbsp;
		<td><input type='password' name='pass' size=40 placeholder='Type new password' value="<?php if(isset($pass)){echo $pass;} ?>" <?php if(isset($code) && $code ==5){echo "class=error" ;} ?> ></td>
	</tr>
	<tr>
		<td>*Confirm Password</td>&nbsp;
		<td><input type='password' name='cpass' size=40 placeholder='Retype new password' value="<?php if(isset($cpass)){echo $cpass;} ?>" <?php if(isset($code) && $code ==6){echo "class=error" ;} ?> ></td>
	</tr>
	<tr>
        <td>&nbsp;*Permission</td>&nbsp;
        <td>
			<select name="permission" <?php if(isset($code) && $code ==7){echo "class=error" ;} ?>>
				<option value="">Select</option>	
				<option value="1" <?php if(isset($permission) && $permission ==1){echo "selected";}?>>Owner</option>  
				<option value="0" <?php if(isset($permission) && $permission ==0){echo "selected";}?>>Admin</option>   
			</select>
		</td> 		
    </tr>
	<tr><td colspan=2><br/><div class="hr"><hr /></div><br/></td></tr>
	<tr>
		<td colspan=2><strong>Note: </strong>Owner is a superior user with full privileges whereas Admin is a standard user with some privileges.</td>
	</tr>
	<tr>
		<td colspan=2><input type='submit' name='create' value='Create'></td>
	</tr>
</table>
</form>

<!-- end content -->

<!-- footer -->

<?php include('./includes/footer.php');?>