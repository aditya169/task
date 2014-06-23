<?php
//needed parameters-> email,type,permission.
 if($e!==''){
	require_once 'db_config.php';
	require_once("./includes/configure.php");

	connect();
	if($type==1){
		$permission=$_SESSION['li_permission111'];
		if($permission==1){$title="Admin (Owner)";}
		if($permission==0){$title="Admin Panel";}
	
		$q ="SELECT fname from admin where email ='".$e."' ";
	}
	elseif($type==2){
		$q ="SELECT fname ,address FROM  poster_profile WHERE  email ='".$e."' ";	 	 
	}
	elseif($type==3){
		$q ="SELECT fname, address FROM  worker_profile where email ='".$e."' ";	 
	}
	if(isset($q)){
		$r=mysql_query($q) or die(mysql_error());
		if($r){ 
			while($row=mysql_fetch_array($r)){
				$firstname=$row['fname'];
				if($type==2 || $type==3){
					$loc=$row['address'];	
				}
			}
		}	
	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>EasyTask</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta name="keywords" content="" />
<meta name="description" content="" />
<base href="http://eztasker.com/" />
<link href="./css/geometry.css" rel="stylesheet" />
<link href="./css/form.css" rel="stylesheet" />
<link href="./css/structure.css" rel="stylesheet" />
<!-- JQuery lib-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<!-- for Google Auto-address Form-->

<body onload="initialize()">

<div class="header">

  <div class="topstrip">
   <div class="logo"></div>
  	<?php if($type==0){?>	
		<div class="links"> <a class="white" href="login.php">Sign In</a></div>	
	<?php } ?>
	
	<?php if($e!=""){ ?>
	<div class="links"> Hi&nbsp;<?php echo $firstname;?>,&nbsp;<a>|</a>&nbsp;Logged In as:&nbsp;<?php echo $e;?>&nbsp;<a>|</a>&nbsp;<?php if($type==1){?> <a class="white" href="./admin/logout.php">Log Out</a>  <?php }else{ ?> <a class="white" href="<?php echo $logoutURL; ?>">Log Out</a>  <?php }?></div>	

	<?php } ?>

  </div>
  
 