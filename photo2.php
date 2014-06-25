<?php
//============================================================+
// File name   : photo2.php
//
// Description : This file shows each task photo.
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
}
elseif(isset($_SESSION['li_uname222'])){
}
elseif(isset($_SESSION['li_uname333'])){
}
else{
}
?>
<html>
<link href="css/geometry.css" rel="stylesheet" type="text/css" />
<body><br>
<a href='javascript:history.go(-1)'><img src="images/back4.png" width="8%" height="4%"></a><br>   	   	   

<?php function frame($n){ ?>	
<center>
	<iframe class="photo-iframe" src="task-photos/<?php echo $n;?>" scrolling="no"></iframe>
</center>	
<?php } ?>

<?php
if(isset($_REQUEST['v'])){
	$ti=trim($_REQUEST['v']);
	$task_id=$ti;
	
	require_once './includes/db_config.php';
	connect();
	$q = "select * from photos where task_id='".$task_id."' ";
	$result=mysql_query($q) or die(mysql_error());
	if (mysql_num_rows($result)>0) {
		while($row = mysql_fetch_array($result)){
			//echo "<img src=task-photos/".$row['name']."><br>";
			$n=$row['name'];
			frame($n);
		}
	}else{
			echo "<script>history.go(-1)</script>" ;
		}
}else{echo "<script>history.go(-1)</script>" ;}
?>
</body>
</html>