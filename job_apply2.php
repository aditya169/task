<?php
session_start();
if(isset($_SESSION['li_uname333'])){
	$e=$_SESSION['li_uname333'];
	$type=3;
	$title="Task Worker";
	require_once './includes/db_config.php';
	connect();
	$q = "SELECT worker_id,fname,lname,gender,address,telephone FROM   worker_profile WHERE  email='".$e."'";		   
	$r=mysql_query($q) or die(mysql_error());
	$row = mysql_fetch_array($r);
	//gathering worker's data
	$worker_id= $row['worker_id'];
	$wname=$row['fname'];
	$gender=$row['gender'];
	if($gender==1){$gen="Mr.";} elseif($gender==2){$gen="Ms.";}
}else{
		header('location:login.php');die;//redirect to login page
}
?>

<?php
$formElement = 	$_REQUEST;
$poster_id =  	$formElement['pid']; 
$pname =  	    $formElement['fname']; 
$pemail =  	    $formElement['email']; 
//task details
$task_id =  	$formElement['task_id']; 
$comment=  		$formElement['comment'];
$today = 		mktime(0,0,0,date("m"),date("d"),date("Y"));
$applied_date = date("m/d/y", $today);

//save the applied tasks into dB.	
require_once './includes/db_config.php';
connect();

    $q9 = "select task_id, worker_id from task_applied where task_id='".$task_id."' &&   worker_id='".$worker_id."' ";
	$r9=mysql_query($q9) or die(mysql_error());
	if (mysql_num_rows($r9) > 0) {
	 echo "<script> alert('You have already applied for this post.') </script>" ;
	 echo "<script>window.location='index.php'</script>" ;die;
	} 
   else{
		$query1= "insert into task_applied values('','$task_id','$poster_id','$worker_id','$comment','$applied_date','0','0','0')";
		$result1=mysql_query($query1);
	
	if($result1){
		//send mail
		  require_once './includes/mail.php';
		  $obj = new mail();  
		  $url="http://eztasker.com/";
		  $from=$e;
		  $to = $pemail;
		  $subject = "EasyTask: A Candidate made offer for your task. ";
		  $message='<html>
							<head>
								<title>EasyTask</title>
							</head>
						<body>
							<br><p>Hi '.$pname.',<br/><br/>
							'.$gen.' '.$wname.' is made offer for the task you posted on EasyTask.<br>
							Please login your account at <a href='.$url.'>EasyTask</a> and view notifications.<br><br>
							Best Regards,<br>
							EasyTask</p>	
						</body>
					</html>';
		  
			 if ($obj->mail_sender($from,$to, $subject, $message)){
						echo "<script> alert('You have applied for this post.') </script>" ;
						echo "<script>window.location='index.php'</script>" ;
				}else{ 
						echo "<p>Oops! problem sending mail!</p>";
				}				
		}
}
?>	