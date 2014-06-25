<?php
//============================================================+
// File name   : notific_action.php
//
// Description : This file let the user to take actions upon each notification .
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
if(isset($_SESSION['li_uname222'])){
	$e=$_SESSION['li_uname222'];
	$type=2;
	$title="Task Poster";
	require_once './includes/db_config.php';
	connect();
	$rs=mysql_query("select * from poster_profile where email ='".$e."' ");
	$rw=mysql_fetch_array($rs);
	$pname=$rw['fname'];	
}
elseif(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";
}
else{
	header('location:login.php');die; //kill script & jump to login page
}
?>
<?php
function accept($apid,$wname,$wemail,$pname,$e,$gen){      //Accept offer
require_once './includes/db_config.php';
connect();
$r3 = mysql_query("update task_applied set accepted_flag=1, accepted_date=now() where id='".$apid."' ")or die(mysql_error());

	if($r3){
		//send mail
		  require_once './includes/mail.php';
		  $obj = new mail();                        
		  $url="http://eztasker.com/";
		  $from=$e;
		  $to = $wemail;
		  $subject = "Your Task Offer is accepted on EasyTask";
		  $message='<html>
							<head>
								<title>EasyTask</title>
							</head>
						<body>
							<br><p>Hi '.$wname.',<br><br>
							'.$gen.' '.$pname.' has accepted your offer for his task posted on EasyTask. <br>
							Please login your account at <a href='.$url.'>EasyTask</a> and view notifications.<br><br>
							Best Regards,<br>
							EasyTask Team</p>	
						</body>
					</html>';
		  
			 if ($obj->mail_sender($from,$to, $subject, $message)){
					echo "<script> alert('offer accepted') </script>" ;
					echo "<script>window.location='./'</script>" ;
				}else{ 
						echo "<p>Oops! problem sending mail!</p>";
				}				
	}else{
		echo "<script> alert('Oops somthing went wrong') </script>" ;
		echo "<script>window.location='./')</script>" ;
	}
}

function decline($apid){      //Rejected offer
require_once './includes/db_config.php';
connect();
$r3 = mysql_query("delete from task_applied where id='".$apid."' ")or die(mysql_error());

	if($r3){
		echo "<script> alert('offer rejected') </script>" ;
		echo "<script>window.location='./'</script>" ;
	}else{
		echo "<script> alert('Oops somthing went wrong') </script>" ;
		echo "<script>window.location='./')</script>" ;
	}
}
function read($apid){      //Read notification for accepted offer 
require_once './includes/db_config.php';
connect();
$r3 = mysql_query("update task_applied set read_flag=1 where id='".$apid."' ")or die(mysql_error());
if($r3){
	echo "<script>window.location='job_apply_history1.php'</script>" ;
}else{
		echo "<script> alert('Oops somthing went wrong') </script>" ;
		echo "<script>window.location='./')</script>" ;
	}
}
?>

<?php  
//accept offer
if(isset($_GET['apid']) && isset($_GET['action1'])&& isset($_GET['wi'])){ 
       $apid=$_GET['apid'];         // applied id
       $wid=$_GET['wi'];           // worker id
	   $r=mysql_query("select * from worker_profile where worker_id=$wid");
	   $row=mysql_fetch_array($r);
	   $wname=$row['fname'];
	   $wemail=$row['email'];
	   $gender=$row['gender'];
	   if($gender==1){$gen="Mr.";}else{$gen="Ms.";}
	   $_GET['action1']($apid,$wname,$wemail,$pname,$e,$gen);       // call to both function with parameter.
}
//decline offer
elseif(isset($_GET['apid']) && isset($_GET['action2'])){ 
       $apid=$_GET['apid'];         // applied id
	   $_GET['action2']($apid);  
}
//read accepted offer	
elseif(isset($_GET['apid']) && isset($_GET['action'])){ 
       $apid=$_GET['apid'];         // applied id
	   $_GET['action']($apid);  
}	

?>