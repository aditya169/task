<?php
session_start();
$e='';
$type=0;
?>

<!-- Header -->
<?php include('./includes/header.php');?>
 <div class="">
	<!-- Menus -->
	<?php include './includes/menu.php';?> 
  </div>
  <div class="spacer"></div>
</div>

<br/><br/>
<div id="container" class="ltr">

<header id="header" class="info">
	<br/><h2>&nbsp;&nbsp;Reset Password</h2>
</header>



<?php
$token=$_GET['token'];                     
$tp=trim($_GET['tp']);
require_once './includes/db_config.php';
connect();

if(!isset($_POST['pass'])){
	
	$q="SELECT email
		FROM  tokens 
		WHERE token ='".$token."' 
		AND used=0 
		AND role= '".$tp."'";
	
	$r=mysql_query($q);
	if($r){
	while($row=mysql_fetch_array($r)){
		$email=$row['email'];
	}
	}
	If ($email!=''){
          $_SESSION['email']=$email;
	}
	else {
		
		echo'
		<br><br><br><br>
		<center><table bgcolor="lightyellow">
		<tr><td>
			<p>Invalid link or Password already changed.</p>
		</td></tr>
		</table><br><br><br><br><br><br>
		</center></div><br/><br/>';
		include('./includes/footer.php');die;
	}
}

$email=$_SESSION['email'];

function form($email){
	
	echo'
	<form method="post">
	<h2>&nbsp;We have successfully verified your identity.</h2>
	<hr width="100%" size=1 color="lightblue"><br/><br/>
	<p>&nbsp;Your password should be at least 6 characters long & contain alphanumeric characters(a-z and 0-9).</p><br><br>
	<table class="login-table">
		<tr>
			<td>Email:</td>
			<td>'.$email.'</td>
		</tr>
		<tr>
			<td>*New password:</td>
			<td><input type="password" name="pass" size=30 placeholder="Your new password" /></td>
		</tr>
		<tr>
			<td>*Confirm password:</td>
			<td><input type="password" name="cnfrm_pass" size=30 placeholder="Confirm new password"/></td>
		</tr>
		<tr>
			 <td></td>
			<td><input type="submit" value="Set New Password"></td>
		</tr>
	<table>
</form>';

}


if(isset($_POST['pass'])){
	$pass=$_POST['pass'];
	$pass=preg_replace( '/\s+/','',$pass);
	if($pass==""){
		unset($pass);
		form($email);
		echo'
		<br><table class="" border=1 rules="" bgcolor="lightyellow">
			<tr><td>
			<p> &nbsp;Please enter new password.&nbsp;</p>
			</td></tr>
		</table></div><br/><br/>';
		include('./includes/footer.php');die;	
	}
}

if(isset($_POST['cnfrm_pass']))
{
	$cnfrm_pass = $_POST['cnfrm_pass'];
	$cnfrm_pass = preg_replace( '/\s+/','',$cnfrm_pass);
	if($cnfrm_pass==""){
		unset($cnfrm_pass);
		form($email);
		echo'
		<br><center><table  bgcolor="lightyellow">
			<tr><td>
			<p> &nbsp;Please Re-enter new password.&nbsp;</p>
			</td></tr>
		</table></center></div><br/><br/>';
			include('./includes/footer.php');die;
	}	
	if($cnfrm_pass!=$pass){
		unset($cnfrm_pswd);
		form($email);
		echo'
		<br><center><table bgcolor="lightyellow">
			<tr><td>
			<p> &nbsp;Password mismatch! Please Re-enter Password &nbsp;</p>
			</td></tr>
		</table></center></div><br/><br/>';
		include('./includes/footer.php');die;
	}	
}


if(isset($_POST['pass'])&& isset($_SESSION['email']))
{
	switch($tp)
	{
	
	case '1':
	
	$q="update  admin set password='".$pass."', pass_changed=NOW() where email='".$email."'";
	$r=mysql_query($q);
	if($r)mysql_query("update tokens set used=1 where token='".$token."'");
	
	echo'<h2>Success!</h2>
		 <br><br><br><br>
		<center><table bgcolor="lightpink">
		<tr><td>
			<p>You have successfully created a new password.Click<a href="./admin/"> <b>here to login </b></a>with your new password.</p>
		</td></tr>
		</table><br/><br/><br/><br/></center>
		</div><br/><br/>';
		
	if(!$r)echo "An error occurred.";
	include('./includes/footer.php');
	break;
	
	

	case '2':
	
	$q="update  poster_profile set password='".$pass."' where email='".$email."'";
	$r=mysql_query($q);
	if($r)mysql_query("update tokens set used=1 where token='".$token."'");
	
	echo'<h2>Success!</h2>
		 <br><br><br><br>
		<center><table bgcolor="lightpink">
		<tr><td>
			<p>You have successfully created a new password.Click<a href="login.php"> <b>here to login </b></a>with your new password.</p>
		</td></tr>
		</table><br/><br/><br/><br/></center>
		</div><br/><br/>';
		
	if(!$r)echo "An error occurred.";
	//include('./includes/footer.php');
	break;
	
	
	
	case '3':
	
	$q="update  worker_profile set password='".$pass."' where email='".$email."'";
	$r=mysql_query($q);
	if($r)mysql_query("update tokens set used=1 where token='".$token."'");
	include('./includes/header.php');
	echo'<h2>Success!</h2>
		 <br><br><br><br>
		<center><table  bgcolor="lightpink">
		<tr><td>
			<p>You have successfully created a new password.Click<a href="login.php"> <b>here to login </b></a>with your new password.</p>
		</td></tr>
		</table><br/><br/><br/><br/></center>
		</div><br/><br/>';
	if(!$r){echo "An error occurred.";}
	//include('./includes/footer.php');
	
}	
if(isset($_SESSION['email'])){
		session_destroy();
	}
	
}

if(!isset($pass)){
	form($email);
	include('./includes/footer.php');die;
}
?>



</div>
<br/><br/>
<!-- footer -->
<?php include('./includes/footer.php');?>