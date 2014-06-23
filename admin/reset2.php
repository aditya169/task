<?php 
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

function goback(){
	echo'<br/><br/><a class="hyper" href="./login.php">&nbsp; &nbsp;Back to login page</a><br/><br/></div><br/><br/>';
}

function checkEmail($email){
   $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    if (preg_match($pattern, trim(strip_tags($email)))){
        return true;	
    } else {
            return false;		
        }
}

if(isset($_GET['email']))
{
	$email=$_GET['email'];
	$email=preg_replace( '/\s+/','',$email);
	if($email==""){
		unset($email);
		form();
		goback();
		include('./includes/footer.php');die;
	}	
	if(!checkEmail($email)){
		form();
		goback();
		include('./includes/footer.php');die;
		
	}	
}	
	
$tp=trim($_GET['tp']);

function form(){
echo'
<form action="reset2.php" method="get">
	<table class="login-table"  height="200">
		<tr>
			<td colspan=3><h3 class="err">Please enter your valid email address to receive an email with the link to reset your password !</h3><br/></td>
		</tr>

		<tr>
			<td>Your Email Address<span class="imp">*</span> </td>
			<td><input type="text" name="email" placeholder="Your Email" size="40"></td>
		</tr>
		
		<td>Your Role<span class="imp">*</span> </td>
		<td>
			<select name="tp" >
				<option value="3">Task Worker &nbsp;&nbsp;</option>
				<option value="2">Task Poster &nbsp;&nbsp;</option>
			</select>
		
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="submit" value="Reset" /></td>
		</tr>
		<tr><td></td></tr>
	</table>
</form> ';
}	


function getRandomString($length) {
    $validCharacters = "ABCDEFGHIJKLMNPQRSTUXYVWZ123456789";
    $validCharNumber = strlen($validCharacters);
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
	return $result;
}


function mailresetlink($to,$token,$tp){
$url = 'taurustrip.com/projectjob';	//$url='http://'. $_SERVER['http_host'];
$subject = "Forgot Password on TaskMaster";
$message = '					
<html>
	<head>
		<title>Forgot Password For TaskMaster.</title>
	</head>
	<body>
	<p><b>Forgot password for TaskMaster</b></p><br>
	<p>Click on the given link to reset your password <br><br><br>
	'.$url.'/reset3.php?token='.$token.'&tp='.$tp.' <br><br><br>
	If above link doesn\'t work, copy & paste the link in address bar.<br><br>
    Regards,<br>
    TaskMaster Team </p>
	</body>
</html> ';

		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From:" ."kapilsubhash2009@gmail.com" . "\r\n";
	if(mail($to,$subject,$message,$headers)){
	echo'<table class="main-table" border=1 rules="all" bgcolor="lightpink">
		<tr><td>
			<p>We have sent the password reset link to your email id  <b>'.$to.'</b></p>
		</td></tr>
		</table><br><br><br><br><br>';
		
	}
}


switch($tp)
{

	case '1':
	require_once './includes/db_config.php';
	connect();
	$q="select email from admin where email='".$email."'";
	$r=mysql_query($q);
	$n=mysql_num_rows($r);
	if($n==0){
		form(); 
		echo '<br><table class="main-table" border=1 rules="all" bgcolor="lightyellow">
				<tr><td> Email id is not registered</td></tr>
			 </table>';
		goback();
		include('./includes/footer.php');die;
	
	}
	$token=getRandomString(10);
	$q="insert into tokens(token,email,role) values ('".$token."','".$email."','1')";
	mysql_query($q);
	if(isset($_GET['email'])){
		mailresetlink($email,$token,$tp);
	}
	break;


	case '2':
	require_once './includes/db_config.php';
	connect();
	$q="select email from poster_profile where email='".$email."'";
	$r=mysql_query($q);
	$n=mysql_num_rows($r);
	if($n==0){
		form(); 
		echo '<br><table border=1 rules="all" bgcolor="lightyellow">
				<tr><td> Email id is not registered</td></tr>
			 </table>';
		goback();
		include('./includes/footer.php');die;
		
	}
	$token=getRandomString(10);
	$q="insert into tokens(token,email,role) values ('".$token."','".$email."','2')";
	mysql_query($q);
	if(isset($_GET['email'])){
		mailresetlink($email,$token,$tp);
	}
	break;


	case '3':
	require_once './includes/db_config.php';
	connect();
	$q="select email from worker_profile where email='".$email."'";
	$r=mysql_query($q);
	$n=mysql_num_rows($r);
	if($n==0){
		form(); 
		echo '<br><table  border=1 rules="all" bgcolor="lightyellow">
				<tr><td> Email id is not registered</td></tr>
			 </table>';
		goback();
		include('./includes/footer.php');die;
		
	}
	$token=getRandomString(10);
	$q="insert into tokens(token,email,role) values ('".$token."','".$email."','3')";
	mysql_query($q);
	if(isset($_GET['email'])){
		mailresetlink($email,$token,$tp);
	}
}
   
?>   

<br/><br/>
<!-- footer -->
<?php include('./includes/footer.php');?>